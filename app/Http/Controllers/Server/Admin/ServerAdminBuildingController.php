<?php

namespace App\Http\Controllers\Server\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\ServerBuilding;
use App\Models\ServerConfiguration;
use App\Models\ServerTranslation;
use App\Services\ServerBuildingService;
use App\Services\ServerConfigurationService;
use App\Services\ServerService;
use App\Services\ServerTranslationService;
use Illuminate\Http\Request;

class ServerAdminBuildingController extends Controller
{
    protected $serverService;
    protected $serverBuildingService;

    public function __construct(ServerService $serverService, ServerBuildingService $serverBuildingService)
    {
        $this->serverService = $serverService;
        $this->serverBuildingService = $serverBuildingService;
    }

    public function list(Server $server)
    {
        return view('servers.admin.buildings.list', [
            'server' => $server,
            'buildings' => $server->serverBuildings,
        ]);
    }

    public function create(Server $server)
    {
        return view('servers.admin.buildings.create', [
            'server' => $server,
        ]);
    }

    public function store(Server $server, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'descr' => 'required|string',
            'min_level' => 'required|integer',
            'max_level' => 'required|integer',
            'default_level' => 'required|integer',
        ]);

        if ($request->min_level > $request->max_level)
        {
            dd("erreur 01");
            return redirect()->route('game.servers.admin.buildings.create', ['server' => $server]);
        }
        if ($request->min_level > $request->default_level) {
            dd("erreur 02");
            return redirect()->route('game.servers.admin.buildings.create', ['server' => $server]);
        }
        if ($request->max_level < $request->default_level)
        {
            dd("erreur 03");
            return redirect()->route('game.servers.admin.buildings.create', ['server' => $server]);
        }
        try {
            $this->serverBuildingService->createBuilding($server, $request->name, $request->descr, $request->min_level, $request->max_level, $request->default_level);
            return redirect()->route('game.servers.admin.buildings.list', ['server' => $server]);
        }
        catch (\Exception $e) {
            dd($e);
            return redirect()->route('game.servers.admin.buildings.create', ['server' => $server]);
        }
    }

    public function edit(Server $server, ServerConfiguration $building)
    {
        return view('servers.admin.buildings.edit', [
            'server' => $server,
            'building' => $building,
        ]);
    }

    public function update(Request $request, Server $server, ServerBuilding $building)
    {
        return redirect()->route('game.servers.admin.buildings.list', [
            'server' => $server,
        ]);
    }
}

?>
