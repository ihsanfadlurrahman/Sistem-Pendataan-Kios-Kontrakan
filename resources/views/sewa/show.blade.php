@extends('layouts.master')

@section('title', 'Detail Sewa')
@section('page-title', 'Detail Sewa')

@section('content')
<div class="form-container" style="max-width:860px;">
    <div class="form-card">

        {{-- Header --}}
        <div class="form-header">
            <div class="form-header-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </div>
            <div style="flex:1;">
                <h4>Detail Kontrak Sewa</h4>
                <p>{{ $sewa->unit->nama_unit ?? '-' }} &mdash; {{ $sewa->penyewa->nama ?? '-' }}</p>
            </div>
            <div style="display:flex; gap:8px; align-items:center;">
                @if ($sewa->status === 'booking')
                    <span class="badge warning" style="font-size:13px; padding:6px 14px;">Booking</span>
                @elseif ($sewa->status === 'aktif')
                    <span class="badge success" style="font-size:13px; padding:6px 14px;">Aktif</span>
                @elseif ($sewa->status === 'selesai')
                    <span class="badge secondary" style="font-size:13px; padding:6px 14px;">Selesai</span>
                @else
                    <span class="badge danger" style="font-size:13px; padding:6px 14px;">Batal</span>
                @endif
                <a href="{{ route('sewa.index') }}" class="btn btn-secondary btn-sm">← Kembali</a>
            </div>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="alert alert-success" style="margin-bottom:20px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" style="margin-bottom:20px;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @php
            $sisa = $sewa->harga_sewa - $sewa->total_dibayar;
        @endphp

        {{-- Info Grid --}}
        <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:24px; margin-bottom:28px;">

            {{-- Kolom Kiri --}}
            <div style="display:flex; flex-direction:column; gap:16px;">
                <div class="detail-item">
                    <span class="detail-label">Penyewa</span>
                    <span class="detail-value">{{ $sewa->penyewa->nama ?? '-' }}</span>
                </div>
                @if ($sewa->nama_toko)
                <div class="detail-item">
                    <span class="detail-label">Nama Toko</span>
                    <span class="detail-value" style="color:var(--blue);">{{ $sewa->nama_toko }}</span>
                </div>
                @endif
                <div class="detail-item">
                    <span class="detail-label">Unit</span>
                    <span class="detail-value">{{ $sewa->unit->nama_unit ?? '-' }}
                        <small style="color:var(--text-muted); font-weight:400;">({{ $sewa->unit->tipe ?? '' }})</small>
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tanggal Mulai</span>
                    <span class="detail-value">
                        {{ $sewa->tanggal_mulai ? \Carbon\Carbon::parse($sewa->tanggal_mulai)->format('d M Y') : '-' }}
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Tanggal Selesai</span>
                    <span class="detail-value">
                        {{ $sewa->tanggal_selesai ? \Carbon\Carbon::parse($sewa->tanggal_selesai)->format('d M Y') : '-' }}
                    </span>
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div style="display:flex; flex-direction:column; gap:16px;">
                <div class="detail-item">
                    <span class="detail-label">Harga Sewa</span>
                    <span class="detail-value">Rp {{ number_format($sewa->harga_sewa, 0, ',', '.') }}</span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Total Dibayar</span>
                    <span class="detail-value" style="color:var(--green);">
                        Rp {{ number_format($sewa->total_dibayar, 0, ',', '.') }}
                    </span>
                </div>
                <div class="detail-item">
                    <span class="detail-label">Sisa Tagihan</span>
                    <span class="detail-value">
                        @if ($sewa->status === 'batal')
                            <span style="color:var(--text-muted);">-</span>
                        @elseif ($sisa > 0)
                            <span style="color:#f59e0b; font-weight:700;">
                                Rp {{ number_format($sisa, 0, ',', '.') }}
                            </span>
                        @else
                            <span style="color:var(--green); font-weight:700;">Lunas ✓</span>
                        @endif
                    </span>
                </div>
            </div>

        </div>

        {{-- FORM BAYAR — hanya saat booking dan masih ada sisa --}}
        @if ($sewa->status === 'booking' && $sisa > 0)
            <div class="form-divider"></div>
            <div style="margin-bottom:28px;">
                <h5 style="font-size:15px; font-weight:700; margin-bottom:16px; color:var(--text-primary);">
                    💳 Tambah Pembayaran
                </h5>
                @if ($errors->any())
                    <div class="alert alert-danger" style="margin-bottom:16px;">
                        <ul style="margin:0; padding-left:16px;">
                            @foreach ($errors->all() as $error)
                                <li style="font-size:13px;">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('sewa.bayar', $sewa->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div style="display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
                        <div class="form-group" style="flex:2; min-width:160px;">
                            <label for="jumlah">Jumlah Bayar</label>
                            <input type="number" id="jumlah" name="jumlah"
                                placeholder="Rp ..."
                                min="1" max="{{ $sisa }}"
                                value="{{ old('jumlah') }}"
                                required>
                            <small class="field-hint">Maks: Rp {{ number_format($sisa, 0, ',', '.') }}</small>
                        </div>
                        <div class="form-group" style="flex:1; min-width:130px;">
                            <label for="tipe">Tipe Pembayaran</label>
                            <select id="tipe" name="tipe" required>
                                @if ($sewa->total_dibayar == 0)
                                    <option value="dp">DP</option>
                                    <option value="pelunasan">Langsung Lunas</option>
                                @else
                                    <option value="pelunasan">Pelunasan</option>
                                @endif
                            </select>
                        </div>
                        <div style="padding-bottom:2px;">
                            <button type="submit" class="btn btn-primary">Bayar</button>
                        </div>
                    </div>
                </form>
            </div>
        @endif

        {{-- TOMBOL AKSI BAWAH --}}
        @if ($sewa->status === 'aktif')
            <div class="form-divider"></div>
            <div style="display:flex; justify-content:flex-end;">
                <form action="{{ route('sewa.selesai', $sewa->id) }}" method="POST"
                    onsubmit="return confirm('Tandai sewa ini sebagai selesai?')">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-success">✓ Selesaikan Sewa</button>
                </form>
            </div>
        @endif

        @if ($sewa->status === 'booking')
            <div class="form-divider"></div>
            <div style="display:flex; justify-content:flex-end; gap:10px;">
                <form action="{{ route('sewa.refund', $sewa->id) }}" method="POST"
                    onsubmit="return confirm('Batalkan booking dan refund DP ke penyewa?')">
                    @csrf
                    @method('PATCH')
                    <button class="btn btn-danger">↩ Refund & Batalkan Booking</button>
                </form>
            </div>
        @endif

        {{-- TOMBOL PERPANJANG — hanya saat selesai --}}
        @if ($sewa->status === 'selesai')
            <div class="form-divider"></div>
            <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:var(--radius-md); padding:16px 20px; margin-bottom:4px;">
                <div style="display:flex; align-items:center; justify-content:space-between; gap:16px; flex-wrap:wrap;">
                    <div>
                        <div style="font-size:14px; font-weight:700; color:#15803d; margin-bottom:3px;">
                            🔄 Perpanjang Sewa
                        </div>
                        <div style="font-size:12.5px; color:#166534;">
                            Buat kontrak sewa baru untuk <strong>{{ $sewa->penyewa->nama }}</strong>
                            di unit <strong>{{ $sewa->unit->nama_unit }}</strong> dengan harga yang sama.
                        </div>
                    </div>
                    <form action="{{ route('sewa.perpanjang', $sewa->id) }}" method="POST"
                        onsubmit="return confirm('Perpanjang sewa untuk {{ $sewa->penyewa->nama }} di unit {{ $sewa->unit->nama_unit }}?')">
                        @csrf
                        @method("PATCH")
                        <button type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                            Perpanjang Sewa
                        </button>
                    </form>
                </div>
            </div>
        @endif

        {{-- RIWAYAT PEMBAYARAN --}}
        <div class="form-divider"></div>
        <h5 style="font-size:15px; font-weight:700; margin-bottom:16px; color:var(--text-primary);">
            🧾 Riwayat Pembayaran
        </h5>

        @if ($sewa->pembayaran->isEmpty())
            <p style="color:var(--text-muted); font-style:italic; font-size:14px;">Belum ada pembayaran.</p>
        @else
            <div style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>Tipe</th>
                            <th>Jumlah</th>
                            <th>Tanggal Bayar</th>
                            <th style="text-align:center;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sewa->pembayaran as $bayar)
                            <tr @if($bayar->is_refunded) style="opacity:0.55;" @endif>
                                <td>
                                    <span style="font-weight:600; text-transform:uppercase; font-size:12px;">
                                        {{ $bayar->tipe }}
                                    </span>
                                </td>
                                <td style="font-weight:600;">
                                    Rp {{ number_format($bayar->jumlah, 0, ',', '.') }}
                                </td>
                                <td style="font-family:'DM Mono',monospace; font-size:13px; color:var(--text-secondary);">
                                    {{ $bayar->tanggal_bayar ? \Carbon\Carbon::parse($bayar->tanggal_bayar)->format('d M Y') : '-' }}
                                </td>
                                <td style="text-align:center;">
                                    @if ($bayar->is_refunded)
                                        <span class="badge danger" style="font-size:11px;">
                                            Direfund {{ \Carbon\Carbon::parse($bayar->tanggal_refund)->format('d M Y') }}
                                        </span>
                                    @else
                                        <span class="badge success" style="font-size:11px;">Lunas</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</div>

<style>
.detail-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}
.detail-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.detail-value {
    font-size: 15px;
    font-weight: 600;
    color: var(--text-primary);
}
</style>
@endsection
