<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('jabatan.index')
            ->with('jabatans', $jabatans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.action');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required|numeric',
            'uang_lembur' => 'required|numeric',
            // 'tunjangan_transportasi' => 'required|numeric',
            // 'uang_makan' => 'required|numeric',
        ], [
            'nama_jabatan.required' => 'Nama jabatan tidak boleh kosong',
            'gaji_pokok.required' => 'Gaji pokok tidak boleh kosong',
            'gaji_pokok.numeric' => 'Gaji pokok harus berupa angka',
            'uang_lembur.required' => 'Uang lembur tidak boleh kosong',
            'uang_lembur.numeric' => 'Uang lembur harus berupa angka',
            // 'tunjangan_transportasi.required' => 'Tunjangan transportasi tidak boleh kosong',
            // 'tunjangan_transportasi.numeric' => 'Tunjangan transportasi harus berupa angka',
            // 'uang_makan.required' => 'Uang makan tidak boleh kosong',
            // 'uang_makan.numeric' => 'Uang makan harus berupa angka',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        Jabatan::create($request->all());

        return $this->setResponse(true, "Sukses membuat jabatan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Jabatan::find($id);
        return view('jabatan.action')
            ->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->removeUnused($request);

        $validator = Validator::make($request->all(), [
            'nama_jabatan' => 'required',
            'gaji_pokok' => 'required',
            'uang_lembur' => 'required',
            // 'tunjangan_transportasi' => 'required',
            // 'uang_makan' => 'required',
        ], [
            'nama_jabatan.required' => 'Nama jabatan tidak boleh kosong',
            'gaji_pokok.required' => 'Gaji pokok tidak boleh kosong',
            'uang_lembur.required' => 'Uang lembur tidak boleh kosong',
            // 'tunjangan_transportasi.required' => 'Tunjangan transportasi tidak boleh kosong',
            // 'uang_makan.required' => 'Uang makan tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        Jabatan::where('id_jabatan', $id)->update($request->all());

        return $this->setResponse(true, "Sukses update jabatan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Jabatan::findOrFail($id);
        $delete->delete();

        if ($delete) {
            return $this->setResponse(true, "Sukses hapus jabatan");
        } else {
            return $this->setResponse(true, "Gagal hapus jabatan");
        }
    }
}
