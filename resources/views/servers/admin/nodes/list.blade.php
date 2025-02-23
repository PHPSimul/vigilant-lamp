@extends('layouts.admin')

@section('title', 'Liste des nodes du Serveur')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">🌐 node du Serveur</h1>
        <a href="{{ route('game.servers.admin.nodes.create', ['server' => $server->id]) }}" class="btn btn-primary">
            ➕ Ajouter une node
        </a>
    </div>

    <!-- Champ de recherche -->
    <input type="text" id="search" class="form-control mb-3" placeholder="Rechercher une node...">

    <div class="table-responsive table-container">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Type de Propriétaire</th>
                    <th>ID Propriétaire</th>
                    <th>Position</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody id="nodeTable">
                @foreach($nodes as $node)
                <tr>
                    <td>{{ $node->name }}</td>
                    <td>{{ $node->owner_type ?? 'N/A' }}</td>
                    <td>{{ $node->owner_id ?? 'N/A' }}</td>
                    <td>{{ $node->position }}</td>
                    <td class="text-center">
                        <a href="{{ route('game.servers.admin.nodes.edit', ['server' => $server->id, 'node' => $node->id]) }}" class="btn btn-warning btn-sm">
                            ✏️ Modifier
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('search').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#nodeTable tr');

        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
