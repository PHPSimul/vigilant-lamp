<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerEntityCost extends Model
{
    protected $fillable = ['entity_id', 'entity_type', 'cost', 'evolution', 'resource_id'];

    public function entity() {
        return $this->morphTo();
    }

    public function ressource() {
        return $this->belongsTo(ServerRessource::class, 'resource_id');
    }
}
