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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </div>
            <div>
                <h4>Tambah Kontrak Sewa Baru</h4>
                <p>Catat kontrak sewa unit untuk penyewa</p>
            </div>
        </div>

        {{-- Error Alert --}}
        @if($errors->any())
        <div class="alert alert-danger">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
            </svg>
            <div>
                <strong>Terdapat kesalahan:</strong>
                <ul style="margin:6px 0 0 0; padding-left:20px;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('sewa.store') }}" method="POST">
            @csrf

            {{-- Penyewa Type Toggle --}}
            <div class="penyewa-toggle-section">
                <label class="section-label">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Pilih Tipe Penyewa
                </label>
                <div class="radio-group">
                    <label class="radio-card">
                        <input type="radio" name="mode_penyewa" value="lama" checked onclick="togglePenyewa()">
                        <div class="radio-card-content">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>
                            <div>
                                <span class="radio-card-title">Penyewa Baru</span>
                                <span class="radio-card-desc">Daftarkan penyewa baru sekaligus</span>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            {{-- Penyewa Lama Section --}}
            <div id="penyewa_lama_section" class="conditional-section">
                <div class="form-group">
                    <label for="penyewa_id">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Pilih Penyewa
                        <span class="required">*</span>
                    </label>
                    <select id="penyewa_id" name="penyewa_id">
                        <option value="">-- Pilih Penyewa --</option>
                        @foreach($penyewa as $value)
                        <option value="{{ $value->id }}">{{ $value->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Penyewa Baru Section --}}
            <div id="penyewa_baru_section" class="conditional-section" style="display:none;">
                <div class="form-grid">
                    <div class="form-group form-group-full">
                        <label for="nama">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            Nama Penyewa Baru
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-group">
                        <label for="no_hp">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            No. Telepon
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="no_hp" name="no_hp" maxlength="15" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="08123456789">
                    </div>
                    <div class="form-group">
                        <label for="alamat">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            Alamat
                            <span class="required">*</span>
                        </label>
                        <input type="text" id="alamat" name="alamat" placeholder="Alamat lengkap">
                    </div>
                </div>
            </div>

            <div class="form-divider"></div>

            {{-- Unit & Dates --}}
            <div class="form-grid">

                {{-- Unit --}}
                <div class="form-group form-group-full">
                    <label for="unit_id">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                        Pilih Unit
                        <span class="required">*</span>
                    </label>
                    <select id="unit_id" name="unit_id" required>
                        <option value="">-- Pilih Unit Kosong --</option>
                        @foreach($units as $unit)
                        <option value="{{ $unit->id }}" {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                            {{ $unit->nama_unit }} - Rp {{ number_format($unit->harga_sewa, 0, ',', '.') }}/bulan
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Mulai --}}
                <div class="form-group">
                    <label for="tanggal_mulai">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                        Tanggal Mulai
                        <span class="required">*</span>
                    </label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                </div>

                {{-- Tanggal Selesai --}}
                <div class="form-group">
                    <label for="tanggal_selesai">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                        Tanggal Selesai
                        <span class="optional">(opsional)</span>
                    </label>
                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                    <small class="field-hint">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                            <path fill-rule="evenodd" d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Zm-6 3.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7.293 5.293a1 1 0 1 1 .99 1.667c-.459.134-.715.369-.85.59a.25.25 0 0 0 .444.224c.24-.4.658-.769 1.313-.898a2.5 2.5 0 0 0-2.384-3.633 2.5 2.5 0 0 0-1.927 3.546.75.75 0 0 0 1.436-.428A1 1 0 0 1 7.293 5.293Z" clip-rule="evenodd" />
                        </svg>
                        Kosongkan jika kontrak tidak memiliki batas waktu
                    </small>
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
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Simpan Sewa
                </button>
            </div>

        </form>

    </div>
</div>

<script>
function togglePenyewa() {
    const mode = document.querySelector('input[name="mode_penyewa"]:checked').value;
    const lamaSection = document.getElementById('penyewa_lama_section');
    const baruSection = document.getElementById('penyewa_baru_section');

    if (mode === 'lama') {
        lamaSection.style.display = 'block';
        baruSection.style.display = 'none';

        // Reset baru fields
        document.getElementById('nama').value = '';
        document.getElementById('no_hp').value = '';
        document.getElementById('alamat').value = '';
    } else {
        lamaSection.style.display = 'none';
        baruSection.style.display = 'block';

        // Reset lama field
        document.getElementById('penyewa_id').value = '';
    }
}
</script>
@endsection
