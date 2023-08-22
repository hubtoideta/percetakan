<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataPaketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\InformationStoreController;
use App\Http\Controllers\pembayaranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|*/

/* Route user non login */
Route::group(['middleware' => 'guest'], function(){
    /* ============== LOGIN ============== */
        /* Show page login */
        Route::get('/', [AuthController::class, 'loginViewPage'])->name('login');
        /* Login proses */
        Route::post('/', [AuthController::class, 'loginPost'])->name('login');
    /* ============== LOGIN ============== */

    /* ============== REGIS ============== */
        /* Show page registrasi */
        Route::get('/registrasi', [AuthController::class, 'registrasiViewPage'])->name('registrasi');
        /* Registrasi Proses */
        Route::post('/registrasi', [AuthController::class, 'registrasiPost'])->name('registrasi');
    /* ============== REGIS ============== */

    /* ============== RESET PASSWORD ============== */
        /* Show page lupa password */
        Route::get('/lupa-password', [AuthController::class, 'lupaPasswordViewPage'])->name('lupa_password');
        /* Lupa password & send token to email proses */
        Route::post('/lupa-password', [AuthController::class, 'lupaPasswordPost'])->name('lupa_password');
        /* Show page ubah passwrod with token url */
        Route::get('/reset-password/{token}', [AuthController::class, 'passwordResetViewPage'])->name('password.reset');
        /* Ubah Password Proses */
        Route::post('/update-password', [AuthController::class, 'passwordResetPost'])->name('password.update');
    /* ============== RESET PASSWORD ============== */
});

/* Route user Login */
Route::group(['middleware' => 'auth'], function(){
    /* Show page home */
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    /* Logut proses */
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    /* ============== PROFILE & ACCOUNT ============== */
        /* Show page profil dan akun */
        Route::get('/lihat-profile', [ProfileUserController::class, 'index'])->name('profile');
        /* input data profil proses */
        Route::post('/input-profile', [ProfileUserController::class, 'create'])->name('inputProfile');
        /* update data profil proses */
        Route::post('/update-profile', [ProfileUserController::class, 'update'])->name('editProfile');
        /* update data email proses */
        Route::post('/update-email', [ProfileUserController::class, 'updateEmail'])->name('editEmail');
        /* update data password proses */
        Route::post('/update-password', [ProfileUserController::class, 'updatePassword'])->name('editPassword');
    /* ============== PROFILE & ACCOUNT ============== */
    
    /* ============== SETTINGS PRICE PAKET DEVELOPER PANEL ============== */
        /* Show page kelolah Paket */
        Route::get('/paket-langganan', [DataPaketController::class, 'index'])->name('paket');
        Route::post('/edit-harga-paket', [DataPaketController::class, 'updateHargaPaket'])->name('editPaket');
        Route::post('/edit-diskon-paket', [DataPaketController::class, 'updateDiskonPaket'])->name('editDiskon');
    /* ============== SETTINGS PRICE PAKET DEVELOPER PANEL ============== */

    Route::get('/pembayaran-premium', [pembayaranController::class, 'premiumPaket'])->name('checkoutPremium');

    /* ============== DATA STORE OWNER PANEL ============== */
        /* Show page kelolah toko */
        Route::get('/kelolah-toko', [InformationStoreController::class, 'index'])->name('kelolah-toko');
        /* Input data toko proses */
        Route::post('/input-toko', [InformationStoreController::class, 'create'])->name('input-toko');
        /* Edit data toko proses */
        Route::post('/edit-toko', [InformationStoreController::class, 'update'])->name('edit-toko');
    /* ============== DATA STORE OWNER PANEL ============== */
    
});
