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

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="alert alert-success" style="margin-bottom:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
    <div class="alert alert-danger" style="margin-bottom:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- Stats Bar --}}
    @php
        $total   = $sewa->count();
        $aktif   = $sewa->where('status', 'aktif')->count();
        $selesai = $sewa->where('status', 'selesai')->count();
    @endphp
    <div class="sewa-stats">
        <div class="sewa-stat-item">
            <span class="stat-number">{{ $total }}</span>
            <span class="stat-label">Total Sewa</span>
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
    </div>

    {{-- Table --}}
    @if($sewa->isEmpty())
    <div style="text-align:center; padding:60px 24px;">
        <div style="width:56px;height:56px;background:#f1f5f9;border-radius:14px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#94a3b8" style="width:28px;height:28px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
            </svg>
        </div>
        <p style="font-size:15px;font-weight:600;color:var(--text-secondary);">Belum ada data sewa</p>
        <p style="font-size:13px;color:var(--text-muted);margin-top:4px;">Klik "Tambah Sewa" untuk membuat kontrak sewa baru.</p>
    </div>
    @else
    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th style="width:50px; text-align:center;">No</th>
                    <th>Penyewa</th>
                    <th>Unit</th>
                    <th style="white-space:nowrap;">Tanggal Mulai</th>
                    <th style="white-space:nowrap;">Tanggal Selesai</th>
                    <th style="width:100px; text-align:center;">Status</th>
                    <th style="width:180px; text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sewa as $index => $value)
                <tr>
                    <td style="text-align:center; color:var(--text-muted); font-size:13px; font-weight:600;">
                        {{ $index + 1 }}
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:10px;">
                            <div class="table-avatar">
                                {{ strtoupper(substr($value->penyewa->nama ?? 'X', 0, 1)) }}
                            </div>
                            <span style="font-weight:600;">{{ $value->penyewa->nama ?? '-' }}</span>
                        </div>
                    </td>
                    <td>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <div class="table-unit-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                                </svg>
                            </div>
                            <span style="font-weight:600; color:var(--blue);">{{ $value->unit->nama_unit ?? '-' }}</span>
                        </div>
                    </td>
                    <td style="color:var(--text-secondary); font-family:'DM Mono',monospace; font-size:13px;">
                        {{ \Carbon\Carbon::parse($value->tanggal_mulai)->format('d M Y') }}
                    </td>
                    <td style="color:var(--text-secondary); font-family:'DM Mono',monospace; font-size:13px;">
                        @if($value->tanggal_selesai)
                            {{ \Carbon\Carbon::parse($value->tanggal_selesai)->format('d M Y') }}
                        @else
                            <span style="color:var(--text-muted); font-style:italic;">-</span>
                        @endif
                    </td>
                    <td style="text-align:center;">
                        @if($value->status == 'aktif')
                        <span class="badge success">
                            <span style="width:5px;height:5px;background:currentColor;border-radius:50%;display:inline-block;"></span>
                            Aktif
                        </span>
                        @else
                        <span class="badge secondary">
                            Selesai
                        </span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; gap:6px; justify-content:center;">
                            @if($value->status == 'aktif')
                            <form action="{{ route('sewa.selesai', $value->id) }}" method="POST" style="margin:0;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm"
                                    onclick="return confirm('Tandai sewa ini sebagai selesai?');"
                                    title="Selesaikan Sewa">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Selesai
                                </button>
                            </form>
                            @endif

                            <form action="{{ route('sewa.destroy', $value->id) }}" method="POST"
                                onsubmit="return confirm('Hapus data sewa ini?');" style="margin:0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Hapus Sewa">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                    Hapus
                                </button>
                            </form>
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
