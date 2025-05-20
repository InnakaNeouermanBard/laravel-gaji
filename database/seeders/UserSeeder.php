<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'username' => 'admin',
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'level' => 0
            ],
            [
                'username' => 'manager1',
                'name' => 'Manager Keuangan',
                'email' => 'manager1@gmail.com',
                'password' => Hash::make('password'),
                'level' => 1
            ],
            [
                'username' => '111',
                'name' => 'Anton',
                'email' => 'anton@gmail.com',
                'password' => Hash::make('password'),
                'level' => 2
            ],
        ]);

        Karyawan::insert([[
            'id_user' => 3,
            'id_jabatan' => 1,
            'nik' => 111,
            'nama_karyawan' => 'Anton',
            'kelamin' => 'L',
            'agama' => 'Islam',
            'alamat_tinggal' => 'Jl Diponegoro',
            'no_telepon' => '081234101010',
            'tempat_lahir' => 'Malang',
            'tanggal_lahir' => '1999-05-15',
            'status_perkawinan' => 'Belum Kawin',
            'tanggal_masuk' => '2024-01-08'
        ]]);
    }
}
