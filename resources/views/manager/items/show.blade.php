@extends('layout.manager.main')

@section('main')
    <h1>Item</h1>

    <a href="{{ route('manager.items.index') }}">Retour à la liste</a>
    <a href="{{ route('manager.items.create') }}">Créer un item</a>

    <ul>
        <li>id : {{ $item->id }}</li>
        <li>nom : {{ $item->name }}</li>
        <li>price : {{ $item->price/100 }}€</li>
        <li>cost : {{ $item->cost/100 }}€</li>
        <li>created_at : {{ $item->created_at }}</li>
        <li>updated_at : {{ $item->updated_at }}</li>
    </ul>

    <h2>Category : {{ $item->category->name }}</h2>

    <a href="{{ route('manager.categories.show', $item->category->id) }}" title="Voir la catégorie">Aller à la catégorie {{ $item->category->name }}</a>
    
    <h2>Restaurant : {{ $item->category->restaurant->name }}</h2>
    <a href="{{ route('manager.index') }}" title="Voir le restaurant">Aller au restaurant {{ $item->category->restaurant->name }}</a>
@endsection