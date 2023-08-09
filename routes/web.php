<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\InformationStoreController;

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
    /* HOME ROUTE */
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    /* LOGOUT */
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    /* PROFILE & ACCOUNT */
    Route::get('/lihat-profile', [ProfileUserController::class, 'index'])->name('profile');
    Route::post('/input-profile', [ProfileUserController::class, 'create'])->name('inputProfile');
    Route::post('/update-profile', [ProfileUserController::class, 'update'])->name('editProfile');
    Route::post('/update-email', [ProfileUserController::class, 'updateEmail'])->name('editEmail');
    Route::post('/update-password', [ProfileUserController::class, 'updatePassword'])->name('editPassword');
    /* CONFIG STORE */
    Route::get('/kelolah-toko', [InformationStoreController::class, 'index'])->name('kelolah-toko');
    Route::post('/input-toko', [InformationStoreController::class, 'create'])->name('input-toko');
    Route::post('/edit-toko', [InformationStoreController::class, 'update'])->name('edit-toko');
    
});
