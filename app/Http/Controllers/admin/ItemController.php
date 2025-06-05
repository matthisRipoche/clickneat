<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        return view('dashboard.items.index', [
            'items' => Item::with('category')->get()
        ]);
    }

    public function create()
    {
        return view('dashboard.items.create', [
            'categories' => Category::all()
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

        return redirect()->route('items.index');
    }

    public function edit($id)
    {
        return view('dashboard.items.edit', [
            'item' => Item::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $restaurant = Item::findOrFail($id);

        $restaurant->name = $request->get('name');
        $restaurant->category_id = $request->get('category_id');
        $restaurant->save();

        return redirect()->route('items.index');
    }

    public function show($id)
    {
        return view('dashboard.items.show', [
            'item' => Item::findOrFail($id),
            'categories' => Category::all()
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->get('id') == $id) {
            Item::destroy($id);
        }
        return redirect()->route('items.index');
    }
}
