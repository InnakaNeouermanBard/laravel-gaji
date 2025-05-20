<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\PotonganGaji;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PotongGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $potongs = PotonganGaji::all();
        return view('potong_gaji.index')
            ->with('potongs', $potongs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = $this->getKaryawans();
        return view('potong_gaji.action')
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
            'alpha' => 'required',
            'potongan_gaji' => 'required',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'alpha.required' => 'Jumlah hari alpha tidak boleh kosong',
            'potongan_gaji.required' => 'Potongan Gaji tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['bulan'] = $request['bulan'] . '-01';
        $request['id_user'] = Karyawan::where('id_karyawan', $request->id_karyawan)->first()->id_user;
        PotonganGaji::create($request->all());

        return $this->setResponse(true, "Sukses membuat potongan gaji");
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
        $karyawans = $this->getKaryawans();
        $data = PotonganGaji::find($id);
        $data->bulan = Carbon::parse($data->bulan)->format('Y-m');
        return view('potong_gaji.action')
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
            'alpha' => 'required',
            'potongan_gaji' => 'required',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'bulan.required' => 'Bulan tidak boleh kosong',
            'alpha.required' => 'Jumlah hari alpha tidak boleh kosong',
            'potongan_gaji.required' => 'Potongan Gaji tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['bulan'] = $request['bulan'] . '-01';
        PotonganGaji::where('id_potong_gaji', $id)->update($request->all());

        return $this->setResponse(true, "Sukses update potongan gaji");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = PotonganGaji::findOrFail($id);
        $delete->delete();

        if ($delete) {
            return $this->setResponse(true, "Sukses hapus potongan gaji");
        } else {
            return $this->setResponse(true, "Gagal hapus potongan gaji");
        }
    }
}
