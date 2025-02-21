<?php

namespace App\Http\Controllers\Server\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\ServerConfiguration;
use App\Models\ServerTranslation;
use App\Services\ServerConfigurationService;
use App\Services\ServerService;
use App\Services\ServerTranslationService;
use Illuminate\Http\Request;

class ServerAdminConfigurationController extends Controller
{
    protected $serverService;
    protected $serverConfigurationService;

    public function __construct(ServerService $serverService, ServerConfigurationService $serverConfigurationService)
    {
        $this->serverService = $serverService;
        $this->serverConfigurationService = $serverConfigurationService;
    }

    public function list(Server $server)
    {
        return view('servers.admin.configurations.list', [
            'server' => $server,
            'configurations' => $server->serverConfigurations,
        ]);
    }

    public function create(Server $server)
    {
        return view('servers.admin.configurations.create', [
            'server' => $server,
        ]);
    }

    public function store(Server $server, Request $request)
    {
        $request->validate([
            'conf_key' => 'required|string',
            'conf_value' => 'required|string',
        ]);

        try {
            $this->serverConfigurationService->createConfiguration($server, $request->conf_key, $request->conf_value);
        }
        catch (\Exception $e) {
            return redirect()->route('game.servers.admin.configurations.create', ['server' => $server]);
        }

        return redirect()->route('game.servers.admin.configurations.list', ['server' => $server]);
    }

    public function edit(Server $server, ServerConfiguration $configuration)
    {
        return view('servers.admin.configurations.edit', [
            'server' => $server,
            'config' => $configuration,
        ]);
    }

    public function update(Request $request, Server $server, ServerConfiguration $configuration)
    {
        $request->validate([
            'conf_key' => 'required|string',
            'conf_value' => 'required|string',
        ]);

        $this->serverConfigurationService->updateConfiguration($configuration, $request->conf_key, $request->conf_value);

        return redirect()->route('game.servers.admin.configurations.list', [
            'server' => $server,
        ]);
    }
}

?>