<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDonasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\KategoriProgramController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProfileHeroController;
use App\Http\Controllers\ProgramDonasiController;
use App\Http\Controllers\SejarahLembagaController;
use App\Http\Controllers\VisiMisiController;
use App\Models\ProgramDonasi;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== ROUTE AUTH ====================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==================== ROUTE PUBLIC ====================
Route::get('/', function () {
    return view('home.index');
})->name('home');

Route::get('/profile', function () {
    return view('home.profile');
})->name('profile');

// ROUTE BERITA PUBLIC
Route::get('/berita', [BeritaController::class, 'publicIndex'])->name('news');
Route::get('/berita/{slug}', [BeritaController::class, 'publicShow'])->name('berita.detail');
// ROUTE CARA DONASI
Route::get('/cara-donasi', function () {
    return view('home.cara-donasi');
})->name('cara.donasi');

// ROUTE PROGRAM DONASI PUBLIC
Route::get('/program', [ProgramDonasiController::class, 'publicIndex'])->name('programs');

// ROUTE DETAIL PROGRAM DONASI PUBLIC
Route::get('/donasi/{slug}', function ($slug) {
    $program = ProgramDonasi::where('slug', $slug)->firstOrFail();

    return view('home.donation-detail', compact('program'));
})->name('donation.detail');

Route::get('/kontak', function () {
    return view('home.contact');
})->name('contact');

// ==================== ROUTE DONASI (PROSES) ====================
Route::post('/donasi/confirm/{program_id}', [DonasiController::class, 'confirm'])->name('donasi.confirm');
Route::post('/donasi/store', [DonasiController::class, 'store'])->name('donasi.store');
Route::get('/donasi/payment/{kode_unik}', [DonasiController::class, 'payment'])->name('donasi.payment');
Route::post('/donasi/upload-bukti/{kode_unik}', [DonasiController::class, 'uploadBukti'])->name('donasi.upload-bukti');
Route::get('/donasi/waiting/{kode_unik}', [DonasiController::class, 'waiting'])->name('donasi.waiting');
Route::get('/donasi/success/{kode_unik}', [DonasiController::class, 'success'])->name('donasi.success');

// ===== ROUTE GALLERY PUBLIC =====
Route::get('/gallery', [GalleryController::class, 'publicIndex'])->name('gallery');
Route::get('/gallery/{id}/photos', [GalleryController::class, 'getPhotos'])->name('gallery.photos');

// ==================== ROUTE DONATUR (USER) ====================
Route::middleware(['auth'])->prefix('donatur')->group(function () {
    Route::get('/dashboard', [DonaturController::class, 'dashboard'])->name('donatur.dashboard');
    Route::get('/riwayat', [DonaturController::class, 'history'])->name('donation.history');
    Route::get('/riwayat/{id}', [DonaturController::class, 'detail'])->name('user.donation.detail');

    Route::get('/profil', [DonaturController::class, 'profile'])->name('donatur.profile');
    Route::get('/profil/edit', [DonaturController::class, 'editProfile'])->name('donatur.edit.profile');
    Route::put('/profil/update', [DonaturController::class, 'updateProfile'])->name('donatur.update.profile');
    Route::post('/profil/change-password', [DonaturController::class, 'changePassword'])->name('donatur.change.password');
});

