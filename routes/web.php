<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;

use App\Http\Controllers\AdminController;


use App\Http\Controllers\DokterController;

use App\Http\Controllers\PasienController;

use App\Http\Controllers\Admin\AdminDokterController;
use App\Http\Controllers\Admin\AdminPasienController;
use App\Http\Controllers\Admin\AdminPoliController;
use App\Http\Controllers\Admin\AdminObatController;

use App\Http\Controllers\Dokter\ScheduleController;

use App\Models\Obat;

use Illuminate\Support\Facades\Auth;

// HOME
Route::get('/', function () {
    return view('login');
})->name('home');

// REG PASIEN
Route::get('/register/index', [AuthController::class, 'showRegisterForm'])->name('register.index');
Route::post('/register/post', [AuthController::class, 'post'])->name('register.post');

// LOGIN
Route::get('/login/index', [AuthController::class, 'showLoginForm'])->name('login.index');

Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::get('/login', [AuthController::class, 'homeLogin'])->name('login');


// AUTH EROR
Route::get('/401', function () {
    return view('401');
})->name('401');


// ADMIN
Route::middleware(['auth', RoleMiddleware::class])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // MANAGE DOKTER
    Route::get('/admin/dokter', [AdminDokterController::class, 'index'])->name('admin.dokter.index');
    Route::get('/admin/dokter/create', [AdminDokterController::class, 'create'])->name('admin.dokter.create');
    Route::post('/admin/dokter', [AdminDokterController::class, 'store'])->name('admin.dokter.store');
    Route::get('/admin/dokter/{dokter}', [AdminDokterController::class, 'show'])->name('admin.dokter.show');
    Route::get('/admin/dokter/{dokter}/edit', [AdminDokterController::class, 'edit'])->name('admin.dokter.edit');
    Route::put('/admin/dokter/{dokter}', [AdminDokterController::class, 'update'])->name('admin.dokter.update');
    Route::delete('/admin/dokter/{dokter}', [AdminDokterController::class, 'destroy'])->name('admin.dokter.destroy');

    // MANAGE PASIEN
    Route::get('/admin/pasien', [AdminPasienController::class, 'index'])->name('admin.pasien.index');
    Route::get('/admin/pasien/create', [AdminPasienController::class, 'create'])->name('admin.pasien.create');
    Route::post('/admin/pasien', [AdminPasienController::class, 'store'])->name('admin.pasien.store');
    Route::get('/admin/pasien/{pasien}', [AdminPasienController::class, 'show'])->name('admin.pasien.show');
    Route::get('/admin/pasien/{pasien}/edit', [AdminPasienController::class, 'edit'])->name('admin.pasien.edit');
    Route::put('/admin/pasien/{pasien}', [AdminPasienController::class, 'update'])->name('admin.pasien.update');
    Route::delete('/admin/pasien/{pasien}', [AdminPasienController::class, 'destroy'])->name('admin.pasien.destroy');

    // MANAGE POLI
    Route::get('/admin/poli', [AdminPoliController::class, 'index'])->name('admin.poli.index');
    Route::get('/admin/poli/create', [AdminPoliController::class, 'create'])->name('admin.poli.create');
    Route::post('/admin/poli', [AdminPoliController::class, 'store'])->name('admin.poli.store');
    Route::get('/admin/poli/{poli}', [AdminPoliController::class, 'show'])->name('admin.poli.show');
    Route::get('/admin/poli/{poli}/edit', [AdminPoliController::class, 'edit'])->name('admin.poli.edit');
    Route::put('/admin/poli/{poli}', [AdminPoliController::class, 'update'])->name('admin.poli.update');
    Route::delete('/admin/poli/{poli}', [AdminPoliController::class, 'destroy'])->name('admin.poli.destroy');

    // MANAGE OBAT
    Route::get('admin/obat', [AdminObatController::class, 'index'])->name('admin.obat.index');
    Route::get('/admin/obat/create', [AdminObatController::class, 'create'])->name('admin.obat.create');
    Route::post('/admin/obat', [AdminObatController::class, 'store'])->name('admin.obat.store');
    Route::get('/admin/obat/{obat}', [AdminObatController::class, 'show'])->name('admin.obat.show');
    Route::get('/admin/obat/{obat}/edit', [AdminObatController::class, 'edit'])->name('admin.obat.edit');
    Route::put('/admin/obat/{obat}', [AdminObatController::class, 'update'])->name('admin.obat.update');
    Route::delete('/admin/obat/{obat}', [AdminObatController::class, 'destroy'])->name('admin.obat.destroy');

    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');
});

