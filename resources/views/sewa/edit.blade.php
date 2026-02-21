@extends('layouts.master')

@section('title', 'Edit Sewa (Admin)')
@section('page-title', 'Edit Sewa')

@section('content')
    <div class="form-container" style="max-width:680px;">
        <div class="form-card">

            {{-- Header --}}
            <div class="form-header">
                <div class="form-header-icon" style="background:linear-gradient(135deg,#dc2626 0%,#b91c1c 100%);">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487 18.5 2.85a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                </div>
                <div>
                    <h4>Edit Data Sewa <span style="color:#dc2626;">[Admin]</span></h4>
                    <p>Perubahan di sini bersifat manual. Pastikan data yang diubah sudah benar.</p>
                </div>
            </div>

            {{-- Warning --}}
            <div class="alert"
                style="background:#fef3c7; border:1px solid #fcd34d; color:#92400e; margin-bottom:20px; border-radius:var(--radius-md); padding:12px 16px; font-size:13px; display:flex; gap:10px; align-items:flex-start;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" style="width:16px;height:16px;flex-shrink:0;margin-top:1px;">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                </svg>
                Halaman ini hanya untuk koreksi data oleh admin. Perubahan status akan sinkronisasi otomatis ke status unit.
            </div>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger" style="margin-bottom:16px;">
                    <ul style="margin:0; padding-left:16px;">
                        @foreach ($errors->all() as $error)
                            <li style="font-size:13px;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('sewa.update', $sewa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-grid">

                    {{-- Penyewa --}}
                    <div class="form-group form-group-full">
                        <label for="penyewa_id">Penyewa <span class="required">*</span></label>
                        <select id="penyewa_id" name="penyewa_id" required>
                            @foreach ($penyewa as $p)
                                <option value="{{ $p->id }}"
                                    {{ old('penyewa_id', $sewa->penyewa_id) == $p->id ? 'selected' : '' }}>
                                    {{ $p->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Unit --}}
                    <div class="form-group form-group-full">
                        <label for="unit_id">Unit <span class="required">*</span></label>
                        <select id="unit_id" name="unit_id" required>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}"
                                    {{ old('unit_id', $sewa->unit_id) == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->nama_unit }} ({{ $unit->tipe }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Harga Sewa --}}
                    <div class="form-group">
                        <label for="harga_sewa">Harga Sewa <span class="required">*</span></label>
                        <input type="number" id="harga_sewa" name="harga_sewa"
                            value="{{ old('harga_sewa', $sewa->harga_sewa) }}" required min="0">
                    </div>

                    {{-- Total Dibayar --}}
                    <div class="form-group">
                        <label for="total_dibayar">Total Dibayar <span class="required">*</span></label>
                        <input type="number" id="total_dibayar" name="total_dibayar"
                            value="{{ old('total_dibayar', $sewa->total_dibayar) }}" required min="0">
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                            value="{{ old('tanggal_mulai', $sewa->tanggal_mulai) }}">
                    </div>

                    {{-- Tanggal Selesai --}}
                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                            value="{{ old('tanggal_selesai', $sewa->tanggal_selesai) }}">
                    </div>

                    {{-- Status --}}
                    <div class="form-group form-group-full">
                        <label for="status">Status <span class="required">*</span></label>
                        <select id="status" name="status" required>
                            @foreach (['booking', 'aktif', 'selesai', 'batal'] as $s)
                                <option value="{{ $s }}"
                                    {{ old('status', $sewa->status) === $s ? 'selected' : '' }}>
                                    {{ ucfirst($s) }}
                                </option>
                            @endforeach
                        </select>
                        <small class="field-hint">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                style="width:13px;height:13px;flex-shrink:0;">
                                <path fill-rule="evenodd"
                                    d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Zm-6 3.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7.293 5.293a1 1 0 1 1 .99 1.667c-.459.134-.715.369-.85.59a.25.25 0 0 0 .444.224c.24-.4.658-.769 1.313-.898a2.5 2.5 0 0 0-2.384-3.633 2.5 2.5 0 0 0-1.927 3.546.75.75 0 0 0 1.436-.428A1 1 0 0 1 7.293 5.293Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Mengubah status akan otomatis memperbarui status unit terkait.
                        </small>
                    </div>

                </div>

                {{-- Actions --}}
                <div class="form-actions">
                    <a href="{{ route('sewa.show', $sewa->id) }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>

            </form>

        </div>
    </div>
@endsection
