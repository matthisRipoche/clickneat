@extends('layout.manager.main')

@section('main')
    <h1>Creation restaurant</h1>

    <a href="{{ route('manager.index') }}">Retour à la liste</a>

    <form action="{{ route('manager.storeRestaurant') }}" method="POST">
        @csrf
        <label for="name">Nom : </label>
        <input type="text" id="name" name="name" placeholder="Nom">
        <button type="submit">Envoyer</button>
    </form>
@endsection