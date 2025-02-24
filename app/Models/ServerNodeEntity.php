<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerNodeEntity extends Model
{
    use HasFactory;

    protected $fillable = ['server_node_id', 'entity_type', 'entity_id', 'content'];

    public function node()
    {
        return $this->belongsTo(ServerNode::class);
    }

    public function entity()
    {
        return $this->morphTo();
    }
}
