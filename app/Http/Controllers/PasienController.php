<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Carbon;
use Carbon\Carbon;

use App\Models\DaftarPoli;
use App\Models\DetailPeriksa;
use App\Models\Periksa;
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
        // Helper function inside the controller
        function getNextDateForDay($dayName)
        {
            $daysOfWeek = [
                'Senin' => Carbon::MONDAY,
                'Selasa' => Carbon::TUESDAY,
                'Rabu' => Carbon::WEDNESDAY,
                'Kamis' => Carbon::THURSDAY,
                'Jumat' => Carbon::FRIDAY,
                'Sabtu' => Carbon::SATURDAY,
                'Minggu' => Carbon::SUNDAY,
            ];

            if (!isset($daysOfWeek[$dayName])) {
                return null;
            }

            return Carbon::now()->next($daysOfWeek[$dayName]);
        }

        // Validate the ID
        if (!is_numeric($id)) {
            abort(404, 'Invalid ID format.');
        }

        $user = Auth::user();
        $pasien = Pasien::where('user_id', $user->id)->first();

        // Check if the user is authorized
        if ($pasien->user_id !== $user->id) {
            abort(403, 'Access denied. You are not authorized to view this resource.');
        }

        $poli = Poli::with('dokters')->findOrFail($id);

        $dokterIds = $poli->dokters->pluck('id');

        // Retrieve only active schedules
        $activeSchedules = Schedule::whereIn('dokter_id', $dokterIds)
            ->where('is_active', true)
            ->get();

        // Format the dates for the active schedules
        foreach ($activeSchedules as $schedule) {
            $schedule->formatted_hari = getNextDateForDay($schedule->hari)->translatedFormat('l, d F Y');
        }

        $dokters = $poli->dokters;
        $medical_record_number = optional($user->pasien)->medical_record_number;

        // Pass only the active schedules to the view
        return view('pasien.poli.show', compact(
            'activeSchedules',
            'poli',
            'medical_record_number',
            'user',
            'dokters'
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

    public function showDetails($id)
    {
        $periksa = Periksa::with(['dokter', 'detailPeriksa.obat'])
            ->where('daftar_poli_id', $id)
            ->first();

        if (!$periksa) {
            return response()->json(['error' => 'Detail not found'], 404);
        }

        return response()->json([
            'tglPeriksa' => $periksa->tgl_periksa,
            'catatan' => $periksa->catatan,
            'biayaPeriksa' => $periksa->biaya_periksa,
            'dokterName' => $periksa->dokter->name ?? '-',
            'detailPeriksa' => $periksa->detailPeriksa->map(function ($detail) {
                return [
                    'obatName' => $detail->obat->name ?? 'Unknown',
                ];
            }),
        ]);
    }
}
