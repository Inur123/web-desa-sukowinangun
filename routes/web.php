<?php

use App\Models\Kehilangan;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\ProfileController;


use App\Http\Controllers\Admin\PostController;

use App\Http\Controllers\Layanan\SkuController;

use App\Http\Controllers\Layanan\SktmController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Layanan\LainnyaController;
use App\Http\Controllers\Admin\ArsipSuratController;
use App\Http\Controllers\Layanan\DomisiliController;
use App\Http\Controllers\Layanan\KematianController;
use App\Http\Controllers\Admin\ContactFormController;
use App\Http\Controllers\Layanan\KelahiranController;
use App\Http\Controllers\Layanan\HargaTanahController;
use App\Http\Controllers\Layanan\KehilanganController;
use App\Http\Controllers\Layanan\PenghasilanController;
use App\Http\Controllers\Admin\Setting\BannerController;
use App\Http\Controllers\Layanan\BelumMenikahController;
use App\Http\Controllers\Layanan\PengantarSkckController;
use App\Http\Controllers\Admin\Setting\BroadcastWaController;



Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/form-kontak', [ContactFormController::class, 'store'])->name('form-kontak.store');

Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/form-kontak', [ContactFormController::class, 'index'])->name('form-kontak.index');
    Route::delete('/form-kontak/{id}', [ContactFormController::class, 'destroy'])->name('form-kontak.destroy');
    Route::get('/form-kontak/{id}', [ContactFormController::class, 'show'])->name('form-kontak.show');
    Route::resource('/posts', PostController::class);
    Route::post('/generate-content', [App\Http\Controllers\Admin\PostController::class, 'generateContent'])->name('generate.content');
    Route::resource('/arsip-surat',ArsipSuratController::class);
    Route::resource('/layanan/sku', SkuController::class)
        ->except(['store']);
    Route::resource('/layanan/belum-menikah', BelumMenikahController::class)
        ->except(['store']);
        Route::resource('/layanan/skck', PengantarSkckController::class)
    ->except(['store']);
    Route::resource('/layanan/domisili', DomisiliController::class)
        ->except(['store']);
    Route::resource('/layanan/harga-tanah', HargaTanahController::class)
        ->except(['store']);
    Route::resource('/layanan/kehilangan', KehilanganController::class)
        ->except(['store']);
    Route::resource('/layanan/kelahiran', KelahiranController::class)
        ->except(['store']);
    Route::resource('/layanan/kematian', KematianController::class)
        ->except(['store']);
    Route::resource('/layanan/penghasilan', PenghasilanController::class)
        ->except(['store']);
    Route::resource('/layanan/sktm', SktmController::class)
        ->except(['store']);
    Route::resource('/layanan/skck', PengantarSkckController::class)
        ->except(['store']);
    Route::resource('/layanan/lainnya', LainnyaController::class)
        ->except(['store']);


    //sku
    Route::post('/layanan/sku/{id}/approve', [SkuController::class, 'approve'])->name('sku.approve');
    Route::post('/layanan/sku/{id}/reject', [SkuController::class, 'reject'])->name('sku.reject');
    Route::get('/layanan/sku/{id}/file/{type}', [SkuController::class, 'showFile'])->name('sku.showFile');
    //sktm
    Route::post('/layanan/sktm/{id}/approve', [SktmController::class, 'approve'])->name('sktm.approve');
    Route::post('/layanan/sktm/{id}/reject', [SktmController::class, 'reject'])->name('sktm.reject');
    Route::get('/layanan/sktm/{id}/file/{type}', [SktmController::class, 'showFile'])->name('sktm.showFile');
    //domisili
    Route::post('/layanan/domisili/{id}/approve', [DomisiliController::class, 'approve'])->name('domisili.approve');
    Route::post('/layanan/domisili/{id}/reject', [DomisiliController::class, 'reject'])->name('domisili.reject');
    Route::get('/layanan/domisili/{id}/file/{type}', [DomisiliController::class, 'showFile'])->name('domisili.showFile');
    //harga-tanah
    Route::post('/layanan/harga-tanah/{id}/approve', [HargaTanahController::class, 'approve'])->name('harga-tanah.approve');
    Route::post('/layanan/harga-tanah/{id}/reject', [HargaTanahController::class, 'reject'])->name('harga-tanah.reject');
    Route::get('/layanan/harga-tanah/{id}/file/{type}', [HargaTanahController::class, 'showFile'])->name('harga-tanah.showFile');
    //belum-menikah
    Route::post('/layanan/belum-menikah/{id}/approve', [BelumMenikahController::class, 'approve'])->name('belum-menikah.approve');
    Route::post('/layanan/belum-menikah/{id}/reject', [BelumMenikahController::class, 'reject'])->name('belum-menikah.reject');
    Route::get('/layanan/belum-menikah/{id}/file/{type}', [BelumMenikahController::class, 'showFile'])->name('belum-menikah.showFile');
    //pengantar-skck
    Route::post('/layanan/pengantar-skck/{id}/approve', [PengantarSkckController::class, 'approve'])->name('pengantar-skck.approve');
    Route::post('/layanan/pengantar-skck/{id}/reject', [PengantarSkckController::class, 'reject'])->name('pengantar-skck.reject');
    Route::get('/layanan/pengantar-skck/{id}/file/{type}', [PengantarSkckController::class, 'showFile'])->name('pengantar-skck.showFile');
    //kehilangan
    Route::post('/layanan/kehilangan/{id}/approve', [KehilanganController::class, 'approve'])->name('kehilangan.approve');
    Route::post('/layanan/kehilangan/{id}/reject', [KehilanganController::class, 'reject'])->name('kehilangan.reject');
    Route::get('/layanan/kehilangan/{id}/file/{type}', [KehilanganController::class, 'showFile'])->name('kehilangan.showFile');
    //kelahiran
    Route::post('/layanan/kelahiran/{id}/approve', [KelahiranController::class, 'approve'])->name('kelahiran.approve');
    Route::post('/layanan/kelahiran/{id}/reject', [KelahiranController::class, 'reject'])->name('kelahiran.reject');
    Route::get('/layanan/kelahiran/{id}/file/{type}', [KelahiranController::class, 'showFile'])->name('kelahiran.showFile');
    //penghasilan
    Route::post('/layanan/penghasilan/{id}/approve', [PenghasilanController::class, 'approve'])->name('penghasilan.approve');
    Route::post('/layanan/penghasilan/{id}/reject', [PenghasilanController::class, 'reject'])->name('penghasilan.reject');
    Route::get('/layanan/penghasilan/{id}/file/{type}', [PenghasilanController::class, 'showFile'])->name('penghasilan.showFile');
    //kematian
    Route::post('/layanan/kematian/{id}/approve', [KematianController::class, 'approve'])->name('kematian.approve');
    Route::post('/layanan/kematian/{id}/reject', [KematianController::class, 'reject'])->name('kematian.reject');
    Route::get('/layanan/kematian/{id}/file/{type}', [KematianController::class, 'showFile'])->name('kematian.showFile');
    //lainnya
    Route::post('/layanan/lainnya/{id}/approve', [LainnyaController::class, 'approve'])->name('lainnya.approve');
    Route::post('/layanan/lainnya/{id}/reject', [LainnyaController::class, 'reject'])->name('lainnya.reject');
    Route::get('/layanan/lainnya/{id}/file/{fileId}', [LainnyaController::class, 'showFile'])->name('lainnya.showFile');

    // Setting
    Route::get('/BroadcastWa', [BroadcastWaController::class, 'index'])->name('admin.setting.BroadcastWa.index');
    Route::put('/BroadcastWa', [BroadcastWaController::class, 'update'])->name('admin.setting.BroadcastWa.update');

    Route::get('/banner', [BannerController::class, 'edit'])->name('admin.setting.banner');
    Route::put('/banner', [BannerController::class, 'update'])->name('admin.setting.banner.update');
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

//lainnya
Route::get('/layanan/lainnya/create', [LainnyaController::class, 'create'])->name('lainnya.create');
Route::post('/layanan/lainnya', [LainnyaController::class, 'store'])->name('lainnya.store');




