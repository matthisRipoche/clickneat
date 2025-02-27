@extends('layout.main')

@section('main')
    <h1>Restaurants</h1>

    <a href="{{ route('restaurants.create') }}">Créer un restaurant</a>

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
                            @foreach($restaurants as $restaurant)
                                <tr>
                                    <td>{{ $restaurant->id }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $restaurant->name }}</td>
                                    <td>
                                        <div style="display: flex;">
                                            <a style="margin-right: 8px;" href="{{ route('restaurants.show', $restaurant->id) }}">Voir</a>
                                            <a style="margin-right: 8px;" href="{{ route('restaurants.edit', $restaurant->id) }}">Modifier</a>
                                            <form action="{{ route('restaurants.destroy', $restaurant->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="{{ $restaurant->id }}">
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