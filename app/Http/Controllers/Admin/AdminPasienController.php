<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\User;
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
            'medical_record_number' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'date_of_birth' => 'required|date',
            'address' => 'required',
        ]);

        $pasien = Pasien::create($request->only([
            'medical_record_number',
            'name',
            'email',
            'phone',
            'date_of_birth',
            'address'
        ]));

        $password = bcrypt('123123123'); 
        $role = DB::selectOne("SELECT id FROM roles WHERE role_code = 'pasien'");
        DB::table("users")->insert([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $password,
            "role_id" => $role->id,
            "status_code" => 'user_active'
        ]);
        return redirect()->route('admin.pasien.index')->with('success', 'Pasien created successfully with login access.');
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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $pasien = Pasien::findOrFail($id);
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