// ==================== ROUTE ADMIN ====================
Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', function () {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/profile', [AuthController::class, 'adminProfile'])->name('admin.profile');

    // ===== KELOLA USER =====
    Route::get('/users', [AuthController::class, 'users'])->name('admin.users');
    Route::get('/users/{id}/edit', function ($id) {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
        $user = User::findOrFail($id);

        return response()->json($user);
    });
    Route::post('/users', [AuthController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/users/{id}', [AuthController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [AuthController::class, 'deleteUser'])->name('admin.users.delete');

    // ===== KELOLA BERITA =====
    Route::get('/berita', [BeritaController::class, 'index'])->name('admin.berita.index');
    Route::get('/berita/create', [BeritaController::class, 'create'])->name('admin.berita.create');
    Route::post('/berita', [BeritaController::class, 'store'])->name('admin.berita.store');
    Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('admin.berita.edit');
    Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('admin.berita.update');
    Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('admin.berita.delete');

    // ===== KELOLA PROGRAM =====
    Route::get('/programs', function () {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.programs');
    })->name('admin.programs');

    // ===== KELOLA DONASI =====
    Route::get('/donations', function () {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.donations');
    })->name('admin.donations');

    // ===== KELOLA TESTIMONI =====
    Route::get('/testimonials', function () {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        return view('admin.testimonials');
    })->name('admin.testimonials');

    // ===== KELOLA HERO SECTION =====
    Route::get('/hero', [HeroSectionController::class, 'index'])->name('admin.hero');
    Route::put('/hero/{id}', [HeroSectionController::class, 'update'])->name('admin.hero.update');

    // ===== KELOLA PROFILE HERO =====
    Route::get('/profile-hero', [ProfileHeroController::class, 'index'])->name('admin.profile-hero');
    Route::put('/profile-hero/{id}', [ProfileHeroController::class, 'update'])->name('admin.profile-hero.update');

    // ===== KELOLA SEJARAH LEMBAGA =====
    Route::get('/sejarah', [SejarahLembagaController::class, 'index'])->name('admin.sejarah');
    Route::put('/sejarah/{id}', [SejarahLembagaController::class, 'update'])->name('admin.sejarah.update');

    // ===== KELOLA VISI & MISI =====
    Route::get('/visi-misi', [VisiMisiController::class, 'index'])->name('admin.visi-misi');
    Route::put('/visi-misi/{id}', [VisiMisiController::class, 'update'])->name('admin.visi-misi.update');

    // ===== KELOLA KONTAK =====
    Route::get('/kontak', [KontakController::class, 'index'])->name('admin.kontak');
    Route::put('/kontak/{id}', [KontakController::class, 'update'])->name('admin.kontak.update');

    // ===== KELOLA KATEGORI PROGRAM =====
    Route::get('/kategori-program', [KategoriProgramController::class, 'index'])->name('admin.kategori-program.index');
    Route::get('/kategori-program/create', [KategoriProgramController::class, 'create'])->name('admin.kategori-program.create');
    Route::post('/kategori-program', [KategoriProgramController::class, 'store'])->name('admin.kategori-program.store');
    Route::get('/kategori-program/{id}/edit', [KategoriProgramController::class, 'edit'])->name('admin.kategori-program.edit');
    Route::put('/kategori-program/{id}', [KategoriProgramController::class, 'update'])->name('admin.kategori-program.update');
    Route::delete('/kategori-program/{id}', [KategoriProgramController::class, 'destroy'])->name('admin.kategori-program.delete');

    // ===== KELOLA PROGRAM DONASI =====
    Route::get('/program', [ProgramDonasiController::class, 'index'])->name('admin.program.index');
    Route::get('/program/create', [ProgramDonasiController::class, 'create'])->name('admin.program.create');
    Route::post('/program', [ProgramDonasiController::class, 'store'])->name('admin.program.store');
    Route::get('/program/{id}/edit', [ProgramDonasiController::class, 'edit'])->name('admin.program.edit');
    Route::put('/program/{id}', [ProgramDonasiController::class, 'update'])->name('admin.program.update');
    Route::delete('/program/{id}', [ProgramDonasiController::class, 'destroy'])->name('admin.program.delete');

    // ===== KELOLA BANK =====
    Route::get('/bank', [BankController::class, 'index'])->name('admin.bank.index');
    Route::get('/bank/create', [BankController::class, 'create'])->name('admin.bank.create');
    Route::post('/bank', [BankController::class, 'store'])->name('admin.bank.store');
    Route::get('/bank/{id}/edit', [BankController::class, 'edit'])->name('admin.bank.edit');
    Route::put('/bank/{id}', [BankController::class, 'update'])->name('admin.bank.update');
    Route::delete('/bank/{id}', [BankController::class, 'destroy'])->name('admin.bank.delete');

    // ============================================================
    // ===== ROUTE DONASI ADMIN =====
    // PENTING: URUTAN ROUTE HARUS SEPERTI INI!
    // ============================================================

    // 1. ROUTE STATIS (tanpa parameter) - DIDAHULUKAN
    Route::get('/donasi', [AdminDonasiController::class, 'index'])->name('admin.donasi.index');
    Route::patch('/donasi/settings', [AdminDonasiController::class, 'updateSettings'])->name('admin.donasi.settings.update');
    Route::get('/donasi/confirmed', [AdminDonasiController::class, 'confirmed'])->name('admin.donasi.confirmed');
    Route::get('/donasi/cancelled', [AdminDonasiController::class, 'cancelled'])->name('admin.donasi.cancelled');

    // 2. ROUTE DENGAN PARAMETER - SETELAH ROUTE STATIS
    // Tambahkan ->where('id', '[0-9]+') agar hanya menerima angka
    Route::get('/donasi/{id}', [AdminDonasiController::class, 'show'])
        ->name('admin.donasi.show')
        ->where('id', '[0-9]+');

    Route::post('/donasi/{id}/confirm', [AdminDonasiController::class, 'confirm'])
        ->name('admin.donasi.confirm')
        ->where('id', '[0-9]+');

    Route::delete('/donasi/{id}/cancel', [AdminDonasiController::class, 'cancel'])
        ->name('admin.donasi.cancel')
        ->where('id', '[0-9]+');

    Route::patch('/donasi/{id}/restore', [AdminDonasiController::class, 'restore'])
        ->name('admin.donasi.restore')
        ->where('id', '[0-9]+');

    Route::post('/donasi/{id}/unconfirm', [AdminDonasiController::class, 'unconfirm'])
        ->name('admin.donasi.unconfirm')
        ->where('id', '[0-9]+');

    // ===== ROUTE NOTIFIKASI =====
    Route::get('/admin/notifications', [AdminController::class, 'getNotifications'])->name('admin.notifications');

    Route::get('/donasi/invoice/{id}', [DonasiController::class, 'generateInvoice'])->name('donation.invoice');

    // ===== ROUTE EXPORT =====
    Route::get('/admin/donasi/export-excel', [DonasiController::class, 'exportExcelConfirmed'])->name('admin.donasi.export-excel');
    Route::get('/admin/donasi/export-pdf', [DonasiController::class, 'exportPdfConfirmed'])->name('admin.donasi.export-pdf');

    // ===== KELOLA GALLERY =====
    Route::resource('gallery', GalleryController::class)->names([
        'index' => 'admin.gallery.index',
        'create' => 'admin.gallery.create',
        'store' => 'admin.gallery.store',
        'show' => 'admin.gallery.show',
        'edit' => 'admin.gallery.edit',
        'update' => 'admin.gallery.update',
        'destroy' => 'admin.gallery.destroy',
    ]);
    Route::post('gallery/{id}/add-photos', [GalleryController::class, 'addPhotos'])->name('admin.gallery.add-photos');
    Route::delete('gallery/photo/{id}', [GalleryController::class, 'deletePhoto'])->name('admin.gallery.delete-photo');
    Route::post('gallery/update-order', [GalleryController::class, 'updatePhotoOrder'])->name('admin.gallery.update-order');
    Route::put('gallery/photo/{id}/update-keterangan', [GalleryController::class, 'updatePhotoKeterangan'])->name('admin.gallery.update-keterangan');
});
