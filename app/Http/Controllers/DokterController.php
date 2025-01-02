<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


use App\Models\Poli;
use App\Models\DaftarPoli;
use App\Models\Dokter;

use App\Models\Obat;
use App\Models\Periksa;
use App\Models\DetailPeriksa;






class DokterController extends Controller
{
    public function dashboard()
    {
        $user = User::find(Auth::id());
        return view('dokter.dashboard');
    }

    public function indexPeriksa()
    {
        $obats = Obat::all();

        $user = Auth::user();

        $dokter = Dokter::where('user_id', $user->id)->first();

        if (!$dokter) {
            return abort(404, 'Dokter not found');
        }

        $daftarPoli = DaftarPoli::with(['pasien', 'schedule', 'periksa'])
            ->where('dokter_id', $dokter->id)
            ->where('status', '!=', 'selesai')
            ->get();

        
        
        return view('dokter.periksa.index', compact('dokter', 'daftarPoli', 'obats'));
    }

    public function createPeriksa($daftarPoliId)
    {

        $obats = Obat::all();

        $user = Auth::user();

        $daftarPoli = DaftarPoli::with(['pasien', 'dokter'])->findOrFail($daftarPoliId);

        $dokter = Dokter::where('user_id', $user->id)->first();

        if ($daftarPoli->dokter_id !== $dokter->id) {
            abort(403, 'Access denied.');
        }

        return view('dokter.periksa.create', compact('daftarPoli', 'dokter', 'obats'));
    }

    public function searchObat(Request $request)
    {
        $query = $request->input('query');
        return Obat::where('nama', 'like', "%$query%")->get(['id', 'nama', 'kemasan']);
    }

    public function getObatPrice(Obat $obat)
    {
        
        return response()->json([
            'harga' => $obat->harga,
        ]);
    }


    public function storePeriksa(Request $request, $daftarPoliId)
    {
        try {
            $validated = $request->validate([
                'tgl_periksa' => 'required|date',
                'catatan' => 'nullable|string',
                'total_biaya' => 'required|numeric|min:150000', 
                'selected_obats' => 'required|json', 
            ]);

            $selectedObats = json_decode($validated['selected_obats'], true);

            return DB::transaction(function () use ($validated, $selectedObats, $daftarPoliId) {
                $user = Auth::user();
                $dokter = Dokter::where('user_id', $user->id)->firstOrFail();

                $daftarPoli = DaftarPoli::findOrFail($daftarPoliId);

                
                if ($daftarPoli->dokter_id !== $dokter->id) {
                    abort(403, 'Access denied.');
                }

                
                $daftarPoli->update(['status' => 'selesai']);

                
                $obatNotes = $this->formatObatNotes($selectedObats);

                
                $fullNotes = $this->combineNotes($validated['catatan'], $obatNotes);

                
                $periksa = Periksa::create([
                    'daftar_poli_id' => $daftarPoli->id,
                    'dokter_id' => $dokter->id,
                    'tgl_periksa' => $validated['tgl_periksa'],
                    'catatan' => $fullNotes,
                    'biaya_periksa' => $validated['total_biaya'],
                ]);

                
                $this->createDetailPeriksa($periksa, $selectedObats);

                return redirect()
                    ->route('dokter.periksa.index')
                    ->with('success', 'Pemeriksaan pasien berhasil disimpan.');
            });
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function formatObatNotes(array $selectedObats): string
    {
        return collect($selectedObats)
            ->map(function ($obat, $index) {
                return ($index + 1) . '. ' . $obat['nama'];
            })
            ->join("\n");
    }

    private function combineNotes(?string $dokterNotes, string $obatNotes): string
    {
        $notes = "Obat yang diberikan:\n" . $obatNotes;

        if (!empty($dokterNotes)) {
            $notes .= "\n\nCatatan Dokter:\n" . $dokterNotes;
        }

        return $notes;
    }

    private function createDetailPeriksa(Periksa $periksa, array $selectedObats): void
    {
        foreach ($selectedObats as $obat) {
            DetailPeriksa::create([
                'periksa_id' => $periksa->id,
                'obat_id' => $obat['id'],
            ]);
        }
    }

    public function updateStatus(Request $request, Periksa $periksa)
    {
        $newStatus = $request->input('status');

        if (!$periksa->canTransitionTo($newStatus)) {
            return back()->withErrors(['error' => 'Invalid status transition.']);
        }

        $periksa->update(['status' => $newStatus]);

        return redirect()->route('dokter.periksa.index')
            ->with('success', 'Status berhasil diperbarui.');
    }

    

    public function indexRiwayat()
    {

        $obats = Obat::all();

        $user = Auth::user();

        $dokter = Dokter::where('user_id', $user->id)->first();

        if (!$dokter) {
            return abort(404, 'Dokter not found');
        }

        $riwayatPeriksa = DaftarPoli::with(['pasien', 'schedule', 'periksa'])
            ->where('dokter_id', $dokter->id)
            ->where('status', '!=', 'dalam_antrian')
            ->get();

        return view('dokter.riwayat.index', compact('dokter', 'obats', 'riwayatPeriksa'));
    }

    public function getDetail($id)
    {
        $periksa = Periksa::with('obats')->find($id);

        $biaya = Periksa::all();

        return response()->json([
            'obats' => $periksa->obats->map(function ($obat) {
                return [
                    'nama' => $obat->nama,
                    'kemasan' => $obat->kemasan,
                ];
            }),
        ]);
    }

    public function indexProfil()
    {
        $dokter = Dokter::with('specialization')->where('user_id', Auth::id())->firstOrFail();
        $poli = Poli::all();
        return view('dokter.profil.index', compact('dokter', 'poli'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $dokter = Dokter::where('user_id', $user->id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'required|string|max:20',
            'specialization_id' => 'required|exists:poli,id',
            'status' => 'required|in:Tersedia,Tidak Tersedia',
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|min:8|confirmed',
        ]);

        
        DB::beginTransaction();
        try {
            
            $user->name = $request->name;
            $user->email = $request->email;
            
            
            if ($request->filled('current_password')) {
                if (!Hash::check($request->current_password, $user->password)) {
                    return back()->withErrors(['current_password' => 'Password saat ini tidak sesuai']);
                }
                $user->password = Hash::make($request->new_password);
            }
            
            $user->save();

            
            $dokter->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status,
                'specialization_id' => $request->specialization_id,
            ]);

            DB::commit();
            return redirect()->route('dokter.profil.index')->with('success', 'Profil berhasil diperbarui');
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['msg' => 'Terjadi kesalahan saat memperbarui profil']);
        }
    }
}
