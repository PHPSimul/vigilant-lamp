<?php

// app/Http/Controllers/ServerController.php

namespace App\Http\Controllers\Server;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\User;
use App\Services\ServerService;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    protected $serverService;

    public function __construct(ServerService $serverService)
    {
        $this->serverService = $serverService;
    }

    public function list()
    {
        return view('servers.list', [
            'servers' => Server::all(),
        ]);
    }

    public function create()
    {
        return view('servers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'owner_type' => 'required|string',
            'owner_id' => 'required|integer',
        ]);

        if ($request->owner_type === 'user') {
            $request->validate([
                'owner_id' => 'exists:users,id',
            ]);
            $user = User::findOrFail($request->owner_id);
            $this->serverService->createServer($user);
        }

        return redirect()->route('servers.list');
    }
}

?>