@extends('layout.main')

@section('main')
<h1>Creer une Categorie</h1>
<a href="{{ route('categories.index') }}">Retour à la liste</a>

<form action="{{ route('categories.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nom : </label>
        <input type="text" id="name" name="name" placeholder="Nom">
    </div>
    <div>
        <label for="restaurant_id">Restaurant</label>
        <select name="restaurant_id" id="restaurant_id">
            <option value="">Choisir un restaurant</option>
            @foreach ($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}">{{ $restaurant->name }}</option>
            @endforeach
        </select>
    </div>

    <button type="submit">Envoyer</button>
</form>
@endsection