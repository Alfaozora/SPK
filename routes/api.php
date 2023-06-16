<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\alternatifApi;
use App\Http\Controllers\LoginMobile;

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

#Data Alternatif
Route::resource('alternatifapi', alternatifApi::class);

#Login
Route::get('/loginApp', [LoginMobile::class, 'loginApp'])->middleware('guest');
Route::post('/loginApp/action', [LoginMobile::class, 'postloginApp'])->middleware('guest');
Route::get('/loginApp/logout', [LoginMobile::class, 'logoutApp'])->middleware(['auth']);
