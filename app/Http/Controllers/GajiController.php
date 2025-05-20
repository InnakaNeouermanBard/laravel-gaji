<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $gajis = Gaji::all();
        if ($request->bulan && $request->tahun) {
            $gajis = Gaji::whereMonth('periode_gaji', $request->bulan)
                ->whereYear('periode_gaji', $request->tahun)
                ->get();
        }

        if (auth()->user()->level == 2) {
            $gajis = $gajis->where('id_user', auth()->user()->id_user);
        }

        $gajis = $gajis->map(function ($item) {
            $item->total_gaji = $item->gaji_pokok + $item->total_bonus - $item->potongan_gaji;
            return $item;
        });

        return view('gaji.index')
            ->with('gajis', $gajis);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = $this->getKaryawans();
        return view('gaji.action')
            ->with('karyawans', $karyawans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'periode_gaji' => 'required',
            'gaji_pokok' => 'required',
            'potongan_gaji' => 'required',
            'total_lembur' => 'required',
            'total_bonus' => 'required',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'periode_gaji.required' => 'Periode gaji tidak boleh kosong',
            'gaji_pokok.required' => 'Gaji pokok tidak boleh kosong',
            'potongan_gaji.required' => 'Potongan gaji tidak boleh kosong',
            'total_lembur.required' => 'Total lembur tidak boleh kosong',
            'total_bonus.required' => 'Total bonus tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['periode_gaji'] = $request['periode_gaji'] . '-01';
        $request['id_user'] = Karyawan::where('id_karyawan', $request->id_karyawan)->first()->id_user;
        $request['tanggal'] = date('Y-m-d');
        Gaji::create($request->all());

        return $this->setResponse(true, "Sukses membuat gaji");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $karyawans = $this->getKaryawans();
        $data = Gaji::find($id);
        $data->periode_gaji = Carbon::parse($data->periode_gaji)->format('Y-m');
        return view('gaji.detail')
            ->with('data', $data)
            ->with('karyawans', $karyawans);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawans = $this->getKaryawans();
        $data = Gaji::find($id);
        $data->periode_gaji = Carbon::parse($data->periode_gaji)->format('Y-m');
        return view('gaji.action')
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
            'periode_gaji' => 'required',
            'gaji_pokok' => 'required',
            'potongan_gaji' => 'required',
            'total_lembur' => 'required',
            'total_bonus' => 'required',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'periode_gaji.required' => 'Periode gaji tidak boleh kosong',
            'gaji_pokok.required' => 'Gaji pokok tidak boleh kosong',
            'potongan_gaji.required' => 'Potongan gaji tidak boleh kosong',
            'total_lembur.required' => 'Total lembur tidak boleh kosong',
            'total_bonus.required' => 'Total bonus tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['periode_gaji'] = $request['periode_gaji'] . '-01';
        Gaji::where('id_gaji', $id)->update($request->all());

        return $this->setResponse(true, "Sukses update gaji");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Gaji::findOrFail($id);
        $delete->delete();

        if ($delete) {
            return $this->setResponse(true, "Sukses hapus gaji");
        } else {
            return $this->setResponse(true, "Gagal hapus gaji");
        }
    }

    public function approve(string $id)
    {
        $gaji = Gaji::where('id_gaji', $id)->update([
            'status' => 1
        ]);

        if ($gaji) {
            return $this->setResponse(true, "Sukses approve gaji");
        } else {
            return $this->setResponse(true, "Gagal approve gaji");
        }
    }

    public function decline(string $id)
    {
        $gaji = Gaji::where('id_gaji', $id)->update([
            'status' => 2
        ]);

        if ($gaji) {
            return $this->setResponse(true, "Sukses menolak gaji");
        } else {
            return $this->setResponse(true, "Gagal menolak gaji");
        }
    }
}
