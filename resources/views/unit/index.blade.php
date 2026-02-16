@extends('layouts.master')

@section('title', 'Data Unit')

@section('content')
    <div class="table-box">

        <!-- HEADER + BUTTON -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h4>Data Unit</h4>
            <a href="{{ route('units.create') }}"
                style="background:#2563eb; color:#fff; padding:8px 14px; border-radius:6px; text-decoration:none; font-size:14px;">
                Tambah Unit
            </a>
        </div>

        @if (session('success'))
            <div style="background:#dcfce7; color:#166534; padding:10px; border-radius:6px; margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- CARD GRID -->
        <div
            style="
        display:grid;
        grid-template-columns:repeat(auto-fill, minmax(250px,1fr));
        gap:15px;
    ">

            @foreach ($units as $value)
                <div
                    style="
                padding:15px;
                border-radius:10px;
                box-shadow:0 2px 8px rgba(0,0,0,0.05);
                background:{{ $value->warna == 'pink' ? '#fce7f3' : '#dbeafe' }};
            ">

                    <!-- Nama Unit -->
                    <h4 style="margin-bottom:8px;">
                        {{ $value->nama_unit }}
                    </h4>

                    <!-- Tipe -->
                    <p style="margin:4px 0;">
                        <strong>Tipe:</strong> {{ $value->tipe }}
                    </p>

                    <!-- Harga -->
                    <p style="margin:4px 0;">
                        <strong>Harga:</strong>
                        Rp {{ number_format($value->harga_sewa, 0, ',', '.') }}
                    </p>

                    <!-- Status -->
                    <p style="margin:6px 0;">
                        <strong>Status:</strong>
                        <span
                            style="
                        padding:3px 8px;
                        border-radius:6px;
                        font-size:12px;
                        background:{{ $value->status == 'kosong' ? '#22c55e' : '#ef4444' }};
                        color:#fff;
                    ">
                            {{ ucfirst($value->status) }}
                        </span>
                    </p>

                    <!-- Keterangan -->
                    @if ($value->keterangan)
                        <p style="margin:6px 0; font-size:13px; color:#555;">
                            {{ $value->keterangan }}
                        </p>
                    @endif

                    <!-- Aksi -->
                    <div style="display:flex; gap:6px; margin-top:10px;">

                        <a href="{{ route('units.edit', $value->id) }}"
                            style="background:#f59e0b; color:#fff; padding:6px 10px; border-radius:6px; font-size:13px; text-decoration:none;">
                            Edit
                        </a>

                        <form action="{{ route('units.destroy', $value->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus unit ini?');" style="margin:0;">
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
