<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class StripeCheckoutController extends Controller
{
    /**
     * Crée une session de paiement Stripe pour un panier donné.
     *
     * Cette méthode prend un ID de panier en paramètre, récupère les infos associées,
     * puis génère une session de paiement Stripe en utilisant le montant total du panier.
     *
     * @param \Illuminate\Http\Request $request La requête HTTP contenant l'ID du panier (cart_id)
     * @return \Illuminate\Http\JsonResponse Retourne l'ID de la session Stripe en JSON
     *
     * @throws \Illuminate\Validation\ValidationException Si le paramètre cart_id est manquant ou invalide
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si aucun panier n'est trouvé avec cet ID
     */
    public function createCheckoutSession(Request $request)
    {
        // Valide la présence et le type du paramètre cart_id
        $validated = $request->validate([
            'cart_id' => 'required|numeric',
        ]);

        // Récupère le panier via l'ID
        $cart = Order::findOrFail($validated['cart_id']);
        $cart_name = $cart->name;
        $cart_price = $cart->total_price;
        // Initialise Stripe avec la clé secrète définie dans config/services.php
        Stripe::setApiKey(config('services.stripe.secret'));

        // Crée une session de paiement Stripe avec les infos du panier
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => $cart_name,
                    ],
                    'unit_amount' => $cart_price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('cart.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cart.checkout.cancel'),
        ]);

        // Retourne l'ID de la session Stripe au frontend
        return response()->json(['id' => $session->id]);
    }


    public function success(Request $request)
    {
        $user = Auth::user();

        // Récupère la commande "cart" de l'utilisateur
        $order = Order::where('user_id', $user->id)
            ->where('status', 'cart')
            ->first();

        // Vérifie qu'on a bien une commande à valider
        if (!$order) {
            return redirect()->route('home_user.index')->with('error', 'Aucune commande trouvée à valider.');
        }

        // Met à jour le statut de la commande
        $order->status = 'finished';
        $order->reserved_at = now();
        $order->save();

        return redirect()->route('home_user.index')->with('success', 'Commande validée avec succès.');
    }


    public function cancel(Request $request)
    {
        return view('user.stripe.cancel');
    }
}
