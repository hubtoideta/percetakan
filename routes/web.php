<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataPaketController;
use App\Http\Controllers\dataStoreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\InformationStoreController;
use App\Http\Controllers\pembayaranController;
use App\Http\Controllers\PembelianPaketController;
use App\Models\InformationStore;

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
Route::middleware(['guest'])->group(function (){
    Route::controller(AuthController::class)->group(function () {
        /* ============== BEGIN LOGIN ============== */
            /* Show page login */
            Route::get('/','loginViewPage')->name('login');
            /* Login proses */
            Route::post('/','loginPost')->name('loginAction');
        /* ============== END LOGIN ============== */

        /* ============== BEGIN REGIS ============== */
            /* Show page registrasi */
            Route::get('/registrasi','registrasiViewPage')->name('registrasi');
            /* Registrasi Proses */
            Route::post('/registrasi','registrasiPost')->name('registrasiAction');
        /* ============== END REGIS ============== */

        /* ============== BEGIN RESET PASSWORD ============== */
            /* Show page lupa password */
            Route::get('/lupa-password','lupaPasswordViewPage')->name('lupa_password');
            /* Lupa password & send token to email proses */
            Route::post('/lupa-password','lupaPasswordPost')->name('lupa_password_action');
            /* Show page ubah passwrod with token url */
            Route::get('/reset-password/{token}','passwordResetViewPage')->name('password.reset');
            /* Ubah Password Proses */
            Route::post('/update-password','passwordResetPost')->name('password.update');
        /* ============== END RESET PASSWORD ============== */
    });
});

/* Route user Login */
Route::middleware(['auth'])->group(function (){
    
    /* ----------- ALL USER PANEL ----------- */
        /* Show page home */
        Route::get('/home', [HomeController::class, 'index'])->name('home');
        /* Logut proses */
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        /* ============== BEGIN PROFILE & ACCOUNT ALL USER PANEL ============== */
            Route::controller(ProfileUserController::class)->group(function () {
                /* Show page profil dan akun */
                Route::get('/lihat-profile','index')->name('profile');
                /* input data profil proses */
                Route::post('/input-profile','create')->name('inputProfile');
                /* update data profil proses */
                Route::post('/update-profile','update')->name('editProfile');
                /* update data email proses */
                Route::post('/update-email','updateEmail')->name('editEmail');
                /* update data password proses */
                Route::post('/update-password','updatePassword')->name('editPassword');

            });
        /* ============== END PROFILE & ACCOUNT ALL USER PANEL ============== */
    /* ----------- ALL USER PANEL ----------- */


    /* ----------- USER DEVELOPER PANEL ----------- */
        Route::middleware(['checkRole:Developer'])->group(function () {
            /* ============== BEGIN SETTINGS PRICE PAKET USER DEVELOPER PANEL ============== */
                Route::controller(DataPaketController::class)->group(function () {
                    /* Show page kelolah Paket */
                    Route::get('/paket-langganan','index')->name('paket');
                    /* EDIT HARGA PAKET */
                    Route::post('/edit-harga-paket','updateHargaPaket')->name('editPaket');
                    /* EDIT HARGA DISKON DURASI PAKET */
                    Route::post('/edit-diskon-paket','updateDiskonPaket')->name('editDiskon');
                });
            /* ============== END SETTINGS PRICE PAKET USER DEVELOPER PANEL ============== */
    
            /* ============== BEGIN DATA PEMBELIAN PAKET USER DEVELOPER PANEL ============== */
                Route::controller(PembelianPaketController::class)->group(function () {
                    Route::get('/pembelian-paket','index')->name('pembelianPaket');
                    Route::post('/pembelian-paket','findData')->name('cari');
                });
            /* ============== END DATA PEMBELIAN PAKET USER DEVELOPER PANEL ============== */
    
            /* ============== BEGIN DATA TOKO USER DEVELOPER PANEL ============== */
                Route::controller(dataStoreController::class)->group(function () {
                    Route::get('/data-toko','index')->name('dataToko');
                    Route::post('/data-toko','findData')->name('cari');
                    Route::post('/data-toko/{slug}', 'update');
                });
            /* ============== END DATA TOKO USER DEVELOPER PANEL ============== */
        });
    /* ----------- USER DEVELOPER PANEL ----------- */


    /* ----------- USER OWNER PANEL ----------- */
        Route::middleware(['checkRole:Owner'])->group(function () {
            /* ============== BEGIN PEMBELIAN PAKET OWNER PANEL ============== */
                Route::middleware(['blockBuy'])->group(function () {
                    Route::controller(pembayaranController::class)->group(function () {
                        Route::get('/pembayaran-premium','premiumPaket')->name('checkoutPremium');
                        Route::get('/pembayaran-business','businessPaket')->name('checkoutBusiness');
                        Route::post('/pembayaran','checkoutPost')->name('checkoutPost');
                    });
                });
            /* ============== END PEMBELIAN PAKET OWNER PANEL ============== */

            /* ============== BEGIN DATA STORE OWNER PANEL ============== */
                Route::controller(InformationStoreController::class)->group(function () {
                    /* Show page kelolah toko */
                    Route::get('/kelolah-toko','index')->name('kelolah-toko');
                    /* Input data toko proses */
                    Route::post('/input-toko','create')->name('input-toko');
                    /* Edit data toko proses */
                    Route::post('/edit-toko','update')->name('edit-toko');
                });
            /* ============== END DATA STORE OWNER PANEL ============== */
        });
    /* ----------- USER OWNER PANEL ----------- */

});
