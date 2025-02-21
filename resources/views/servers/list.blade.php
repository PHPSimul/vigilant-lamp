@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Liste des serveurs</h1>

    <a href="{{ route('servers.create') }}" class="btn btn-primary mb-4">Créer un nouveau serveur</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Propriétaire</th>
                    <th>Nom du serveur</th>
                    <th>Créé le</th>
                    <th>Dernière modification</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servers as $server)
                    <tr>
                        <td>{{ $server->id }}</td>
                        <td>{{ $server->owner_type }} - {{ $server->owner_id }}</td>
                        <td>{{ $server->name }}</td>
                        <td>{{ $server->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $server->updated_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('game.servers.admin.index', ['server' => $server->id]) }}" class="btn btn-primary">Gérer</a> <br />
                            <a href="{{ route('game.servers.api.index', ['server' => $server->id]) }}" class="btn btn-primary">Api</a> <br />
                            <a href="{{ route('game.servers.play.index', ['server' => $server->id]) }}" class="btn btn-primary">Jouer</a> <br />
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
