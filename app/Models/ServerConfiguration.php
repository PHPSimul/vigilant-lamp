<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerConfiguration extends Model
{
    protected $fillable = ['server_id', 'key', 'value'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}