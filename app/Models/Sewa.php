<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sewa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'sewas'; // Sesuaikan dengan nama tabel
    protected $fillable = [
        'unit_id',
        'penyewa_id',
        'nama_toko',
        'tanggal_mulai',
        'tanggal_selesai',
        'harga_sewa',
        'total_dibayar',
        'status'
    ];
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function penyewa()
    {
        return $this->belongsTo(Penyewa::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

}
