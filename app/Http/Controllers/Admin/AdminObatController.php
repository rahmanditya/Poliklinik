<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Obat;

class AdminObatController extends Controller
{
    
    public function index()
    {
        $obats = Obat::all();
        return view('admin.obat.index', compact('obats'));
    }


    public function create()
    {
        $obats = Obat::all();
        return view('admin.obat.create', compact('obats'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'kemasan' => 'required|string|max:20',
            'harga' => 'nullable|numeric|regex:/^\d{1,6}(\.\d{1,3})?$/',
        ]);


        $obat = Obat::create($request->only([
            'nama',
            'kemasan',
            'harga'
        ]));

        return redirect()->route('admin.obat.index')->with('success', 'Obat berhasil ditambahkan');
    }


    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('admin.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'kemasan' => 'required|string|max:20',
            'harga' => 'nullable|string|max:255',
        ]);

        $obat->update($request->only([
            'nama',
            'kemasan',
            'harga'
        ]));

        return redirect()->route('admin.obat.index')->with('success', 'Obat updated successfully.');
    }



    public function destroy($id)
    {
        $obat = Obat::findOrFail($id);
        $obat->delete();
        return redirect()->route('admin.obat.index')->with('success', 'Obat deleted successfully');
    }

}
