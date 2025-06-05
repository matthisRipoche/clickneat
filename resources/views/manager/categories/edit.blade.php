@extends('layout.manager.main')

@section('main')
    <h1>Modification Category</h1>

    <a href="{{ route('manager.categories.index') }}">Retour à la liste</a>

    <form action="{{ route('manager.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('put')
        <div>
            <label for="name">Nom : </label>
            <input type="text" id="name" name="name" placeholder="Nom" value="{{ $category->name }}">
        </div>
        <button type="submit">Envoyer</button>
    </form>
@endsection