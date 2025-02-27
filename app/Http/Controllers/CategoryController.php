<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::with('restaurant')->get()
        ]);
    }

    public function create()
    {
        return view('categories.create', [
            'restaurants' => Restaurant::all()
        ]);
    }

    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->get('name');
        $category->restaurant_id = $request->get('restaurant_id');
        $category->save();

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        return view('categories.edit', [
            'category' => Category::findOrFail($id),
            'restaurants' => Restaurant::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->name = $request->get('name');
        $category->restaurant_id = $request->get('restaurant_id');
        $category->save();

        return redirect()->route('categories.index');
    }

    public function show(Request $request, $id)
    {
        return view('categories.show', [
            'category' => Category::findOrFail($id),
            'restaurants' => Restaurant::all()
        ]);
    }

    public function destroy(Request $request, $id)
    {
        if ($request->get('id') == $id) {
            Category::destroy($id);
        }
        return redirect()->route('categories.index');
    }
}
