<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
use App\Http\Controllers\FcmController;
use Kreait\Firebase\Contract\Messaging;
use App\Http\Controllers\TestNotificationController;
use App\Http\Controllers\MonitoringLogController;







Route::get('/w', function () {
    return view('welcome');
    });
// LOGIN
Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

// DASHBOARD PETUGAS
Route::middleware('petugas')->group(function () {

    Route::get('/petugas/dashboard', [PetugasController::class, 'dashboard']);
    Route::get('/petugas/container', [PetugasController::class, 'container']);
    Route::get('/petugas/notifikasi', [PetugasController::class, 'notifikasi']);
    Route::get('/petugas/laporan', [PetugasController::class, 'laporan']);
    Route::get('/petugas/monitoring-log', [MonitoringLogController::class, 'index']);



});
Route::middleware(['admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/admin/analytics', [AdminController::class, 'analytics']);
    Route::get('/admin/tambah/petugas', [AdminController::class, 'createPetugas'])->name('admin.petugas.create');
    Route::post('/admin/petugas/store', [AdminController::class, 'storePetugas']) ->name('admin.petugas.store');
    Route::get('/admin/daftar/petugas', [AdminController::class, 'daftarPetugas'])->name('admin.petugas.index');
    Route::get('/admin/petugas/export', [AdminController::class, 'exportPetugas'])->name('admin.petugas.export');
    Route::get   ('/admin/petugas/{user}/edit', [AdminController::class, 'editPetugas'])->name('admin.petugas.edit');
    Route::put   ('/admin/petugas/{user}',      [AdminController::class, 'updatePetugas'])->name('admin.petugas.update');
    Route::delete('/admin/petugas/{user}',      [AdminController::class, 'destroyPetugas'])->name('petugas.destroy');
    Route::get('/admin/daftar/kontainer', [ContainerController::class, 'index'])->name('admin.kontainer.index');
    Route::get('/admin/tambah/kontainer', [ContainerController::class, 'create'])->name('admin.kontainer.create');
    Route::post('/admin/kontainer/store', [ContainerController::class, 'store'])->name('admin.kontainer.store');
    Route::get('/admin/kontainer/{id}', [ContainerController::class, 'edit'])->name('admin.kontainer.edit');
    Route::put('/admin/kontainer/{id}', [ContainerController::class, 'update'])->name('admin.kontainer.update');
    Route::delete('/admin/kontainer/{id}', [ContainerController::class, 'destroy'])->name('admin.kontainer.destroy');

    Route::get('admin/kecamatan', [KecamatanController::class, 'index'])->name('admin.kecamatan.index');
    Route::get('admin/tambah/kecamatan', [KecamatanController::class, 'create'])->name('admin.kecamatan.create');
    Route::post('admin/kecamatan', [KecamatanController::class, 'store'])->name('admin.kecamatan.store');
    Route::get   ('/kecamatan/{id}/edit',    [KecamatanController::class, 'edit'])   ->name('admin.kecamatan.edit');   
    Route::put('admin/kecamatan/{id}', [KecamatanController::class, 'update'])->name('admin.kecamatan.update');
    Route::delete('admin/kecamatan/{id}', [KecamatanController::class, 'destroy'])->name('admin.kecamatan.destroy');

    Route::get('admin/kelurahan', [KelurahanController::class, 'index'])->name('admin.kelurahan.index');
    Route::get('admin/tambah/kelurahan', [KelurahanController::class, 'create'])->name('admin.kelurahan.create');
    Route::post('admin/kelurahan', [KelurahanController::class, 'store'])->name('admin.kelurahan.store');
    Route::get('admin/kelurahan/{id}/edit', [KelurahanController::class, 'edit'])->name('admin.kelurahan.edit');
    Route::put('admin/kelurahan/{id}', [KelurahanController::class, 'update'])->name('admin.kelurahan.update');
    Route::delete('admin/kelurahan/{id}', [KelurahanController::class, 'destroy'])->name('admin.kelurahan.destroy');
    Route::get('admin/monitoring-log', [MonitoringLogController::class, 'index']);



});

Route::get('/export-excel', [ContainerController::class, 'exportExcel']);
Route::post('/save-fcm-token', [FcmController::class, 'saveToken']);
Route::get('/test-notifikasi', [TestNotificationController::class, 'kirim']);
Route::get('/firebase-test', function (Messaging $messaging) {
    return "Firebase Connected!";
});
// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/info', [ContainerController::class, 'info']);
Route::get('/', [ContainerController::class, 'dashboard']);








