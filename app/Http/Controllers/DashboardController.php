<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->level == 2) {
            $profile = auth()->user();
            return view('dashboard.karyawan')
                ->with('profile', $profile);
        } else {

            $data_karyawan = Karyawan::count();
            $data_admin = User::where('level', 0)->count();
            $data_jabatan = Jabatan::count();
            $data_kehadiran = Absensi::count();
            return view('dashboard.admin')
                ->with('data_karyawan', $data_karyawan)
                ->with('data_admin', $data_admin)
                ->with('data_jabatan', $data_jabatan)
                ->with('data_kehadiran', $data_kehadiran);
        }
    }
}
