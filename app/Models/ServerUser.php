<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerUser extends Model
{
    use HasFactory;

    protected $table = 'server_users';

    // Attributs qui peuvent être assignés en masse
    protected $fillable = [
        'server_id', 
        'user_id', 
        'register_at'
    ];

    // Relation avec le modèle Server
    public function server()
    {
        return $this->belongsTo(Server::class);
    }

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}