@extends('layouts.master')

@section('title', 'Tambah Penyewa')
@section('page-title', 'Tambah Penyewa')

@section('content')
<div class="form-container">
    <div class="form-card">

        {{-- Header --}}
        <div class="form-header">
            <div class="form-header-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                </svg>
            </div>
            <div>
                <h4>Tambah Penyewa Baru</h4>
                <p>Daftarkan penyewa unit kios atau kontrakan</p>
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
        <form action="{{ route('penyewa.store') }}" method="POST">
            @csrf

            <div class="form-grid">

                {{-- Nama Penyewa --}}
                <div class="form-group form-group-full">
                    <label for="nama">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Nama Penyewa
                        <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        value="{{ old('nama') }}"
                        placeholder="Masukkan nama lengkap penyewa"
                        required
                        autofocus>
                </div>

                {{-- No HP --}}
                <div class="form-group form-group-full">
                    <label for="no_hp">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                        </svg>
                        No. Telepon
                        <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="no_hp"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        placeholder="Contoh: 08123456789"
                        maxlength="13"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        required>
                    <small class="field-hint">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                            <path fill-rule="evenodd" d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Zm-6 3.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7.293 5.293a1 1 0 1 1 .99 1.667c-.459.134-.715.369-.85.59a.25.25 0 0 0 .444.224c.24-.4.658-.769 1.313-.898a2.5 2.5 0 0 0-2.384-3.633 2.5 2.5 0 0 0-1.927 3.546.75.75 0 0 0 1.436-.428A1 1 0 0 1 7.293 5.293Z" clip-rule="evenodd" />
                        </svg>
                        Hanya angka, tanpa spasi atau tanda hubung
                    </small>
                </div>

                {{-- Alamat (full width) --}}
                <div class="form-group form-group-full">
                    <label for="alamat">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                        </svg>
                        Alamat Lengkap
                        <span class="required">*</span>
                    </label>
                    <textarea
                        id="alamat"
                        name="alamat"
                        rows="4"
                        placeholder="Masukkan alamat lengkap penyewa"
                        required>{{ old('alamat') }}</textarea>
                </div>

            </div>

            {{-- Form Actions --}}
            <div class="form-actions">
                <a href="{{ route('penyewa.index') }}" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Simpan Penyewa
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
