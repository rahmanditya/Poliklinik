<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DokterController extends Controller
{
    
    // public function createPeriksa($id)
    // {
    //     $poli = Poli::with(['dokters', 'periksa.pasien'])->findOrFail($id); // Ensure ID is numeric

    //     $dokters = $poli->dokters;
    //     $pasiens = Pasien::all();
    //     $allDokters = Dokter::all();

    //     return view('poli.tambah_periksa', compact('poli', 'dokters', 'pasiens', 'allDokters'));
    // }

    // public function storePeriksa(Request $request)
    // {
    //     $validated = $request->validate([
    //         'specialization_id' => 'required|exists:poli,id',
    //         'pasien_id' => 'required|exists:pasiens,id',
    //         'jadwal_periksa_id' => 'nullable|exists:jadwal_periksa,id',
    //         'keluhan' => 'nullable|string',
    //     ]);

    //     DaftarPoli::create($validated);

    //     return redirect()->route('admin.poli.show')->with('success', 'Poli appointment created successfully!');
        
    // }
}
