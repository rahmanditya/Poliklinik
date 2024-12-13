<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Models\Poli;
use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Periksa;
use App\Models\Schedule;

class DokterController extends Controller
{
    public function dashboard()
    {
        $user = User::find(Auth::id());
        return view('dokter.dashboard');
    }

    public function indexJadwal()
    {
        $schedules = Schedule::all();
        return view('dokter.schedule.index', compact('schedules'));
    }
    
    public function indexPeriksa()
    {
        $periksa = Periksa::all();
        return view('dokter.periksa.index', compact('periksa'));
    }

    public function indexRiwayat()
    {
        $riwayat = Periksa::all();
        return view('dokter.riwayat.index', compact('riwayat'));
    }

    public function indexProfil()
    {
        $profil = User::all();
        return view('dokter.profil.index', compact('profil'));
    }

    public function createJadwal()
    {
        $user = Auth::user();

        // Fetch all Poli along with their associated Dokters
        $poli = Poli::with('dokters')->get();

        // Collect all dokter IDs from all Poli
        $dokterIds = $poli->flatMap(function ($poli) {
            return $poli->dokters->pluck('id');
        });

        // Get schedules for these dokter IDs
        $schedules = Schedule::whereIn('dokter_id', $dokterIds)->get();

        // Fetch medical record number if user is a pasien
        $medical_record_number = optional($user->pasien)->medical_record_number;

        // Fetch all Dokters
        $dokters = Dokter::all(); // Or whatever method you're using to get Dokters

        // Pass the data to the view
        return view('dokter.schedule.create', compact(
            'poli',
            'user',
            'dokterIds',
            'dokters' // Pass dokters to the view as well
        ));
    }



    public function storeJadwal(Request $request)
    {
        // Validate the input
        $request->validate([
            'hari' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'date' => 'required|date',
            'dokter' => 'required|exists:dokters,id',
        ]);

        $dokterId = $request->dokter;
        $hari = $request->hari;
        $date = $request->date;
        $startTime = $request->start_time;
        $endTime = $request->end_time;

        // Check for overlapping schedules
        $overlappingSchedules = Schedule::where('dokter_id', $dokterId)
            ->where('hari', $hari)
            ->where(function ($query) use ($startTime, $endTime) {
                $query->where(function ($q) use ($startTime, $endTime) {
                    $q->where('start_time', '<', $endTime)
                        ->where('end_time', '>', $startTime);
                });
            })
            ->exists();

        if ($overlappingSchedules) {
            return redirect()->back()->withErrors(['error' => 'Schedule overlaps with an existing one.']);
        }

        // Create new schedule
        Schedule::insert([
            'dokter_id' => $dokterId,
            'hari' => $hari,
            'date' => $date,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ]);

        return redirect()->route('dokter.schedule.index')->with('success', 'Schedule created successfully.');
    }

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
