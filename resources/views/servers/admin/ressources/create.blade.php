@extends('layouts.admin')

@section('title', 'Ajouter une Ressource')

@section('content')
<div class="container">
    <h1 class="fw-bold">📦 Ajouter une Ressource au Serveur</h1>

    <form action="{{ route('game.servers.admin.ressources.store', ['server' => $server->id]) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="trans_key" class="form-label">Clé de la Traduction :</label>
            <input type="text" name="trans_key" id="trans_key" class="form-control" required>
        </div>

        @if ($medias == null || $medias->isEmpty())
            <div class="alert alert-warning">
                Aucun média n'est disponible pour le moment.
            </div>
        @else
        <div class="mb-4">
            <label for="media_id" class="form-label">Média Associé :</label>
            <select name="media_id" id="media_id" class="form-control">
                <option value="">Sélectionner un Média</option>
                @foreach($medias as $media)
                    <option value="{{ $media->id }}">{{ $media->name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <button type="submit" class="btn btn-success">
            Enregistrer la Ressource
        </button>
    </form>
</div>
@endsection
