<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $pasiens = Pasien::all();
        return view('admin.pasien.index', compact('pasiens'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.pasien.create');
    }

    // Store a newly created resource in storage
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

        $password = bcrypt('defaultpassword'); // Generate a default password or use a random generator
        $role = DB::selectOne("SELECT id FROM roles WHERE role_code = 'pasien'");
        DB::table("users")->insert([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $password,
            "role_id" => $role->id,
            "status_code" => 'user_active'
        ]);
        return redirect()->route('pasien.index')->with('success', 'Pasien created successfully with login access.');
    }

    // Display the specified resource
    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404, 'Invalid ID format.');
        }

        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.show', compact('pasien'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('admin.pasien.edit', compact('pasien'));
    }

    // Update the specified resource in storage
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
        return redirect()->route('pasien.index')->with('success', 'Pasien updated successfully');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $pasienUser = User::findOrFail($id);
        $pasien = Pasien::findOrFail($id);
        $pasien&$pasienUser->delete();
        return redirect()->route('pasien.index')->with('success', 'Pasien deleted successfully');
    }
}
