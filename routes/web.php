<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|*/

Route::get('/', [AuthController::class, 'loginViewPage'])->name('login');

Route::get('/registrasi', [AuthController::class, 'registrasiViewPage'])->name('registrasi');
Route::post('/registrasi', [AuthController::class, 'registrasiPost'])->name('registrasi');
