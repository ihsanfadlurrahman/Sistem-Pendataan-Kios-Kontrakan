@extends('layouts.master')

@section('title', 'Tambah Sewa')
@section('page-title', 'Tambah Sewa')

@section('content')
    <div class="form-container">
        <div class="form-card">

            {{-- Header --}}
            <div class="form-header">
                <div class="form-header-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                </div>
                <div>
                    <h4>Tambah Kontrak Sewa Baru</h4>
                    <p>Catat kontrak sewa unit untuk penyewa</p>
                </div>
            </div>

            {{-- Info Alert (dari perpanjang) --}}
            @if (session('info'))
                <div class="alert" style="margin-bottom:20px; background:#eff6ff; border:1px solid #bfdbfe; color:#1e40af;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    {{ session('info') }}
                </div>
            @endif

            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-bottom:20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <div>
                        <strong>Terdapat kesalahan:</strong>
                        <ul style="margin:6px 0 0 0; padding-left:20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('sewa.store') }}" method="POST" id="formSewa">
                @csrf

                {{-- ══ SECTION 1: PENYEWA ══════════════════════════ --}}
                <div class="penyewa-toggle-section">
                    <label class="section-label">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                        Pilih Tipe Penyewa
                    </label>
                    <div class="radio-group">
                        <label class="radio-card">
                            <input type="radio" name="mode_penyewa" value="lama" checked onclick="togglePenyewa()">
                            <div class="radio-card-content">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                <div>
                                    <span class="radio-card-title">Penyewa Lama</span>
                                    <span class="radio-card-desc">Pilih dari daftar penyewa yang sudah terdaftar</span>
                                </div>
                            </div>
                        </label>
                        <label class="radio-card">
                            <input type="radio" name="mode_penyewa" value="baru" onclick="togglePenyewa()">
                            <div class="radio-card-content">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                </svg>
                                <div>
                                    <span class="radio-card-title">Penyewa Baru</span>
                                    <span class="radio-card-desc">Daftarkan penyewa baru sekaligus</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Penyewa Lama --}}
                <div id="penyewa_lama_section" class="conditional-section">
                    <div class="form-group">
                        <label for="penyewa_id">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Pilih Penyewa <span class="required">*</span>
                        </label>
                        <select id="penyewa_id" name="penyewa_id">
                            <option value="">-- Pilih Penyewa --</option>
                            @foreach ($penyewa as $p)
                                <option value="{{ $p->id }}"
                                    {{ (old('penyewa_id', request('penyewa_id')) == $p->id) ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Penyewa Baru --}}
                <div id="penyewa_baru_section" class="conditional-section" style="display:none;">
                    <div class="form-grid">
                        <div class="form-group form-group-full">
                            <label for="nama">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                                Nama Penyewa <span class="required">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="form-group">
                            <label for="no_hp">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                </svg>
                                No. Telepon <span class="required">*</span>
                            </label>
                            <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                maxlength="15" inputmode="numeric"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')"
                                placeholder="08123456789">
                        </div>
                        <div class="form-group">
                            <label for="alamat">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                Alamat <span class="optional">(opsional)</span>
                            </label>
                            <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" placeholder="Alamat lengkap">
                        </div>
                    </div>
                </div>

                <div class="form-divider"></div>

                {{-- ══ SECTION 2: UNIT ════════════════════════════ --}}
                <div class="form-grid">

                    <div class="form-group form-group-full">
                        <label for="unit_id">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                            </svg>
                            Pilih Unit <span class="required">*</span>
                        </label>
                        <select id="unit_id" name="unit_id" required>
                            <option value="">-- Pilih Unit Kosong --</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}"
                                    data-harga="{{ $unit->harga_sewa }}"
                                    data-periode="{{ $unit->periode }}"
                                    data-tipe="{{ $unit->tipe }}"
                                    {{ (old('unit_id', request('unit_id')) == $unit->id) ? 'selected' : '' }}>
                                    {{ $unit->nama_unit }}
                                    — Rp {{ number_format($unit->harga_sewa, 0, ',', '.') }}
                                    / {{ $unit->periode }}
                                    ({{ $unit->tipe }})
                                </option>
                            @endforeach
                        </select>
                        <div id="unit_info" style="margin-top:8px; font-size:13px; color:var(--text-muted);"></div>
                    </div>

                    {{-- Nama Toko (hanya kios) --}}
                    <div class="form-group form-group-full" id="nama_toko_field" style="display:none;">
                        <label for="nama_toko">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>
                            Nama Toko/Usaha <span class="optional">(opsional)</span>
                        </label>
                        <input type="text" id="nama_toko" name="nama_toko"
                            value="{{ old('nama_toko') }}" placeholder="Nama toko yang akan beroperasi">
                    </div>

                </div>

                <div class="form-divider"></div>

                {{-- ══ SECTION 3: PEMBAYARAN AWAL ════════════════ --}}
                <label class="section-label" style="margin-bottom:16px;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                    </svg>
                    Pembayaran Awal
                </label>

                <div class="form-grid">

                    {{-- Tipe --}}
                    <div class="form-group">
                        <label for="tipe_bayar">Tipe Pembayaran <span class="required">*</span></label>
                        <select id="tipe_bayar" name="tipe_bayar" required onchange="onTipeChange()">
                            <option value="dp"        {{ old('tipe_bayar', 'dp') === 'dp'       ? 'selected' : '' }}>DP (Uang Muka)</option>
                            <option value="pelunasan"  {{ old('tipe_bayar') === 'pelunasan'      ? 'selected' : '' }}>Langsung Lunas</option>
                        </select>
                        <small class="field-hint" id="tipe_hint">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" style="width:13px;height:13px;flex-shrink:0;">
                                <path fill-rule="evenodd" d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Zm-6 3.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7.293 5.293a1 1 0 1 1 .99 1.667c-.459.134-.715.369-.85.59a.25.25 0 0 0 .444.224c.24-.4.658-.769 1.313-.898a2.5 2.5 0 0 0-2.384-3.633 2.5 2.5 0 0 0-1.927 3.546.75.75 0 0 0 1.436-.428A1 1 0 0 1 7.293 5.293Z" clip-rule="evenodd" />
                            </svg>
                            Sewa berstatus <strong>Booking</strong>. Tanggal mulai otomatis terisi saat pelunasan.
                        </small>
                    </div>

                    {{-- Jumlah --}}
                    <div class="form-group">
                        <label for="jumlah_bayar">Jumlah Bayar <span class="required">*</span></label>
                        <div class="input-group">
                            <span class="input-prefix">Rp</span>
                            <input type="number" id="jumlah_bayar" name="jumlah_bayar"
                                value="{{ old('jumlah_bayar') }}"
                                placeholder="0" min="1"
                                inputmode="numeric"
                                oninput="onJumlahInput()"
                                required>
                        </div>

                        {{-- Warning: jumlah = harga sewa tapi tipe masih DP --}}
                        <div id="warn_ubah_lunas" style="display:none; margin-top:8px;">
                            <div style="background:#fffbeb; border:1px solid #fde68a; border-radius:var(--radius-md); padding:10px 14px; font-size:12.5px; color:#92400e;">
                                <div style="display:flex; gap:8px; align-items:flex-start;">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" style="width:15px;height:15px;flex-shrink:0;margin-top:1px;">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                    </svg>
                                    <div>
                                        Jumlah ini sama dengan harga sewa. Ubah tipe ke <strong>Langsung Lunas</strong>?
                                        <div style="margin-top:8px;">
                                            <button type="button" onclick="ubahKeLunas()" class="btn btn-warning btn-sm">
                                                Ya, ubah ke Lunas
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Form Actions --}}
                <div class="form-actions">
                    <a href="{{ route('sewa.index') }}" class="btn btn-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Simpan Sewa
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        
    </script>
@endsection
