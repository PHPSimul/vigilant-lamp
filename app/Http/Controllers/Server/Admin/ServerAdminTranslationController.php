<?php

// app/Http/Controllers/ServerController.php

namespace App\Http\Controllers\Server\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\ServerTranslation;
use App\Services\ServerService;
use App\Services\ServerTranslationService;
use Illuminate\Http\Request;

class ServerAdminTranslationController extends Controller
{
    protected $serverService;
    protected $serverTranslationService;

    public function __construct(ServerService $serverService, ServerTranslationService $serverTranslationService)
    {
        $this->serverService = $serverService;
        $this->serverTranslationService = $serverTranslationService;
    }

    public function list(Server $server)
    {
        return view('servers.admin.translations.list', [
            'server' => $server,
            'translations' => $server->serverTranslations,
        ]);
    }

    public function create(Server $server)
    {
        return view('servers.admin.translations.create', [
            'server' => $server,
        ]);
    }

    public function store(Server $server, Request $request)
    {
        $request->validate([
            'trans_key' => 'required|string',
            'trans_value' => 'required|string',
            'trans_lang' => 'required|string',
        ]);


        // TODO : Créer la traduction
        try {
            $this->serverTranslationService->createTranslation($server, $request->trans_key, $request->trans_value, $request->trans_lang);
        }
        catch (\Exception $e) {
            return redirect()->route('game.servers.admin.translations.create', ['server' => $server]);
        }

        return redirect()->route('game.servers.admin.translations.list', ['server' => $server]);
    }

    public function show(Server $server, ServerTranslation $translation)
    {
        return view('servers.admin.translations.show', [
            'server' => $server,
            'translation' => $translation,
        ]);
    }

    public function edit(Server $server, ServerTranslation $translation)
    {
        return view('servers.admin.translations.edit', [
            'server' => $server,
            'translation' => $translation,
        ]);
    }

    public function update(Request $request, Server $server, ServerTranslation $translation)
    {
        $request->validate([
            'trans_key' => 'required|string',
            'trans_value' => 'required|string',
            'trans_lang' => 'required|string',
        ]);

        $this->serverTranslationService->updateTranslation($translation, $request->trans_key, $request->trans_value, $request->trans_lang);

        return redirect()->route('game.servers.admin.translations.list', [
            'server' => $server,
        ]);
    }
}

?>