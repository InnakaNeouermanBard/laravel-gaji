<?php
// model absesnsi
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'id_karyawan',
        'bulan',
        'masuk',
        'izin',
        'alpha',
    ];

    public function karyawan()
    {
        return $this->belongsTo('App\Models\Karyawan', 'id_karyawan');
    }
}
