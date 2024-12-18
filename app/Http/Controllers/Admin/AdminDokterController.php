<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Poli;
use App\Models\User;
use App\Models\Dokter;
use Illuminate\Support\Facades\DB;

class AdminDokterController extends Controller
{
    public function index()
    {
        $specializations = Poli::all();
        $dokters = Dokter::with('specialization')->get();
        return view('admin.dokter.index', compact('dokters', 'specializations'));
    }


    public function create()
    {
        $specializations = Poli::all();
        $dokters = Dokter::with('specialization')->get();
        return view('admin.dokter.create', compact('dokters', 'specializations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:dokters,email|unique:users,email', // Ensure email is unique in both tables
            'phone' => 'required|string|max:20',
            'status' => 'nullable|string|max:255',
            'specialization_id' => 'required|exists:poli,id',
        ]);

        $password = bcrypt('123123123');
        $role = DB::selectOne("SELECT id FROM roles WHERE role_code = 'dokter'");
        $user = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role_id' => $role->id,
            'status_code' => 'user_active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $dokter = Dokter::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status ?? 'Tersedia',
            'specialization_id' => $request->specialization_id,
            'user_id' => $user, 
        ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404, 'Invalid ID format.');
        }

        $dokter = Dokter::findOrFail($id);
        return view('admin.dokter.show', compact('dokter'));
    }

    public function edit($id)
    {
        $specializations = Poli::all();
        $dokters = Dokter::with('specialization')->get();
        $dokter = Dokter::findOrFail($id);
        $polis = Poli::all();
        return view('admin.dokter.edit', compact('dokter', 'polis', 'dokters', 'specializations'));
    }

    public function update(Request $request, $id)
    {
        $dokter = Dokter::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:dokters,email,{$dokter->id}|unique:users,email,{$dokter->user_id}",
            'phone' => 'required|string|max:20',
            'status' => 'nullable|string|max:255',
            'specialization_id' => 'required|exists:poli,id',
        ]);

        $dokter->update($request->only([
            'name',
            'email',
            'phone',
            'status',
            'specialization_id',
        ]));

        DB::table('users')
            ->where('id', $dokter->user_id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'updated_at' => now(),
            ]);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter updated successfully.');
    }

    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter deleted successfully');
    }
}
