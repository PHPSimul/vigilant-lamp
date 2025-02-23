@extends('layouts.admin')

@section('title', 'Liste des Utilisateurs du Serveur')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">👥 Utilisateurs du Serveur</h1>
        <a href="{{ route('game.servers.admin.users.create', ['server' => $server->id]) }}" 
           class="btn btn-primary">
            ➕ Ajouter un Utilisateur
        </a>
    </div>

    <div class="table-responsive table-container">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID Utilisateur</th>
                    <th>Nom</th>
                    <th>Date d'inscription</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($serverUsers as $serverUser)
                <tr>
                    <td>{{ $serverUser->user->id }}</td>
                    <td>{{ $serverUser->user->name }}</td>
                    <td>{{ $serverUser->register_at }}</td>
                    <td class="text-center">
                        <a href="{{ route('game.servers.admin.users.edit', ['server' => $server->id, 'user' => $serverUser->id]) }}" 
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