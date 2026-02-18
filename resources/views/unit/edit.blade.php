@extends('layouts.master')

@section('title', 'Edit Unit')
@section('page-title', 'Edit Unit')

@section('content')
<div class="form-container">
    <div class="form-card">

        {{-- Header --}}
        <div class="form-header">
            <div class="form-header-icon edit-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125" />
                </svg>
            </div>
            <div>
                <h4>Edit Unit</h4>
                <p>Perbarui informasi unit <strong>{{ $unit->nama_unit }}</strong></p>
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
        <form action="{{ route('units.update', $unit->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">

                {{-- Nama Unit --}}
                <div class="form-group">
                    <label for="nama_unit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                        </svg>
                        Nama Unit
                        <span class="required">*</span>
                    </label>
                    <input
                        type="text"
                        id="nama_unit"
                        name="nama_unit"
                        value="{{ old('nama_unit', $unit->nama_unit) }}"
                        placeholder="Contoh: 46A, B12, Kios 5"
                        required
                        autofocus>
                </div>

                {{-- Tipe --}}
                <div class="form-group">
                    <label for="tipe">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                        </svg>
                        Tipe Unit
                        <span class="required">*</span>
                    </label>
                    <select id="tipe" name="tipe" required>
                        <option value="kios" {{ old('tipe', $unit->tipe) == 'kios' ? 'selected' : '' }}>Kios</option>
                        <option value="kontrakan" {{ old('tipe', $unit->tipe) == 'kontrakan' ? 'selected' : '' }}>Kontrakan</option>
                    </select>
                </div>

                {{-- Harga Sewa --}}
                <div class="form-group">
                    <label for="harga_sewa">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Harga Sewa / Bulan
                        <span class="required">*</span>
                    </label>
                    <div class="input-group">
                        <span class="input-prefix">Rp</span>
                        <input
                            type="number"
                            id="harga_sewa"
                            name="harga_sewa"
                            value="{{ old('harga_sewa', $unit->harga_sewa) }}"
                            placeholder="5000000"
                            min="0"
                            step="100000"
                            required>
                    </div>
                </div>

                {{-- Status --}}
                <div class="form-group">
                    <label for="status">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Status Unit
                        <span class="required">*</span>
                    </label>
                    <select id="status" name="status" required>
                        <option value="kosong" {{ old('status', $unit->status) == 'kosong' ? 'selected' : '' }}>Kosong</option>
                        <option value="disewa" {{ old('status', $unit->status) == 'disewa' ? 'selected' : '' }}>Disewa</option>
                    </select>
                </div>

                {{-- Pemilik --}}
                <div class="form-group">
                    <label for="pemilik">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                        </svg>
                        Pemilik
                        <span class="required">*</span>
                    </label>
                    <select id="pemilik" name="pemilik" required>
                        <option value="ibu" {{ old('pemilik', $unit->pemilik) == 'ibu' ? 'selected' : '' }}>Ibu</option>
                        <option value="bapak" {{ old('pemilik', $unit->pemilik) == 'bapak' ? 'selected' : '' }}>Bapak</option>
                    </select>
                </div>

                {{-- Keterangan (full width) --}}
                <div class="form-group form-group-full">
                    <label for="keterangan">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
                        </svg>
                        Keterangan
                        <span class="optional">(opsional)</span>
                    </label>
                    <textarea
                        id="keterangan"
                        name="keterangan"
                        rows="3"
                        placeholder="Catatan tambahan tentang unit ini...">{{ old('keterangan', $unit->keterangan) }}</textarea>
                </div>

            </div>

            {{-- Form Actions --}}
            <div class="form-actions">
                <a href="{{ route('units.index') }}" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                    Batal
                </a>
                <button type="submit" class="btn btn-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Update Unit
                </button>
            </div>

        </form>

    </div>
</div>
@endsection
