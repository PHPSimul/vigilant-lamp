<?php

// app/Services/ServerService.php

namespace App\Services;

use App\Models\Server;
use App\Models\ServerConfiguration;
use App\Models\ServerMedia;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ServerMediaService
{
    public function createMedia(Server $server, string $key, string $trans_key, String $path): ServerMedia
    {
        $find = ServerMedia::where('server_id', $server->id)->where('name', $key)->first();
        if ($find) {
            throw new \Exception('Le média existe déjà.');
        }
        $path = str_replace("//", "/", $path);
        $find = ServerMedia::create([
            'server_id' => $server->id,
            'name' => $key,
            'trans_key' => $trans_key,
            'path' => $path,
        ]);
        return $find;
    }

    public function updateMedia(Server $server, ServerMedia $media, string $trans_key): ServerMedia
    {
        if ($server->id !== $media->server_id)
            throw new \Exception('Le média n\'appartient pas au serveur.');
        if ($media == null)
            throw new \Exception('Le média n\'existe pas.');

        $media->update([
            'trans_key' => $trans_key,
        ]);
        return $media;
    }
}
