<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest'])->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('login');
    Route::post('/', [UserController::class, 'login']);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/user', [AdminController::class, 'index']);
    Route::get('/user/admin', [AdminController::class, 'admin'])->middleware('user.akses:admin');
    Route::get('/user/mahasiswa', [AdminController::class, 'mahasiswa'])->middleware('user.akses:mahasiswa');
    Route::get('/user/dosen', [AdminController::class, 'dosen'])->middleware('user.akses:dosen');
    Route::get('/logout', [UserController::class, 'logout']);
});

Route::get('/home', function(){
    return redirect('/admin');
});

Route::resource('mahasiswa', MahasiswaController::class);