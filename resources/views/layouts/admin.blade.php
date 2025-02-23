<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Optionnel: icônes (font-awesome ou autre) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body class="light-mode">
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">🏠 Accueil</a>
                    </li>

                    <!-- MENU DÉROULANT "Gestion Serveur" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="serverDropdown" role="button" data-bs-toggle="dropdown">
                            ⚙️ Configurations
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.configurations.list', ['server' => $server->id]) }}">📜 Liste des configurations</a></li>
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.configurations.create', ['server' => $server->id]) }}">➕ Ajouter une configuration</a></li>
                        </ul>
                    </li>

                    <!-- MENU DÉROULANT "Traductions" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="translationsDropdown" role="button" data-bs-toggle="dropdown">
                            🌍 Traductions
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.translations.list', ['server' => $server->id]) }}">📖 Liste des traductions</a></li>
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.translations.create', ['server' => $server->id]) }}">➕ Ajouter une traduction</a></li>
                        </ul>
                    </li>

                    <!-- MENU DÉROULANT "Ressources" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="ressourcesDropdown" role="button" data-bs-toggle="dropdown">
                            📦 Ressources
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.ressources.list', ['server' => $server->id]) }}">📖 Liste des ressources</a></li>
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.ressources.create', ['server' => $server->id]) }}">➕ Ajouter une ressource</a></li>
                        </ul>
                    </li>

                    <!-- MENU DÉROULANT "Media" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="mediasDropdown" role="button" data-bs-toggle="dropdown">
                            🖼️ Media
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.medias.list', ['server' => $server->id]) }}">📖 Liste des medias</a></li>
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.medias.create', ['server' => $server->id]) }}">➕ Ajouter une media</a></li>
                        </ul>
                    </li>

                    <!-- MENU DÉROULANT "Media" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="nodesDropdown" role="button" data-bs-toggle="dropdown">
                            🏘️​ Node
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.nodes.list', ['server' => $server->id]) }}">📖 Liste des nodes</a></li>
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.nodes.create', ['server' => $server->id]) }}">➕ Ajouter une node</a></li>
                        </ul>
                    </li>

                    <!-- MENU DÉROULANT "Media" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown">
                            👥 Utilisateurs
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.users.list', ['server' => $server->id]) }}">📖 Liste des Utilisateurs</a></li>
                            <li><a class="dropdown-item" href="{{ route('game.servers.admin.users.create', ['server' => $server->id]) }}">➕ Ajouter un Utilisateur</a></li>
                        </ul>
                    </li>

                    

                    
                </ul>

                <!-- Bouton de changement de thème -->
                <button class="btn btn-outline-secondary" id="theme-toggle">🌗 Mode</button>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- Bootstrap JS, Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        // Gestion du mode sombre/clair
        document.getElementById('theme-toggle').addEventListener('click', function () {
            let htmlTag = document.documentElement;
            let currentTheme = htmlTag.getAttribute('data-bs-theme');
            let newTheme = currentTheme === 'light' ? 'dark' : 'light';
            htmlTag.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });

        // Récupérer le thème stocké
        (function () {
            let savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        })();
    </script>

    @yield('scripts')
</body>
</html>
