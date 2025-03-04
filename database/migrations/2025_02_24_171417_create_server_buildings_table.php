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
        Schema::create('server_buildings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->string('name');
            $table->string('description');
            $table->integer('default_level');
            $table->integer('max_level');
            $table->integer('min_level');
            $table->foreign('server_id')->references('id')->on('servers')->onDelete('cascade');
            $table->foreign('media_id')->references('id')->on('server_media')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_buildings');
    }
};
