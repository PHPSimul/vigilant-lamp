<?php

// app/Services/ServerService.php

namespace App\Services;

use App\Models\Server;
use App\Models\ServerConfiguration;
use App\Models\ServerNode;
use App\Models\ServerTranslation;
use Illuminate\Database\Eloquent\Model;

class ServerNodeService
{
    public function generatePosition(Server $server): string
    {
        $collection = ServerConfiguration::where('server_id', $server->id)->whereIn('key', [
            'map_type',
            'x_min',
            'x_max',
            'y_min',
            'y_max',
            'z_min',
            'z_max',
            'x_center',
            'y_center',
            'spawn_generation',
        ])->get();

        $map_type = $collection->where('key', 'map_type')->first();
        $x_min = $collection->where('key', 'x_min')->first();
        $x_max = $collection->where('key', 'x_max')->first();
        $y_min = $collection->where('key', 'y_min')->first();
        $y_max = $collection->where('key', 'y_max')->first();
        $z_min = $collection->where('key', 'z_min')->first();
        $z_max = $collection->where('key', 'z_max')->first();
        $x_center = $collection->where('key', 'x_center')->first();
        $y_center = $collection->where('key', 'y_center')->first();
        $spawn_generation = $collection->where('key', 'spawn_generation')->first();
        if ($map_type != null) {
            if ($map_type->value == '2D') {
                if ($spawn_generation == 'random') {
                    while (true) {
                        $x = rand($x_min->value, $x_max->value);
                        $y = rand($y_min->value, $y_max->value);
                        $position = $x . '|' . $y;
                        $node = ServerNode::where('server_id', $server->id)->where('position', $position)->first();
                        if ($node == null) {
                            return $position;
                        }
                    }
                }
                else if ($spawn_generation == 'center') {
                    return $x_center->value . '|' . $y_center->value;
                }
            }
            else if ($map_type->value == '3D') {
                if ($spawn_generation == 'random') {
                    while (true) {
                        $x = rand($x_min->value, $x_max->value);
                        $y = rand($y_min->value, $y_max->value);
                        $z = rand($z_min->value, $z_max->value);
                        $position = $x . '|' . $y . '|' . $z;
                        $node = ServerNode::where('server_id', $server->id)->where('position', $position)->first();
                        if ($node == null) {
                            return $position;
                        }
                    }
                }
            }
        }
        return '0|0';
    }

    public function createNode(Server $server, ?Model $owner): ServerNode
    {
        $serverConfigurationNodeName = ServerConfiguration::where('server_id', $server->id)->where('key', 'node_name')->first();
        $name = 'Node';
        if ($serverConfigurationNodeName) {
            $name = $serverConfigurationNodeName->value;
        }
        return ServerNode::create([
            'server_id' => $server->id,
            'name' => $name,
            'position' => $this->generatePosition($server),
            'owner_id' => $owner ? $owner->id : null,
            'owner_type' => $owner ? get_class($owner) : null,
        ]);
    }

    public function renameNode(ServerNode $node, string $name): ServerNode
    {
        $node->name = $name;
        $node->save();
        return $node;
    }

    public function updateNodeOwner(Server $server, ServerNode $node, ?Model $owner): ServerNode
    {
        if ($server->id !== $node->server_id)
            throw new \Exception('Le noeud n\'appartient pas au serveur.');

        if ($owner) {
            if ($owner->hasAttribute('server_id') && $owner->server_id !== $server->id)
                throw new \Exception('Le propriétaire n\'appartient pas au serveur.');
            $node->owner_id = $owner->id;
            $node->owner_type = get_class($owner);
        }
        else {
            $node->owner_id = null;
            $node->owner_type = null;
        }
        $node->save();
        return $node;
    }

    public function updateNodePosition(ServerNode $node, string $position): ServerNode
    {
        if ($node->position === $position)
            return $node;
        if (ServerNode::where('server_id', $node->server_id)->where('position', $position)->first())
            throw new \Exception('La position est déjà utilisée.');
        if (strpos($position, '|') === false)
            throw new \Exception('La position est invalide.');
        if (count(explode('|', $position)) !== count(explode('|', $node->position)))
            throw new \Exception('La position est invalide.');
        $datas = explode('|', $position);
        foreach ($datas as $data) {
            if (!is_numeric($data))
                throw new \Exception('La position est invalide.');
        }
        $x = $datas[0];
        $y = $datas[1];
        $z = $datas[2] ?? null;
        $x_min = ServerConfiguration::where('server_id', $node->server_id)->where('key', 'x_min')->first();
        $x_max = ServerConfiguration::where('server_id', $node->server_id)->where('key', 'x_max')->first();
        $y_min = ServerConfiguration::where('server_id', $node->server_id)->where('key', 'y_min')->first();
        $y_max = ServerConfiguration::where('server_id', $node->server_id)->where('key', 'y_max')->first();
        $z_min = ServerConfiguration::where('server_id', $node->server_id)->where('key', 'z_min')->first();
        $z_max = ServerConfiguration::where('server_id', $node->server_id)->where('key', 'z_max')->first();
        $map_type = ServerConfiguration::where('server_id', $node->server_id)->where('key', 'map_type')->first();
        if ($map_type->value == '2D') {
            if ($x < $x_min->value || $x > $x_max->value || $y < $y_min->value || $y > $y_max->value)
                throw new \Exception('La position est invalide.');
        }
        else if ($map_type->value == '3D') {
            if ($x < $x_min->value || $x > $x_max->value || $y < $y_min->value || $y > $y_max->value || $z < $z_min->value || $z > $z_max->value)
                throw new \Exception('La position est invalide.');
        }

        $node->position = $position;
        $node->save();
        return $node;
    }
}
