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


    // Show the form for creating a new resource
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
            'email' => 'required|email|unique:dokters,email',
            'phone' => 'required|string|max:20',
            'status' => 'nullable|string|max:255',
            'specialization_id' => 'required|exists:poli,id',
        ]);

        Dokter::create($validatedData);

        return redirect()->route('admin.dokter.index')->with('success', 'Dokter created successfully');
        
    }


    // Display the specified resource
    public function show($id)
    {
        if (!is_numeric($id)) {
            abort(404, 'Invalid ID format.');
        }

        $dokter = Dokter::findOrFail($id);
        return view('admin.dokter.show', compact('dokter'));
    }

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('admin.dokter.edit', compact('dokter'));
    }

    // Update the specified resource in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
        ]);

        $dokter = Dokter::findOrFail($id);
        $dokter->update($request->all());
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter updated successfully');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();
        return redirect()->route('admin.dokter.index')->with('success', 'Dokter deleted successfully');
    }

    public function assign(Request $request, $poliId)
    {
        // Validate the doctor id
        $request->validate([
            'dokter_id' => 'required|exists:dokters,id',
        ]);

        // Find the selected poli by its ID
        $poli = Poli::findOrFail($poliId);

        // Find the selected doctor by ID
        $dokter = Dokter::findOrFail($request->dokter_id);

        // Attach the doctor to the poli (assuming a many-to-many relationship)
        $poli->dokters()->attach($dokter);

        // Redirect or return a success message
        return redirect()->route('admin.poli.show', $poliId)->with('success', 'Dokter berhasil ditambahkan ke poli');
    }
}
