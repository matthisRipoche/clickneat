@extends('layout.main')

@section('main')
    <h1>Category</h1>

    <a href="{{ route('categories.index') }}">Retour à la liste</a>
    <a href="{{ route('categories.create') }}">Créer un restaurant</a>

    <ul>
        <li>id : {{ $category->id }}</li>
        <li>nom : {{ $category->name }}</li>
        <li>created_at : {{ $category->created_at }}</li>
        <li>updated_at : {{ $category->updated_at }}</li>
    </ul>

    <h2>Restaurant : {{ $category->restaurant->name }}</h2>

    <a href="{{ route('restaurants.show', $category->restaurant->id) }}" title="Voir le restaurant">Aller au restaurant {{ $category->restaurant->name }}</a>

    <h2>Items</h2>

    <ul>
        @foreach($category->items as $item)
            <li>
                <a href="{{ route('items.show', $item->id) }}" title="Voir l'item">{{ $item->name }}</a>
            </li>
        @endforeach
    </ul>
    
@endsection