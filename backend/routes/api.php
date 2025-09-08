<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MusicaController;
use App\Http\Controllers\SugestaoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Aqui ficam as rotas da API, prefixadas automaticamente com "api/"
| graças ao RouteServiceProvider.
|
*/

// Rotas de autenticação
Route::post('/login', [AuthController::class, 'login']);

// Rotas públicas
Route::get('/musicas/top5', [MusicaController::class, 'top5']);
Route::get('/musicas', [MusicaController::class, 'index']);
Route::post('/sugestoes', [SugestaoController::class, 'store']);

// Rotas protegidas por autenticação
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Gestão de músicas
    Route::post('/musicas', [MusicaController::class, 'store']);
    Route::put('/musicas/{musica}', [MusicaController::class, 'update']);
    Route::delete('/musicas/{musica}', [MusicaController::class, 'destroy']);

    // Gestão de sugestões
    Route::get('/sugestoes', [SugestaoController::class, 'index']);
    Route::put('/sugestoes/{sugestao}/aprovar', [SugestaoController::class, 'aprovar']);
    Route::put('/sugestoes/{id}/rejeitar', [SugestaoController::class, 'rejeitar']);
    Route::put('/sugestoes/{sugestao}/reprovar', [SugestaoController::class, 'reprovar']);
});
