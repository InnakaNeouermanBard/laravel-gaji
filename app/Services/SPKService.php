<?php

namespace App\Services;

use App\Models\Absensi;
use App\Models\Gaji;
use App\Models\Karyawan;
use Carbon\Carbon;

class SPKService
{
    protected $weights = [
        'attendance' => 0.4,
        'overtime' => 0.3,
        'bonus' => 0.3
    ];

    public function calculatePerformance($month, $year)
    {
        $employees = Karyawan::all();
        $results = [];

        foreach ($employees as $employee) {
            // Filter by month & year
            $absensi = Absensi::where('id_karyawan', $employee->id_karyawan)
                ->whereMonth('bulan', $month)
                ->whereYear('bulan', $year)
                ->sum('masuk');


            $lembur = Gaji::where('id_karyawan', $employee->id_karyawan)
                ->whereMonth('periode_gaji', $month)
                ->whereYear('periode_gaji', $year)
                ->sum('total_lembur');

            $bonus = Gaji::where('id_karyawan', $employee->id_karyawan)
                ->whereMonth('periode_gaji', $month)
                ->whereYear('periode_gaji', $year)
                ->sum('total_bonus');

            // Normalization
            $maxAbsensi = Absensi::whereMonth('bulan', $month)->whereYear('bulan', $year)->max('masuk') ?: 1;
            $maxLembur = Gaji::whereMonth('periode_gaji', $month)->whereYear('periode_gaji', $year)->max('total_lembur') ?: 1;
            $maxBonus = Gaji::whereMonth('periode_gaji', $month)->whereYear('periode_gaji', $year)->max('total_bonus') ?: 1;

            $normalizedAttendance = $absensi / $maxAbsensi;
            $normalizedOvertime = $lembur / $maxLembur;
            $normalizedBonus = $bonus / $maxBonus;

            // Final Score Calculation
            $finalScore = ($normalizedAttendance * $this->weights['attendance']) +
                ($normalizedOvertime * $this->weights['overtime']) +
                ($normalizedBonus * $this->weights['bonus']);

            $results[] = [
                'id_karyawan' => $employee->id_karyawan,
                'nama_karyawan' => $employee->nama_karyawan,
                'month' => $month,
                'year' => $year,
                'attendance_score' => round($normalizedAttendance * 100, 2),
                'overtime_score' => round($normalizedOvertime * 100, 2),
                'bonus_score' => round($normalizedBonus * 100, 2),
                'final_score' => round($finalScore * 100, 2)
            ];
        }

        return $results;
    }
}
