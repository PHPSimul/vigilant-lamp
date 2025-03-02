<?php

namespace App\Services;

use App\Models\Server;
use App\Models\ServerBuilding;
use App\Models\ServerEntityCost;
use App\Models\ServerRessource;

class ServerBuildingService
{
    public function createBuilding(Server $server, string $name, string $description, int $min_level, int $max_level, int $default_level, ServerMedia $media = null): ServerBuilding
    {
        $serverMedia = null;
        if ($media) {
            if ($media->server_id == $server->id) {
                $serverMedia = $media;
            }
            else {
                throw new \Exception("Le serveur de la ressource et du building ne correspondent pas.");
            }
        }

        return ServerBuilding::create([
            'server_id' => $server->id,
            'name' => $name,
            'description' => $description,
            'min_level' => $min_level,
            'max_level' => $max_level,
            'default_level' => $default_level,
            'media_id' => $serverMedia,
        ]);
    }

    public function generateCostOfBuilding(ServerBuilding $building, ServerRessource $ressource, int $initialCost, int $evolution) {
        if ($building->server_id != $ressource->server_id)
            throw new \Exception("Le serveur de la ressource et du building ne correspondent pas.");
        $exist = ServerEntityCost::where('entity_id', $building->id)->where('entity_type', ServerBuilding::class)->where('resource_id', $ressource->id)->get();
        if ($exist != null && $exist->count() > 0)
            throw new \Exception("Le cost pour ce batiment avec cette ressource est deja existant.");
        ServerEntityCost::create([
            'entity_type' => ServerBuilding::class,
            'entity_id' => $building->id,
            'resource_id' => $ressource->id,
            'cost' => $initialCost,
            'evolution' => $evolution,
        ]);
    }
}
