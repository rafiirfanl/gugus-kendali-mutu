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

    Route::prefix('admin')->name('admin.')->group(function () {
        // CRUD USER
        Route::get('/user', [AdminUserController::class, 'index'])->name('user.index');
        Route::post('/user', [AdminUserController::class, 'store'])->name('user.store');
        Route::delete('/user/{user}', [AdminUserController::class, 'destroy'])->name('user.destroy');

        // CRUD PRODI
        Route::get('/prodi', [AdminProdiController::class, 'index'])->name('prodi.index');
        Route::post('/prodi', [AdminProdiController::class, 'store'])->name('prodi.store');
        Route::delete('/prodi/{prodi}', [AdminProdiController::class, 'destroy'])->name('prodi.destroy');

        // CRUD MATKUL
        Route::get('/matkul', [AdminMatkulController::class, 'index'])->name('matkul.index');
        Route::post('/matkul', [AdminMatkulController::class, 'store'])->name('matkul.store');
        Route::delete('/matkul/{matkul}', [AdminMatkulController::class, 'destroy'])->name('matkul.destroy');

        // CRUD KELAS
        Route::get('/kelas', [AdminKelasController::class, 'index'])->name('kelas.index');
        Route::post('/kelas', [AdminKelasController::class, 'store'])->name('kelas.store');
        Route::delete('/kelas/{kelas}', [AdminKelasController::class, 'destroy'])->name('kelas.destroy');

        // CRUD TAHUN AJARAN
        Route::get('/tahun-ajaran', [AdminTahunAjaranController::class, 'index'])->name('tahunAjaran.index');
        Route::post('/tahun-ajaran', [AdminTahunAjaranController::class, 'store'])->name('tahunAjaran.store');
        Route::delete('/tahun-ajaran/{tahunAjaran}', [AdminTahunAjaranController::class, 'destroy'])->name('tahunAjaran.destroy');

        // CRUD DATA TEMUAN
        Route::get('/data-temuan', [AdminDataTemuanController::class, 'index'])->name('dataTemuan.index');
        Route::post('/data-temuan', [AdminDataTemuanController::class, 'store'])->name('dataTemuan.store');
        Route::delete('/data-temuan/{dataTemuan}', [AdminDataTemuanController::class, 'destroy'])->name('dataTemuan.destroy');
    });
});

require __DIR__ . '/auth.php';
