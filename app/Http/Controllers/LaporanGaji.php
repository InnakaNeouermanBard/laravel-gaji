<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanGaji extends Controller
{
    public function index()
    {
        return view('laporan.gaji');
    }

    public function print(Request $request)
    {
        $gajis = Gaji::with('karyawan')->whereMonth('periode_gaji', $request->bulan)
            ->whereYear('periode_gaji', $request->tahun)
            ->where('status', 1)
            ->get();

        $gajis = $gajis->map(function ($item) {
            $item->total_gaji = $item->gaji_pokok + $item->total_bonus - $item->potongan_gaji;
            return $item;
        });

        if (count($gajis) == 0) {
            return back()->with('warning', 'Data kosong');
        }

        $data = [
            'gajis' => $gajis,
            'bulan' => Carbon::createFromFormat('m', $request->bulan)->locale('id')->isoFormat('MMMM'),
            'tahun' => $request->tahun,
        ];

        $pdf = Pdf::loadView('print.gaji', compact('data'));
        return $pdf->stream("laporan_gaji_$request->bulan $request->tahun.pdf");
    }
}
