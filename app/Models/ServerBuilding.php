<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerBuilding extends Model
{
    //

    protected $fillable = ['server_id', 'name', 'description', 'default_level', 'max_level', 'min_level', 'media_id'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function media() {
        return $this->belongsTo(ServerMedia::class, 'media_id');
    }

    public function costs() {
        return $this->morphMany(ServerEntityCost::class, 'entity');
    }

    public function prods() {
        return $this->morphMany(ServerEntityProduction::class, 'entity');
    }

    public function storages() {
        return $this->morphMany(ServerEntityStorage::class, 'entity');
    }
}
