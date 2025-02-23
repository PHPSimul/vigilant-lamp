@extends('layouts.admin')

@section('title', 'Modifier un Nœud')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">✏️ Modifier le Nœud</h1>
        <a href="{{ route('game.servers.admin.nodes.list', ['server' => $server->id]) }}" class="btn btn-secondary">
            ⬅ Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('game.servers.admin.nodes.update', ['server' => $server->id, 'node' => $node->id]) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Nom du Nœud :</label>
                    <input type="text" name="name" value="{{ old('name', $node->name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Type de Propriétaire :</label>
                    <input type="text" name="owner_type" value="{{ old('owner_type', $node->owner_type) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">ID Propriétaire :</label>
                    <input type="number" name="owner_id" value="{{ old('owner_id', $node->owner_id) }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Position :</label>
                    <input type="number" name="position" value="{{ old('position', $node->position) }}" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    💾 Mettre à jour
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
