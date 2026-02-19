<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('units')->insert([
            [
                'nama_unit' => 'Kios 1',
                'tipe' => 'kios',
                'harga_sewa' => 21000000,
                'status' => 'kosong',
                'periode' => 'tahunan',
                'pemilik' => 'Bapak',
                'keterangan' => 'Kios depan rumah'
            ],
            [
                'nama_unit' => 'Kios 2',
                'tipe' => 'kios',
                'harga_sewa' => 21000000,
                'status' => 'kosong',
                'periode' => 'tahunan',
                'pemilik' => 'Bapak',
                'keterangan' => 'Kios depan rumah'
            ],
            [
                'nama_unit' => 'Kios 3',
                'tipe' => 'kios',
                'harga_sewa' => 21000000,
                'status' => 'kosong',
                'periode' => 'tahunan',
                'pemilik' => 'Bapak',
                'keterangan' => 'Kios depan rumah'
            ],
            [
                'nama_unit' => 'Kios 4',
                'tipe' => 'kios',
                'harga_sewa' => 21000000,
                'status' => 'kosong',
                'periode' => 'tahunan',
                'pemilik' => 'Bapak',
                'keterangan' => 'Kios depan pohon asem'
            ],
            [
                'nama_unit' => 'Kios 5',
                'tipe' => 'kios',
                'harga_sewa' => 21000000,
                'status' => 'kosong',
                'periode' => 'tahunan',
                'pemilik' => 'Bapak',
                'keterangan' => 'Kios depan pohon asem'
            ],
            [
                'nama_unit' => 'Kios 6',
                'tipe' => 'kios',
                'harga_sewa' => 21000000,
                'status' => 'kosong',
                'periode' => 'tahunan',
                'pemilik' => 'Bapak',
                'keterangan' => 'Kios depan pohon asem'
            ],
            [
                'nama_unit' => 'Kontrakan 1',
                'tipe' => 'kontrakan',
                'harga_sewa' => 3500000,
                'status' => 'kosong',
                'periode' => 'bulanan',
                'pemilik' => 'Bapak',
                'keterangan' => 'Kontrakan Setu'
            ],
            [
                'nama_unit' => 'Kontrakan 2',
                'tipe' => 'kontrakan',
                'harga_sewa' => 3500000,
                'status' => 'kosong',
                'periode' => 'bulanan',
                'pemilik' => 'Bapak',
                'keterangan' => 'Kontrakan Setu',
            ],
            [
                'nama_unit' => 'Kontrakan 3',
                'tipe' => 'kontrakan',
                'harga_sewa' => 3500000,
                'status' => 'kosong',
                'periode' => 'bulanan',
                'pemilik' => 'Bapak',
                'keterangan' => 'Kontrakan Setu',
            ],
            [
                'nama_unit' => 'Kontrakan 4',
                'tipe' => 'kontrakan',
                'harga_sewa' => 3500000,
                'status' => 'kosong',
                'periode' => 'bulanan',
                'pemilik' => 'Bapak',
                'keterangan' => 'Kontrakan Setu',
            ],
            [
                'nama_unit' => '45A',
                'tipe' => 'kontrakan',
                'harga_sewa' => 3500000,
                'status' => 'kosong',
                'periode' => 'bulanan',
                'pemilik' => 'Ibu',
                'keterangan' => 'Kontrakan Cilangkap',
            ],
            [
                'nama_unit' => '45B',
                'tipe' => 'kontrakan',
                'harga_sewa' => 3500000,
                'status' => 'kosong',
                'periode' => 'bulanan',
                'pemilik' => 'Ibu',
                'keterangan' => 'Kontrakan Cilangkap',
            ],
            [
                'nama_unit' => '45C',
                'tipe' => 'kontrakan',
                'harga_sewa' => 3500000,
                'status' => 'kosong',
                'periode' => 'bulanan',
                'pemilik' => 'Ibu',
                'keterangan' => 'Kontrakan Cilangkap',
            ],
            [
                'nama_unit' => '45D',
                'tipe' => 'kontrakan',
                'harga_sewa' => 3500000,
                'status' => 'kosong',
                'periode' => 'bulanan',
                'pemilik' => 'Ibu',
                'keterangan' => 'Kontrakan Cilangkap',
            ],
            [
                'nama_unit' => '45E',
                'tipe' => 'kontrakan',
                'harga_sewa' => 3500000,
                'status' => 'kosong',
                'periode' => 'bulanan',
                'pemilik' => 'Ibu',
                'keterangan' => 'Kontrakan Cilangkap',
            ]
        ]);
    }
}
