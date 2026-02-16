@extends('layouts.master')

@section('title', 'Data Penyewa')

@section('content')
<div class="table-box">

    <!-- HEADER + BUTTON -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
        <h4>Data Penyewa</h4>
        <a href="{{ route('penyewa.create') }}"
           style="background:#2563eb; color:#fff; padding:8px 14px; border-radius:6px; text-decoration:none; font-size:14px;">
            Tambah Penyewa
        </a>
    </div>

    @if (session('success'))
        <div style="background:#dcfce7; color:#166534; padding:10px; border-radius:6px; margin-bottom:15px;">
            {{ session('success') }}
        </div>
    @endif

    <!-- CARD GRID -->
    <div style="
        display:grid;
        grid-template-columns:repeat(auto-fill, minmax(250px,1fr));
        gap:15px;
    ">

        @foreach ($penyewa as $value)

            <div style="
                padding:15px;
                border-radius:10px;
                box-shadow:0 2px 8px rgba(0,0,0,0.05);
                background:#f8fafc;
            ">

                <!-- Nama + Icon -->
                <h4 style="margin-bottom:8px; display:flex; align-items:center; gap:6px;">
                    <span style="font-size:20px;">👤</span>
                    {{ $value->nama }}
                </h4>

                <p style="margin:4px 0;">
                    <strong>No HP:</strong> {{ $value->no_hp }}
                </p>

                <p style="margin:4px 0;">
                    <strong>Alamat:</strong> {{ $value->alamat }}
                </p>

                <!-- Unit yang disewa -->
                @php
                    $sewaAktif = $value->sewa->where('status', 'aktif');
                @endphp

                <p style="margin:6px 0;">
                    <strong>Unit Aktif:</strong>
                    @if($sewaAktif->count())
                        <span style="color:#16a34a;">
                            {{ $sewaAktif->pluck('unit.nama_unit')->implode(', ') }}
                        </span>
                    @else
                        <span style="color:#ef4444;">Tidak ada</span>
                    @endif
                </p>

                <!-- Aksi -->
                <div style="display:flex; gap:6px; margin-top:10px;">

                    <a href="{{ route('penyewa.edit', $value->id) }}"
                       style="background:#f59e0b; color:#fff; padding:6px 10px; border-radius:6px; font-size:13px; text-decoration:none;">
                        Edit
                    </a>

                    <form action="{{ route('penyewa.destroy', $value->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus penyewa ini?');"
                          style="margin:0;">
                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                style="background:#ef4444; color:#fff; padding:6px 10px; border:none; border-radius:6px; font-size:13px; cursor:pointer;">
                            Hapus
                        </button>
                    </form>

                </div>

            </div>

        @endforeach

    </div>

</div>
@endsection
