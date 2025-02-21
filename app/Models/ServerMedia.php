<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerMedia extends Model
{
    protected $fillable = ['server_id', 'name', 'trans_key', 'path'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}