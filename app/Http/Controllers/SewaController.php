<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Penyewa;
use App\Models\Sewa;
use App\Models\Unit;
use Illuminate\Http\Request;

class SewaController extends Controller
{
    public function index(Request $request)
    {
        $filter  = $request->get('filter', 'aktif');
        $sewaAll = Sewa::with(['penyewa', 'unit'])->get();

        $sewa = Sewa::with(['penyewa', 'unit'])
            ->when($filter !== 'semua', fn($q) => $q->where('status', $filter))
            ->latest()
            ->get();

        return view('sewa.index', compact('sewa', 'sewaAll', 'filter'));
    }

    public function create()
    {
        $units   = Unit::where('status', 'kosong')->get();
        $penyewa = Penyewa::all();
        return view('sewa.create', compact('units', 'penyewa'));
    }

    public function store(Request $request)
    {
        $mode = $request->mode_penyewa;

        if ($mode === 'lama') {
            $request->validate(['penyewa_id' => 'required|exists:penyewas,id']);
            $penyewa_id = $request->penyewa_id;
        } else {
            $request->validate([
                'nama'   => 'required|string|max:255',
                'no_hp'  => 'required|digits_between:10,15',
                'alamat' => 'nullable|string|max:255',
            ]);
            $penyewa    = Penyewa::create($request->only('nama', 'no_hp', 'alamat'));
            $penyewa_id = $penyewa->id;
        }

        $request->validate([
            'unit_id'      => 'required|exists:units,id',
            'nama_toko'    => 'nullable|string|max:255',
            'tipe_bayar'   => 'required|in:dp,pelunasan',
            'jumlah_bayar' => 'required|integer|min:1',
        ]);

        $unit = Unit::findOrFail($request->unit_id);

        if ($unit->status !== 'kosong') {
            return back()->withInput()->with('error', 'Unit sudah tidak tersedia.');
        }

        $jumlah = (int) $request->jumlah_bayar;
        $tipe   = $request->tipe_bayar;
        $harga  = $unit->harga_sewa;

        if ($tipe === 'dp' && $jumlah >= $harga) {
            return back()->withInput()
                ->withErrors(['jumlah_bayar' => 'DP harus lebih kecil dari harga sewa (Rp ' . number_format($harga, 0, ',', '.') . ').']);
        }

        if ($tipe === 'pelunasan' && $jumlah !== $harga) {
            return back()->withInput()
                ->withErrors(['jumlah_bayar' => 'Jumlah pelunasan harus sama dengan harga sewa (Rp ' . number_format($harga, 0, ',', '.') . ').']);
        }

        $nama_toko    = ($unit->tipe === 'kios') ? $request->nama_toko : null;
        $statusSewa   = ($tipe === 'pelunasan') ? 'aktif' : 'booking';
        $tanggalMulai = ($tipe === 'pelunasan') ? now() : null;

        $sewa = Sewa::create([
            'unit_id'       => $unit->id,
            'penyewa_id'    => $penyewa_id,
            'nama_toko'     => $nama_toko,
            'harga_sewa'    => $harga,
            'total_dibayar' => $jumlah,
            'status'        => $statusSewa,
            'tanggal_mulai' => $tanggalMulai,
        ]);

        Pembayaran::create([
            'sewa_id'       => $sewa->id,
            'tipe'          => $tipe,
            'jumlah'        => $jumlah,
            'tanggal_bayar' => now(),
            'status'        => 'lunas',
        ]);

        $unit->update(['status' => 'disewa']);

        $pesan = $tipe === 'pelunasan'
            ? 'Sewa berhasil dibuat dan langsung aktif.'
            : 'Sewa berhasil dibuat dengan status Booking. Lakukan pelunasan untuk mengaktifkan.';

        return redirect()->route('sewa.show', $sewa->id)->with('success', $pesan);
    }

    public function show(Sewa $sewa)
    {
        $sewa->load(['penyewa', 'unit', 'pembayaran']);
        return view('sewa.show', compact('sewa'));
    }

    public function edit(Sewa $sewa)
    {
        $units   = Unit::all();
        $penyewa = Penyewa::all();
        return view('sewa.edit', compact('sewa', 'units', 'penyewa'));
    }

