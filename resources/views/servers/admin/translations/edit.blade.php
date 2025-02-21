@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-3xl font-semibold mb-4">Modifier la Traduction</h1>

    <!-- Formulaire avec Bootstrap -->
    <form action="{{ route('game.servers.admin.translations.update', ['server' => $server->id, 'translation' => $translation->id]) }}" method="POST">
        @csrf
        @method('PUT') <!-- Méthode PUT pour la mise à jour -->

        <div class="mb-4">
            <label for="trans_key" class="form-label">Clé de la Traduction :</label>
            <input type="text" id="trans_key" name="trans_key" value="{{ old('trans_key', $translation->trans_key) }}" class="form-control" required disabled>
        </div>

        <div class="mb-4">
            <label for="trans_value" class="form-label">Valeur :</label>
            <input type="text" id="trans_value" name="trans_value" value="{{ old('trans_value', $translation->trans_value) }}" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="trans_lang" class="form-label">Langue :</label>
            <input type="text" id="trans_lang" name="trans_lang" value="{{ old('trans_lang', $translation->trans_lang) }}" class="form-control" required disabled>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-success">Mettre à Jour</button>
            <a href="{{ route('game.servers.admin.translations.list', ['server' => $server->id]) }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </form>
</div>
@endsection