@extends('layouts.master')

@section('title', 'Data Pembayaran')
@section('page-title', 'Data Pembayaran')

@section('content')
<div class="table-box">

    {{-- Header --}}
    <div class="table-box-header">
        <div>
            <h4>Data Pembayaran</h4>
            <p style="font-size:13px; color:var(--text-muted); margin-top:3px;">
                Riwayat seluruh pembayaran sewa
            </p>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert alert-success" style="margin-bottom:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
            stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Stats Bar (dari semua data bulan ini) --}}
    @php
        $total          = $pembayaran->count();
        $lunas          = $pembayaran->where('status', 'lunas')->count();
        $belum          = $pembayaran->where('status', 'belum_lunas')->count();
        $totalPemasukan = $pembayaran->where('status', 'lunas')->where('is_refunded', false)->sum('jumlah');
    @endphp
    <div class="pembayaran-stats">
        <div class="pembayaran-stat-item">
            <span class="stat-number">{{ $total }}</span>
            <span class="stat-label">Total Transaksi</span>
        </div>
        <div class="pembayaran-stat-divider"></div>
        <div class="pembayaran-stat-item">
            <span class="stat-number" style="color:var(--green);">{{ $lunas }}</span>
            <span class="stat-label">Lunas</span>
        </div>
        <div class="pembayaran-stat-divider"></div>
        <div class="pembayaran-stat-item">
            <span class="stat-number" style="color:var(--red);">{{ $belum }}</span>
            <span class="stat-label">Belum Lunas</span>
        </div>
        <div class="pembayaran-stat-divider"></div>
        <div class="pembayaran-stat-item">
            <span class="stat-number" style="color:var(--blue); font-size:15px;">
                Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
            </span>
            <span class="stat-label">Total Pemasukan</span>
        </div>
    </div>

    {{-- Filter Bulan/Tahun --}}
    <form method="GET" action="{{ route('pembayaran.index') }}"
        style="display:flex; align-items:center; gap:10px; flex-wrap:wrap; margin-bottom:20px;">
        <span style="font-size:12px; font-weight:700; color:var(--text-secondary); text-transform:uppercase; letter-spacing:0.5px;">
            Filter:
        </span>
        <select name="bulan" style="border:1.5px solid var(--border); border-radius:var(--radius-md); padding:7px 12px; font-size:13px; font-family:'DM Sans',sans-serif; font-weight:600; color:var(--text-primary); background:var(--bg-elevated); outline:none;">
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ $bulan == $m ? 'selected' : '' }}>
                    {{ \Carbon\Carbon::createFromDate(null, $m, 1)->translatedFormat('F') }}
                </option>
            @endforeach
        </select>
        <select name="tahun" style="border:1.5px solid var(--border); border-radius:var(--radius-md); padding:7px 12px; font-size:13px; font-family:'DM Sans',sans-serif; font-weight:600; color:var(--text-primary); background:var(--bg-elevated); outline:none;">
            @foreach(range(date('Y'), date('Y') - 5, -1) as $y)
                <option value="{{ $y }}" {{ $tahun == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endforeach
        </select>
        <button type="submit" style="background:var(--text-primary); color:#fff; border:none; padding:8px 18px; border-radius:var(--radius-md); font-size:13px; font-family:'DM Sans',sans-serif; font-weight:700; cursor:pointer;">
            Tampilkan
        </button>
        @if(request('bulan') || request('tahun'))
            <a href="{{ route('pembayaran.index') }}" style="font-size:13px; color:var(--text-muted); text-decoration:none; font-weight:600;">
                Reset
            </a>
        @endif
    </form>

    {{-- Table --}}
    @if($pembayaran->isEmpty())
        <div style="text-align:center; padding:60px 24px;">
            <div style="width:56px;height:56px;background:#f1f5f9;border-radius:14px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="#94a3b8" style="width:28px;height:28px;">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
                </svg>
            </div>
            <p style="font-size:15px;font-weight:600;color:var(--text-secondary);">Tidak ada pembayaran di periode ini</p>
            <p style="font-size:13px;color:var(--text-muted);margin-top:4px;">
                Coba pilih bulan atau tahun yang berbeda.
            </p>
        </div>
    @else
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th style="width:50px; text-align:center;">No</th>
                        <th>Penyewa</th>
                        <th>Unit</th>
                        <th style="width:110px;">Tipe</th>
                        <th style="width:130px;">Tanggal Bayar</th>
                        <th style="width:160px; text-align:right;">Jumlah</th>
                        <th style="width:90px; text-align:center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembayaran as $index => $value)
                    <tr @if($value->is_refunded) style="opacity:0.5;" @endif>

                        <td style="text-align:center; color:var(--text-muted); font-size:13px; font-weight:600;">
                            {{ $index + 1 }}
                        </td>

                        {{-- Penyewa --}}
                        <td>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <div class="table-avatar">
                                    {{ strtoupper(substr($value->sewa->penyewa->nama ?? 'X', 0, 1)) }}
                                </div>
                                <div>
                                    <div style="font-weight:600;">{{ $value->sewa->penyewa->nama ?? '-' }}</div>
                                    <div style="font-size:11.5px; color:var(--text-muted);">{{ $value->sewa->unit->tipe ?? '' }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Unit --}}
                        <td>
                            <div style="display:flex; align-items:center; gap:8px;">
                                <div class="table-unit-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                                    </svg>
                                </div>
                                <span style="font-weight:600; color:var(--blue);">{{ $value->sewa->unit->nama_unit ?? '-' }}</span>
                            </div>
                        </td>

                        {{-- Tipe --}}
                        <td>
                            @if($value->tipe === 'dp')
                                <span class="badge warning">DP</span>
                            @elseif($value->tipe === 'pelunasan')
                                <span class="badge success">Pelunasan</span>
                            @else
                                <span class="badge info">{{ ucfirst($value->tipe) }}</span>
                            @endif
                            @if($value->is_refunded)
                                <span class="badge danger" style="font-size:10px; margin-left:4px;">Refund</span>
                            @endif
                        </td>

                        {{-- Tanggal Bayar --}}
                        <td>
                            <div style="display:flex; align-items:center; gap:6px;">
                                <div class="table-date-icon-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                                    </svg>
                                </div>
                                <span style="font-family:'DM Mono',monospace; font-size:13px; color:var(--text-secondary);">
                                    {{ $value->tanggal_bayar ? \Carbon\Carbon::parse($value->tanggal_bayar)->format('d M Y') : '-' }}
                                </span>
                            </div>
                        </td>

                        {{-- Jumlah --}}
                        <td style="text-align:right;">
                            <div style="display:flex; align-items:center; justify-content:flex-end; gap:6px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    style="width:16px;height:16px;color:var(--green);flex-shrink:0;">
                                    <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                                </svg>
                                <span style="font-family:'DM Mono',monospace; font-size:14px; font-weight:700;
                                    color:{{ $value->is_refunded ? 'var(--text-muted)' : 'var(--green)' }};">
                                    {{ number_format($value->jumlah, 0, ',', '.') }}
                                </span>
                            </div>
                        </td>

                        {{-- Status --}}
                        <td style="text-align:center;">
                            @if($value->is_refunded)
                                <span class="badge danger">
                                    <span style="width:5px;height:5px;background:currentColor;border-radius:50%;display:inline-block;"></span>
                                    Refund
                                </span>
                            @elseif($value->status === 'lunas')
                                <span class="badge success">
                                    <span style="width:5px;height:5px;background:currentColor;border-radius:50%;display:inline-block;"></span>
                                    Lunas
                                </span>
                            @else
                                <span class="badge danger">
                                    <span style="width:5px;height:5px;background:currentColor;border-radius:50%;display:inline-block;"></span>
                                    Belum
                                </span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</div>
@endsection
