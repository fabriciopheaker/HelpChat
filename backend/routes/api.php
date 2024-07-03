<?php

use App\Http\Controllers\AuthSessionController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\GuildController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::controller(AuthSessionController::class)->group(function () {
    Route::post('/auth/register', 'register');
    Route::post('/auth/login', 'login');
    Route::post('/auth/logout', 'logout')->middleware('auth:sanctum');;
});


Route::prefix('guilds')->middleware('auth:sanctum')->group(function () {

    Route::controller(GuildController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::delete('/{guildId}', 'destroy');
        Route::get('/{guildId}', 'show');
    });

    Route::controller(ChannelController::class)->group(function () {
        Route::get('/{guildId}/channel', 'index');
        Route::post('/{guildId}/channel', 'store');
        Route::get('/{guildId}/channel/{channelId}', 'show');
    });

    Route::controller(MessageController::class)->group(function () {
        Route::get('/{guildId}/channel/{channelId}/messages', 'index');
        Route::post('/{guildId}/channel/{channelId}/messages', 'store');
    });
});


//Route::get('/', [ClienteController::class, 'Cliente'])->name('cliente.home');