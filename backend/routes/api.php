<?php

use App\Http\Controllers\MusicaController;
use App\Http\Controllers\SugestaoController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Rotas de autenticação (login e logout)
Route::post('/login', [AuthController::class, 'login']);

// Rotas Públicas
Route::get('/musicas/top5', [MusicaController::class, 'top5']);
Route::get('/musicas', [MusicaController::class, 'index']);
Route::post('/sugestoes', [SugestaoController::class, 'store']);

// Rotas Protegidas por Autenticação
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rotas de gestão de músicas
    Route::post('/musicas', [MusicaController::class, 'store']);
    Route::put('/musicas/{musica}', [MusicaController::class, 'update']);
    Route::delete('/musicas/{musica}', [MusicaController::class, 'destroy']);

    // Rotas de gestão de sugestões
    Route::get('/sugestoes', [SugestaoController::class, 'index']);
    Route::put('/sugestoes/{sugestao}/aprovar', [SugestaoController::class, 'aprovar']);
    Route::put('/sugestoes/{sugestao}/reprovar', [SugestaoController::class, 'reprovar']);
});

