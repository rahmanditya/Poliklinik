<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $dokters = Dokter::all();
        return view('admin.dokter.index', compact('dokters'));
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.dokter.create');
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'specialization' => 'required',
        ]);

        Dokter::create($request->all());
        return redirect()->route('dokter.index')->with('success', 'Dokter created successfully');
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
        return redirect()->route('dokter.index')->with('success', 'Dokter updated successfully');
    }

    // Remove the specified resource from storage
    public function destroy($id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();
        return redirect()->route('dokter.index')->with('success', 'Dokter deleted successfully');
    }
}
