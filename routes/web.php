<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\Layanan\SkuController;
use App\Http\Controllers\Layanan\SktmController;

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/posts', PostController::class);
    Route::resource('/arsip-surat',ArsipSuratController::class);
    Route::resource('/layanan/sku', SkuController::class)
        ->except(['store']);
    //sku
    Route::post('/layanan/sku/{id}/approve', [SkuController::class, 'approve'])->name('sku.approve');
    Route::post('/layanan/sku/{id}/reject', [SkuController::class, 'reject'])->name('sku.reject');
    Route::get('/layanan/sku/{id}/file/{type}', [SkuController::class, 'showFile'])->name('sku.showFile');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');

//sku
Route::get('/layanan/sku/create', [SkuController::class, 'create'])->name('sku.create');
Route::post('/layanan/sku', [SkuController::class, 'store'])->name('sku.store');




