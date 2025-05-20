<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\Lembur;
use App\Models\PotonganGaji;
use App\Exports\AbsensiExport;
use App\Imports\AbsensiImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $absensis = Absensi::with(['karyawan.jabatan'])->get();
        if ($request->bulan && $request->tahun) {
            $absensis = Absensi::with(['karyawan.jabatan'])
                ->whereMonth('bulan', $request->bulan)
                ->whereYear('bulan', $request->tahun)
                ->get();
        }
        return view('absensi.index')
            ->with('absensis', $absensis);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = $this->fetchAllKaryawans();
        return view('absensi.action')
            ->with('karyawans', $karyawans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'bulan' => 'required',
            'masuk' => 'required|numeric',
            'izin' => 'required|numeric',
            'alpha' => 'required|numeric',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'masuk.required' => 'Jumlah hari masuk tidak boleh kosong',
            'masuk.numeric' => 'Jumlah hari masuk harus berupa angka',
            'izin.required' => 'Jumlah hari izin tidak boleh kosong',
            'izin.numeric' => 'Jumlah hari izin harus berupa angka',
            'alpha.required' => 'Jumlah hari alpha tidak boleh kosong',
            'alpha.numeric' => 'Jumlah hari alpha harus berupa angka',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['bulan'] = $request['bulan'] . '-01';
        Absensi::create($request->all());

        return $this->setResponse(true, "Sukses membuat absensi");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawans = $this->fetchAllKaryawans();
        $data = Absensi::find($id);
        $data->bulan = Carbon::parse($data->bulan)->format('Y-m');
        return view('absensi.action')
            ->with('data', $data)
            ->with('karyawans', $karyawans);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->removeUnused($request);

        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'bulan' => 'required',
            'masuk' => 'required|numeric',
            'izin' => 'required|numeric',
            'alpha' => 'required|numeric',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'masuk.required' => 'Jumlah hari masuk tidak boleh kosong',
            'masuk.numeric' => 'Jumlah hari masuk harus berupa angka',
            'izin.required' => 'Jumlah hari izin tidak boleh kosong',
            'izin.numeric' => 'Jumlah hari izin harus berupa angka',
            'alpha.required' => 'Jumlah hari alpha tidak boleh kosong',
            'alpha.numeric' => 'Jumlah hari alpha harus berupa angka',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['bulan'] = $request['bulan'] . '-01';
        Absensi::where('id_absensi', $id)->update($request->all());

        return $this->setResponse(true, "Sukses update absensi");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Absensi::findOrFail($id);
        $delete->delete();

        if ($delete) {
            return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil dihapus');
        } else {
            return redirect()->route('absensi.index')->with('error', 'Gagal menghapus data absensi');
        }
    }

    public function cariAbsensi(Request $request)
    {
        $absensi = Absensi::whereMonth('bulan', $request->bulan)
            ->whereYear('bulan', $request->tahun)
            ->where('id_karyawan', $request->id_karyawan)
            ->first();

        if ($absensi) {
            return $this->setResponse(true, "Sukses get absensi", $absensi);
        } else {
            return $this->setResponse(false, "Absensi tidak ditemukan", []);
        }
    }

    public function cariAbsensiLembur(Request $request)
    {
        $gaji_pokok = Karyawan::with('jabatan')->where('id_karyawan', $request->id_karyawan)->first();

        $potongan = PotonganGaji::whereMonth('bulan', $request->bulan)
            ->whereYear('bulan', $request->tahun)
            ->where('id_karyawan', $request->id_karyawan)
            ->first();

        $lembur = Lembur::whereMonth('tanggal', $request->bulan)
            ->whereYear('tanggal', $request->tahun)
            ->where('id_karyawan', $request->id_karyawan)
            ->get();

        $absensi = Absensi::select('izin', 'masuk', 'alpha')->whereMonth('bulan', $request->bulan)
            ->whereYear('bulan', $request->tahun)
            ->where('id_karyawan', $request->id_karyawan)
            ->first();

        $obj = [];
        $obj['gaji']['uang_lembur'] = $gaji_pokok->jabatan->uang_lembur;
        $obj['gaji']['uang_makan'] = 0;
        $obj['gaji']['tunjangan_transportasi'] = 0;
        $obj['gaji']['gaji_pokok'] = $gaji_pokok->jabatan->gaji_pokok;

        if ($absensi) {
            $obj['absensi'] = $absensi;
        } else {
            $obj['absensi']['izin'] = 0;
            $obj['absensi']['masuk'] = 0;
            $obj['absensi']['alpha'] = 0;
        }

        if ($potongan) {
            $obj['potongan'] = $potongan->potongan_gaji;
        } else {
            $obj['potongan'] = 0;
        }

        if ($lembur) {
            $obj['lembur'] = $lembur->pluck('jam')->sum();
        } else {
            $obj['lembur'] = 0;
        }

        return $this->setResponse(true, "Sukses get data", $obj);
    }

    /**
     * Show the form for importing data.
     */
    public function showImportForm()
    {
        return view('absensi.import');
    }

    /**
     * Import data from Excel file
     */
    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls,csv',
            'bulan' => 'required',
            'tahun' => 'required',
        ], [
            'file.required' => 'File tidak boleh kosong',
            'file.mimes' => 'File harus berformat xlsx, xls, atau csv',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        try {
            Excel::import(new AbsensiImport($request->bulan, $request->tahun), $request->file('file'));

            return redirect()->route('absensi.index')->with('success', 'Data absensi berhasil diimport');
        } catch (\Exception $e) {
            return redirect()->route('absensi.index')->with('error', 'Gagal import data: ' . $e->getMessage());
        }
    }

    /**
     * Export data to Excel
     */
    public function export(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $filename = 'absensi';
        if ($bulan && $tahun) {
            $month_name = Carbon::createFromDate($tahun, $bulan, 1)->locale('id')->isoFormat('MMMM');
            $filename = 'absensi_' . $month_name . '_' . $tahun;
        }

        return Excel::download(new AbsensiExport($bulan, $tahun), $filename . '.xlsx');
    }

    /**
     * Download template Excel untuk import
     */
    public function downloadTemplate()
    {
        $templatePath = public_path('templates/template_absensi.xlsx');

        if (!file_exists($templatePath)) {
            // Jika file template belum dibuat, redirect ke halaman dengan pesan error
            return redirect()->route('absensi.index')->with('error', 'Template belum tersedia. Harap generate terlebih dahulu.');
        }

        return response()->download($templatePath);
    }

    /**
     * Helper function to get karyawans
     * Renamed to avoid conflict with parent class
     */
    private function fetchAllKaryawans()
    {
        return Karyawan::all();
    }

    /**
     * Helper function to remove unused request parameters
     */
    public function removeUnused($request)
    {
        // Implementasi kode removeUnused jika diperlukan
    }

    /**
     * Response formatter
     */
    public function setResponse($status, $message, $data = null)
    {
        $response = [
            'success' => $status,
            'message' => $message
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return response()->json($response);
    }
}
