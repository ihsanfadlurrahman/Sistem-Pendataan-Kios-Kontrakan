<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::all();
        return view('unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1️⃣ Validasi
        $validated = $request->validate([
            'nama_unit'   => 'required|string|max:100',
            'tipe'        => 'required|in:kios,kontrakan',
            'harga_sewa'  => 'required|numeric|min:0',
            'status'      => 'required|in:kosong,disewa',
            'keterangan'  => 'nullable|string|max:255',
            'pemilik' => 'required|in:ibu,bapak',
        ]);

        // 2️⃣ Simpan ke database
        Unit::create($validated);

        // 3️⃣ Redirect + flash message
        return redirect()
            ->route('units.index')
            ->with('success', 'Unit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        return view('unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_unit'   => 'required|string|max:100',
            'tipe'        => 'required|in:kios,kontrakan',
            'harga_sewa'  => 'required|numeric|min:0',
            'status'      => 'required|in:kosong,disewa',
            'keterangan'  => 'nullable|string|max:255',
            'pemilik' => 'required|in:ibu,bapak',
        ]);

        $unit = Unit::findOrFail($id);
        $unit->update($validated);

        return redirect()
            ->route('units.index')
            ->with('success', 'Unit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::findOrFail($id);
        // if ($unit->sewas()->count() > 0) {
        //     return back()->with('error', 'Unit tidak bisa dihapus karena memiliki data sewa.');
        // }
        $unit->delete();

        return redirect()
            ->route('units.index')
            ->with('success', 'Unit berhasil dihapus.');
    }
}
