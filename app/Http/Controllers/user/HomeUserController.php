<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\User;

class HomeUserController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $cart = Order::with('orderItems.item')->where('user_id', $user->id)->where('status', 'cart')->first();
        return view('user.index', [
            'user' => Auth::user(),
            'restaurants' => Restaurant::all(),
            'cart' => $cart,
        ]);
    }

    public function restaurantchoosen($id)
    {
        $user = Auth::user();
        $restaurants = Restaurant::with(['categories', 'items'])->get();
        $selectedRestaurant = Restaurant::with('items', 'categories')->find($id);

        if (!$selectedRestaurant) {
            abort(404, 'Restaurant non trouvé');
        }

        $cart = Order::with('orderItems.item')->where('user_id', $user->id)->where('status', 'cart')->first();

        return view('user.restaurantchoosen', [
            'user' => $user,
            'restaurants' => $restaurants,
            'selectedRestaurant' => $selectedRestaurant,
            'categories' => $selectedRestaurant->categories,
            'cart' => $cart,
        ]);
    }

    public function cart()
    {
        $user = Auth::user();
        $cart = Order::with('orderItems.item')->where('user_id', $user->id)->where('status', 'cart')->first();

        return view('user.cart', [
            'user' => $user,
            'cart' => $cart,
        ]);
    }
}
