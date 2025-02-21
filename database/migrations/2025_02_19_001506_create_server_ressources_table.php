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
        Schema::create('server_ressources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('server_id')->constrained()->onDelete('cascade'); // Référence au serveur
            $table->string('trans_key'); // Clé de la ressource
            $table->unsignedBigInteger('media_id')->nullable(); // Référence au média
            $table->timestamps();

            $table->foreign('media_id')->references('id')->on('server_media')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_ressources');
    }
};
