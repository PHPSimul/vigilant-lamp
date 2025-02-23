<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['owner_type', 'owner_id'];

    // Relations
    public function serverConfigurations()
    {
        return $this->hasMany(ServerConfiguration::class);
    }

    public function serverRessources()
    {
        return $this->hasMany(ServerRessource::class);
    }

    public function serverMedia()
    {
        return $this->hasMany(ServerMedia::class);
    }

    public function serverTranslations()
    {
        return $this->hasMany(ServerTranslation::class);
    }

    public function serverNodes()
    {
        return $this->hasMany(ServerNode::class);
    }

    public function serverUsers()
    {
        return $this->hasMany(ServerUser::class);
    }
}