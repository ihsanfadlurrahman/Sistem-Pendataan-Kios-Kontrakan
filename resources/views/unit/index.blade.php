@extends('layouts.master')

@section('title', 'Data Unit')
@section('page-title', 'Data Unit')

@section('content')
<div class="table-box">

    {{-- Header --}}
    <div class="table-box-header">
        <div>
            <h4>Data Unit</h4>
            <p style="font-size:13px; color:var(--text-muted); margin-top:3px;">
                Kelola semua unit kios &amp; kontrakan
            </p>
        </div>
        <a href="{{ route('units.create') }}" class="btn btn-primary">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Tambah Unit
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
        $total   = $units->count();
        $kosong  = $units->where('status','kosong')->count();
        $disewa  = $units->where('status','disewa')->count();
        $kios    = $units->where('tipe','kios')->count();
        $kontrakan = $units->where('tipe','kontrakan')->count();
    @endphp
    <div class="unit-stats">
        <div class="unit-stat-item">
            <span class="stat-number">{{ $total }}</span>
            <span class="stat-label">Total Unit</span>
        </div>
        <div class="unit-stat-divider"></div>
        <div class="unit-stat-item">
            <span class="stat-number" style="color:var(--green);">{{ $kosong }}</span>
            <span class="stat-label">Kosong</span>
        </div>
        <div class="unit-stat-divider"></div>
        <div class="unit-stat-item">
            <span class="stat-number" style="color:var(--red);">{{ $disewa }}</span>
            <span class="stat-label">Disewa</span>
        </div>
        <div class="unit-stat-divider"></div>
        <div class="unit-stat-item">
            <span class="stat-number" style="color:var(--blue);">{{ $kios }}</span>
            <span class="stat-label">Kios</span>
        </div>
        <div class="unit-stat-divider"></div>
        <div class="unit-stat-item">
            <span class="stat-number" style="color:#7c3aed;">{{ $kontrakan }}</span>
            <span class="stat-label">Kontrakan</span>
        </div>
    </div>

    {{-- Unit Grid --}}
    @if($units->isEmpty())
    <div style="text-align:center; padding:60px 24px;">
        <div style="width:56px;height:56px;background:#f1f5f9;border-radius:14px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#94a3b8" style="width:28px;height:28px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
            </svg>
        </div>
        <p style="font-size:15px;font-weight:600;color:var(--text-secondary);">Belum ada unit</p>
        <p style="font-size:13px;color:var(--text-muted);margin-top:4px;">Klik "Tambah Unit" untuk menambahkan unit baru.</p>
    </div>
    @else
    <div class="unit-grid">
        @foreach($units as $value)
        @php
            $isKontrakan = strtolower($value->tipe) == 'kontrakan';
            $isKosong    = $value->status == 'kosong';
            $isMilikIbu  = $value->pemilik == 'ibu';
        @endphp
        <div class="unit-card">

            {{-- Top accent stripe based on owner --}}
            <div class="unit-card-stripe {{ $isMilikIbu ? 'stripe-pink' : 'stripe-blue' }}"></div>

            {{-- Card Header --}}
            <div class="unit-card-header">
                <div class="unit-card-icon-wrap {{ $isKontrakan ? 'icon-purple' : ($value->tipe == 'kios' ? 'icon-blue' : 'icon-green') }}">
                    @if(strtolower($value->tipe) == 'kontrakan')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12L11.204 3.045c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    @elseif(strtolower($value->tipe) == 'kios')
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016 2.993 2.993 0 0 0 2.25-1.016 3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                    @endif
                </div>

                <div>
                    <div class="unit-card-name">{{ $value->nama_unit }}</div>
                    <div class="unit-card-owner">Pemilik: {{ ucfirst($value->pemilik ?? '-') }}</div>
                </div>

                <span class="unit-status-badge {{ $isKosong ? 'status-kosong' : 'status-disewa' }}">
                    <span class="status-dot"></span>
                    {{ ucfirst($value->status) }}
                </span>
            </div>

            {{-- Info Rows --}}
            <div class="unit-info-rows">
                <div class="unit-info-row">
                    <span class="info-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>
                        Tipe
                    </span>
                    <span class="info-value">
                        <span class="tipe-badge {{ $isKontrakan ? 'tipe-kontrakan' : 'tipe-kios' }}">
                            {{ ucfirst($value->tipe) }}
                        </span>
                    </span>
                </div>

                <div class="unit-info-row">
                    <span class="info-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Harga Sewa
                    </span>
                    <span class="info-value info-price">
                        Rp {{ number_format($value->harga_sewa, 0, ',', '.') }}
                    </span>
                </div>

                <div class="unit-info-row">
                    <span class="info-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                        Periode
                    </span>
                    <span class="info-value">
                        <span class="periode-badge {{ $value->periode == 'bulanan' ? 'periode-bulanan' : 'periode-tahunan' }}">
                            {{ ucfirst($value->periode ?? 'Tidak Ada') }}
                        </span>
                    </span>
                </div>

                @if($value->keterangan)
                <div class="unit-info-row" style="align-items:flex-start;">
                    <span class="info-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                        Keterangan
                    </span>
                    <span class="info-value" style="color:var(--text-secondary); font-size:12.5px;">
                        {{ $value->keterangan }}
                    </span>
                </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="unit-card-actions">
                <a href="{{ route('units.edit', $value->id) }}" class="btn btn-warning btn-sm" style="flex:1; justify-content:center;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('units.destroy', $value->id) }}" method="POST"
                    onsubmit="return confirm('Hapus unit {{ $value->nama_unit }}?');" style="flex:1; margin:0;">
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
