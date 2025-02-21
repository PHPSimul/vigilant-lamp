@extends('layouts.admin')

@section('title', 'Liste des Traductions')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">📜 Traductions du Serveur</h1>
        <a href="{{ route('game.servers.admin.translations.create', ['server' => $server->id]) }}" 
           class="btn btn-primary">
            ➕ Ajouter une Traduction
        </a>
    </div>

    <!-- Formulaire de filtrage -->
    <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par clé ou valeur" 
    oninput="filterTable()" />

    <div class="table-responsive table-container">
        <table class="table table-hover" id="searchTable">
            <thead class="table-dark">
                <tr>
                    <th>Clé</th>
                    <th>Valeur</th>
                    <th>Langue</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($translations as $translation)
                <tr>
                    <td>{{ $translation->trans_key }}</td>
                    <td>{{ $translation->trans_value }}</td>
                    <td>{{ strtoupper($translation->trans_lang) }}</td>
                    <td class="text-center">
                        <a href="{{ route('game.servers.admin.translations.edit', ['server' => $server->id, 'translation' => $translation->id]) }}" 
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
            let valueCell = rows[i].getElementsByTagName("td")[1]; // The 'value' cell
            
            if (keyCell && valueCell) {
                let keyText = keyCell.textContent || keyCell.innerText;
                let valueText = valueCell.textContent || valueCell.innerText;
                let langCell = rows[i].getElementsByTagName("td")[2]; // The 'lang' cell

                // If the key or value contains the search query, display the row, otherwise hide it
                if (keyText.toLowerCase().includes(searchInput) || valueText.toLowerCase().includes(searchInput) || langCell.textContent.toLowerCase().includes(searchInput)) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection