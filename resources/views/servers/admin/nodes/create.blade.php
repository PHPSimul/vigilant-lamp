@extends('layouts.admin')

@section('title', 'Ajouter un Nœud')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">➕ Ajouter une node</h1>
        <a href="{{ route('game.servers.admin.nodes.list', ['server' => $server->id]) }}" class="btn btn-secondary">
            ⬅ Retour à la liste
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('game.servers.admin.nodes.store', ['server' => $server->id]) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Type de Propriétaire :</label>
                    <select name="owner_type" class="form-control">
                        <option value="App\Models\ServerUser">Joueur</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">ID Propriétaire :</label>
                    <input type="number" name="owner_id" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    💾 Enregistrer
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
