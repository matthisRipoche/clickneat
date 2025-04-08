@extends('layout.admin.main')

@section('main')
    <h1>Utilisateurs</h1>

    <a href="#">Créer un utilisateur</a>

    <main class="main">
        <div class="row">
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="d-none d-xl-table-cell">Nom</th>
                                <th class="d-none d-xl-table-cell">Email</th>
                                <th class="d-none d-xl-table-cell">Rôle</th>
                                <th class="d-none d-xl-table-cell">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $user->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $user->email }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $user->role }}</td>
                                    <td>
                                        <div style="display: flex;">
                                            <a style="margin-right: 8px;" href="{{ route('users.show', $user->id) }}">Voir</a>
                                            <a style="margin-right: 8px;" href="#">Modifier</a>
                                            <form action="#" method="POST">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="{{ $user->id }}">
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