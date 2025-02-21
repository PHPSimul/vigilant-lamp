<?php

namespace App\Http\Controllers\Server\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\ServerRessource;
use App\Services\ServerRessourceService;
use App\Services\ServerService;
use Illuminate\Http\Request;

class ServerAdminRessourceController extends Controller
{
    protected $serverService;
    protected $serverRessourceService;

    public function __construct(ServerService $serverService, ServerRessourceService $serverRessourceService)
    {
        $this->serverService = $serverService;
        $this->serverRessourceService = $serverRessourceService;
    }

    public function list(Server $server)
    {
        return view('servers.admin.ressources.list', [
            'server' => $server,
            'ressources' => $server->serverRessources,
        ]);
    }

    public function create(Server $server)
    {
        return view('servers.admin.ressources.create', [
            'server' => $server,
            'medias' => $server->serverMedias,
        ]);
    }

    public function store(Server $server, Request $request)
    {
        $request->validate([
            'trans_key' => 'required|string',
        ]);

        try {
            $this->serverRessourceService->createRessource($server, $request->trans_key, $request->media_id);
        }
        catch (\Exception $e) {
            return redirect()->route('game.servers.admin.ressources.create', ['server' => $server]);
        }

        return redirect()->route('game.servers.admin.ressources.list', ['server' => $server]);
    }

    public function edit(Server $server, ServerRessource $ressource)
    {
        return view('servers.admin.ressources.edit', [
            'server' => $server,
            'ressource' => $ressource,
            'medias' => $server->serverMedias,
        ]);
    }

    public function update(Request $request, Server $server, ServerRessource $ressource)
    {
        $request->validate([
            'conf_key' => 'required|string',
            'conf_value' => 'required|string',
        ]);

        $this->serverRessourceService->updateRessource($ressource, $request->conf_key, $request->conf_value);

        return redirect()->route('game.servers.admin.ressources.list', [
            'server' => $server,
        ]);
    }
}

?>