<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;

use Illuminate\Support\Facades\DB;

class AdminPasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::all();
        return view('admin.pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('admin.pasien.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_record_number' => 'required|string|unique:pasiens,medical_record_number',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'date_of_birth' => 'required|date',
            'address' => 'required|string|max:255',
        ]);

        $password = bcrypt('123123123'); 
        $role = DB::selectOne("SELECT id FROM roles WHERE role_code = 'pasien'"); 
        $user = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'role_id' => $role->id,
            'status_code' => 'user_active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $pasien = Pasien::create([
            'user_id' => $user, 
            'medical_record_number' => $request->medical_record_number,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }


    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404, 'Invalid ID format.');
        }

        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.index', compact('pasien'));
    }

    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.edit', compact('pasien'));
    }

    public function update(Request $request, $id)
    {
        $pasien = Pasien::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:dokters,email,{$pasien->id}|unique:users,email,{$pasien->user_id}",
            'phone' => 'required',
            'address' => 'required',
        ]);

        $pasien->update($request->all());
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien updated successfully');
    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien deleted successfully');
    }
}
