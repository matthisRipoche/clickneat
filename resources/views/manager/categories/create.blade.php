@extends('layout.manager.main')

@section('main')
<h1>Creer une Categorie</h1>
<a href="{{ route('manager.categories.index') }}">Retour à la liste</a>

<form action="{{ route('manager.categories.store') }}" method="POST">
    @csrf
    <div>
        <label for="name">Nom : </label>
        <input type="text" id="name" name="name" placeholder="Nom">
    </div>

    <button type="submit">Envoyer</button>
</form>
@endsection