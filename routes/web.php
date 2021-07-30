<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\paisController;
use App\Http\Controllers\regionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('mostrar/paises', [paisController::class,'mostrarPaises'])->name("mostrar.paises");
Route::get('mostrar/regiones/{country}', [regionController::class,'mostrarRegiones'])->name("mostrar.regiones");
Route::get('obtener/paisId/{id}', [paisController::class, 'obtenerPaisId'])->name('obtener.nombre');
Route::get('obtener/paisNombre/{nombre}', [paisController::class, 'obtenerPaisNombre'])->name('obtener.nombre');
Route::get('obtener/regionPais/{pais}', [regionController::class, 'obtenerRegionPais'])->name('obtener.id');
Route::get('obtener/regionNombre/{nombre}', [regionController::class, 'obtenerRegionNombre'])->name('obtener.nombre');