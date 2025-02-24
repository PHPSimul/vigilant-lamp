<?php

namespace App\Http\Controllers\Server\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\ServerNode;
use App\Models\ServerRessource;
use App\Models\ServerUser;
use App\Services\ServerNodeService;
use App\Services\ServerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServerAdminNodeController extends Controller
{
    protected $serverService;
    protected $serverNodeService;

    public function __construct(ServerService $serverService, ServerNodeService $serverNodeService)
    {
        $this->serverService = $serverService;
        $this->serverNodeService = $serverNodeService;
    }

    public function list(Server $server)
    {
        return view('servers.admin.nodes.list', [
            'server' => $server,
            'nodes' => $server->serverNodes,
        ]);
    }

    public function create(Server $server)
    {
        return view('servers.admin.nodes.create', [
            'server' => $server,
        ]);
    }

    public function store(Server $server, Request $request)
    {
        $request->validate([
            'owner_type' => 'string|nullable|in:App\Models\ServerUser',
            'owner_id' => 'integer',
        ]);
    
        try {
            if ($request->owner_type != null && $request->owner_id != null) {
                if ($request->owner_type == 'App\Models\ServerUser') {
                    $owner = ServerUser::where('id', $request->owner_id)->first();
                    if ($owner == null) {
                        return redirect()->route('game.servers.admin.nodes.create', ['server' => $server])
                                         ->with('error', 'Erreur lors de la creation : utilisateur introuvable.');
                    }
                    if ($owner->server_id != $server->id) {
                        return redirect()->route('game.servers.admin.nodes.create', ['server' => $server])
                                         ->with('error', 'Erreur lors de la creation : utilisateur non lié au serveur.');
                    }
                }
                else {
                    $owner = null;
                }
            }
            else {
                $owner = null;
            }
            $this->serverNodeService->createNode($server, $owner);

        } catch (\Exception $e) {
            return redirect()->route('game.servers.admin.nodes.create', ['server' => $server])
                             ->with('error', 'Erreur lors de la creation : ' . $e->getMessage());
        }
    
        return redirect()->route('game.servers.admin.nodes.list', ['server' => $server])
                         ->with('success', 'Node ajouté avec succès.');
    }

    public function edit(Server $server, ServerNode $node)
    {
        return view('servers.admin.nodes.edit', [
            'server' => $server,
            'node' => $node,
        ]);
    }

    public function update(Request $request, Server $server, ServerNode $node)
    {
        $request->validate([
            'owner_type' => 'string|nullable|in:App\Models\ServerUser',
            'owner_id' => 'integer',
            'name' => 'string',
            'position' => 'string',
        ]);

        try {
            if ($request->owner_type != null && $request->owner_id != null) {
                if ($request->owner_type == 'App\Models\ServerUser') {
                    $owner = ServerUser::where('id', $request->owner_id)->first();
                    if ($owner == null) {
                        return redirect()->route('game.servers.admin.nodes.edit', [
                            'server' => $server,
                            'node' => $node,
                        ])->with('error', 'Erreur lors de la modification : utilisateur introuvable.');
                    }
                    if ($owner->server_id != $server->id) {
                        return redirect()->route('game.servers.admin.nodes.edit', [
                            'server' => $server,
                            'node' => $node,
                        ])->with('error', 'Erreur lors de la modification : utilisateur non lié au serveur.');
                    }
                }
                else {
                    $owner = null;
                }
            }
            else {
                $owner = null;
            }
            $this->serverNodeService->renameNode($node, $request->name);
            $this->serverNodeService->updateNodeOwner($server, $node, $owner);
            $this->serverNodeService->updateNodePosition($node, $request->position);
            $node->save();
        } catch (\Exception $e) {
            return redirect()->route('game.servers.admin.nodes.edit', [
                'server' => $server,
                'node' => $node,
            ])->with('error', 'Erreur lors de la modification : ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('game.servers.admin.nodes.edit', [
                'server' => $server,
                'node' => $node,
            ]);
        }

        return redirect()->route('game.servers.admin.nodes.list', [
            'server' => $server,
        ]);
    }

    public function view(Server $server, ServerNode $node)
    {
        return view('servers.admin.nodes.view', [
            'server' => $server,
            'node' => $node,
        ]);
    }

    public function createEntity(Server $server, ServerNode $node)
    {
        return view('servers.admin.nodes.entity.create', [
            'server' => $server,
            'node' => $node,
        ]);
    }

    public function storeEntity(Request $request, Server $server, ServerNode $node) {
        if ($node->server_id != $server->id) {
            return redirect()->route('game.servers.admin.nodes.view', [
                'server' => $server,
                'node' => $node,
            ])->with('error', 'Erreur lors de la création de l\'entité : node non lié au serveur.');
        }

        $request->validate([
            'entity_type' => 'string',
            'entity_id' => 'integer',
            'content' => 'string',
        ]);

        if ($request->entity_type == 'App\Models\ServerRessource') {
            $entity = ServerRessource::where('id', $request->entity_id)->first();
        }
        else {
            $entity = null;
        }

        if ($entity->server_id != $server->id) {
            return redirect()->route('game.servers.admin.nodes.view', [
                'server' => $server,
                'node' => $node,
            ])->with('error', 'Erreur lors de la création de l\'entité : node non lié au serveur.');
        }

        if ($entity == null) {
            return redirect()->route('game.servers.admin.nodes.view', [
                'server' => $server,
                'node' => $node,
            ])->with('error', 'Erreur lors de la création de l\'entité : entité introuvable.');
        }

        $this->serverNodeService->createNodeEntityModel($node, $entity, $request->content);
    }
}

?>