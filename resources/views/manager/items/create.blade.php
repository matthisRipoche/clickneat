@extends('layout.manager.main')

@section('main')
<h1>Creer un item</h1>
<a href="{{ route('manager.items.index') }}">Retour à la liste</a>

<form action="{{ route('manager.items.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nom : </label>
        <input type="text" id="name" name="name" placeholder="Nom">
    </div>
    <div>
        <label for="price">Price : </label>
        <input type="text" id="price" name="price" placeholder="Price">
    </div>
    <div>
        <label for="cost">Cost : </label>
        <input type="text" id="cost" name="cost" placeholder="Cost">
    </div>
    <div>
        <label for="category_id">Categorie</label>
        <select name="category_id" id="category_id">
            <option value="" selected>Choisir une Catégorie</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Envoyer</button>
</form>
@endsection