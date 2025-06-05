<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('dashboard.commandes.index', [
            'commandes' => Order::all()
        ]);
    }

    public function show($id)
    {
        $commande = Order::with('orderItems.item')->findOrFail($id);

        return view('dashboard.commandes.show', [
            'commande' => $commande
        ]);
    }
}
