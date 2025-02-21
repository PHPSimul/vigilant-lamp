@extends('layouts.admin')

@section('title', 'Liste des Médias')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">🖼️ Gestion des Médias</h1>
        <a href="{{ route('game.servers.admin.medias.create', ['server' => $server->id]) }}" 
           class="btn btn-primary">
            ➕ Ajouter un Média
        </a>
    </div>

    <div class="table-responsive table-container">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Clé de traduction</th>
                    <th>Prévisualisation</th>
                    <th>Chemin</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medias as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->trans_key }}</td>
                    <td>
                        @if(in_array(pathinfo($item->path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ Storage::url($item->path) }}" alt="{{ $item->name }}" class="img-thumbnail" width="50">
                        @else
                            <span class="badge bg-secondary">Aperçu non disponible</span>
                        @endif
                    </td>
                    <td>{{ $item->path }}</td>
                    <td class="text-center">
                        <a href="{{ route('game.servers.admin.medias.edit', ['server' => $server->id, 'media' => $item->id]) }}" 
                           class="btn btn-warning btn-sm">
                            ✏️ Modifier
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
