<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\Pasien;
use App\Models\Dokter;
use App\Models\Schedule;

class PoliController extends Controller
{
    public function index()
    {
        $polis = Poli::with(['pasien', 'dokter', 'schedule'])->get();

        return view('admin.poli.index', compact('polis'));
    }

    public function create()
    {
        $polis = Poli::all();
        $pasiens = Pasien::all();
        $dokters = Dokter::all();
        $schedules = Schedule::all();
        
        return view('admin.poli.create', compact('polis', 'pasiens', 'dokters', 'schedules'));
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
