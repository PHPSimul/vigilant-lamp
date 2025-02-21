@extends('layouts.admin')

@section('title', 'Ajouter un Média')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4">➕ Ajouter un Média</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('game.servers.admin.medias.store', ['server' => $server->id]) }}" 
                  method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Nom du Média :</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Clé de Traduction :</label>
                    <input type="text" name="trans_key" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Fichier :</label>
                    <input type="file" name="media_file" id="mediaFileInput" class="form-control" accept="image/*,video/*" required>
                    <div class="mt-2">
                        <img id="previewImage" src="#" alt="Aperçu" class="img-thumbnail d-none" width="150">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">
                    ✅ Enregistrer
                </button>
                <a href="{{ route('game.servers.admin.medias.list', ['server' => $server->id]) }}" class="btn btn-secondary">
                    🔙 Retour
                </a>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('mediaFileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('previewImage');
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('previewImage').classList.add('d-none');
    }
});
</script>
@endsection
