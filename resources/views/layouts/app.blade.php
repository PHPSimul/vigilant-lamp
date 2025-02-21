<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Gestion des serveurs')</title>

    <!-- Fichiers CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJvPQx4QpF4l4fB0JJxW6XlshyquD0ZZjK67w/F5/dgAY/VzmQq5Zm6kPTrD" crossorigin="anonymous">
    
    <!-- Fichiers JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybP+8D1P7wH7IRXoIk8kL9sVtOh64aUnBqc0t1JXkiGqf8A22h" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0FzFfA6F9s6FwG51dN1HzpjyK96lIH6RbZB+BbT3MwnQlrHb" crossorigin="anonymous"></script>

    <!-- Optionnel: Ajouter des styles CSS supplémentaires si nécessaire -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Optionnel: Ajouter des scripts JavaScript supplémentaires si nécessaire -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
</head>

<body>
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Gestion des serveurs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('servers.list') }}">Liste des serveurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('servers.create') }}">Créer un serveur</a>
                    </li>
                    <!-- Autres liens de navigation peuvent être ajoutés ici -->
                </ul>
            </div>
        </nav>

        <!-- Affichage du contenu de la page -->
        @yield('content')
    </div>
</body>

</html>
