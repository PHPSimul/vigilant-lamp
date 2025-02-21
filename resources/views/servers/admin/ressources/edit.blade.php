@extends('layouts.admin')

@section('title', 'Modifier la Ressource')

@section('content')
<div class="container">
    <h1 class="fw-bold">📦 Modifier la Ressource du Serveur</h1>

    <form action="{{ route('game.servers.admin.ressources.update', ['server' => $server->id, 'ressource' => $ressource->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="trans_key" class="form-label">Clé de la Traduction :</label>
            <input type="text" name="trans_key" id="trans_key" value="{{ old('trans_key', $ressource->trans_key) }}" class="form-control" required disabled>
        </div>
        @if ($medias == null || $medias->isEmpty())
            <div class="alert alert-warning">
                Aucun média n'est disponible pour le moment.
            </div>
        @else

        <div class="mb-4">
            <label for="media_id" class="form-label">Média Associé :</label>
            <select name="media_id" id="media_id" class="form-control">
                @foreach($medias as $media)
                    <option value="{{ $media->id }}" {{ $media->id == $ressource->media_id ? 'selected' : '' }}>
                        {{ $media->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @endif
        <button type="submit" class="btn btn-warning">
            Mettre à Jour la Ressource
        </button>
    </form>
</div>
@endsection
