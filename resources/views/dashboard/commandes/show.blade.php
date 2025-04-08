@extends('layout.admin.main')

@section('main')
    <h1>Commandes</h1>

    <a href="{{ route('commandes.index') }}">Retour à la liste</a>
    
    <ul>
        <li>id : {{ $commande->id }}</li>
        <li>nom : {{ $commande->name }}</li>
        <li>restaurant : {{ $commande->restaurant->name }}</li>
        <li>user : {{ $commande->user->name }}</li>
        <li>total_price : {{ $commande->total_price }}</li>
        <li>reserved_at : {{ $commande->reserved_at }}</li>
        <li>status : {{ $commande->status }}</li>
        <li>created_at : {{ $commande->created_at }}</li>
        <li>updated_at : {{ $commande->updated_at }}</li>
    </ul>

    <h2>Items</h2>
    
    <ul>
        @foreach($commande->orderItems as $orderItem)
            <li>
                <a href="{{ route('items.show', $orderItem->item->id) }}">{{ $orderItem->item->name }}</a>
                <span>{{ $orderItem->quantity }}</span>
            </li>
        @endforeach
    </ul>

@endsection