<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\DaftarPoli;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Poli;
use App\Models\Schedule;

class PasienController extends Controller
{
    public function dashboard()
    {
        $user = User::find(Auth::id());
        return view('pasien.dashboard');
    }

    public function index()
    {
        $polis = Poli::all();
        return view('pasien.poli.index', compact('polis'));
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404, 'Invalid ID format.');
        }

        $user = Auth::user();
        $poli = Poli::with('dokters')->findOrFail($id);
        $dokterIds = $poli->dokters->pluck('id');
        $schedules = Schedule::whereIn('dokter_id', $dokterIds)->get();
        $medical_record_number = optional($user->pasien)->medical_record_number;
        $dokters = $poli->dokters;

        // dd($user->pasien->daftarPoli);



        return view('pasien.poli.show', compact(
            'poli',
            'dokters',
            'schedules',
            'medical_record_number',
            'user'
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'schedule_id' => 'required',
            'keluhan' => 'required'
        ]);

        // Get the latest queue number for this schedule
        $latestQueue = DaftarPoli::where('schedule_id', $request->schedule_id)
            ->orderBy('no_antrian', 'desc')
            ->first();

        // Set queue number
        $queueNumber = $latestQueue ? $latestQueue->no_antrian + 1 : 1;

        try {
            DB::beginTransaction();

            DaftarPoli::create([
                'pasien_id' => $request->pasien_id,
                'schedule_id' => $request->schedule_id,
                'dokter_id' => $request->dokter_id,
                'keluhan' => $request->keluhan,
                'no_antrian' => $queueNumber,
                'status_periksa' => '0'
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Berhasil mendaftar poli');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mendaftar poli');
        }
    }
}
