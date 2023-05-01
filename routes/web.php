<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\CripsController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\LoginController;
use Route as GlobalRoute;

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
#Login
Route::get('/login', [LoginController::class, 'login']);

#Dashboard
Route::get('/', [HomeController::class, 'index'])->name('home');

#Kriteria
Route::resource('kriteria', KriteriaController::class);

#Crips
Route::resource('crips', CripsController::class);

#Alternatif
Route::resource('alternatif', AlternatifController::class);
