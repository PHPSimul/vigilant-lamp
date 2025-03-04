<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('server_entity_costs', function (Blueprint $table) {
            $table->id();
            $table->morphs('entity');
            $table->unsignedBigInteger('resource_id');
            $table->unsignedBigInteger('cost');
            $table->float('evolution');
            $table->foreign('resource_id')->references('id')->on('server_ressources');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_entity_costs');
    }
};
