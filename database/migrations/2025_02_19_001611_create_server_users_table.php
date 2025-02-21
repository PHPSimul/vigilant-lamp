<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('server_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('register_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();

            // Définir les clés étrangères
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // S'assurer qu'un utilisateur ne peut être inscrit qu'une seule fois par serveur
            $table->unique(['server_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_users');
    }
};
