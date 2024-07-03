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
        Schema::create('chats', function (Blueprint $table) {
            $table->id('ID_CHAT');
            $table->string('MSG');
            $table->unsignedBigInteger('ID_CHANNEL');
            $table->unsignedBigInteger('ID_GUILD');
            $table->unsignedBigInteger('ID_USER');
            $table->foreign('ID_GUILD')->references('ID_GUILD')->on('guilds');
            $table->foreign('ID_CHANNEL')->references('ID_CHANNEL')->on('channels');
            $table->foreign('ID_USER')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
