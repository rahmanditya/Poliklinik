<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Obat;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        
        $specializations = Poli::all();
        $dokters = Dokter::all();
        $pasiens = Pasien::all();
        $polis = Poli::all();
        $obats = Obat::all();

        return view('admin.dashboard', compact('dokters','pasiens',
        'polis', 'obats', 'specializations'));
    }
}
