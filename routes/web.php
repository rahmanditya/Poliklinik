<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Middleware\RoleMiddleware;

use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\PasienController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Admin\ObatController;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');


// ADMIN DASHBOARD
Route::middleware([
    'auth:sanctum', 
    RoleMiddleware::class.':admin'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    // Dokter
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    Route::get('/dokter/create', [DokterController::class, 'create'])->name('dokter.create');
    Route::post('/dokter', [DokterController::class, 'store'])->name('dokter.store');
    Route::get('/dokter/{dokter}', [DokterController::class, 'show'])->name('dokter.show');
    Route::get('/dokter/{dokter}/edit', [DokterController::class, 'edit'])->name('dokter.edit');
    Route::put('/dokter/{dokter}', [DokterController::class, 'update'])->name('dokter.update');
    Route::delete('/dokter/{dokter}', [DokterController::class, 'destroy'])->name('dokter.destroy');

    // Pasien
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/create', [PasienController::class, 'create'])->name('pasien.create');
    Route::post('/pasien', [PasienController::class, 'store'])->name('pasien.store');
    Route::get('/pasien/{pasien}', [PasienController::class, 'show'])->name('pasien.show');
    Route::get('/pasien/{pasien}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
    Route::put('/pasien/{pasien}', [PasienController::class, 'update'])->name('pasien.update');
    Route::delete('/pasien/{pasien}', [PasienController::class, 'destroy'])->name('pasien.destroy');

    // Poli
    Route::get('/poli', [PoliController::class, 'index'])->name('poli.index');
    Route::get('/poli/create', [PoliController::class, 'create'])->name('poli.create');
    Route::post('/poli', [PoliController::class, 'store'])->name('poli.store');
    Route::get('/poli/{poli}', [PoliController::class, 'show'])->name('poli.show');
    Route::get('/poli/{poli}/edit', [PoliController::class, 'edit'])->name('poli.edit');
    Route::put('/poli/{poli}', [PoliController::class, 'update'])->name('poli.update');
    Route::delete('/poli/{poli}', [PoliController::class, 'destroy'])->name('poli.destroy');

    // Obats
    Route::get('/obats', [ObatController::class, 'index'])->name('obats.index');
    Route::get('/obats/create', [ObatController::class, 'create'])->name('obats.create');
    Route::post('/obats', [ObatController::class, 'store'])->name('obats.store');
    Route::get('/obats/{obat}', [ObatController::class, 'show'])->name('obats.show');
    Route::get('/obats/{obat}/edit', [ObatController::class, 'edit'])->name('obats.edit');
    Route::put('/obats/{obat}', [ObatController::class, 'update'])->name('obats.update');
    Route::delete('/obats/{obat}', [ObatController::class, 'destroy'])->name('obats.destroy');
});



// // Route::middleware([
// //     'auth:sanctum', 
// //     RoleMiddleware::class.':dokter'
// // ])->group(function () {
// //     Route::get('/dokter/dashboard', [DashboardController::class, 'dashboard'])->name('dokter.dashboard');
// // });

// // Route::middleware([
// //     'auth:sanctum', 
// //     RoleMiddleware::class.':pasien'
// // ])->group(function () {
// //     Route::get('/pasien/dashboard', [DashboardController::class, 'dashboard'])->name('pasien.dashboard');
// // });

// // ADMIN DASHBOARD
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::prefix('admin')->name('admin.')->group(function () {
//         Route::get('/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
//         Route::resource('/dokter', DokterController::class);
//         Route::resource('/pasien', PasienController::class);
//         Route::resource('/poli', PoliController::class);
//         Route::resource('/obat', ObatController::class);
//     });
// });

// // PASIEN DASHBOARD
// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::prefix('pasien')->name('pasien.')->group(function () {
//         Route::get('/dashboard', [DashboardController::class, 'pasienDashboard'])->name('dashboard');
//         Route::get('/riwayat-poli', [RiwayatController::class, 'index'])->name('riwayat.index');
//         Route::get('/riwayat-poli/{id}', [RiwayatController::class, 'detail'])->name('riwayat.detail');
//         Route::get('/register', [RegisterController::class, 'create'])->name('register.create');
//         Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
//     });
// });


