<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'penyewas'; // Sesuaikan dengan nama tabel
    protected $fillable = [
        'nama',
        'no_hp',
        'alamat'
    ];
    public function sewa()
    {
        return $this->hasMany(Sewa::class);
    }

}