    public function update(Request $request, Sewa $sewa)
    {
        $validated = $request->validate([
            'unit_id'         => 'required|exists:units,id',
            'penyewa_id'      => 'required|exists:penyewas,id',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after:tanggal_mulai',
            'harga_sewa'      => 'required|integer|min:0',
            'total_dibayar'   => 'required|integer|min:0',
            'status'          => 'required|in:booking,aktif,selesai,batal',
        ]);

        $oldUnitId = $sewa->unit_id;
        $sewa->update($validated);

        if ($oldUnitId !== (int) $validated['unit_id']) {
            $masihAda = Sewa::where('unit_id', $oldUnitId)
                ->whereIn('status', ['booking', 'aktif'])
                ->where('id', '!=', $sewa->id)
                ->exists();
            Unit::where('id', $oldUnitId)->update(['status' => $masihAda ? 'disewa' : 'kosong']);
        }

        $statusUnit = in_array($validated['status'], ['aktif', 'booking']) ? 'disewa' : 'kosong';
        Unit::where('id', $validated['unit_id'])->update(['status' => $statusUnit]);

        return redirect()->route('sewa.show', $sewa->id)->with('success', 'Data sewa berhasil diperbarui.');
    }

    public function destroy(Sewa $sewa)
    {
        if ($sewa->status === 'aktif') {
            return back()->with('error', 'Data tidak bisa dihapus karena status sewa masih aktif.');
        }

        $unitId = $sewa->unit_id;
        $sewa->delete();

        $masihAda = Sewa::where('unit_id', $unitId)
            ->whereIn('status', ['booking', 'aktif'])
            ->exists();

        if (!$masihAda) {
            Unit::where('id', $unitId)->update(['status' => 'kosong']);
        }

        return redirect()->route('sewa.index')->with('success', 'Data sewa berhasil dihapus.');
    }

    public function bayar(Request $request, Sewa $sewa)
    {
        if ($sewa->status !== 'booking') {
            return back()->with('error', 'Pembayaran hanya bisa dilakukan saat status booking.');
        }

        $sisa = $sewa->harga_sewa - $sewa->total_dibayar;

        $validated = $request->validate([
            'jumlah' => "required|integer|min:1|max:{$sisa}",
            'tipe'   => 'required|in:dp,pelunasan',
        ]);

        Pembayaran::create([
            'sewa_id'       => $sewa->id,
            'tipe'          => $validated['tipe'],
            'jumlah'        => $validated['jumlah'],
            'tanggal_bayar' => now(),
            'status'        => 'lunas',
        ]);

        $sewa->total_dibayar += $validated['jumlah'];
        $sewa->save();

        if ($sewa->total_dibayar >= $sewa->harga_sewa) {
            $sewa->update([
                'status'        => 'aktif',
                'tanggal_mulai' => now(),
            ]);
            $sewa->unit->update(['status' => 'disewa']);
            return back()->with('success', 'Pelunasan berhasil! Sewa sekarang aktif.');
        }

        return back()->with('success', 'Pembayaran berhasil dicatat.');
    }

    public function selesai(Sewa $sewa)
    {
        if ($sewa->status !== 'aktif') {
            return back()->with('error', 'Sewa belum aktif.');
        }

        $sewa->update([
            'status'          => 'selesai',
            'tanggal_selesai' => now(),
        ]);

        $sewa->unit->update(['status' => 'kosong']);

        return redirect()->route('sewa.index')->with('success', 'Sewa telah selesai.');
    }

    public function refund(Sewa $sewa)
    {
        if ($sewa->status !== 'booking') {
            return back()->with('error', 'Refund hanya bisa dilakukan saat status masih booking.');
        }

        $sewa->pembayaran()
            ->where('tipe', 'dp')
            ->where('is_refunded', false)
            ->update([
                'is_refunded'    => true,
                'tanggal_refund' => now(),
            ]);

        $sewa->update([
            'status'          => 'batal',
            'tanggal_selesai' => now(),
        ]);

        $sewa->unit->update(['status' => 'kosong']);

        return redirect()->route('sewa.index')->with('success', 'Booking dibatalkan dan DP telah direfund.');
    }

    /**
     * Perpanjang sewa — buat kontrak baru dari sewa yang sudah selesai.
     * Data penyewa, unit, dan harga sewa diambil dari sewa lama.
     * Redirect ke create sewa dengan data pre-filled.
     */
    public function perpanjang(Sewa $sewa)
    {
        if ($sewa->status !== 'selesai') {
            return back()->with('error', 'Perpanjang hanya bisa dilakukan pada sewa yang sudah selesai.');
        }

        // Cek apakah unit masih tersedia
        if ($sewa->unit->status !== 'kosong') {
            return back()->with('error', 'Unit ' . $sewa->unit->nama_unit . ' sedang tidak tersedia untuk diperpanjang.');
        }

        // Redirect ke create dengan query string untuk pre-fill form
        return redirect()->route('sewa.create', [
            'perpanjang_dari' => $sewa->id,
            'penyewa_id'      => $sewa->penyewa_id,
            'unit_id'         => $sewa->unit_id,
        ])->with('info', 'Silakan lengkapi pembayaran untuk memperpanjang sewa ' . $sewa->penyewa->nama . ' di unit ' . $sewa->unit->nama_unit . '.');
    }
}
