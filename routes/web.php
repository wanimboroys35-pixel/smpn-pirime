<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\SiswaController as AdminSiswaController;
use App\Http\Controllers\User\SiswaController as UserSiswaController;
use App\Http\Controllers\Admin\PendaftarController;

        
        use App\Http\Controllers\Admin\SiswaController;


// ================= HALAMAN AWAL =================
// ================= HALAMAN AWAL =================
// ================= HALAMAN UTAMA (PUBLIK) =================

// Beranda
Route::get('/', fn() => view('home'))->name('home');

// Tentang Sekolah
Route::get('/tentang', fn() => view('tentang'))->name('tentang');

// Pendaftaran PPDB
Route::get('/daftar', fn() => view('daftar'))->name('daftar');

// Informasi Pengumuman
Route::get('/pengumuman', fn() => view('pengumuman'))->name('pengumuman');

// Kontak Sekolah
Route::get('/kontak', fn() => view('kontak'))->name('kontak');

// ================= ADMIN =================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::patch('/siswa/{id}/update-status', [SiswaController::class, 'updateStatus'])->name('siswa.updateStatus');
});


// ======================
// ROUTE ADMIN SISWA
// ======================
Route::prefix('admin')->name('admin.')->group(function () {

    // Dashboard Siswa
    Route::get('/siswas/dashboard', [SiswaController::class, 'dashboard'])
        ->name('siswas.dashboard');

    // Resource CRUD Siswa
    Route::resource('siswas', SiswaController::class)
        ->except(['show']); // karena tidak ada show di controllermu

    // Update status siswa
    Route::post('/siswas/{id}/update-status', [SiswaController::class, 'updateStatus'])
        ->name('siswas.updateStatus');

    // Export ke CSV
    Route::get('/siswas/export', [SiswaController::class, 'export'])
        ->name('siswas.export');

    // Import dari CSV
    Route::post('/siswas/import', [SiswaController::class, 'import'])
        ->name('siswas.import');
});

// ================= AUTH =================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

// ================= USER =================
Route::middleware(['auth', 'role:user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {
        // Dashboard User
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');

        // CRUD siswa (user hanya kelola datanya sendiri)
        Route::resource('siswas', UserSiswaController::class);
        
        

        // Alias form pendaftaran
        Route::get('/pendaftaran', [UserSiswaController::class, 'create'])->name('siswa.create');
        Route::post('/pendaftaran', [UserSiswaController::class, 'store'])->name('siswa.store');
        Route::get('/pendaftaran/list', [UserSiswaController::class, 'index'])->name('siswa.index');
    });

// ================= ADMIN =================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Dashboard utama admin
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/siswas/dashboard', [AdminSiswaController::class, 'index'])->name('siswas.dashboard');



Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::patch('/siswa/{id}/update-status', [SiswaController::class, 'updateStatus'])->name('siswa.updateStatus');
    });


    // ✅ Tambahkan route ini
    Route::post('/siswa/{id}/update-status', [SiswaController::class, 'updateStatus'])->name('siswa.updateStatus');
    Route::patch('/admin/siswa/{id}/status', [SiswaController::class, 'updateStatus'])->name('admin.siswa.updateStatus');
    Route::patch('/admin/siswa/{id}/update-status', [SiswaController::class, 'updateStatus'])->name('admin.siswa.updateStatus');

        // CRUD siswa
        Route::resource('siswas', AdminSiswaController::class);
        Route::get('/siswas/dashboard', [AdminSiswaController::class, 'index'])->name('siswas.dashboard');
        Route::get('/siswas/export', [AdminSiswaController::class, 'export'])->name('siswas.export');
        Route::post('/siswas/import', [AdminSiswaController::class, 'import'])->name('siswas.import');
        Route::patch('/siswas/{id}/status', [AdminSiswaController::class, 'updateStatus'])->name('siswas.updateStatus');

        // CRUD & update status pendaftar
        Route::patch('/pendaftar/{id}/update-status', [PendaftarController::class, 'updateStatus'])
            ->name('pendaftar.updateStatus');
    });
    Route::prefix('user')->name('user.')->group(function() {
    Route::get('siswas', [SiswaController::class, 'index'])->name('siswas.index');

    // Tambahkan route export/import/cetak
    Route::get('siswas/export', [SiswaController::class, 'export'])->name('siswas.export');
    Route::post('siswas/import', [SiswaController::class, 'import'])->name('siswas.import');
    Route::get('siswas/cetak', [SiswaController::class, 'cetak'])->name('siswas.cetak');
});