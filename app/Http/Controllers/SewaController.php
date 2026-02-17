<?php

namespace App\Http\Controllers;

use App\Models\Penyewa;
use App\Models\Sewa;
use App\Models\Unit;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sewa = Sewa::with(['penyewa', 'unit'])->latest()->get();
        return view('sewa.index', compact('sewa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units = Unit::where('status', 'kosong')->get();
        $penyewa = Penyewa::all();

        return view('sewa.create', compact('units', 'penyewa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mode = $request->mode_penyewa;

        if ($mode == 'lama') {

            $request->validate([
                'penyewa_id' => 'required|exists:penyewas,id',
            ]);

            $penyewa_id = $request->penyewa_id;
        } else {

            $request->validate([
                'nama' => 'required|string|max:255',
                'no_hp' => 'required|string|max:20',
                'alamat' => 'required|string|max:255',
            ]);

            $penyewa = Penyewa::create([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

            $penyewa_id = $penyewa->id;
        }

        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'nullable|date|after:tanggal_mulai',
        ]);

        // Cegah unit sudah aktif
        $unitSudahDipakai = Sewa::where('unit_id', $request->unit_id)
            ->where('status', 'aktif')
            ->exists();

        if ($unitSudahDipakai) {
            return back()->with('error', 'Unit sedang digunakan.');
        }

        Sewa::create([
            'unit_id' => $request->unit_id,
            'penyewa_id' => $penyewa_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'aktif',
        ]);

        Unit::where('id', $request->unit_id)
            ->update(['status' => 'disewa']);

        return redirect()->route('sewa.index')
            ->with('success', 'Sewa berhasil dibuat.');
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
    public function edit(Sewa $sewa)
    {
        $units = Unit::all();
        $penyewa = Penyewa::all();

        return view('sewa.edit', compact('sewa', 'units', 'penyewa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'unit_id'         => 'required|exists:units,id',
            'penyewa_id'      => 'required|exists:penyewas,id',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after:tanggal_mulai',
            'status'          => 'required|in:aktif,selesai',
        ]);
        $sewa = Sewa::findOrFail($id);
        // 🔒 Jika mau ubah jadi aktif, pastikan tidak ada aktif lain
        if ($validated['status'] === 'aktif') {

            $existingActive = Sewa::where('unit_id', $validated['unit_id'])
                ->where('status', 'aktif')
                ->where('id', '!=', $sewa->id)
                ->exists();

            if ($existingActive) {
                return back()
                    ->withInput()
                    ->with('error', 'Unit ini sudah memiliki sewa aktif.');
            }
        }

        $sewa->update($validated);

        // 🔄 Update status unit berdasarkan status sewa
        if ($validated['status'] === 'aktif') {
            Unit::where('id', $validated['unit_id'])
                ->update(['status' => 'disewa']);
        } else {
            Unit::where('id', $validated['unit_id'])
                ->update(['status' => 'kosong']);
        }

        return redirect()
            ->route('sewa.index')
            ->with('success', 'Data sewa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sewa $sewa)
    {
        // ❌ Tidak boleh hapus kalau masih aktif
        if ($sewa->status === 'aktif') {
            return back()->with('error', 'Data tidak bisa dihapus karena status sewa masih aktif. Ubah ke selesai terlebih dahulu.');
        }

        $unitId = $sewa->unit_id;

        $sewa->delete();

        // 🔄 Pastikan unit jadi kosong jika tidak ada sewa aktif lain
        $masihAdaAktif = Sewa::where('unit_id', $unitId)
            ->where('status', 'aktif')
            ->exists();

        if (! $masihAdaAktif) {
            Unit::where('id', $unitId)
                ->update(['status' => 'kosong']);
        }

        return redirect()
            ->route('sewa.index')
            ->with('success', 'Data sewa berhasil dihapus.');
    }

    public function selesai(Sewa $sewa)
    {
        if ($sewa->status !== 'aktif') {
            return back()->with('error', 'Sewa sudah selesai.');
        }

        $sewa->update([
            'status' => 'selesai'
        ]);

        // Kosongkan unit
        $sewa->unit->update([
            'status' => 'kosong'
        ]);

        return redirect()->route('sewa.index')
            ->with('success', 'Sewa berhasil diselesaikan.');
    }
}
