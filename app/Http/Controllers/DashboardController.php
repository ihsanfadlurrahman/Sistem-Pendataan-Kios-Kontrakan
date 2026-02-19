<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Unit;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Total Unit
        $totalUnit = Unit::count();

        // Unit Disewa
        $disewa = Unit::where('status', 'disewa')->count();

        // Unit Kosong
        $kosong = Unit::where('status', 'kosong')->count();

        // Pemasukan Bulan Ini
        $pemasukanBulanIni = Pembayaran::whereMonth('periode', now()->month)
            ->whereYear('periode', now()->year)
            ->where('status', 'lunas')
            ->sum('jumlah');

        return view('dashboard.index', compact(
            'totalUnit',
            'disewa',
            'kosong',
            'pemasukanBulanIni'
        ));
    }
}
