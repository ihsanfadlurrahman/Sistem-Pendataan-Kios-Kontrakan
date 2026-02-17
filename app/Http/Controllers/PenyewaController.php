<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use Illuminate\Http\Request;

class PenyewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewa = Penyewa::all();
        return view('penyewa.index', compact('penyewa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penyewa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1️⃣ Validasi
        $validated = $request->validate([
            'nama'   => 'required|string|max:100',
            'no_hp' => 'required|digits_between:10,15',
            'alamat' => 'nullable|string|max:255',
        ]);

        // 2️⃣ Simpan ke database
        Penyewa::create($validated);

        // 3️⃣ Redirect + pesan sukses
        return redirect()
            ->route('penyewa.index')
            ->with('success', 'Penyewa berhasil ditambahkan.');
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
    public function edit(Penyewa $penyewa)
    {
        return view('penyewa.edit', compact('penyewa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama'   => 'required|string|max:100',
            'no_hp'  => 'required|digits_between:10,15',
            'alamat' => 'nullable|string|max:255',
        ]);

        $penyewa = Penyewa::findOrFail($id);
        $penyewa->update($validated);

        return redirect()
            ->route('penyewa.index')
            ->with('success', 'Data penyewa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penyewa = Penyewa::findOrFail($id);

        $penyewa->delete();

        return redirect()
            ->route('penyewa.index')
            ->with('success', 'Penyewa berhasil dihapus.');
    }
}
