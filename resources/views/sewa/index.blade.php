@extends('layouts.master')

@section('title', 'Data Sewa')

@section('content')
    <div class="table-box">

        <!-- HEADER + BUTTON -->
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <h4>Data Sewa</h4>
            <a href="{{ route('sewa.create') }}"
                style="background:#2563eb; color:#fff; padding:8px 14px; border-radius:6px; text-decoration:none; font-size:14px;">
                Tambah Sewa
            </a>
        </div>

        {{-- Alert Success --}}
        @if (session('success'))
            <div style="background:#dcfce7; color:#166534; padding:10px; border-radius:6px; margin:15px 0;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Alert Error --}}
        @if (session('error'))
            <div style="background:#fee2e2; color:#b91c1c; padding:10px; border-radius:6px; margin:15px 0;">
                {{ session('error') }}
            </div>
        @endif

        <table style="margin-top:15px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Penyewa</th>
                    <th>Unit</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($sewa   as $index => $value)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $value->penyewa->nama ?? '-' }}</td>
                        <td>{{ $value->unit->nama_unit ?? '-' }}</td>
                        <td>{{ $value->tanggal_mulai }}</td>
                        <td>{{ $value->tanggal_selesai ?? '-' }}</td>
                        <td>
                            @if ($value->status == 'aktif')
                                <span
                                    style="background:#22c55e; color:#fff; padding:4px 8px; border-radius:6px; font-size:12px;">
                                    Aktif
                                </span>
                            @else
                                <span
                                    style="background:#94a3b8; color:#fff; padding:4px 8px; border-radius:6px; font-size:12px;">
                                    Selesai
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="display:flex; gap:6px;">

                                <!-- Edit -->
                                @if ($value->status == 'aktif')
                                    <form action="{{ route('sewa.selesai', $value->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            style="background:#16a34a; color:#fff; padding:6px 10px; border:none; border-radius:6px;">
                                            Selesai
                                        </button>
                                    </form>
                                @endif

                                <!-- Delete -->
                                <form action="{{ route('sewa.destroy', $value->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data sewa ini?');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        style="background:#ef4444; color:#fff; padding:6px 10px; border:none; border-radius:6px; font-size:13px; cursor:pointer;">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:15px;">
                            Belum ada data sewa.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
@endsection
