<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::insert([
            [
                'nama_jabatan' => 'IT',
                'gaji_pokok' => 3000000,
                'uang_lembur' => 100000,
                // 'tunjangan_transportasi' => 150000,
                // 'uang_makan' => 100000
            ]
        ]);
    }
}
