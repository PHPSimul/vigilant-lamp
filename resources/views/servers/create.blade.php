@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Créer un nouveau serveur</h1>

    <!-- Formulaire de création de serveur -->
    <form action="{{ route('servers.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label for="owner_type">Type du propriétaire</label>
                    <select id="owner_type" name="owner_type" class="form-control @error('owner_type') is-invalid @enderror">
                        <option value="">Sélectionnez le type du propriétaire</option>
                        <option value="user" {{ old('owner_type') == 'user' ? 'selected' : '' }}>Utilisateur</option>
                        <!-- Ajouter d'autres types de propriétaires si nécessaire -->
                    </select>
                    @error('owner_type')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="owner_id">ID du propriétaire</label>
                    <input type="number" id="owner_id" name="owner_id" class="form-control @error('owner_id') is-invalid @enderror" value="{{ old('owner_id') }}" required>
                    @error('owner_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Vous pouvez ajouter d'autres champs ici si nécessaire -->

            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Créer le serveur</button>
            <a href="{{ route('servers.list') }}" class="btn btn-secondary">Retour à la liste des serveurs</a>
        </div>
    </form>
</div>
@endsection
