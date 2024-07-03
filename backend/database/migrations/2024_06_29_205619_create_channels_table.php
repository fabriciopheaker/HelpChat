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
        Schema::create('channels', function (Blueprint $table) {
            $table->id('ID_CHANNEL');
            $table->string('NOME_CHANNEL', 100);
            $table->unsignedBigInteger('ID_GUILD');
            $table->foreign('ID_GUILD')->references('ID_GUILD')->on('guilds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('channels');
    }
};
