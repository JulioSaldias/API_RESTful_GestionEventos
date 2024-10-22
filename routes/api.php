<?php

use App\Http\Controllers\Api\userController;
use App\Http\Controllers\Api\UbicacionController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\EventoController;
use App\Http\Controllers\Api\AsistentesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use OpenApi\Annotations as OA;


//Ubicaciones
Route::get('/Ubicaciones', [UbicacionController::class, 'index']);

Route::get('/Ubicaciones/{id}', [UbicacionController::class, 'show']);

Route::post('/Ubicaciones', [UbicacionController::class, 'store']);

Route::put('/Ubicaciones/{id}', [UbicacionController::class, 'update']);

Route::patch('/Ubicaciones/{id}', [UbicacionController::class, 'updatePartial']);

Route::delete('/Ubicaciones/{id}', [UbicacionController::class, 'destroy']);


//Clientes
Route::get('/Clientes', [ClienteController::class, 'index']);

Route::get('/Clientes/{id}', [ClienteController::class, 'show']);

Route::post('/Clientes', [ClienteController::class, 'store']);

Route::put('/Clientes/{id}', [ClienteController::class, 'update']);

Route::patch('/Clientes/{id}', [ClienteController::class, 'updatePartial']);

Route::delete('/Clientes/{id}', [ClienteController::class, 'destroy']);


//Eventos
Route::get('/Eventos', [EventoController::class, 'index']);

Route::get('/Eventos/{id}', [EventoController::class, 'show']);

Route::get('/Eventos/{id}/Asistentes', [EventoController::class, 'obtenerAsistentesPorEvento']);

Route::post('/Eventos', [EventoController::class, 'store']);

Route::put('/Eventos/{id}', [EventoController::class, 'update']);

Route::patch('/Eventos/{id}', [EventoController::class, 'updatePartial']);

Route::delete('/Eventos/{id}', [EventoController::class, 'destroy']);


//Asistentes
Route::get('/Asistentes', [AsistentesController::class, 'index']);

Route::get('/Asistentes/{id}', [AsistentesController::class, 'show']);

Route::post('/Asistentes', [AsistentesController::class, 'store']);
    
Route::put('/Asistentes/{id}', [AsistentesController::class, 'update']);

Route::patch('/Asistentes/{id}', [AsistentesController::class, 'updatePartial']);

Route::delete('/Asistentes/{id}', [AsistentesController::class, 'destroy']);

//Usuarios

Route::post('/login', [UserController::class, 'login']);

Route::get('/Usuarios', [userController::class, 'index']);

Route::get('/Usuarios/{id}', [userController::class, 'show']);

Route::post('/Usuarios', [userController::class, 'store']);

Route::put('/Usuarios/{id}', [userController::class, 'update']);

Route::patch('/Usuarios/{id}', [userController::class, 'updatePartial']);

Route::delete('/Usuarios/{id}', [userController::class, 'destroy']);

Route::get('/docs', function () {
    return response()->json(file_get_contents(storage_path('api-docs/api-docs.json')));
});
