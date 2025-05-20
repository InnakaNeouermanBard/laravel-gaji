<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_lembur';

    protected $fillable = [
        'id_karyawan',
        'id_user',
        'tanggal',
        'jam',
        'keterangan',
    ];

    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan', 'id_karyawan');
    }
}
