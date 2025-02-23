@extends('layouts.admin')

@section('title', 'Ajouter un Utilisateur au Serveur')

@section('content')
<div class="container">
    <h1 class="mb-4">Ajouter un Utilisateur</h1>

    <form action="{{ route('game.servers.admin.users.store', ['server' => $server->id]) }}" method="POST">
        @csrf
        
        <div class="mb-3">
            <label for="user_id" class="form-label">Utilisateur</label>
            <select class="form-select" id="user_id" name="user_id" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="register_at" class="form-label">Date d'inscription</label>
            <input type="datetime-local" class="form-control" id="register_at" name="register_at" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection