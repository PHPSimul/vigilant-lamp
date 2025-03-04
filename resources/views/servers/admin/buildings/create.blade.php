@extends('layouts.admin')
@section('title', 'Ajouter un Bâtiment')

@section('content')
<div class="container">
    <h1 class="text-3xl font-semibold mb-4">Ajouter un Bâtiment</h1>

    <!-- Formulaire de création d'une configuration -->
    <form action="{{ route('game.servers.admin.buildings.store', ['server' => $server->id]) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="form-label">Clé de traduction du nom du bâtiment :</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="descr" class="form-label">Clé de traduction de la description du bâtiment :</label>
            <input type="text" id="descr" name="descr" class="form-control" required>
        </div>

        <div class="mb-4">
            <label for="min_level" class="form-label">Niveau minimal du bâtiment :</label>
            <input type="number" id="min_level" name="min_level" min="0" class="form-control" step="1" required>
        </div>

        <div class="mb-4">
            <label for="max_level" class="form-label">Niveau maximal du bâtiment :</label>
            <input type="number" id="max_level" name="max_level" min="1" class="form-control" step="1" required>
        </div>

        <div class="mb-4">
            <label for="default_level" class="form-label">Niveau par defaut du bâtiment :</label>
            <input type="number" id="default_level" name="default_level" min="0" class="form-control" step="1" required>
        </div>



        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('game.servers.admin.buildings.list', ['server' => $server->id]) }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
