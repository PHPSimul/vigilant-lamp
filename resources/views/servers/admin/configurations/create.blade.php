@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-3xl font-semibold mb-4">Ajouter une Configuration</h1>

    <!-- Formulaire de création d'une configuration -->
    <form action="{{ route('game.servers.admin.configurations.store', ['server' => $server->id]) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="key" class="form-label">Clé :</label>
            <input type="text" id="key" name="key" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="value" class="form-label">Valeur :</label>
            <input type="text" id="value" name="value" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('game.servers.admin.configurations.list', ['server' => $server->id]) }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
