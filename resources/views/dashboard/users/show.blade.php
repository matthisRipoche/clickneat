@extends('layout.admin.main')

@section('main')
    <h1>Utilisateurs</h1>

    <a href="{{ route('users.index') }}">Retour à la liste</a>
    <a href="#">Créer un utilisateur</a>

    <ul>
        <li>id : {{ $user->id }}</li>
        <li>nom : {{ $user->name }}</li>
        <li>email : {{ $user->email }}</li>
        <li>role : {{ $user->role }}</li>
        <li>created_at : {{ $user->created_at }}</li>
        <li>updated_at : {{ $user->updated_at }}</li>
    </ul>

    <h2>Commandes historique</h2>
    <ul>
        @foreach($user->orders as $order)
            <li>
                <a href="{{ route('commandes.show', $order->id) }}">{{ $order->name }}</a>
            </li>
        @endforeach
    </ul>
@endsection