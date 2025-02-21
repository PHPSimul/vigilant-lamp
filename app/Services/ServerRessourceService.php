<?php

// app/Services/ServerService.php

namespace App\Services;

use App\Models\Server;
use App\Models\ServerMedia;
use App\Models\ServerRessource;

class ServerRessourceService
{
    /**
     * Crée une nouvelle ressource sur le serveur.
     *
     * @param  Server $server
     * @param string $key
     * @param string $value
     * @param ?ServerMedia $value
     * @return ServerRessource
     */
    public function createRessource(Server $server, string $key, ?ServerMedia $media): ServerRessource
    {
        $find = ServerRessource::where('server_id', $server->id)->where('trans_key', $key)->first();
        
        if ($find) {
            throw new \Exception('La ressource existe déjà.');
        }
        if ($media == null) {
            $find = ServerRessource::create([
                'server_id' => $server->id,
                'trans_key' => $key,
            ]);
        }
        else
        {
            if ($media->server_id !== $server->id)
                throw new \Exception('La ressource ne peut pas être liée à un média d\'un autre serveur.');

            $find = ServerRessource::create([
                'server_id' => $server->id,
                'trans_key' => $key,
                'media_id' => $media->id,
            ]);
        }
        return $find;
    }


    /**
     * met à jour une ressource d'un serveur.
     *
     * @param ServerRessource $ressource
     * @param string $key
     * @param string $value
     * @param ?ServerMedia $value
     * @return ServerRessource
     */
    public function updateRessource(ServerRessource $ressource, string $key, ?ServerMedia $media): ServerRessource
    {
        if ($ressource == null)
            throw new \Exception('La ressource n\'existe pas.');
        if ($ressource->trans_key !== $key)
            throw new \Exception('La clé de traduction de la ressource ne peut pas être modifiée.');

        if ($media == null) {
            $ressource->update([
                'media_id' => null,
            ]);
        }
        else
        {
            if ($media->server_id !== $ressource->server_id)
                throw new \Exception('La ressource ne peut pas être liée à un média d\'un autre serveur.');

            $ressource->update([
                'media_id' => $media->id,
            ]);
        }
        
        return $ressource;
    }
}
