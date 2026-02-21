<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));

        $pembayaran = Pembayaran::with(['sewa.penyewa', 'sewa.unit'])
            ->whereMonth('tanggal_bayar', $bulan)
            ->whereYear('tanggal_bayar', $tahun)
            ->latest()
            ->get();

        return view('pembayaran.index', compact('pembayaran', 'bulan', 'tahun'));
    }
}
