<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $fillable = [
        'sewa_id',
        'tipe',
        'jumlah',
        'periode',
        'jatuh_tempo',
        'tanggal_bayar',
        'status',
        'is_refunded',
        'tanggal_refund',
    ];

    protected $casts = [
        'is_refunded'    => 'boolean',
        'tanggal_bayar'  => 'date',
        'jatuh_tempo'    => 'date',
        'tanggal_refund' => 'date',
        'periode'        => 'date',
    ];

    public function sewa()
    {
        return $this->belongsTo(Sewa::class);
    }
}
