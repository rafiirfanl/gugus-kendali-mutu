<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProdiController;
use App\Http\Controllers\Admin\AdminMatkulController;
use App\Http\Controllers\Admin\AdminKelasController;
use App\Http\Controllers\Admin\AdminTahunAjaranController;
use App\Http\Controllers\Admin\AdminDataTemuanController;
use App\Http\Controllers\Admin\AdminDokumenPerkuliahanController;
use App\Http\Controllers\Admin\AdminRoleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('admin')->name('admin.')->group(function () {
        // CRUD USER
        Route::get('/user', [AdminUserController::class, 'index'])->name('user.index');
        Route::post('/user', [AdminUserController::class, 'store'])->name('user.store');
        Route::put('/user/{user}', [AdminUserController::class, 'update'])->name('user.update');
        Route::delete('/user/{user}', [AdminUserController::class, 'destroy'])->name('user.destroy');

        // CRUD PRODI
        Route::get('/prodi', [AdminProdiController::class, 'index'])->name('prodi.index');
        Route::post('/prodi', [AdminProdiController::class, 'store'])->name('prodi.store');
        Route::put('/prodi/{prodi}', [AdminProdiController::class, 'update'])->name('prodi.update');
        Route::delete('/prodi/{prodi}', [AdminProdiController::class, 'destroy'])->name('prodi.destroy');

        // CRUD MATKUL
        Route::get('/matkul', [AdminMatkulController::class, 'index'])->name('matkul.index');
        Route::post('/matkul', [AdminMatkulController::class, 'store'])->name('matkul.store');
        Route::put('/matkul/{matkul}', [AdminMatkulController::class, 'update'])->name('matkul.update');
        Route::delete('/matkul/{matkul}', [AdminMatkulController::class, 'destroy'])->name('matkul.destroy');

        // CRUD KELAS
        Route::get('/kelas', [AdminKelasController::class, 'index'])->name('kelas.index');
        Route::post('/kelas', [AdminKelasController::class, 'store'])->name('kelas.store');
        Route::put('/kelas/{kelas}', [AdminKelasController::class, 'update'])->name('kelas.update');
        Route::delete('/kelas/{kelas}', [AdminKelasController::class, 'destroy'])->name('kelas.destroy');

        // CRUD TAHUN AJARAN
        Route::get('/tahun-ajaran', [AdminTahunAjaranController::class, 'index'])->name('tahunAjaran.index');
        Route::post('/tahun-ajaran', [AdminTahunAjaranController::class, 'store'])->name('tahunAjaran.store');
        Route::put('/tahun-ajaran/{tahunAjaran}', [AdminTahunAjaranController::class, 'update'])->name('tahunAjaran.update');
        Route::delete('/tahun-ajaran/{tahunAjaran}', [AdminTahunAjaranController::class, 'destroy'])->name('tahunAjaran.destroy');

        // CRUD DATA TEMUAN
        Route::get('/data-temuan', [AdminDataTemuanController::class, 'index'])->name('dataTemuan.index');
        Route::post('/data-temuan', [AdminDataTemuanController::class, 'store'])->name('dataTemuan.store');
        Route::put('/data-temuan/{dataTemuan}', [AdminDataTemuanController::class, 'update'])->name('dataTemuan.update');
        Route::delete('/data-temuan/{dataTemuan}', [AdminDataTemuanController::class, 'destroy'])->name('dataTemuan.destroy');

        // CRUD ROLE
        Route::resource('role', AdminRoleController::class);

        // CRUD DOKUMEN PERKULIAHAN
        Route::get('/dokumen-perkuliahan', [AdminDokumenPerkuliahanController::class, 'index'])->name('dokumenPerkuliahan.index');
        Route::post('/dokumen-perkuliahan', [AdminDokumenPerkuliahanController::class, 'store'])->name('dokumenPerkuliahan.store');
        Route::put('/dokumen-perkuliahan/{dokumenPerkuliahan}', [AdminDokumenPerkuliahanController::class, 'update'])->name('dokumenPerkuliahan.update');
        Route::delete('/dokumen-perkuliahan/{dokumenPerkuliahan}', [AdminDokumenPerkuliahanController::class, 'destroy'])->name('dokumenPerkuliahan.destroy');
    });
});

require __DIR__ . '/auth.php';
