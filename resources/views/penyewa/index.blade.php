@extends('layouts.master')

@section('title', 'Data Penyewa')
@section('page-title', 'Data Penyewa')

@section('content')
<div class="table-box">

    {{-- Header --}}
    <div class="table-box-header">
        <div>
            <h4>Data Penyewa</h4>
            <p style="font-size:13px; color:var(--text-muted); margin-top:3px;">
                Kelola informasi penyewa kios &amp; kontrakan
            </p>
        </div>
        <a href="{{ route('penyewa.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
            </svg>
            Tambah Penyewa
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert alert-success" style="margin-bottom:20px;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    {{-- Stats Bar --}}
    @php
        $total     = $penyewa->count();
        $aktif     = $penyewa->filter(fn($p) => $p->sewa->where('status','aktif')->count() > 0)->count();
        $tidakAktif = $total - $aktif;
    @endphp
    <div class="penyewa-stats">
        <div class="penyewa-stat-item">
            <span class="stat-number">{{ $total }}</span>
            <span class="stat-label">Total Penyewa</span>
        </div>
        <div class="penyewa-stat-divider"></div>
        <div class="penyewa-stat-item">
            <span class="stat-number" style="color:var(--green);">{{ $aktif }}</span>
            <span class="stat-label">Aktif Menyewa</span>
        </div>
        <div class="penyewa-stat-divider"></div>
        <div class="penyewa-stat-item">
            <span class="stat-number" style="color:var(--text-muted);">{{ $tidakAktif }}</span>
            <span class="stat-label">Tidak Aktif</span>
        </div>
    </div>

    {{-- Penyewa Grid --}}
    @if($penyewa->isEmpty())
    <div style="text-align:center; padding:60px 24px;">
        <div style="width:56px;height:56px;background:#f1f5f9;border-radius:14px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#94a3b8" style="width:28px;height:28px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
            </svg>
        </div>
        <p style="font-size:15px;font-weight:600;color:var(--text-secondary);">Belum ada penyewa</p>
        <p style="font-size:13px;color:var(--text-muted);margin-top:4px;">Klik "Tambah Penyewa" untuk menambahkan penyewa baru.</p>
    </div>
    @else
    <div class="penyewa-grid">
        @foreach($penyewa as $value)
        @php
            $sewaAktif = $value->sewa->where('status', 'aktif');
            $hasSewaAktif = $sewaAktif->count() > 0;
        @endphp
        <div class="penyewa-card">

            {{-- Avatar & Name Section --}}
            <div class="penyewa-card-header">
                <div class="penyewa-avatar">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="penyewa-info">
                    <div class="penyewa-name">{{ $value->nama }}</div>
                    <div class="penyewa-status {{ $hasSewaAktif ? 'status-active' : 'status-inactive' }}">
                        <span class="status-dot"></span>
                        {{ $hasSewaAktif ? 'Aktif Menyewa' : 'Tidak Aktif' }}
                    </div>
                </div>
            </div>

            {{-- Contact Information --}}
            <div class="penyewa-details">
                <div class="detail-row">
                    <div class="detail-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">No. Telepon</div>
                        <div class="detail-value">{{ $value->no_hp }}</div>
                    </div>
                </div>

                <div class="detail-row">
                    <div class="detail-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Alamat</div>
                        <div class="detail-value">{{ $value->alamat }}</div>
                    </div>
                </div>

                {{-- Unit Info --}}
                @if($hasSewaAktif)
                <div class="detail-row">
                    <div class="detail-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Unit Disewa</div>
                        <div class="unit-badges">
                            @foreach($sewaAktif as $sewa)
                            <span class="unit-badge">{{ $sewa->unit->nama_unit }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                @else
                <div class="no-unit-banner">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <span>Tidak ada unit aktif</span>
                </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="penyewa-card-actions">
                <a href="{{ route('penyewa.edit', $value->id) }}" class="btn btn-warning btn-sm" style="flex:1; justify-content:center;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('penyewa.destroy', $value->id) }}" method="POST"
                    onsubmit="return confirm('Hapus penyewa {{ $value->nama }}?');" style="flex:1; margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" style="width:100%; justify-content:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>

        </div>
        @endforeach
    </div>
    @endif

</div>
@endsection
