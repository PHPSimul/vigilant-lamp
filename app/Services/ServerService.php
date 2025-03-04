<?php

// app/Services/ServerService.php

namespace App\Services;

use App\Models\Server;
use App\Models\ServerConfiguration;
use App\Models\ServerMedia;
use App\Models\ServerNode;
use App\Models\ServerRessource;
use App\Models\ServerTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServerService
{
    public function createServerRessource(Server $server, string $ressource, ?ServerMedia $media): ServerRessource
    {
        if ($media == null) {
            $ressource = ServerRessource::create([
                'server_id' => $server->id,
                'trans_key' => $ressource,
                'media_id' => null,
            ]);
        }
        else
        {
            $ressource = ServerRessource::create([
                'server_id' => $server->id,
                'trans_key' => $ressource,
                'media_id' => $media->id,
            ]);
        }
        return $ressource;
    }

    /**
     * Crée les ressources par défaut pour le serveur.
     *
     */
    public function createServerDefaultRessources(Server $server, bool $zen = false) {
        $ressources = [
            'stone', 'wood', 'iron'
        ];
        if ($zen) {
            $ressources = [
                'stone', 'wood', 'food', 'coal', 'quartz', 'cooper', 'iron', 'gold', 'diamond', 'emerald', 'netherite'
            ];
        }

        $media = null;

        foreach ($ressources as $ressource) {
            $this->createServerRessource($server, $ressource, $media);
        }
    }

    /**
     * Crée un nouveau serveur.
     *
     * @param  array  $data
     * @return Server
     */
    public function createServer(Model $owner)
    {
        // Créer le serveur de base
        $server = Server::create([
            'owner_type' => get_class($owner),
            'owner_id' => $owner->id,
        ]);

        // Retourner le serveur créé
        return $server;
    }

    /**
     * Créer les traductions par défaut pour le serveur.
     *
     * @param Server $server
     */

    public function createServerTranslations(Server $server)
    {
        // Exemple de traductions par défaut
        $translations = [
            'fr' => [
                'name' => 'Serveur ' . $server->id,
                'description' => 'Description du serveur',
            ],
            'en' => [
                'name' => 'Server ' . $server->id,
                'description' => 'Server description',
            ],
        ];


        foreach ($translations as $locale => $values) {
            foreach ($values as $key => $value) {
                ServerTranslation::create([
                    'server_id' => $server->id,
                    'trans_lang' => $locale,
                    'trans_key' => $key,
                    'trans_value' => $value,
                ]);
            }
        }
    }

    /**
     * Créer les configurations par défaut pour le serveur.
     *
     * @param Server $server
     */
    public function createServerConfigurations(Server $server)
    {
        // Exemple de configurations par défaut
        $configurations = [
            'game_speed' => 1,
            'build_speed' => 1,
            'map_size' => 100,
            'map_type' => '2D', // 2D ou 3D
            'x_center' => 50,
            'y_center' => 50,
            'x_min' => 0,
            'y_min' => 0,
            'x_max' => 100,
            'y_max' => 100,
            'z_min' => 0,
            'z_max' => 0,
            'spawn_generation' => 'random', // random
        ];

        foreach ($configurations as $key => $value) {
            ServerConfiguration::create([
                'server_id' => $server->id,
                'key' => $key,
                'value' => $value,
            ]);
        }
    }

    /**
     * Créer les médias de base pour le serveur.
     *
     * @param Server $server
     */
    public function createServerMedia(Server $server)
    {
        $folder = public_path('server/' . $server->id . '/medias/');

        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        foreach (Storage::files('server/default/ressources') as $file) {
            $info = pathinfo($file);
            $filename = $info['filename'] . '.' . $info['extension'];
            Storage::disk('public')->copy($file, $folder . $filename);

            ServerMedia::create([
                'server_id' => $server->id,
                'name' => $filename,
                'trans_key' => Str::slug($filename),
                'path' => 'server/' . $server->id . '/medias/' . $filename, // chemin pour le public
            ]);
        }
    }


    /**
     * Créer un nouveau node pour le serveur.
     *
     * @param Server $server
     */
    private function createServerNodes(Server $server, Model $owner)
    {
        // Exemple de node par défaut
        $node = ServerNode::create([
            'server_id' => $server->id,
            'owner_type' => get_class($owner), // Exemple
            'owner_id' => $owner->id, // Exemple d'ID
            'name' => 'Default Node',
        ]);
    }
}
