<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|*/

Route::group(['middleware' => 'guest'], function(){
    Route::get('/', [AuthController::class, 'loginViewPage'])->name('login');
    Route::post('/', [AuthController::class, 'loginPost'])->name('login');
    Route::get('/registrasi', [AuthController::class, 'registrasiViewPage'])->name('registrasi');
    Route::post('/registrasi', [AuthController::class, 'registrasiPost'])->name('registrasi');
    Route::get('/lupa-password', [AuthController::class, 'lupaPasswordViewPage'])->name('lupa_password');
    Route::post('/lupa-password', [AuthController::class, 'lupaPasswordPost'])->name('lupa_password');
    Route::get('/reset-password/{token}', [AuthController::class, 'passwordResetViewPage'])->name('password.reset');
    Route::post('/update-password', [AuthController::class, 'passwordResetPost'])->name('password.update');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    /* LOGOUT */
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
