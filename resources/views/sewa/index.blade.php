@extends('layouts.master')

@section('title', 'Data Sewa')
@section('page-title', 'Data Sewa')

@section('content')
    <div class="table-box">

        {{-- Header --}}
        <div class="table-box-header">
            <div>
                <h4>Data Sewa</h4>
                <p style="font-size:13px; color:var(--text-muted); margin-top:3px;">
                    Kelola kontrak sewa unit kios &amp; kontrakan
                </p>
            </div>
            <a href="{{ route('sewa.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Tambah Sewa
            </a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success" style="margin-bottom:20px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" style="margin-bottom:20px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        {{-- Stats Bar (selalu hitung dari semua data) --}}
        @php
            $total   = $sewaAll->count();
            $booking = $sewaAll->where('status', 'booking')->count();
            $aktif   = $sewaAll->where('status', 'aktif')->count();
            $selesai = $sewaAll->where('status', 'selesai')->count();
            $batal   = $sewaAll->where('status', 'batal')->count();
            $filter  = request('filter', 'aktif');
        @endphp
        <div class="sewa-stats">
            <div class="sewa-stat-item">
                <span class="stat-number">{{ $total }}</span>
                <span class="stat-label">Total</span>
            </div>
            <div class="sewa-stat-divider"></div>
            <div class="sewa-stat-item">
                <span class="stat-number" style="color:#f59e0b;">{{ $booking }}</span>
                <span class="stat-label">Booking</span>
            </div>
            <div class="sewa-stat-divider"></div>
            <div class="sewa-stat-item">
                <span class="stat-number" style="color:var(--green);">{{ $aktif }}</span>
                <span class="stat-label">Aktif</span>
            </div>
            <div class="sewa-stat-divider"></div>
            <div class="sewa-stat-item">
                <span class="stat-number" style="color:var(--text-muted);">{{ $selesai }}</span>
                <span class="stat-label">Selesai</span>
            </div>
            <div class="sewa-stat-divider"></div>
            <div class="sewa-stat-item">
                <span class="stat-number" style="color:var(--red);">{{ $batal }}</span>
                <span class="stat-label">Batal</span>
            </div>
        </div>

        {{-- Filter Tabs --}}
        <div style="display:flex; gap:6px; flex-wrap:wrap; margin-bottom:20px;">
            @php
                $tabs = [
                    'aktif'   => ['label' => 'Aktif',   'color' => 'var(--green)'],
                    'booking' => ['label' => 'Booking', 'color' => '#f59e0b'],
                    'selesai' => ['label' => 'Selesai', 'color' => 'var(--text-muted)'],
                    'batal'   => ['label' => 'Batal',   'color' => 'var(--red)'],
                    'semua'   => ['label' => 'Semua',   'color' => 'var(--blue)'],
                ];
            @endphp
            @foreach ($tabs as $key => $tab)
                <a href="{{ route('sewa.index', ['filter' => $key]) }}"
                    style="display:inline-flex; align-items:center; gap:6px; padding:6px 14px; border-radius:99px; font-size:13px; font-weight:600; text-decoration:none; transition:all 0.15s;
                        {{ $filter === $key
                            ? 'background:var(--text-primary); color:#fff; border:1.5px solid var(--text-primary);'
                            : 'background:var(--bg-elevated); color:var(--text-secondary); border:1.5px solid var(--border);' }}">
                    <span style="width:7px; height:7px; border-radius:50%; background:{{ $filter === $key ? '#fff' : $tab['color'] }}; flex-shrink:0;"></span>
                    {{ $tab['label'] }}
                </a>
            @endforeach
        </div>

        {{-- Table --}}
        @if ($sewa->isEmpty())
            <div style="text-align:center; padding:60px 24px;">
                <div style="width:56px;height:56px;background:#f1f5f9;border-radius:14px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="#94a3b8" style="width:28px;height:28px;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <p style="font-size:15px;font-weight:600;color:var(--text-secondary);">
                    Tidak ada data sewa {{ $filter !== 'semua' ? '"' . ucfirst($filter) . '"' : '' }}
                </p>
                <p style="font-size:13px;color:var(--text-muted);margin-top:4px;">
                    @if($filter === 'aktif')
                        Belum ada sewa aktif. Klik "Tambah Sewa" untuk membuat kontrak baru.
                    @else
                        Tidak ada data untuk filter ini.
                    @endif
                </p>
            </div>
        @else
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th style="width:50px; text-align:center;">No</th>
                            <th>Penyewa</th>
                            <th>Nama Toko</th>
                            <th>Unit</th>
                            <th style="white-space:nowrap;">Tanggal Mulai</th>
                            <th style="white-space:nowrap;">Tanggal Selesai</th>
                            <th style="white-space:nowrap;">Sisa Bayar</th>
                            <th style="width:100px; text-align:center;">Status</th>
                            <th style="width:200px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sewa as $index => $value)
                            <tr>
                                <td style="text-align:center; color:var(--text-muted); font-size:13px; font-weight:600;">
                                    {{ $index + 1 }}
                                </td>

                                {{-- Penyewa --}}
                                <td>
                                    <div style="display:flex; align-items:center; gap:10px;">
                                        <div class="table-avatar">
                                            {{ strtoupper(substr($value->penyewa->nama ?? 'X', 0, 1)) }}
                                        </div>
                                        <span style="font-weight:600;">{{ $value->penyewa->nama ?? '-' }}</span>
                                    </div>
                                </td>

                                {{-- Nama Toko --}}
                                <td>
                                    @if ($value->nama_toko)
                                        <span style="font-weight:600; color:var(--blue);">{{ $value->nama_toko }}</span>
                                    @else
                                        <span style="color:var(--text-muted); font-style:italic;">-</span>
                                    @endif
                                </td>

                                {{-- Unit --}}
                                <td>
                                    <div style="display:flex; align-items:center; gap:8px;">
                                        <div class="table-unit-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                                            </svg>
                                        </div>
                                        <span style="font-weight:600; color:var(--blue);">{{ $value->unit->nama_unit ?? '-' }}</span>
                                    </div>
                                </td>

                                {{-- Tanggal Mulai --}}
                                <td style="color:var(--text-secondary); font-family:'DM Mono',monospace; font-size:13px;">
                                    {{ $value->tanggal_mulai ? \Carbon\Carbon::parse($value->tanggal_mulai)->format('d M Y') : '-' }}
                                </td>

                                {{-- Tanggal Selesai --}}
                                <td style="color:var(--text-secondary); font-family:'DM Mono',monospace; font-size:13px;">
                                    {{ $value->tanggal_selesai ? \Carbon\Carbon::parse($value->tanggal_selesai)->format('d M Y') : '-' }}
                                </td>

                                {{-- Sisa Bayar --}}
                                <td style="font-weight:600;">
                                    @php $sisa = $value->harga_sewa - $value->total_dibayar; @endphp
                                    @if ($value->status === 'batal')
                                        <span style="color:var(--text-muted); font-style:italic;">-</span>
                                    @elseif ($sisa > 0)
                                        <span style="color:#f59e0b;">Rp {{ number_format($sisa, 0, ',', '.') }}</span>
                                    @else
                                        <span style="color:var(--green);">Lunas</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td style="text-align:center;">
                                    @if ($value->status === 'booking')
                                        <span class="badge warning">Booking</span>
                                    @elseif ($value->status === 'aktif')
                                        <span class="badge success">Aktif</span>
                                    @elseif ($value->status === 'selesai')
                                        <span class="badge secondary">Selesai</span>
                                    @else
                                        <span class="badge danger">Batal</span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    <div style="display:flex; gap:6px; justify-content:center; flex-wrap:wrap;">
                                        <a href="{{ route('sewa.show', $value->id) }}" class="btn btn-secondary btn-sm">Detail</a>

                                        @if ($value->status === 'booking')
                                            <form action="{{ route('sewa.refund', $value->id) }}" method="POST"
                                                onsubmit="return confirm('Batalkan booking dan refund DP ke penyewa?')">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-danger btn-sm">Refund & Batal</button>
                                            </form>
                                        @elseif ($value->status === 'aktif')
                                            <form action="{{ route('sewa.selesai', $value->id) }}" method="POST"
                                                onsubmit="return confirm('Tandai sewa ini sebagai selesai?')">
                                                @csrf @method('PATCH')
                                                <button class="btn btn-success btn-sm">Selesai</button>
                                            </form>
                                        @elseif ($value->status === 'selesai' || $value->status === 'batal')
                                            <form action="{{ route('sewa.destroy', $value->id) }}" method="POST"
                                                onsubmit="return confirm('Hapus data sewa ini secara permanen?')">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
@endsection