// DOKTER

Route::middleware(['auth', RoleMiddleware::class])->group(function () {
    Route::get('/dokter/dashboard', [DokterController::class, 'dashboard'])->name('dokter.dashboard');

    // JADWAL
    Route::get('/dokter/schedule', [ScheduleController::class, 'index'])->name('dokter.schedule.index');
    Route::get('/dokter/schedule/create', [ScheduleController::class, 'create'])->name('dokter.schedule.create');
    Route::post('/dokter/schedule', [ScheduleController::class, 'store'])->name('dokter.schedule.store');
    Route::get('/dokter/schedule/{schedule}/edit', [ScheduleController::class, 'edit'])->name('dokter.schedule.edit');
    Route::put('/dokter/schedule/{schedule}', [ScheduleController::class, 'update'])->name('dokter.schedule.update');

    // PERIKSA
    Route::get('/dokter/periksa/', [DokterController::class, 'indexPeriksa'])->name('dokter.periksa.index');
    Route::get('/dokter/periksa/create/{daftarPoli}', [DokterController::class, 'createPeriksa'])->name('dokter.periksa.create');
    Route::post('/dokter/periksa/store/{daftarPoli}', [DokterController::class, 'storePeriksa'])->name('dokter.periksa.store');
    Route::get('/dokter/periksa/{pasien}/edit', [DokterController::class, 'editPeriksa'])->name('dokter.periksa.edit');
    Route::put('/dokter/periksa/{pasien}', [DokterController::class, 'updateStatus'])->name('dokter.periksa.update');
    Route::post('/dokter/periksa/{periksa}/detail', [DokterController::class, 'detailPeriksa'])->name('dokter.periksa.detail');

    // OBAT PERIKSA
    Route::get('api/obat/search', [DokterController::class, 'searchObat'])->name('dokter.obat.search');
    Route::get('/api/obat/harga/{obat}', [DokterController::class, 'getObatPrice'])->name('dokter.obat.harga');

    // RIWAYAT
    Route::get('/dokter/riwayat/', [DokterController::class, 'indexRiwayat'])->name('dokter.riwayat.index');
    Route::get('/dokter/riwayat/{id}/detail', [DokterController::class, 'getDetail'])->name('dokter.riwayat.detail');

    // PROFIL
    Route::get('/dokter/profil/', [DokterController::class, 'indexProfil'])->name('dokter.profil.index');
    Route::put('/dokter/profil/update', [DokterController::class, 'updateProfil'])->name('dokter.profil.update');

    Route::post('/dokter/logout', [AuthController::class, 'logout'])->name('dokter.logout');
});

// PASIEN

Route::middleware(['auth', RoleMiddleware::class])->group(function () {

    Route::get('/pasien/dashboard', [PasienController::class, 'dashboard'])->name('pasien.dashboard');

    Route::get('/pasien/poli', [PasienController::class, 'index'])->name('pasien.poli.index');
    Route::get('/pasien/poli/{poli}', [PasienController::class, 'show'])->name('pasien.poli.show');
    Route::get('/pasien/poli/{id}/detail', [PasienController::class, 'showDetails'])->name('pasien.poli.detail');
    // Route::get('/dokter/riwayat/{id}/detail', [DokterController::class, 'getDetail'])->name('dokter.riwayat.detail');

    Route::post('/pasien/poli/store', [PasienController::class, 'store'])->name('pasien.poli.store');

    Route::post('/pasien/logout', [AuthController::class, 'logout'])->name('pasien.logout');
});

// ROLE AUTH

Route::get('/login/admin', function () {
    return redirect()->route('login.index', ['role' => 'admin']);
})->name('admin.login');

Route::get('/login/dokter', function () {
    return redirect()->route('login.index', ['role' => 'dokter']);
})->name('dokter.login');

Route::get('/login/pasien', function () {
    return redirect()->route('login.index', ['role' => 'pasien']);
})->name('pasien.login');
