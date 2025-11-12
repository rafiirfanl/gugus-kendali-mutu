<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProdiController;
use App\Http\Controllers\Admin\AdminMatkulController;
use App\Http\Controllers\Admin\AdminKelasController;
use App\Http\Controllers\Admin\AdminTahunAjaranController;
use App\Http\Controllers\Admin\AdminDataTemuanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD USER
    Route::get('/user', [AdminUserController::class, 'index'])->name('user.index');

    // CRUD PRODI
    Route::get('/prodi', [AdminProdiController::class, 'index'])->name('prodi.index');

    // CRUD MATKUL
    Route::get('/matkul', [AdminMatkulController::class, 'index'])->name('matkul.index');

    // CRUD KELAS
    Route::get('/kelas', [AdminKelasController::class, 'index'])->name('kelas.index');

    // CRUD TAHUN AJARAN
    Route::get('/tahun-ajaran', [AdminTahunAjaranController::class, 'index'])->name('tahun-ajaran.index');

    // CRUD DATA TEMUAN
    Route::get('/data-temuan', [AdminDataTemuanController::class, 'index'])->name('data-temuan.index');
});

require __DIR__.'/auth.php';
