@extends('layouts.admin')

@section('title', 'Modifier une Entité de la node')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 fw-bold">✏️ Modifier une Entité de la node</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('game.servers.admin.nodes.entities.update', ['server' => $server->id, 'node' => $node->id, 'entity' => $entity->id]) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="entity_type" class="form-label">Type d'Entité</label>
                    <select id="entity_type" name="entity_type" class="form-select" required>
                        <option value="App\Models\ServerRessource" {{ $entity->entity_type == 'App\Models\ServerRessource' ? 'selected' : '' }}>ServerRessource</option>
                        <option value="App\Models\ServerBuilding" {{ $entity->entity_type == 'App\Models\ServerBuilding' ? 'selected' : '' }}>ServerBuilding</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="entity_id" class="form-label">ID de l'Entité</label>
                    <input type="text" id="entity_id" name="entity_id" class="form-control" value="{{ $entity->entity_id }}" required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea id="content" name="content" class="form-control" rows="3" required>{{ $entity->content }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">💾 Mettre à jour</button>
            </form>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('game.servers.admin.nodes.view', ['server' => $server->id, 'node' => $node->id]) }}" class="btn btn-secondary">
            ⬅️ Retour
        </a>
    </div>
</div>
@endsection
