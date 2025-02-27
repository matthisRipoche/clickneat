@extends('layout.main')

@section('main')
    <h1>Categories la vie de fou  le .yml y marche</h1>

    <a href="{{ route('categories.create') }}">Créer une catégorie</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $categorie)
                <tr>
                    <td>{{ $categorie->id }}</td>
                    <td>{{ $categorie->name }}</td>
                    <td>
                        <div style="display: flex;">
                            <a style="margin-right: 8px;" href="{{ route('categories.show', $categorie->id) }}">Voir</a>
                            <a style="margin-right: 8px;" href="{{ route('categories.edit', $categorie->id) }}">Modifier</a>
                            <form action="{{ route('categories.destroy', $categorie->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $categorie->id }}">
                                <button type="submit">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    
@endsection