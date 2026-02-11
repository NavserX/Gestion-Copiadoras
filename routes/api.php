<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ReparacionController;
use App\Http\Controllers\Api\AuthController;

// --- RUTAS PÚBLICAS ---
// Cualquiera puede intentar hacer login para obtener su "llave" (token)
Route::post('/login', [AuthController::class, 'login']);

// --- RUTAS PROTEGIDAS ---
// Todo lo que esté aquí dentro requiere que el usuario estés identificado
Route::middleware('auth:sanctum')->group(function () {

    // Ruta para ver los datos del usuario actual
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /*
    | Gestión de Reparaciones de Ofimática Digital Soluciones
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

});
