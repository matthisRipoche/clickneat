<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        return view('dashboard.categories.index', [
            'categories' => Category::with('restaurant')->get()
        ]);
    }

    public function create()
    {
        return view('dashboard.categories.create', [
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
        return view('dashboard.categories.edit', [
            'category' => Category::findOrFail($id),
            'restaurants' => Restaurant::all()
        ]);
    }

    /**
     * Met à jour une catégorie existante avec les données fournies.
     *
     * Cette méthode récupère une catégorie par son ID, met à jour son nom et son restaurant associé,
     * puis la sauvegarde en base de données.
     *
     * @param \Illuminate\Http\Request $request La requête HTTP contenant les données à mettre à jour (name, restaurant_id)
     * @param int $id L'identifiant de la catégorie à modifier
     * @return \Illuminate\Http\RedirectResponse Redirige vers la liste des catégories après mise à jour
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException Si aucune catégorie n’est trouvée avec l’ID fourni
     */
    public function update(Request $request, $id)
    {
        // Récupère la catégorie via son ID ou échoue avec une 404
        $category = Category::findOrFail($id);

        // Met à jour les champs à partir des données reçues
        $category->name = $request->get('name');
        $category->restaurant_id = $request->get('restaurant_id');

        // Sauvegarde les modifications
        $category->save();

        // Redirige vers la vue index des catégories
        return redirect()->route('categories.index');
    }


    public function show(Request $request, $id)
    {
        return view('dashboard.categories.show', [
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
