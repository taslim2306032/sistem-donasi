<?php

use App\Http\Controllers\DonasiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


// ================= PUBLIC =================
Route::get('/', function () {
    return redirect()->route('donasi.index');
});

Route::get('/donasi', [DonasiController::class, 'index'])->name('donasi.index');
Route::get('/donasi/{id}', [DonasiController::class, 'show'])->name('donasi.show')->where('id', '[0-9]+');

// ================= AUTH (USER & ADMIN) =================
Route::middleware('auth')->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/users', [App\Http\Controllers\DashboardController::class, 'users'])->name('admin.users');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CREATE DONASI (ALL USERS can create, but status differs)
    Route::get('/donasi/create', [DonasiController::class, 'create'])->name('donasi.create');
    Route::post('/donasi', [DonasiController::class, 'store'])->name('donasi.store');

    // DONATE
    Route::get('/donasi/{id}/donasi', [DonasiController::class, 'donasiForm'])->name('donasi.form');
    Route::post('/donasi/{id}/donasi', [DonasiController::class, 'donasiStore'])->name('donasi.storeNominal');

    // HISTORY
    Route::get('/riwayat-donasi', [DonasiController::class, 'riwayat'])->name('donasi.riwayat');
});

// ================= ADMIN ONLY =================
Route::middleware(['auth', 'admin'])->group(function () {
    // MANAGE DONASI
    Route::get('/donasi/{id}/edit', [DonasiController::class, 'edit'])->name('donasi.edit');
    Route::put('/donasi/{id}', [DonasiController::class, 'update'])->name('donasi.update');
    Route::delete('/donasi/{id}', [DonasiController::class, 'destroy'])->name('donasi.destroy');

    // VERIFIKASI PEMBAYARAN
    Route::get('/admin/payments/pending', [DonasiController::class, 'pending'])->name('admin.payments.pending');
    Route::post('/admin/payments/{id}/verify', [DonasiController::class, 'verify'])->name('admin.payments.verify');
});

require __DIR__.'/auth.php';
