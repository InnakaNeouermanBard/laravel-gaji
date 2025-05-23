<?php

namespace App\Models;

use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekeningKaryawan extends Model
{
    use HasFactory;

    protected $fillable = ['karyawan_id', 'bank_name', 'rekening_number', 'pemilik_rekening'];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
