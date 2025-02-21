@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="text-3xl font-semibold mb-4">Modifier la Configuration</h1>

    <!-- Formulaire de modification de la configuration -->
    <form action="{{ route('game.servers.admin.configurations.update', ['server' => $server->id, 'configuration' => $configuration->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="key" class="form-label">Clé :</label>
            <input type="text" id="key" name="key" value="{{ old('key', $configuration->key) }}" class="form-control" required disabled>
        </div>

        <div class="mb-4">
            <label for="value" class="form-label">Valeur :</label>
            <input type="text" id="value" name="value" value="{{ old('value', $configuration->value) }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Mettre à Jour</button>
        <a href="{{ route('game.servers.admin.configurations.list', ['server' => $server->id]) }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
