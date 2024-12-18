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
use App\Models\Role;

use Illuminate\Support\Facades\Log;


class DokterController extends Controller
{
    public function dashboard()
    {
        $user = User::find(Auth::id());
        return view('dokter.dashboard');
    }

    public function indexPeriksa()
    {
        // Get the currently authenticated dokter
        $user = Auth::user();

        $dokter = Dokter::where('user_id', $user->id)->first();

        if (!$dokter) {
            return abort(404, 'Dokter not found');
        }

        // Fetch daftar_poli records for the dokter, including related pasien and schedule data
        $daftarPoli = DaftarPoli::with(['pasien', 'schedule', 'periksa'])
            ->where('dokter_id', $dokter->id)
            ->where('status', '!=', 'selesai')
            ->get();


        // Pass data to the view
        // EDIT===

        // {{ route('dokter.periksa.edit', $periksa->id) }}
        // {{route('dokter.periksa.updateStatus', $periksa->id)}}
        return view('dokter.periksa.index', compact('dokter', 'daftarPoli'));
    }

    public function createPeriksa($daftarPoliId)
    {
        $user = Auth::user();

        // Fetch the relevant daftar_poli entry
        $daftarPoli = DaftarPoli::with(['pasien', 'dokter'])->findOrFail($daftarPoliId);

        // Ensure the logged-in dokter is associated with this daftar_poli entry

        $dokter = Dokter::where('user_id', $user->id)->first();

        if ($daftarPoli->dokter_id !== $dokter->id) {
            abort(403, 'Access denied.');
        }

        return view('dokter.periksa.create', compact('daftarPoli', 'dokter'));
    }

    public function storePeriksa(Request $request, $daftarPoliId)
    {
        $user = Auth::user();

        // Validate the input
        $validated = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'biaya_periksa' => 'nullable|numeric|min:0',
        ]);

        // Fetch the daftar_poli entry
        $daftarPoli = DaftarPoli::findOrFail($daftarPoliId);


        $dokter = Dokter::where('user_id', $user->id)->first();

        if ($daftarPoli->dokter_id !== $dokter->id) {
            abort(403, 'Access denied.');
        }

        // Create the periksa entry
        $periksa = Periksa::create([
            'daftar_poli_id' => $daftarPoli->id,
            'dokter_id' => $dokter->id,
            'tgl_periksa' => $validated['tgl_periksa'],
            'catatan' => $validated['catatan'],
            'biaya_periksa' => $validated['biaya_periksa'],
        ]);

        $daftarPoli->update(['status' => 'dalam_antrian']);

        return redirect()->route('dokter.periksa.index')->with('success', 'Pasien berhasil diperiksa!');
    }

    public function updateStatus(Request $request, Periksa $periksa)
    {
        $newStatus = $request->input('status');

        // Validate the status transition
        if (!$periksa->canTransitionTo($newStatus)) {
            return back()->withErrors(['error' => 'Invalid status transition.']);
        }

        // Update the status
        $periksa->update(['status' => $newStatus]);

        // Redirect with a success message
        return redirect()->route('dokter.periksa.index')
            ->with('success', 'Status berhasil diperbarui.');
    }

    public function detailPeriksa(Request $request, Periksa $periksa)
    {
        $validated = $request->validate([
            'catatan' => 'nullable|string',
            'biaya_obat' => 'nullable|numeric|min:0',
        ]);

        // Calculate the total cost
        $totalBiaya = 150000 + ($validated['biaya_obat'] ?? 0);

        // Update the periksa with the details
        $periksa->update([
            'catatan' => $validated['catatan'],
            'biaya_total' => $totalBiaya,
            'status' => Periksa::STATUS_SELESAI,
        ]);

        return redirect()->route('dokter.periksa.index')
            ->with('success', 'Pasien berhasil diperiksa.');
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
}
