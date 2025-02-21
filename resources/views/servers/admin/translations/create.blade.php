@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-3xl font-semibold mb-4">Ajouter une Traduction</h1>

    <!-- Formulaire avec Bootstrap -->
    <form action="{{ route('game.servers.admin.translations.store', ['server' => $server->id]) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="trans_key" class="form-label">Clé de la Traduction :</label>
            <input type="text" id="trans_key" name="trans_key" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="trans_value" class="form-label">Valeur :</label>
            <input type="text" id="trans_value" name="trans_value" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="trans_lang" class="form-label">Langue :</label>
            <input type="text" id="trans_lang" name="trans_lang" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a href="{{ route('game.servers.admin.translations.list', ['server' => $server->id]) }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </form>
</div>
@endsection
