<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $role = auth()->user()->role_id;

        switch ($role) {
            case 1: // Admin
                return view('admin.dashboard');
            case 2: // Dokter
                return view('dokter.dashboard');
            case 3: // Pasien
                return view('pasien.dashboard');
            default:
                abort(403, 'Unauthorized access');
        }
    }
}
