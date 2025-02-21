<?php

// app/Services/ServerService.php

namespace App\Services;

use App\Models\Server;
use App\Models\ServerConfiguration;
use App\Models\ServerMedia;
use App\Models\ServerNode;
use App\Models\ServerTranslation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServerTranslationService
{
    /**
     * Crée une nouvelle traduction sur un serveur.
     *
     * @param  Server $server
     * @param string $key
     * @param string $value
     * @param string $locale
     * @return ServerTranslation
     */
    public function createTranslation(Server $server, string $key, string $value, string $locale): ServerTranslation
    {
        $find = ServerTranslation::where('server_id', $server->id)->where('trans_key', $key)->where('trans_lang', $locale)->first();
        if ($find) {
            throw new \Exception('La traduction existe déjà.');
        }
        $find = ServerTranslation::create([
            'server_id' => $server->id,
            'trans_key' => $key,
            'trans_value' => $value,
            'trans_lang' => $locale,
        ]);
        return $find;
    }
    /**
     * Met à jour une traduction sur un serveur.
     *
     * @param ServerTranslation $trans
     * @param string $key
     * @param string $value
     * @param string $locale
     * @return ServerTranslation
     */
    public function updateTranslation(ServerTranslation $trans, string $key, string $value, string $locale): ServerTranslation
    {
        if ($trans == null)
            throw new \Exception('La traduction n\'existe pas.');
        if ($trans->trans_key !== $key)
            throw new \Exception('La clé de traduction ne peut pas être modifiée.');
        if ($trans->trans_lang !== $locale)
            throw new \Exception('La langue de traduction ne peut pas être modifiée.');

        $trans->update([
            'trans_value' => $value,            
        ]);

        return $trans;
    }
}
