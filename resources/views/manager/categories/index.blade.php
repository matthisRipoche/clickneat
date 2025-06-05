@extends('layout.manager.main')

@section('main')
    <h1>Categories</h1>

    <a href="{{ route('manager.categories.create') }}">Créer une catégorie</a>

    <div class="main">
        <div class="row">   
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="d-none d-xl-table-cell">Nom</th>
                                <th class="d-none d-xl-table-cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $category->name }}</td>
                                    <td>
                                        <div style="display: flex;">
                                            <a style="margin-right: 8px;" href="{{ route('manager.categories.show', $category->id) }}">Voir</a>
                                            <a style="margin-right: 8px;" href="{{ route('manager.categories.edit', $category->id) }}">Modifier</a>
                                            <form action="{{ route('manager.categories.destroy', $category->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="{{ $category->id }}">
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