@extends('layouts.admin')

@section('title', 'Modifier un Utilisateur du Serveur')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier un Utilisateur</h1>

    <form action="{{ route('game.servers.admin.users.update', ['server' => $server->id, 'user' => $serverUser->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="register_at" class="form-label">Date d'inscription</label>
            <input type="datetime-local" class="form-control" id="register_at" name="register_at" value="{{ $serverUser->register_at }}" required>
        </div>

        <button type="submit" class="btn btn-success">Mettre à Jour</button>
    </form>
</div>
@endsection