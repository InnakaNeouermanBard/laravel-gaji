<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Gaji;
use App\Models\Lembur;
use App\Models\PotonganGaji;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanSlipGaji extends Controller
{
    public function index()
    {
        return view('laporan.slip');
    }

    public function print(Request $request)
    {
        $gajis = Gaji::with('karyawan')->with('karyawan.jabatan')->whereMonth('periode_gaji', $request->bulan)
            ->whereYear('periode_gaji', $request->tahun)
            ->where('status', 1);

        if (auth()->user()->level == 2) {
            $gajis = $gajis->where('id_karyawan', auth()->user()->karyawan->id_karyawan);
        }

        $gajis = $gajis->get();

        if (count($gajis) == 0) {
            return back()->with('warning', 'Data kosong');
        }

        $gajis = $gajis->map(function ($item) use ($request) {
            $item->total_gaji = $item->gaji_pokok + $item->total_bonus - $item->potongan_gaji;
            $absensi = Absensi::whereMonth('bulan', $request->bulan)
                ->whereYear('bulan', $request->tahun)
                ->where('id_karyawan', $item->id_karyawan)
                ->first();

            $potongan = PotonganGaji::whereMonth('bulan', $request->bulan)
                ->whereYear('bulan', $request->tahun)
                ->where('id_karyawan', $item->id_karyawan)
                ->first();

            if ($potongan) {
                $potongan_gaji = $potongan->potongan_gaji;
            } else {
                $potongan_gaji = 0;
            }

            $lembur = Lembur::whereMonth('tanggal', $request->bulan)
                ->whereYear('tanggal', $request->tahun)
                ->where('id_karyawan', $item->id_karyawan)
                ->get();

            if ($lembur) {
                $lembur = $lembur->pluck('jam')->sum();
            } else {
                $lembur = 0;
            }

            $item->total_uang_lembur = $lembur * $item->karyawan->jabatan->uang_lembur;
            $item->total_uang_makan = $absensi->masuk * $item->karyawan->jabatan->uang_makan;
            $item->total_tunjangan_transportasi = $absensi->masuk * $item->karyawan->jabatan->tunjangan_transportasi;
            $item->total_bonus = $item->total_uang_lembur + $item->total_uang_makan + $item->total_tunjangan_transportasi;

            $item->potongan_gaji = $potongan_gaji;

            $item->total_diterima = $item->karyawan->jabatan->gaji_pokok + $item->total_bonus - $item->potongan_gaji;
            return $item;
        });

        $bulan = Carbon::createFromFormat('m', $request->bulan)->locale('id')->isoFormat('MMMM');
        $tahun = $request->tahun;

        // return view('print.slip', compact('gajis', 'bulan', 'tahun'));

        $pdf = Pdf::loadView('print.slip', compact('gajis', 'bulan', 'tahun'));
        return $pdf->stream("slip_gaji_$request->bulan $request->tahun.pdf");
    }
}
