@extends('layout.admin.main')

@section('main')
    <h1>Détail de l'utilisateur #{{ $user->id }}</h1>

    <p>
        <a href="{{ route('users.index') }}">⬅️ Retour à la liste</a>
    </p>

    <main class="main">
        <div class="row">
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Informations générales</h5>
                    </div>
                    <div class="card-body">
                        <table class="table my-0">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Nom</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Rôle</th>
                                    <td>{{ $user->role }}</td>
                                </tr>
                                <tr>
                                    <th>Créé le</th>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                                <tr>
                                    <th>Mis à jour le</th>
                                    <td>{{ $user->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Historique des commandes</h5>
                    </div>
                    <div class="card-body">
                        @if($user->orders->count())
                            <ul class="list-unstyled">
                                @foreach($user->orders as $order)
                                    <li>
                                        <a href="{{ route('commandes.show', $order->id) }}">{{ $order->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Aucune commande passée.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
