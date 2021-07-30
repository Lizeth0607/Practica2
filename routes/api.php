<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\paisController;
use App\Http\Controllers\regionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('get/mostrarPaises', [paisController::class, 'mostrarPaises'])->name('mostrar.paises');
Route::get('get/mostrarRegiones/{country}', [regionController::class, 'mostrarRegiones'])->name('mostrar.regiones');
Route::get('get/obtenerPaisId/{id}', [paisController::class, 'obtenerPaisId'])->name('obtener.nombre');
Route::get('get/obtenerPaisNombre/{nombre}', [paisController::class, 'obtenerPaisNombre'])->name('obtener.nombre');
Route::get('get/obtenerRegionPais/{pais}', [regionController::class, 'obtenerRegionPais'])->name('obtener.id');
Route::get('get/obtenerRegionNombre/{nombre}', [regionController::class, 'obtenerRegionNombre'])->name('obtener.nombre');