@extends('layouts.master')

@section('title', 'Tambah Unit')

@section('content')

    <div class="table-box" style="max-width:600px;">

        <h4 style="margin-bottom:20px;">Tambah Unit</h4>

        {{-- Error Validation --}}
        @if ($errors->any())
            <div style="background:#fee2e2; padding:10px; border-radius:6px; margin-bottom:15px; color:#b91c1c;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li style="font-size:14px;">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('units.store') }}" method="POST">
            @csrf

            <!-- Nama Unit -->
            <div style="margin-bottom:15px;">
                <label style="display:block; font-size:14px; margin-bottom:6px;">
                    Nama Unit
                </label>
                <input type="text" name="nama_unit" value="{{ old('nama_unit') }}"
                    style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">
            </div>

            <!-- Tipe -->
            <div style="margin-bottom:15px;">
                <label style="display:block; font-size:14px; margin-bottom:6px;">
                    Tipe
                </label>
                <select name="tipe" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">
                    <option value="">-- Pilih Tipe --</option>
                    <option value="kios" {{ old('tipe') == 'kios' ? 'selected' : '' }}>Kios</option>
                    <option value="kontrakan" {{ old('tipe') == 'kontrakan' ? 'selected' : '' }}>Kontrakan</option>
                </select>
            </div>

            <!-- Harga -->
            <div style="margin-bottom:15px;">
                <label style="display:block; font-size:14px; margin-bottom:6px;">
                    Harga Sewa
                </label>
                <input type="number" name="harga_sewa" value="{{ old('harga_sewa') }}"
                    style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">
            </div>

            <!-- Status -->
            <div style="margin-bottom:15px;">
                <label style="display:block; font-size:14px; margin-bottom:6px;">
                    Status
                </label>
                <select name="status" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">
                    <option value="kosong" selected>Kosong</option>
                    <option value="disewa">Disewa</option>
                </select>
            </div>

            <!-- Keterangan -->
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:14px; margin-bottom:6px;">
                    Keterangan (opsional)
                </label>
                <textarea name="keterangan" rows="3"
                    style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">{{ old('keterangan') }}</textarea>
            </div>

            <div style="margin-bottom:15px;">
                <label>Pemilik</label>
                <select name="pemilik" required
                    style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">
                    <option value="">-- Pilih Pemilik --</option>
                    <option value="ibu">Ibu</option>
                    <option value="bapak">Bapak</option>
                </select>
            </div>


            <!-- Buttons -->
            <div style="display:flex; gap:10px;">
                <button type="submit"
                    style="background:#2563eb; color:#fff; padding:8px 14px; border:none; border-radius:6px; cursor:pointer;">
                    Simpan
                </button>

                <a href="{{ route('units.index') }}"
                    style="background:#94a3b8; color:#fff; padding:8px 14px; border-radius:6px; text-decoration:none;">
                    Batal
                </a>
            </div>

        </form>
    </div>

@endsection
