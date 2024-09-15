<?php

use App\Http\Controllers\equiposController;
use App\Http\Controllers\jugadoresController;
use App\Http\Controllers\partidoEstadosController;
use App\Http\Controllers\partidosController;
use App\Http\Controllers\resultadosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('jugadores/index', [jugadoresController::class, 'index']);
Route::get('jugadores/{id}/show', [jugadoresController::class, 'show']);
Route::post('jugadores/store', [jugadoresController::class, 'store']);
Route::patch('jugadores/{id}/update', [jugadoresController::class, 'update']);
Route::delete('jugadores/{id}/destroy', [jugadoresController::class, 'destroy']);

Route::get('equipos/index', [equiposController::class, 'index']);
Route::get('equipos/{id}/show', [equiposController::class, 'show']);
Route::post('equipos/store', [equiposController::class, 'store']);
Route::patch('equipos/{id}/update', [equiposController::class, 'update']);
Route::delete('equipos/{id}/destroy', [equiposController::class, 'destroy']);

Route::get('partidoEstados/index', [partidoEstadosController::class, 'index']);
Route::get('partidoEstados/{id}/show', [partidoEstadosController::class, 'show']);
Route::post('partidoEstados/store', [partidoEstadosController::class, 'store']);
Route::patch('partidoEstados/{id}/update', [partidoEstadosController::class, 'update']);
Route::delete('partidoEstados/{id}/destroy', [partidoEstadosController::class, 'destroy']);

Route::get('partidos/index', [partidosController::class, 'index']);
Route::get('partidos/{id}/show', [partidosController::class, 'show']);
Route::post('partidos/store', [partidosController::class, 'store']);
Route::patch('partidos/{id}/update', [partidosController::class, 'update']);
Route::delete('partidos/{id}/destroy', [partidosController::class, 'destroy']);

Route::get('resultados/index', [resultadosController::class, 'index']);
Route::get('resultados/{id}/show', [resultadosController::class, 'show']);
Route::post('resultados/store', [resultadosController::class, 'store']);
Route::patch('resultados/{id}/update', [resultadosController::class, 'update']);
Route::delete('resultados/{id}/destroy', [resultadosController::class, 'destroy']);