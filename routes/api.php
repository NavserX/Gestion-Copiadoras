<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReparacionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/*
|--------------------------------------------------------------------------
| API Routes - Gestión de Reparaciones de Ofimática Digital Soluciones
|--------------------------------------------------------------------------
*/

// 1. Obtengo todas las reparaciones (GET)
Route::get('/reparaciones', [ReparacionController::class, 'index']);

// 2. Creo una nueva reparación (POST)
Route::post('/reparaciones', [ReparacionController::class, 'store']);

// 3. Obtengo una reparación específica por ID (GET)
Route::get('/reparaciones/{id}', [ReparacionController::class, 'show']);

// 4. Actualizo una reparación existente (PUT)
Route::put('/reparaciones/{id}', [ReparacionController::class, 'update']);

// 5. Elimino una reparación (DELETE)
Route::delete('/reparaciones/{id}', [ReparacionController::class, 'destroy']);
