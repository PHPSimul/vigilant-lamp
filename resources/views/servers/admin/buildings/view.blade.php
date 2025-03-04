@extends('layouts.admin')

@section('title', 'Détails du bâtiment')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 fw-bold">🌿 Détails du bâtiment</h1>

    <!-- Infos principales de la node -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Informations du batiment
        </div>
        <div class="card-body">
            <p><strong>ID du bâtiment :</strong> {{ $building->id }}</p>
            <p><strong>Nom du bâtiment :</strong> {{ $building->name }}</p>
            <p><strong>Description du bâtiment :</strong> {{ $building->description }}</p>
            <p><strong>Niveau minimum du bâtiment :</strong> {{ $building->min_level }}</p>
            <p><strong>Niveau maximum du bâtiment :</strong> {{ $building->max_level }}</p>
            <p><strong>Niveau de base du bâtiment :</strong> {{ $building->default_level }}</p>
        </div>
    </div>

    <!-- Coûts par niveau et ressource -->
    <x-building-costs :building="$building" />

    <!-- Bouton Retour -->
    <div class="mt-4">
        <a href="{{ route('game.servers.admin.buildings.list', ['server' => $server->id]) }}" class="btn btn-outline-secondary">
            ⬅️ Retour à la liste des buildings
        </a>
    </div>
</div>
@endsection
