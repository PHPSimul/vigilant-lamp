<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - @yield('title', 'Dashboard')</title>
        <!-- Fichiers CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJvPQx4QpF4l4fB0JJxW6XlshyquD0ZZjK67w/F5/dgAY/VzmQq5Zm6kPTrD" crossorigin="anonymous">
    
        <!-- Fichiers JS -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybP+8D1P7wH7IRXoIk8kL9sVtOh64aUnBqc0t1JXkiGqf8A22h" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0FzFfA6F9s6FwG51dN1HzpjyK96lIH6RbZB+BbT3MwnQlrHb" crossorigin="anonymous"></script>
    
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script defer>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".submenu-toggle").forEach(toggle => {
                toggle.addEventListener("click", function () {
                    this.nextElementSibling.classList.toggle("show");
                });
            });
        });
    </script>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            Admin Panel
        </div>
        <nav>
            <a href="{{ route('game.servers.admin.index', ['server' => $server->id]) }}">
                <span>🏠</span> <span>Dashboard</span>
            </a>
            
            <!-- Sous-menu Translations -->
            <div class="submenu">
                <button class="submenu-toggle">
                    <span>📝</span> <span>Traductions</span> ⏷
                </button>
                <div class="submenu-items">
                    <a href="{{ route('game.servers.admin.translations.list', ['server' => $server->id]) }}">📄 Liste</a>
                    <a href="{{ route('game.servers.admin.translations.create', ['server' => $server->id]) }}">➕ Ajouter</a>
                </div>
            </div>

            <!-- Sous-menu Paramètres -->
            <div class="submenu">
                <button class="submenu-toggle">
                    <span>⚙️</span> <span>Paramètres</span> ⏷
                </button>
                <div class="submenu-items">
                    <a href="#">🔧 Configuration</a>
                    <a href="#">🔑 Sécurité</a>
                </div>
            </div>

            <a href="{{ route('servers.list') }}" class="back-btn">🔙 Retour aux serveurs</a>
        </nav>
    </aside>

    <!-- Contenu principal -->
    <main class="main-content">
        <h1>@yield('title')</h1>
        @yield('content')
    </main>

</body>
</html>
