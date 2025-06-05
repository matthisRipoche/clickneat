<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;

use App\Models\Item;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeManagerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('id', $user->restaurant_id)->get()->first();

        if (!$restaurant) {
            return view('manager.createRestaurant', [
                'user' => $user,
                'restaurant' => $restaurant
            ]);
        }

        $items = Item::whereHas('category', function ($query) use ($restaurant) {
            $query->where('restaurant_id', $restaurant->id);
        })->get();


        $orders = Order::where('restaurant_id', $restaurant->id)->get();

        return view('manager.index', [
            'user' => $user,
            'restaurant' => $restaurant,
            'orders' => $orders,
            'items' => $items
        ]);
    }

    public function storeRestaurant(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);



        $restaurant = new Restaurant();
        $restaurant->name = $request->name;
        $restaurant->save();

        $user = Auth::user();
        User::where('id', $user->id)->update([
            'restaurant_id' => $restaurant->id
        ]);

        return redirect()->route('manager.index');
    }
}
