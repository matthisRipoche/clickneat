@extends('layout.main')

@section('main')
    <h1>Items</h1>

    <a href="{{ route('items.create') }}">Créer un item</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Category</th>
                <th>Restaurant</th>
                <th>Actif ?</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>{{ $item->category->restaurant->name }}</td>
                    <td>{{ $item->active ? 'Oui' : 'Non' }}</td>
                    <td>
                        <div style="display: flex;">
                            <a style="margin-right: 8px;" href="{{ route('items.show', $item->id) }}">Voir</a>
                            <a style="margin-right: 8px;" href="{{ route('items.edit', $item->id) }}">Modifier</a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <button type="submit">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>    
@endsection