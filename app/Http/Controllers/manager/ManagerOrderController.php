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
        $commandes = Order::where('restaurant_id', $restaurant->id)->where('status', 'finished')->get();

        return view('manager.commandes.index', [
            'user' => $user,
            'restaurant' => $restaurant,
            'commandes' => $commandes
        ]);
    }

    public function show($id)
    {
        $commande = Order::with('orderItems.item')->findOrFail($id);

        return view('manager.commandes.show', [
            'commande' => $commande
        ]);
    }
}
