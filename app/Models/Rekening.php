<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    use HasFactory;
    protected $fillable = ['karyawan_id', 'bank_name', 'rekening_number', 'pemilik_rekening'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
