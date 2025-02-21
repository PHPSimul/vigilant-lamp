<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerRessource extends Model
{
    protected $fillable = ['server_id', 'trans_key', 'media_id'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function media()
    {
        return $this->belongsTo(ServerMedia::class, 'media_id');
    }
}