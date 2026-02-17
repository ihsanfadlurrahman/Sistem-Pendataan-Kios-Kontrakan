@extends('layouts.master')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="laporan-wrapper">

    {{-- Header --}}
    <div class="laporan-header">
        <div class="laporan-title-block">
            <h4>Laporan Keuangan</h4>
            <p>Ringkasan pemasukan dan pengeluaran per periode</p>
        </div>
        <a href="{{ route('laporan.pdf', ['bulan' => $bulan, 'tahun' => $tahun]) }}" class="btn-export">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5v-13m0 13-4-4m4 4 4-4M3 17.25v1.5A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75v-1.5" />
            </svg>
            Export PDF
        </a>
    </div>

    {{-- Filter --}}
    <form method="GET" class="filter-card">
        <span class="filter-label">Filter:</span>
        <input type="number" name="bulan" min="1" max="12" value="{{ $bulan }}" placeholder="Bulan">
        <input type="number" name="tahun" value="{{ $tahun }}" placeholder="Tahun">
        <button type="submit" class="btn-filter">
            Tampilkan
        </button>
    </form>

    {{-- Summary Cards --}}
    <div class="summary-grid">

        {{-- Total Pemasukan --}}
        <div class="summary-card card-pemasukan">
            <div class="card-icon icon-green">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#16a34a">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941" />
                </svg>
            </div>
            <div class="card-label">Total Pemasukan</div>
            <div class="card-amount">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
        </div>

        {{-- Total Pengeluaran --}}
        <div class="summary-card card-pengeluaran">
            <div class="card-icon icon-red">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#dc2626">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6 9 12.75l4.286-4.286a11.948 11.948 0 0 1 4.306 6.43l.776 2.898m0 0 3.182-5.511m-3.182 5.51-5.511-3.181" />
                </svg>
            </div>
            <div class="card-label">Total Pengeluaran</div>
            <div class="card-amount">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
        </div>

        {{-- Laba / Rugi --}}
        <div class="summary-card card-laba">
            <div class="card-icon icon-blue">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#2563eb">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div class="card-label">Laba / Rugi</div>
            <div class="card-amount">Rp {{ number_format($laba, 0, ',', '.') }}</div>
        </div>

    </div>

    {{-- Detail Sections --}}
    <div class="section-divider">
        <span>Rincian Transaksi</span>
    </div>

    {{-- Detail Pemasukan --}}
    <div class="detail-section">
        <div class="detail-header">
            <div class="detail-header-dot dot-green"></div>
            <h5>Detail Pemasukan</h5>
            <span class="count-badge">{{ count($pemasukan) }} item</span>
        </div>
        <div class="detail-body">
            @if($pemasukan->isEmpty())
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <p>Belum ada data pemasukan untuk periode ini.</p>
                </div>
            @else
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Penyewa</th>
                            <th>Unit / Sewa</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pemasukan as $i => $p)
                        <tr>
                            <td style="color:#94a3b8; font-size:13px; width:40px;">{{ $i + 1 }}</td>
                            <td>{{ $p->sewa->penyewa->nama }}</td>
                            <td style="color:#64748b; font-size:13px;">{{ $p->sewa->unit->nama_unit ?? '-' }}</td>
                            <td class="amount-green">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

    {{-- Detail Pengeluaran --}}
    <div class="detail-section">
        <div class="detail-header">
            <div class="detail-header-dot dot-red"></div>
            <h5>Detail Pengeluaran</h5>
            <span class="count-badge">{{ count($pengeluaran) }} item</span>
        </div>
        <div class="detail-body">
            @if($pengeluaran->isEmpty())
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m6.75 12H9m1.5-12H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                    <p>Belum ada data pengeluaran untuk periode ini.</p>
                </div>
            @else
                <table class="detail-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kategori</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengeluaran as $i => $p)
                        <tr>
                            <td style="color:#94a3b8; font-size:13px; width:40px;">{{ $i + 1 }}</td>
                            <td>
                                <span style="display:inline-block; background:#fef2f2; color:#b91c1c; padding:2px 10px; border-radius:20px; font-size:12.5px; font-weight:700;">
                                    {{ $p->kategori }}
                                </span>
                            </td>
                            <td style="color:#64748b; font-size:13px;">{{ $p->keterangan ?? '-' }}</td>
                            <td class="amount-red">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>
@endsection
