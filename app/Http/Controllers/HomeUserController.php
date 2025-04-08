<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;

class HomeUserController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $restaurants = Restaurant::all();

        return view('user.index', [
            'user' => $user,
            'restaurants' => $restaurants,
        ]);
    }

    public function restaurantchoosen($id)
    {
        $user = Auth::user();
        $restaurants = Restaurant::with(['categories', 'items'])->get();
        $selectedRestaurant = Restaurant::with('items')->find($id);

        return view('user.restaurantchoosen', [
            'user' => $user,
            'restaurants' => $restaurants,
            'selectedRestaurant' => $selectedRestaurant,
            'categories' => $selectedRestaurant->categories,
        ]);
    }

    public function cart()
    {
        $user = Auth::user();
        $cart = $user->cart;
        return view('user.cart', [
            'user' => $user,
            'cart' => $cart,
        ]);
    }
}
