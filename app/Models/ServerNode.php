<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerNode extends Model
{
    protected $fillable = ['server_id', 'owner_type', 'owner_id', 'name'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    public function owner()
    {
        return $this->morphTo();
    }
}