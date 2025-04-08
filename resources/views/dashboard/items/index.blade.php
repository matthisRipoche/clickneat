@extends('layout.admin.main')

@section('main')
    <h1>Items</h1>

    <a href="{{ route('items.create') }}">Créer un item</a>
    
    <main class="main">
        <div class="row">
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="d-none d-xl-table-cell">Nom</th>
                                <th class="d-none d-xl-table-cell">Category</th>
                                <th class="d-none d-xl-table-cell">Restaurant</th>
                                <th class="d-none d-xl-table-cell">Actif ?</th>
                                <th class="d-none d-xl-table-cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $item->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $item->category->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $item->category->restaurant->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $item->active ? 'Oui' : 'Non' }}</td>
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
                </div>
            </div>
        </div>
    </main>
@endsection



