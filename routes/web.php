<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\CripsController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
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
Route::get('/sesi', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/sesi/login', [LoginController::class, 'postLogin'])->middleware('guest');
Route::get('/sesi/logout', [LoginController::class, 'logout'])->middleware('auth');

#Dashboard
Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

#Kriteria
Route::resource('kriteria', KriteriaController::class)->middleware('auth');

#Crips
Route::resource('crips', CripsController::class)->middleware('auth');

#Alternatif
Route::resource('alternatif', AlternatifController::class)->middleware('auth');

#Register
Route::resource('register', RegisterController::class)->middleware('auth');
