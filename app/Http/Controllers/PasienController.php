<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Schedule;




class PasienController extends Controller
{
    public function index()
    {
        $polis = Poli::all();
        return view('pasien.poli.index', compact('polis'));
    }


    public function show($id)
    {
        $user = Auth::user();
        logger('Poli ID passed to show method: ' . $id);

        // Fetch the Poli and related Dokters
        $poli = Poli::with(['dokters', 'periksa.pasien'])->findOrFail($id);

        // Get all related Schedules for the Dokters in the Poli
        $schedules = Schedule::whereIn('dokter_id', $poli->dokters->pluck('id'))->get();

        $medical_record_number = optional($user->pasien)->medical_record_number;
        $dokters = $poli->dokters; // List of dokters in this poli
        $allDokters = Dokter::all(); // All dokters for the dropdown

        return view('pasien.poli.show', compact('poli', 'dokters', 'schedules', 'allDokters', 'medical_record_number'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'dokter_id' => 'required|exists:dokters,id',
            'schedule_id' => 'required|exists:schedules,id',
            'poli' => 'required|string|max:255',
            'complaint' => 'nullable|string',
        ]);

        // Assign the queue number dynamically
        $queueNumber = Poli::where('schedule_id', $validated['schedule_id'])->count() + 1;

        Poli::create([
            'pasien_id' => $validated['pasien_id'],
            'dokter_id' => $validated['dokter_id'],
            'schedule_id' => $validated['schedule_id'],
            'poli' => $validated['poli'],
            'complaint' => $validated['complaint'],
            'queue_number' => $queueNumber,
        ]);

        return redirect()->route('admin.poli.index')->with('success', 'Poli appointment created successfully!');
    }
}
