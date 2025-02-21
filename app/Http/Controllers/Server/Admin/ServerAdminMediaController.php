<?php

namespace App\Http\Controllers\Server\Admin;

use App\Http\Controllers\Controller;
use App\Models\Server;
use App\Models\ServerMedia;
use App\Services\ServerMediaService;
use App\Services\ServerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServerAdminMediaController extends Controller
{
    protected $serverService;
    protected $serverMediaService;

    public function __construct(ServerService $serverService, ServerMediaService $serverMediaService)
    {
        $this->serverService = $serverService;
        $this->serverMediaService = $serverMediaService;
    }

    public function list(Server $server)
    {
        return view('servers.admin.medias.list', [
            'server' => $server,
            'medias' => $server->serverMedia,
        ]);
    }

    public function create(Server $server)
    {
        return view('servers.admin.medias.create', [
            'server' => $server,
        ]);
    }

    public function store(Server $server, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'trans_key' => 'required|string',
            'media_file' => 'required|file|mimes:png,jpg,jpeg',
        ]);
    
        try {
            $file = $request->file('media_file');
    
            if (!$file->isValid()) {
                throw new \Exception('Le fichier est invalide.');
            }
            
            // Définition du dossier de stockage
            $folder = 'server/' . $server->id . '/medias/';
            $filename = $request->name . '.' . $file->extension();
            
            if (!Storage::exists($folder)) {
                Storage::makeDirectory($folder);
            }

            // Stockage du fichier sur le disque public
            $filePath = $file->storeAs($folder, $filename, 'public');
    
            // Génération du chemin accessible
            $publicPath = Storage::url($filePath);
    
            // Enregistrement en base de données via le service
            $this->serverMediaService->createMedia($server, $request->name, $request->trans_key, $filePath);
        } catch (\Exception $e) {
            dd($e);
            return redirect()->route('game.servers.admin.medias.create', ['server' => $server])
                             ->with('error', 'Erreur lors de l\'upload : ' . $e->getMessage());
        }
    
        return redirect()->route('game.servers.admin.medias.list', ['server' => $server])
                         ->with('success', 'Média ajouté avec succès.');
    }

    public function edit(Server $server, ServerMedia $media)
    {
        return view('servers.admin.medias.edit', [
            'server' => $server,
            'media' => $media,
        ]);
    }

    public function update(Request $request, Server $server, ServerMedia $media)
    {
        $request->validate([
            'trans_key' => 'required|string',
        ]);

        try {
            $this->serverMediaService->updateMedia($server, $media, $request->trans_key);
        } catch (\Exception $e) {
            return redirect()->route('game.servers.admin.medias.edit', [
                'server' => $server,
                'media_file' => $media,
            ]);
        }

        return redirect()->route('game.servers.admin.medias.list', [
            'server' => $server,
        ]);
    }
}

?>