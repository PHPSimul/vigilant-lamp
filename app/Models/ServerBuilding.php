<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerBuilding extends Model
{
    //

    protected $fillable = ['server_id', 'name', 'description', 'default_level', 'max_level', 'min_level'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}
