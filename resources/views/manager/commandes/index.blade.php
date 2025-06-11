@extends('layout.manager.main')

@section('main')
    <h1>Commandes</h1>
    
    <main class="main">
        <div class="row">
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="d-none d-xl-table-cell">Nom</th>
                                <th class="d-none d-xl-table-cell">User</th>
                                <th class="d-none d-xl-table-cell">Date et Heure</th>
                                <th class="d-none d-xl-table-cell">Prix Total</th>
                                <th class="d-none d-xl-table-cell">Status</th>
                                <th class="d-none d-xl-table-cell">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($commandes as $commande)
                                <tr>
                                    <td>{{ $commande->id }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $commande->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $commande->user->name }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $commande->reserved_at }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $commande->total_price / 100 }} €</td>
                                    <td class="d-none d-xl-table-cell">{{ $commande->status }}</td>
                                    <td>
                                        <div style="display: flex;">
                                            <a style="margin-right: 8px;" href="{{ route('manager.commandes.show', $commande->id) }}">Voir</a>
                                            <a style="margin-right: 8px;" href="{{ route('manager.commandes.edit', $commande->id) }}">Modifier</a>
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



