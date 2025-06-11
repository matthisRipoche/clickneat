<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerOrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('id', $user->restaurant_id)->first();
        $commandes = Order::where('restaurant_id', $restaurant->id)->whereNotIn('status', ['cart'])->get();

        return view('manager.commandes.index', [
            'user' => $user,
            'restaurant' => $restaurant,
            'commandes' => $commandes
        ]);
    }

    public function show($id)
    {
        $commande = Order::with('orderItems.item')->findOrFail($id);
        $restaurant = Restaurant::where('id', $commande->restaurant_id)->first();

        return view('manager.commandes.show', [
            'commande' => $commande,
            'restaurant' => $restaurant
        ]);
    }

    public function edit($id)
    {
        $commande = Order::with('orderItems.item')->findOrFail($id);
        $restaurant = Restaurant::where('id', $commande->restaurant_id)->first();

        return view('manager.commandes.edit', [
            'commande' => $commande,
            'restaurant' => $restaurant
        ]);
    }

    public function update(Request $request, $id)
    {
        $commande = Order::findOrFail($id);
        $commande->name = $request->name;
        $commande->reserved_at = $request->reserved_at;
        $commande->status = $request->status;
        $commande->save();

        return redirect()->route('manager.commandes.index');
    }
}
