<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Item;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerItemController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('id', $user->restaurant_id)->first();

        // Get items that belong to categories in the restaurant
        $items = Item::whereHas('category', function ($query) use ($restaurant) {
            $query->where('restaurant_id', $restaurant->id);
        })->get();

        return view('manager.items.index', [
            'user' => $user,
            'restaurant' => $restaurant,
            'items' => $items
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('id', $user->restaurant_id)->first();

        return view('manager.items.create', [
            'user' => $user,
            'restaurant' => $restaurant,
            'categories' => Category::where('restaurant_id', $restaurant->id)->get()
        ]);
    }

    public function store(Request $request)
    {
        $item = new Item();

        $item->name = $request->get('name');
        $item->category_id = $request->get('category_id');
        $item->price = $request->get('price');
        $item->cost = $request->get('cost');
        $item->save();

        return redirect()->route('manager.items.index');
    }

    public function edit($id)
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('id', $user->restaurant_id)->first();
        return view('manager.items.edit', [
            'item' => Item::findOrFail($id),
            'categories' => Category::where('restaurant_id', $restaurant->id)->get(),
            'restaurant' => $restaurant
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        $item->name = $request->get('name');
        $item->category_id = $request->get('category_id');
        $item->price = $request->get('price');
        $item->cost = $request->get('cost');
        $item->save();

        return redirect()->route('manager.items.index');
    }

    public function show($id)
    {
        return view('manager.items.show', [
            'item' => Item::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->get('id') == $id) {
            Item::destroy($id);
        }
        return redirect()->route('manager.items.sindex');
    }
}
