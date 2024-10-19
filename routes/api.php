<?php

use App\Http\Controllers\Api\UbicacionController;
use App\Http\Controllers\Api\ClienteController;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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