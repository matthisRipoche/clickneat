<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerCategoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('id', $user->restaurant_id)->get()->first();
        return view('manager.categories.index', [
            'restaurant' => $restaurant,
            'categories' => Category::where('restaurant_id', $restaurant->id)->get()
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('id', $user->restaurant_id)->get()->first();

        return view('manager.categories.create', [
            'user' => $user,
            'restaurant' => $restaurant
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $restaurant = Restaurant::where('id', $user->restaurant_id)->get()->first();

        $category = new Category();

        $category->name = $request->get('name');
        $category->restaurant_id = $restaurant->id;
        $category->save();

        return redirect()->route('manager.categories.index');
    }

    public function edit($id)
    {
        return view('manager.categories.edit', [
            'category' => Category::findOrFail($id),
            'restaurant' => Restaurant::where('id', $id)->get()->first()
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->name = $request->get('name');
        $category->save();

        return redirect()->route('manager.categories.index');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('manager.categories.show', [
            'category' => $category,
            'restaurant' => Restaurant::where('id', $category->restaurant_id)->get()->first()
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->get('id') == $id) {
            Category::destroy($id);
        }
        return redirect()->route('manager.categories.index');
    }
}
