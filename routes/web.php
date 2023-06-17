<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\CripsController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SendEmailController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\IntensitasController;
use App\Http\Controllers\PerhitunganController;
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
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login/action', [LoginController::class, 'postLogin'])->middleware('guest');
Route::get('/login/logout', [LoginController::class, 'logout'])->middleware(['auth']);

#Dashboard
Route::get('/', [HomeController::class, 'index'])->middleware(['auth'])->name('home');

#Kriteria
Route::resource('kriteria', KriteriaController::class)->middleware(['auth']);

#Crips
Route::resource('crips', CripsController::class)->middleware(['auth']);

#Alternatif
Route::resource('alternatif', AlternatifController::class)->middleware(['auth']);
Route::get('/alternatif-export', [AlternatifController::class, 'export'])->middleware(['auth']);

#Register
Route::resource('register', RegisterController::class)->middleware(['auth', 'admin']);

#nilaiIntensitas
Route::resource('nilaiIntensitas', IntensitasController::class)->middleware(['auth']);

#perhitungan
Route::resource('perhitungan', PerhitunganController::class)->middleware(['auth']);
Route::get('/proses', 'App\Http\Controllers\PerhitunganController@proses')->name('perhitungan.proses')->middleware(['auth']);

// #Email Verification
// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect('/');
// })->middleware(['auth', 'signed'])->name('verification.verify');

#Send Email
// Route::get('send-email', [SendEmailController::class, 'index']);

#Profil
Route::resource('profil', ProfilController::class);
