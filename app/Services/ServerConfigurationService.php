<?php

// app/Services/ServerService.php

namespace App\Services;

use App\Models\Server;
use App\Models\ServerConfiguration;

class ServerConfigurationService
{
    /**
     * Crée une nouvelle configuration sur le serveur.
     *
     * @param  Server $server
     * @param string $key
     * @param string $value
     * @return ServerConfiguration
     */
    public function createConfiguration(Server $server, string $key, string $value): ServerConfiguration
    {
        $find = ServerConfiguration::where('server_id', $server->id)->where('key', $key)->first();
        if ($find) {
            throw new \Exception('La configuration existe déjà.');
        }
        $find = ServerConfiguration::create([
            'server_id' => $server->id,
            'key' => $key,
            'value' => $value,
        ]);
        return $find;
    }


    /**
     * met à jour une configuration d'un serveur.
     *
     * @param ServerConfiguration $config
     * @param string $key
     * @param string $value
     * @return ServerConfiguration
     */
    public function updateConfiguration(ServerConfiguration $config, string $key, string $value): ServerConfiguration
    {
        if ($config == null)
            throw new \Exception('La configuration n\'existe pas.');
        if ($config->key !== $key)
            throw new \Exception('La clé de configuration ne peut pas être modifiée.');

        $config->update([
            'value' => $value,            
        ]);
        
        return $config;
    }
}
