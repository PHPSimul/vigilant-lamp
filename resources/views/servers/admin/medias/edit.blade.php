@extends('layouts.admin')

@section('title', 'Modifier un Média')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">🎨 Modifier le Média</h1>
        <a href="{{ route('game.servers.admin.medias.list', ['server' => $server->id]) }}" class="btn btn-secondary">
            ⬅ Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('game.servers.admin.medias.update', ['server' => $server->id, 'media' => $media->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Clé de traduction -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Clé de Traduction :</label>
                    <input type="text" name="trans_key" value="{{ old('trans_key', $media->trans_key) }}" class="form-control" required>
                </div>

                <!-- Aperçu du fichier actuel -->
                @if($media->path)
                <div class="mb-3 text-center">
                    <label class="form-label fw-bold d-block">Aperçu du Média :</label>
                    <img src="{{ asset('storage/' . $media->path) }}" alt="Aperçu du média" class="img-thumbnail" style="max-width: 200px;">
                </div>
                @endif

                <!-- Bouton d'enregistrement -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        💾 Enregistrer les modifications
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
