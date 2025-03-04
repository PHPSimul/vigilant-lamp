@extends('layouts.admin')

@section('title', 'Ajouter une Entité a la node')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 fw-bold">➕ Ajouter une Entité</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('game.servers.admin.nodes.entities.store', ['server' => $server->id, 'node' => $node->id]) }}">
                @csrf

                <div class="mb-3">
                    <label for="entity_type" class="form-label">Type d'Entité</label>
                    <select id="entity_type" name="entity_type" class="form-select" required>
                        <option value="App\Models\ServerRessource">ServerRessource</option>
                        <option value="App\Models\ServerBuilding">ServerBuilding</option>

                    </select>
                </div>

                <div class="mb-3">
                    <label for="entity_id" class="form-label">ID de l'Entité</label>
                    <select id="entity_id" name="entity_id" class="form-select" required>
                        @foreach($server->serverRessources as $entity)
                            <option value="{{ $entity->id }}" class="entity_option" data-type="App\Models\ServerRessource" data-type-filter="App\Models\ServerRessource">[Ressources] {{ $entity->trans_key }}</option>
                        @endforeach
                        @foreach($server->serverBuildings as $entity)
                            <option value="{{ $entity->id }}" class="entity_option" data-type="App\Models\ServerBuilding" data-type-filter="App\Models\ServerBuilding">[Building] {{ $entity->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Contenu</label>
                    <textarea id="content" name="content" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">💾 Ajouter</button>
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

@section('scripts')
<script>
    // Fonction pour filtrer les options basées sur le type sélectionné
    document.getElementById('entity_type').addEventListener('change', function() {
        var selectedType = this.value; // Récupère le type sélectionné
        var entityOptions = document.querySelectorAll('#entity_id .entity_option'); // Récupère toutes les options d'entité

        entityOptions.forEach(function(option) {
            // Si l'option correspond au type sélectionné, on l'affiche
            if (option.getAttribute('data-type-filter') === selectedType) {
                option.style.display = 'block';
            } else {
                option.style.display = 'none'; // Sinon, on la cache
            }
        });
    });
</script>
@endsection
