<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Schedule;
use App\Models\Periksa;
use App\Models\DaftarPoli;

use Illuminate\Support\Facades\DB;

class AdminPoliController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('admin.poli.index', compact('polis'));
    }

    public function create()
    {
        $poli = Poli::all();

        return view('admin.poli.create', compact('poli'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:poli,name|max:255',
        ]);

        Poli::create([
            'name' => $request->input('name'),
        ]);

        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasil ditambahkan');
    }

    public function edit($id)
    {
        $poli = Poli::findOrFail($id);
        return view('admin.poli.edit', compact('poli'));
    }

    public function update(Request $request, $id)
    {
        $poli = Poli::findOrFail($id);

        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Update the dokter record
        $poli->update($request->only([
            'name',
        ]));


        return redirect()->route('admin.poli.index')->with('success', 'Poli berhasi di update.');
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404, 'Invalid Poli ID format.');
        }

        $poli = Poli::with(['dokters'])->findOrFail($id);

        $dokters = $poli->dokters;

        $daftar_poli = DaftarPoli::whereHas('dokter', function ($query) use ($poli) {
            $query->whereIn('id', $poli->dokters->pluck('id'));
        })->get();

        $pasiens = Pasien::whereIn('id', $daftar_poli->pluck('pasien_id'))->get();

        $allDokters = Dokter::all();

        return view('admin.poli.show', compact('poli', 'dokters', 'allDokters', 'pasiens', 'daftar_poli'));
    }


    public function assign(Request $request, $poliId)
    {
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        $poli = Poli::findOrFail($poliId);

        $dokter = Dokter::findOrFail($request->dokter_id);

        $poli->dokters()->attach($dokter);

        return redirect()->route('admin.poli.show', $poliId)->with('success', 'Dokter berhasil ditambahkan ke poli');
    }


    public function destroy($id)
    {
        $poli = Poli::findOrFail($id);
        $poli->delete();
        return redirect()->route('admin.poli.index')->with('success', 'Poli deleted successfully');
    }
}
