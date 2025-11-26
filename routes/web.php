<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminProdiController;
use App\Http\Controllers\Admin\AdminMatkulController;
use App\Http\Controllers\Admin\AdminKelasController;
use App\Http\Controllers\Admin\AdminTahunAjaranController;
use App\Http\Controllers\Admin\AdminDokumenPerkuliahanController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminAssignmentDosenController;
use App\Http\Controllers\Admin\GKMPProgresKelasController;
use App\Http\Controllers\Admin\DosenKelasDiampuController;
use App\Http\Controllers\Admin\DosenRiwayatDokumenController;
use App\Http\Controllers\Admin\DataTemuan\KriteriaController;
use App\Http\Controllers\Admin\DataTemuan\SubkriteriaController;
use App\Http\Controllers\Admin\DataTemuan\IsiSubkriteriaController;


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

        // CRUD ROLE
        Route::resource('role', AdminRoleController::class);

        // ASSIGNMENT DOSEN — STEP 1
        Route::get('/assignment-dosen', [AdminAssignmentDosenController::class, 'stepOne'])
            ->name('assignmentDosen.stepOne');

        // ASSIGNMENT DOSEN — STEP 2
        Route::get('/assignment-dosen/step-two', [AdminAssignmentDosenController::class, 'stepTwo'])
            ->name('assignmentDosen.stepTwo');

        // ASSIGNMENT DOSEN — SUBMIT STEP 1 DAN 2
        Route::post('/assignment-dosen/step-two', [AdminAssignmentDosenController::class, 'submitStepOneAndTwo'])
            ->name('assignmentDosen.submitStepOneAndTwo');


        // CRUD DOKUMEN PERKULIAHAN
        Route::get('/dokumen-perkuliahan', [AdminDokumenPerkuliahanController::class, 'index'])->name('dokumenPerkuliahan.index');
        Route::post('/dokumen-perkuliahan', [AdminDokumenPerkuliahanController::class, 'store'])->name('dokumenPerkuliahan.store');
        Route::put('/dokumen-perkuliahan/{dokumenPerkuliahan}', [AdminDokumenPerkuliahanController::class, 'update'])->name('dokumenPerkuliahan.update');
        Route::delete('/dokumen-perkuliahan/{dokumenPerkuliahan}', [AdminDokumenPerkuliahanController::class, 'destroy'])->name('dokumenPerkuliahan.destroy');


        // LEVEL 1: KRITERIA
        Route::prefix('temuan')->name('temuan.')->group(function () {

            Route::get('/', [KriteriaController::class, 'index'])->name('index');
            Route::get('/create', [KriteriaController::class, 'create'])->name('create');
            Route::post('/', [KriteriaController::class, 'store'])->name('store');

            // LEVEL 2: SUBKRITERIA
            Route::prefix('{kriteria}/sub')->name('sub.')->group(function () {

                Route::get('/create', [SubkriteriaController::class, 'create'])->name('create');
                Route::post('/', [SubkriteriaController::class, 'store'])->name('store');

                Route::get('/{sub}', [SubkriteriaController::class, 'show'])->name('show');
                Route::get('/{sub}/edit', [SubkriteriaController::class, 'edit'])->name('edit');
                Route::put('/{sub}', [SubkriteriaController::class, 'update'])->name('update');

                Route::delete('/{sub}', [SubkriteriaController::class, 'destroy'])->name('destroy');

                // LEVEL 3: ISI SUBKRITERIA
                Route::prefix('{sub}/isi')->name('isi.')->group(function () {

                    Route::get('/create', [IsiSubkriteriaController::class, 'create'])->name('create');
                    Route::post('/', [IsiSubkriteriaController::class, 'store'])->name('store');

                    Route::get('/{isi}/edit', [IsiSubkriteriaController::class, 'edit'])->name('edit');
                    Route::put('/{isi}', [IsiSubkriteriaController::class, 'update'])->name('update');

                    Route::delete('/{isi}', [IsiSubkriteriaController::class, 'destroy'])->name('destroy');
                });
            });


            Route::get('/{kriteria}', [KriteriaController::class, 'show'])->name('show');
            Route::get('/{kriteria}/edit', [KriteriaController::class, 'edit'])->name('edit');
            Route::put('/{kriteria}', [KriteriaController::class, 'update'])->name('update');
            Route::delete('/{kriteria}', [KriteriaController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('gkmp')->name('gkmp.')->group(function () {
        // PROGRES KELAS
        Route::get('/progres-kelas', [GKMPProgresKelasController::class, 'index'])->name('progresKelas.index');

        // PROGRES BY SESI
        Route::get('/progres-kelas/sesi/{sesi}', [GKMPProgresKelasController::class, 'previewSesiPDF'])
            ->name('progresKelas.sesi');

        // DETAIL-KELAS
        Route::get('/progres-kelas/{id}', [GKMPProgresKelasController::class, 'detailKelas'])->name('detailKelas.index');

        // TOLAK DOKUMEN
        Route::post('/gkmp/progres-kelas/tolak', [GKMPProgresKelasController::class, 'tolak'])->name('progres-kelas.tolak');
    });

    Route::prefix('dosen')->name('dosen.')->group(function () {

        Route::get('/kelas-diampu', [DosenKelasDiampuController::class, 'index'])->name('kelasDiampu.index');
        Route::get('/kelas-diampu/{kelasID}', [DosenKelasDiampuController::class, 'show'])->name('kelasDiampu.show');
        Route::post('/kelas-diampu/upload/{dokumenKelas}', [DosenKelasDiampuController::class, 'upload'])->name('kelasDiampu.upload');

        Route::get('/riwayat-dokumen', [DosenRiwayatDokumenController::class, 'index'])->name('riwayatDokumen.index');
    });
});

require __DIR__ . '/auth.php';
