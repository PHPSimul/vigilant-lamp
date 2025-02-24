<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerNode extends Model
{
    protected $fillable = ['server_id', 'owner_type', 'owner_id', 'name', 'position'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function owner() // nullableMorphs('owner');
    {
        return $this->morphTo();
    }

    public function entities()
    {
        return $this->hasMany(ServerNodeEntity::class);
    }
}