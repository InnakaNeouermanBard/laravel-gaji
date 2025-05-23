<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['karyawan_id', 'jumlah_gaji', 'status_pembayaran', 'bukti_pembayaran'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
