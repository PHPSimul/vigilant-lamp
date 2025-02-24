@extends('layouts.admin')

@section('title', 'Détails de la node')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4 fw-bold">🌿 Détails de la node</h1>

    <!-- Infos principales de la node -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            Informations de la node
        </div>
        <div class="card-body">
            <p><strong>ID de la node :</strong> {{ $node->id }}</p>
            <p><strong>Nom :</strong> {{ $node->name }}</p>
            <p><strong>Position :</strong> {{ $node->position }}</p>
            <p><strong>Type de Propriétaire :</strong> {{ class_basename($node->owner_type) }}</p>
            <p><strong>ID du Propriétaire :</strong> {{ $node->owner_id }}</p>
        </div>
    </div>

    {{-- <!-- Liste des entités associées -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            Entités liées au Nœud
        </div>
        <div class="card-body">
            @if($node->entities->isEmpty())
                <p>Aucune entité associée pour le moment.</p>
            @else
                <ul class="list-group">
                    @foreach($node->entities as $entity)
                        <li class="list-group-item">
                            <p><strong>Type d'Entité :</strong> {{ class_basename($entity->entity_type) }}</p>
                            <p><strong>ID de l'Entité :</strong> {{ $entity->entity_id }}</p>
                            <p><strong>Contenu :</strong> {{ $entity->content }}</p>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div> --}}

    <!-- Liste des entités groupées par type -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            Entités liées a la node (par Type) <a href="{{ route('game.servers.admin.nodes.entities.create', ['server' => $server->id, 'node' => $node->id]) }}" class="btn btn-sm btn-success float-end">Ajouter une Entité</a>
        </div>
        <div class="card-body">
            @php
                $groupedEntities = $node->entities->groupBy('entity_type');
            @endphp

            @forelse($groupedEntities as $type => $entities)
                <div class="mb-4">
                    <h5 class="fw-bold">{{ class_basename($type) }}</h5>
                    <ul class="list-group">
                        @foreach($entities as $entity)
                            <li class="list-group-item">
                                <p><strong>ID de l'Entité :</strong> {{ $entity->entity_id }}</p>
                                <p><strong>Contenu :</strong> {{ $entity->content }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @empty
                <p>Aucune entité associée pour le moment.</p>
            @endforelse
        </div>
    </div>

    <!-- Bouton Retour -->
    <div class="mt-4">
        <a href="{{ route('game.servers.admin.nodes.list', ['server' => $server->id]) }}" class="btn btn-outline-secondary">
            ⬅️ Retour à la liste des Nœuds
        </a>
    </div>
</div>
@endsection
