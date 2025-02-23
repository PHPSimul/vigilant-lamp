<?php

namespace App\Http\Controllers\Server\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\ServerNode;
use App\Models\ServerUser;
use App\Models\User;
use App\Services\ServerService;
use App\Services\ServerUserService;
use Illuminate\Http\Request;

class ServerAdminUserController extends Controller
{
    protected $serverService;
    protected $serverUserService;

    public function __construct(ServerService $serverService, ServerUserService $serverUserService)
    {
        $this->serverService = $serverService;
        $this->serverUserService = $serverUserService;
    }

    public function list(Server $server)
    {
        return view('servers.admin.users.list', [
            'server' => $server,
            'serverUsers' => $server->serverUsers,
        ]);
    }

    public function create(Server $server)
    {
        return view('servers.admin.users.create', [
            'server' => $server,
            'users' => User::all(),
        ]);
    }

    public function store(Server $server, Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'register_at' => 'required',
        ]);

        try {
            $user = User::where('id', $request->user_id)->first();
            if ($user == null) {
                return redirect()->route('game.servers.admin.users.create', ['server' => $server])
                                 ->with('error', 'Erreur lors de la creation : utilisateur introuvable.');
            }

            $this->serverUserService->createUser($server, $user, $request->register_at);
        } catch (\Exception $e) {
            return redirect()->route('game.servers.admin.users.create', ['server' => $server])
                             ->with('error', 'Erreur lors de la creation : ' . $e->getMessage());
        }
    
        return redirect()->route('game.servers.admin.users.list', ['server' => $server])
                         ->with('success', 'Node ajouté avec succès.');
    }

    public function edit(Server $server, ServerUser $user)
    {
        return view('servers.admin.users.edit', [
            'server' => $server,
            'user' => $user,
        ]);
    }

    public function update(Request $request, Server $server, ServerUser $user)
    {
        $request->validate([
            'register_at' => 'required',
        ]);

        try {
            $this->serverUserService->updateUser($server, $user, $request->register_at);
        } catch (\Exception $e) {
            return redirect()->route('game.servers.admin.users.edit', [
                'server' => $server,
                'user' => $user,
            ])->with('error', 'Erreur lors de la modification : ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('game.servers.admin.users.edit', [
                'server' => $server,
                'user' => $user,
            ]);
        }

        return redirect()->route('game.servers.admin.users.list', [
            'server' => $server,
        ]);
    }
}

?>