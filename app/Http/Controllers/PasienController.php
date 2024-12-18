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
        $pasien = Pasien::where('user_id', $user->id)->first();

        if ($pasien->user_id !== $user->id) {
            abort(403, 'Access denied. You are not authorized to view this resource.');
        }
        $poli = Poli::with('dokters')->findOrFail($id);
        
        $dokterIds = $poli->dokters->pluck('id');

        $schedules = Schedule::whereIn('dokter_id', $dokterIds)->get();

        $medical_record_number = optional($user->pasien)->medical_record_number;
        
        $dokters = $poli->dokters;


        return view('pasien.poli.show', compact(
            'poli',
            'dokters',
            'schedules',
            'medical_record_number',
            'user'
        ));
    }

    // public function show($id)
    // {

    //     $user = Auth::user();

    //     if (!$user) {
    //         return abort(404, 'User not found');
    //     }

    //     if ($user->role_id != 2) {
    //         return abort(403, 'Access denied');
    //     }

    //     $pasien = Pasien::where('user_id', $user->id)->first(); 

    //     $poli = Poli::where('dokter_id', $dokter->id)->get();

    //     // Ensure the user has access to this resource (if applicable, customize this logic as needed)
    //     if ($pasien->user_id !== $user->id) {
    //         abort(403, 'Access denied. You are not authorized to view this resource.');
    //     }

    //     // Get related dokters and their schedules
    //     $dokterIds = $poli->dokters->pluck('id');
    //     $schedules = Schedule::whereIn('dokter_id', $dokterIds)->get();

    //     // Get the user's medical record number (if applicable)
    //     $medical_record_number = optional($user->pasien)->medical_record_number;

    //     // Return the view with the data
    //     return view('pasien.poli.show', compact(
    //         'poli',
    //         'dokters',
    //         'schedules',
    //         'medical_record_number',
    //         'user'
    //     ));
    // }


    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required',
            'dokter_id' => 'required',
            'schedule_id' => 'required',
            'keluhan' => 'required'
        ]);

        $latestQueue = DaftarPoli::where('schedule_id', $request->schedule_id)
            ->orderBy('no_antrian', 'desc')
            ->first();

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
