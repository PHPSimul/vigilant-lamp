<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerTranslation extends Model
{
    protected $fillable = ['server_id', 'trans_key', 'trans_value', 'trans_lang'];

    public function server()
    {
        return $this->belongsTo(Server::class);
    }
}