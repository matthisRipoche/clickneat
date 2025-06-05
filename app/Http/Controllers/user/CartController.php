<?php

namespace App\Http\Controllers\user;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;


class CartController extends Controller
{
    public function addItemToCart(Request $request)
    {
        // Récupération de l'utilisateur connecté
        $user = Auth::user();

        // Récupération ou création de la commande en cours
        $currentOrder = Order::with('orderItems.item')
            ->where('user_id', $user->id)
            ->where('restaurant_id', $request->restaurant_id)
            ->where('status', 'cart')
            ->first();

        // trouver les commande avec le status cart qui ont un restaurant id different de la request
        $otherRestaurantOrders = Order::where('user_id', $user->id)
            ->where('status', 'cart')
            ->where('restaurant_id', '!=', $request->restaurant_id)
            ->get();
        foreach ($otherRestaurantOrders as $order) {
            $order->delete();
        }


        if (!$currentOrder) {
            $currentOrder = Order::create([
                'name' => now()->format('Y-m-d H:i:s') . ' : Commande de ' . $user->name,
                'user_id' => $user->id,
                'restaurant_id' => $request->restaurant_id,
                'total_price' => 0,
                'reserved_at' => now(),
                'status' => 'cart',
            ]);
        }

        // Récupération de l'item (une seule fois)
        $item = Item::findOrFail($request->item_id);

        //if item already exist add quantity
        $existingItem = $currentOrder->orderItems()->where('item_id', $item->id)->first();
        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
            $currentOrder->updateTotalPrice();
            return redirect()->route('home_user.restaurantchoosen', $request->restaurant_id);
        }

        // Création de l'item dans la commande
        $currentOrder->orderItems()->create([
            'order_id' => $currentOrder->id,
            'item_id' => $item->id,
            'quantity' => $request->quantity,
            'price' => $item->price,
            'name' => $item->name,
            'cost' => $item->cost,
        ]);

        $currentOrder->updateTotalPrice();

        return redirect()->route('home_user.restaurantchoosen', $request->restaurant_id);
    }

    public function removeItemFromCart(Request $request)
    {
        $orderItem = OrderItem::findOrFail($request->id);
        $orderItem->delete();
        $orderItem->order->updateTotalPrice();
        return redirect()->route('home_user.cart');
    }

    public function incrementQuantity(Request $request, $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->quantity++;
        $orderItem->save();
        $orderItem->order->updateTotalPrice();
        return redirect()->route('home_user.cart');
    }

    public function decrementQuantity(Request $request, $id)
    {
        if ($request->quantity <= 1) {
            return redirect()->route('home_user.cart');
        }
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->quantity--;
        $orderItem->save();
        $orderItem->order->updateTotalPrice();
        return redirect()->route('home_user.cart');
    }

    public function resetCart(Request $request)
    {
        $user = Auth::user();
        $cart = Order::where('user_id', $user->id)
            ->where('status', 'cart')
            ->first();

        if ($cart) {
            $cart->orderItems()->delete();
            $cart->updateTotalPrice();
        }

        return redirect()->route('home_user.cart');
    }

    public function CartToOrder(Request $request)
    {
        $user = Auth::user();
        $cart = Order::where('user_id', $user->id)
            ->where('status', 'cart')
            ->first();

        if (!$cart) {
            return redirect()->route('home_user.cart');
        }

        $cart->status = 'finished';
        $cart->save();

        return redirect()->route('home_user.cart');
    }
}
