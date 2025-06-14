@extends('layout.manager.main')

@section('main')
    <h1>Modification Category</h1>

    <a href="{{ route('manager.items.index') }}">Retour à la liste</a>

    <form action="{{ route('manager.items.update', $item->id) }}" method="POST">
        @csrf
        @method('put')
        <div>
            <label for="name">Nom : </label>
            <input type="text" id="name" name="name" placeholder="Nom" value="{{ $item->name }}">
        </div>
        <div>
            <label for="price">Price : </label>
            <input type="text" id="price" name="price" placeholder="Price" value="{{ $item->price }}">
        </div>
        <div>
            <label for="cost">Cost : </label>
            <input type="text" id="cost" name="cost" placeholder="Cost" value="{{ $item->cost }}">
        </div>

        <div>
            <label for="category_id">Categorie</label>
            <select name="category_id" id="category_id">
                @foreach ($categories as $category)
                    @if ($category->id === $item->category_id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div>
            <label for="is_active">Actif ?</label>
            <input type="checkbox" id="is_active" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }}>
        </div>

        <button type="submit">Envoyer</button>
    </form>
@endsection