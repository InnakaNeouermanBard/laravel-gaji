<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_gaji';

    protected $fillable = [
        'id_karyawan',
        'id_user',
        'periode_gaji',
        'tanggal',
        'gaji_pokok',
        'potongan_gaji',
        'total_lembur',
        'total_bonus',
        'status',
    ];

    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan', 'id_karyawan');
    }
}
