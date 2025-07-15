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
use App\Http\Controllers\Layanan\BelumMenikahController;
use App\Http\Controllers\Layanan\PengantarSkckController;
use App\Http\Controllers\Layanan\DomisiliController;
use App\Http\Controllers\Layanan\HargaTanahController;
use App\Http\Controllers\Layanan\KehilanganController;
use App\Http\Controllers\Layanan\KelahiranController;
use App\Http\Controllers\Layanan\KematianController;
use App\Http\Controllers\Layanan\PenghasilanController;
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

// Surat Keterangan Belum Menikah
Route::get('/layanan/belum-menikah/create', [BelumMenikahController::class, 'create'])->name('belum-menikah.create');
Route::post('/layanan/belum-menikah', [BelumMenikahController::class, 'store'])->name('belum-menikah.store');

// Surat Pengantar SKCK
Route::get('/layanan/pengantar-skck/create', [PengantarSkckController::class, 'create'])->name('pengantar-skck.create');
Route::post('/layanan/pengantar-skck', [PengantarSkckController::class, 'store'])->name('pengantar-skck.store');

// Surat Keterangan Domisili
Route::get('/layanan/domisili/create', [DomisiliController::class, 'create'])->name('domisili.create');
Route::post('/layanan/domisili', [DomisiliController::class, 'store'])->name('domisili.store');

// Surat Keterangan Harga Tanah
Route::get('/layanan/harga-tanah/create', [HargaTanahController::class, 'create'])->name('harga-tanah.create');
Route::post('/layanan/harga-tanah', [HargaTanahController::class, 'store'])->name('harga-tanah.store');

// Surat Keterangan Kehilangan
Route::get('/layanan/kehilangan/create', [KehilanganController::class, 'create'])->name('kehilangan.create');
Route::post('/layanan/kehilangan', [KehilanganController::class, 'store'])->name('kehilangan.store');

// Surat Keterangan Kelahiran
Route::get('/layanan/kelahiran/create', [KelahiranController::class, 'create'])->name('kelahiran.create');
Route::post('/layanan/kelahiran', [KelahiranController::class, 'store'])->name('kelahiran.store');

// Surat Keterangan Kematian
Route::get('/layanan/kematian/create', [KematianController::class, 'create'])->name('kematian.create');
Route::post('/layanan/kematian', [KematianController::class, 'store'])->name('kematian.store');

// Surat Keterangan Penghasilan
Route::get('/layanan/penghasilan/create', [PenghasilanController::class, 'create'])->name('penghasilan.create');
Route::post('/layanan/penghasilan', [PenghasilanController::class, 'store'])->name('penghasilan.store');

// Surat SKTM
Route::get('/layanan/sktm/create', [SktmController::class, 'create'])->name('sktm.create');
Route::post('/layanan/sktm', [SktmController::class, 'store'])->name('sktm.store');


