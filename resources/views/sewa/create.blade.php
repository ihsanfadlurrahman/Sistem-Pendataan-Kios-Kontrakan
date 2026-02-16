@extends('layouts.master')

@section('title', 'Tambah Sewa')

@section('content')

<div class="table-box" style="max-width:600px;">

    <h4 style="margin-bottom:20px;">Tambah Sewa</h4>

    @if ($errors->any())
        <div style="background:#fee2e2; padding:10px; border-radius:6px; margin-bottom:15px; color:#b91c1c;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li style="font-size:14px;">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sewa.store') }}" method="POST">
        @csrf

        <!-- Penyewa -->
        <div style="margin-bottom:15px;">
            <label>Pilih Penyewa</label>
            <select name="penyewa_id"
                    style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">
                <option value="">-- Pilih Penyewa --</option>
                @foreach($penyewa as $value)
                    <option value="{{ $value->id }}"
                        {{ old('penyewa_id') == $value->id ? 'selected' : '' }}>
                        {{ $value->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Unit -->
        <div style="margin-bottom:15px;">
            <label>Pilih Unit</label>
            <select name="unit_id"
                    style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">
                <option value="">-- Pilih Unit Kosong --</option>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}"
                        {{ old('unit_id') == $unit->id ? 'selected' : '' }}>
                        {{ $unit->nama_unit }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Tanggal Mulai -->
        <div style="margin-bottom:15px;">
            <label>Tanggal Mulai</label>
            <input type="date"
                   name="tanggal_mulai"
                   value="{{ old('tanggal_mulai') }}"
                   style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">
        </div>

        <!-- Tanggal Selesai -->
        <div style="margin-bottom:15px;">
            <label>Tanggal Selesai (Opsional)</label>
            <input type="date"
                   name="tanggal_selesai"
                   value="{{ old('tanggal_selesai') }}"
                   style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">
        </div>

        <!-- Status -->
        {{-- <div style="margin-bottom:20px;">
            <label>Status</label>
            <select name="status"
                    style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">
                <option value="aktif" selected>Aktif</option>
                <option value="selesai">Selesai</option>
            </select>
        </div> --}}

        <!-- Buttons -->
        <div style="display:flex; gap:10px;">
            <button type="submit"
                    style="background:#2563eb; color:#fff; padding:8px 14px; border:none; border-radius:6px;">
                Simpan
            </button>

            <a href="{{ route('sewa.index') }}"
               style="background:#94a3b8; color:#fff; padding:8px 14px; border-radius:6px; text-decoration:none;">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection
