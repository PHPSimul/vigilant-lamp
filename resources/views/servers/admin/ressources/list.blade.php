@extends('layouts.admin')

@section('title', 'Liste des Ressources')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">📦 Ressources du Serveur</h1>
        <a href="{{ route('game.servers.admin.ressources.create', ['server' => $server->id]) }}" 
           class="btn btn-primary">
            ➕ Ajouter une Ressource
        </a>
    </div>

    <!-- Formulaire de filtrage -->
    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par clé" oninput="filterTable()" />

    <div class="table-responsive table-container">
        <table class="table table-hover" id="searchTable">
            <thead class="table-dark">
                <tr>
                    <th>Clé de Traduction</th>
                    <th>Média Associé</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ressources as $ressource)
                <tr>
                    <td>{{ $ressource->trans_key }}</td>
                    <td>{{ optional($ressource->media)->name ?? 'Aucune ressource média' }}</td>
                    <td class="text-center">
                        <a href="{{ route('game.servers.admin.ressources.edit', ['server' => $server->id, 'ressource' => $ressource->id]) }}" 
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

@section('scripts')
<script>
    function filterTable() {
        let searchInput = document.getElementById("searchInput").value.toLowerCase();
        let rows = document.getElementById("searchTable").getElementsByTagName("tr");

        // Loop through all rows and hide those that don't match the search query
        for (let i = 1; i < rows.length; i++) {  // Start from 1 to skip the table header
            let keyCell = rows[i].getElementsByTagName("td")[0]; // The 'key' cell
            
            if (keyCell) {
                let keyText = keyCell.textContent || keyCell.innerText;

                if (keyText.toLowerCase().indexOf(searchInput) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection
