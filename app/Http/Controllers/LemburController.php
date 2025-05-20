<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Lembur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LemburController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lemburs = Lembur::all();
        return view('lembur.index')
            ->with('lemburs', $lemburs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $karyawans = $this->getKaryawans();
        return view('lembur.action')
            ->with('karyawans', $karyawans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'jam.required' => 'Jumlah jam tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $request['id_user'] = Karyawan::where('id_karyawan', $request->id_karyawan)->first()->id_user;
        Lembur::create($request->all());

        return $this->setResponse(true, "Sukses membuat lembur");
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
        $data = Lembur::find($id);
        return view('lembur.action')
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
            'tanggal' => 'required',
            'jam' => 'required',
        ], [
            'id_karyawan.required' => 'Karyawan tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'jam.required' => 'Jumlah jam tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        Lembur::where('id_lembur', $id)->update($request->all());

        return $this->setResponse(true, "Sukses update lembur");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Lembur::findOrFail($id);
        $delete->delete();

        if ($delete) {
            return $this->setResponse(true, "Sukses hapus lembur");
        } else {
            return $this->setResponse(true, "Gagal hapus lembur");
        }
    }
}
