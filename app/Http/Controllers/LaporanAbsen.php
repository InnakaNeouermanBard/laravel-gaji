<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanAbsen extends Controller
{
    public function index()
    {
        return view('laporan.absen');
    }

    public function print(Request $request)
    {
        $absensis = Absensi::whereMonth('bulan', $request->bulan)
            ->whereYear('bulan', $request->tahun)
            ->get();

        if (count($absensis) == 0) {
            return back()->with('warning', 'Data kosong');
        }

        $data = [
            'absensis' => $absensis,
            'bulan' => Carbon::createFromFormat('m', $request->bulan)->locale('id')->isoFormat('MMMM'),
            'tahun' => $request->tahun,
        ];

        $pdf = Pdf::loadView('print.absen', compact('data'));
        return $pdf->stream("laporan_absen_$request->bulan $request->tahun.pdf");
    }
}
