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

    // Dokters
    Route::get('/dokters', [DokterController::class, 'index'])->name('dokters.index');
    Route::get('/dokters/create', [DokterController::class, 'create'])->name('dokters.create');
    Route::post('/dokters', [DokterController::class, 'store'])->name('dokters.store');
    Route::get('/dokters/{dokter}', [DokterController::class, 'show'])->name('dokters.show');
    Route::get('/dokters/{dokter}/edit', [DokterController::class, 'edit'])->name('dokters.edit');
    Route::put('/dokters/{dokter}', [DokterController::class, 'update'])->name('dokters.update');
    Route::delete('/dokters/{dokter}', [DokterController::class, 'destroy'])->name('dokters.destroy');

    // Pasiens
    Route::get('/pasiens', [PasienController::class, 'index'])->name('pasiens.index');
    Route::get('/pasiens/create', [PasienController::class, 'create'])->name('pasiens.create');
    Route::post('/pasiens', [PasienController::class, 'store'])->name('pasiens.store');
    Route::get('/pasiens/{pasien}', [PasienController::class, 'show'])->name('pasiens.show');
    Route::get('/pasiens/{pasien}/edit', [PasienController::class, 'edit'])->name('pasiens.edit');
    Route::put('/pasiens/{pasien}', [PasienController::class, 'update'])->name('pasiens.update');
    Route::delete('/pasiens/{pasien}', [PasienController::class, 'destroy'])->name('pasiens.destroy');

    // Polis
    Route::get('/polis', [PoliController::class, 'index'])->name('polis.index');
    Route::get('/polis/create', [PoliController::class, 'create'])->name('polis.create');
    Route::post('/polis', [PoliController::class, 'store'])->name('polis.store');
    Route::get('/polis/{poli}', [PoliController::class, 'show'])->name('polis.show');
    Route::get('/polis/{poli}/edit', [PoliController::class, 'edit'])->name('polis.edit');
    Route::put('/polis/{poli}', [PoliController::class, 'update'])->name('polis.update');
    Route::delete('/polis/{poli}', [PoliController::class, 'destroy'])->name('polis.destroy');

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


