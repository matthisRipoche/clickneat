@extends('layout.manager.main')

@section('main')
    <h1>Modification Commande</h1>

    <a href="{{ route('manager.commandes.index') }}">Retour à la liste</a>

    <form action="{{ route('manager.commandes.update', $commande->id) }}" method="POST">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="name">Nom : </label>
            <input type="text" id="name" name="name" placeholder="Nom" value="{{ $commande->name }}">
        </div>
        <div class="form-group">
            <label for="reserved_at">Réservation : </label>
            <input type="datetime-local" id="reserved_at" name="reserved_at" value="{{ $commande->reserved_at }}">
        </div>
        <div class="form-group">
            <label for="status">Status : </label>
            <select name="status" id="status">
                <option value="waiting" {{ $commande->status === 'waiting' ? 'selected' : '' }}>En attente</option>
                <option value="in_progress" {{ $commande->status === 'in_progress' ? 'selected' : '' }}>En cours</option>
                <option value="finished" {{ $commande->status === 'finished' ? 'selected' : '' }}>Terminé</option>
                <option value="canceled" {{ $commande->status === 'canceled' ? 'selected' : '' }}>Annulé</option>
            </select>
        </div>
        <button type="submit">Envoyer</button>
    </form>
@endsection