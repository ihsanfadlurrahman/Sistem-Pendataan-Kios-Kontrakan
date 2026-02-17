<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan</title>
    <style>
        * { margin: 0; padding: 0; }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11px;
            color: #1e293b;
            background: #ffffff;
            line-height: 1.5;
        }

        .page {
            padding: 36px 44px;
        }

        /* ── Summary Cards ── */
        .card {
            border-radius: 8px;
            padding: 14px 16px;
        }

        .card-green { background: #f0fdf4; border: 1.5px solid #86efac; }
        .card-red   { background: #fff1f2; border: 1.5px solid #fca5a5; }
        .card-blue  { background: #eff6ff; border: 1.5px solid #93c5fd; }

        .card-label {
            font-size: 9px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }

        .label-green { color: #15803d; }
        .label-red   { color: #b91c1c; }
        .label-blue  { color: #1d4ed8; }

        .card-amount {
            font-size: 14px;
            font-weight: 900;
            margin-top: 6px;
        }

        .amount-green { color: #14532d; }
        .amount-red   { color: #7f1d1d; }
        .amount-blue  { color: #1e3a8a; }

        .card-note {
            font-size: 9px;
            color: #94a3b8;
            margin-top: 3px;
        }

        /* ── Data Table ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 4px;
        }

        .data-table thead tr {
            background: #0f172a;
        }

        .data-table thead th {
            color: #e2e8f0;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 11px;
            text-align: left;
        }

        .data-table thead th.right  { text-align: right; }
        .data-table thead th.center { text-align: center; }

        .data-table tbody tr.even { background: #f8fafc; }
        .data-table tbody tr.odd  { background: #ffffff; }

        .data-table tbody td {
            padding: 8px 11px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            font-size: 10.5px;
        }

        .data-table tbody td.right  { text-align: right; font-weight: 700; }
        .data-table tbody td.center { text-align: center; }
        .data-table tbody td.no-col { color: #94a3b8; font-size: 10px; }
        .data-table tbody td.muted  { color: #64748b; }

        .data-table tfoot td {
            padding: 8px 11px;
            font-weight: 800;
            font-size: 10.5px;
            border-top: 2px solid #cbd5e1;
            background: #f1f5f9;
        }

        .data-table tfoot td.right { text-align: right; }

        .col-green { color: #15803d; }
        .col-red   { color: #b91c1c; }

        .badge-red {
            background: #fef2f2;
            color: #b91c1c;
            font-size: 9px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 20px;
            text-transform: uppercase;
        }

        .empty-cell {
            text-align: center;
            color: #94a3b8;
            font-style: italic;
            padding: 20px;
            background: #fafafa;
        }

        .section-title {
            font-size: 12px;
            font-weight: 800;
            color: #0f172a;
            padding-left: 8px;
        }

        .count-badge {
            background: #f1f5f9;
            color: #475569;
            font-size: 9px;
            font-weight: 700;
            padding: 2px 9px;
            border-radius: 20px;
        }

        .footer-note {
            font-size: 9px;
            color: #94a3b8;
            line-height: 1.8;
        }
    </style>
</head>
<body>
<div class="page">

    {{-- ═══ HEADER ═══ --}}
    <table style="width:100%; border-collapse:collapse; margin-bottom:0;">
        <tr>
            <td style="width:56px; vertical-align:middle;">
                <table style="width:44px; height:44px; background:#0f172a; border-radius:8px; border-collapse:collapse;">
                    <tr>
                        <td style="text-align:center; vertical-align:middle; color:#ffffff; font-size:16px; font-weight:900;">SK</td>
                    </tr>
                </table>
            </td>
            <td style="vertical-align:middle; padding-left:12px;">
                <div style="font-size:16px; font-weight:900; color:#0f172a;">Sistem Pendataan Kios &amp; Kontrakan</div>
                <div style="font-size:10px; color:#64748b; margin-top:2px;">Manajemen Properti &amp; Keuangan</div>
            </td>
            <td style="text-align:right; vertical-align:middle;">
                <div style="font-size:14px; font-weight:900; color:#0f172a;">Laporan Keuangan</div>
                <div style="margin-top:5px;">
                    <span style="background:#0f172a; color:#ffffff; font-size:10px; font-weight:700; padding:3px 12px; border-radius:20px;">
                        {{ \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->translatedFormat('F Y') }}
                    </span>
                </div>
            </td>
        </tr>
    </table>

    <hr style="border:none; border-top:3px solid #0f172a; margin:14px 0 20px 0;">

    {{-- ═══ RINGKASAN ═══ --}}
    <table style="width:100%; border-collapse:collapse; margin-bottom:20px;">
        <tr>
            <td class="card card-green" style="width:32%;">
                <div class="card-label label-green">Total Pemasukan</div>
                <div class="card-amount amount-green">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                <div class="card-note">{{ count($pemasukan) }} transaksi masuk</div>
            </td>
            <td style="width:2%;"></td>
            <td class="card card-red" style="width:32%;">
                <div class="card-label label-red">Total Pengeluaran</div>
                <div class="card-amount amount-red">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                <div class="card-note">{{ count($pengeluaran) }} transaksi keluar</div>
            </td>
            <td style="width:2%;"></td>
            <td class="card card-blue" style="width:32%;">
                <div class="card-label label-blue">Laba / Rugi</div>
                <div class="card-amount amount-blue">Rp {{ number_format($laba, 0, ',', '.') }}</div>
                <div class="card-note">Selisih pemasukan &amp; pengeluaran</div>
            </td>
        </tr>
    </table>

    <hr style="border:none; border-top:1px solid #e2e8f0; margin:0 0 20px 0;">

    {{-- ═══ DETAIL PEMASUKAN ═══ --}}
    <table style="width:100%; border-collapse:collapse; margin-bottom:8px; margin-top:20px;">
        <tr>
            <td style="width:14px; vertical-align:middle;">
                <table style="width:8px; height:8px; background:#16a34a; border-radius:4px; border-collapse:collapse;">
                    <tr><td></td></tr>
                </table>
            </td>
            <td class="section-title">Detail Pemasukan</td>
            <td style="text-align:right; vertical-align:middle;">
                <span class="count-badge">{{ count($pemasukan) }} item</span>
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th class="center" style="width:32px;">#</th>
                <th>Nama Penyewa</th>
                <th>Unit</th>
                <th>Tanggal</th>
                <th class="right">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemasukan as $i => $p)
            <tr class="{{ $i % 2 == 0 ? 'odd' : 'even' }}">
                <td class="no-col center">{{ $i + 1 }}</td>
                <td>{{ $p->sewa->penyewa->nama }}</td>
                <td class="muted">{{ $p->sewa->unit->nama_unit ?? 'Tidak ada unit (error)' }}</td>
                <td class="muted">{{ optional($p->created_at)->format('d/m/Y') ?? '-' }}</td>
                <td class="right col-green">Rp {{ number_format(    $p->jumlah, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty-cell">Tidak ada data pemasukan untuk periode ini.</td>
            </tr>
            @endforelse
        </tbody>
        @if(count($pemasukan) > 0)
        <tfoot>
            <tr>
                <td colspan="4" style="color:#475569;">Total Pemasukan</td>
                <td class="right col-green">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    {{-- ═══ DETAIL PENGELUARAN ═══ --}}
    <table style="width:100%; border-collapse:collapse; margin-bottom:8px; margin-top:24px;">
        <tr>
            <td style="width:14px; vertical-align:middle;">
                <table style="width:8px; height:8px; background:#dc2626; border-radius:4px; border-collapse:collapse;">
                    <tr><td></td></tr>
                </table>
            </td>
            <td class="section-title">Detail Pengeluaran</td>
            <td style="text-align:right; vertical-align:middle;">
                <span class="count-badge">{{ count($pengeluaran) }} item</span>
            </td>
        </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th class="center" style="width:32px;">#</th>
                <th>Kategori</th>
                <th>Keterangan</th>
                <th>Tanggal</th>
                <th class="right">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengeluaran as $i => $p)
            <tr class="{{ $i % 2 == 0 ? 'odd' : 'even' }}">
                <td class="no-col center">{{ $i + 1 }}</td>
                <td><span class="badge-red">{{ $p->kategori }}</span></td>
                <td class="muted">{{ $p->keterangan ?? '-' }}</td>
                <td class="muted">{{ optional($p->created_at)->format('d/m/Y') ?? '-' }}</td>
                <td class="right col-red">Rp {{ number_format($p->jumlah, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="empty-cell">Tidak ada data pengeluaran untuk periode ini.</td>
            </tr>
            @endforelse
        </tbody>
        @if(count($pengeluaran) > 0)
        <tfoot>
            <tr>
                <td colspan="4" style="color:#475569;">Total Pengeluaran</td>
                <td class="right col-red">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    {{-- ═══ FOOTER ═══ --}}
    <table style="width:100%; border-collapse:collapse; margin-top:32px; border-top:1px solid #e2e8f0;">
        <tr>
            <td style="vertical-align:bottom; padding-top:14px;">
                <div class="footer-note">
                    Dokumen ini digenerate otomatis oleh sistem.<br>
                    Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB
                </div>
            </td>
            <td style="text-align:center; vertical-align:top; width:170px; padding-top:14px;">
                <div style="font-size:9.5px; color:#475569; font-weight:600;">Mengetahui,</div>
                <div style="height:42px;"></div>
                <table style="width:150px; margin:0 auto; border-collapse:collapse;">
                    <tr>
                        <td style="border-top:1px solid #0f172a; padding-top:5px; text-align:center;">
                            <div style="font-size:9.5px; font-weight:800; color:#0f172a;">Admin</div>
                            <div style="font-size:9px; color:#64748b;">Pengelola Kios &amp; Kontrakan</div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</div>
</body>
</html>
