<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';

    protected $table = 'units'; // Sesuaikan dengan nama tabel
    protected $fillable = [
        'nama_unit',
        'tipe',
        'harga_sewa',
        'status',
        'keterangan',
        'pemilik'
    ];
    public function sewas()
    {
        return $this->hasMany(Sewa::class);
    }
}
