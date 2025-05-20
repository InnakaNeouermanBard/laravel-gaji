<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PotonganGaji extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_potong_gaji';

    protected $fillable = [
        'id_karyawan',
        'id_user',
        'alpha',
        'potongan_gaji',
        'bulan',
    ];

    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan', 'id_karyawan');
    }
}
