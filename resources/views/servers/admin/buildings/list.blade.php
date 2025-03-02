@extends('layouts.admin')

@section('title', 'Liste des Bâtiments')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">🏰 Liste des bâtiments</h1>
        <a href="{{ route('game.servers.admin.buildings.create', ['server' => $server->id]) }}"
           class="btn btn-primary">
            ➕ Ajouter un Bâtiment
        </a>
    </div>

    <!-- Formulaire de filtrage -->
    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par clé ou valeur"
    oninput="filterTable()" />

    <div class="table-responsive table-container">
        <table class="table table-hover" id="searchTable">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Descr</th>
                    <th>Min Level</th>
                    <th>Default Level</th>
                    <th>Max Level</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buildings as $building)
                <tr>
                    <td>{{ $building->name }}</td>
                    <td>{{ $building->description }}</td>
                    <td>{{ $building->min_level }}</td>
                    <td>{{ $building->default_level }}</td>
                    <td>{{ $building->max_level }}</td>
                    <td class="text-center">
                        <a href="{{ route('game.servers.admin.buildings.view', ['server' => $server->id, 'building' => $building->id]) }}" class="btn btn-info btn-sm">
                            📄 Détails
                        </a>
                        <a href="{{ route('game.servers.admin.buildings.edit', ['server' => $server->id, 'building' => $building->id]) }}"
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
            let nameCell = rows[i].getElementsByTagName("td")[0]; // The 'key' cell
            let descCell = rows[i].getElementsByTagName("td")[1]; // The 'value' cell


            if (nameCell && descCell) {
                let keyText = nameCell.textContent || nameCell.innerText;
                let valueText = descCell.textContent || descCell.innerText;

                // If the key or value contains the search query, display the row, otherwise hide it
                if (keyText.toLowerCase().includes(searchInput) || valueText.toLowerCase().includes(searchInput)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection
