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
        Schema::create('server_node_entities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_node_id');
            $table->morphs('entity'); // Crée automatiquement entity_type et entity_id
            $table->text('content')->nullable();
            $table->timestamps();

            $table->foreign('server_node_id')->references('id')->on('server_nodes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('server_node_entities');
    }
};
