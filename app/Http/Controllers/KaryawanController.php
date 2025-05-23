<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->wantsJson()) {
            $karyawans = $this->getKaryawans(false);
            return $this->setResponse(200, "Success", $karyawans);
        } else {
            $karyawans = $this->getKaryawans(false);
            return view('karyawan.index')
                ->with('karyawans', $karyawans);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatans = Jabatan::all();

        return view('karyawan.action')
            ->with('jabatans', $jabatans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_jabatan' => 'required',
            'nik' => 'required',
            'nama_karyawan' => 'required',
            'kelamin' => 'required',
            'agama' => 'required',
            'alamat_tinggal' => 'required',
            'no_telepon' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'status_perkawinan' => 'required',
            'tanggal_masuk' => 'required|date',
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'email' => 'required',

        ], [
            'id_jabatan.required' => 'Jabatan tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'nama_karyawan.required' => 'Nama karyawan tidak boleh kosong',
            'kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'agama.required' => 'Agama tidak boleh kosong',
            'alamat_tinggal.required' => 'Alamat tinggal tidak boleh kosong',
            'no_telepon.required' => 'Nomor telepon tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'status_perkawinan.required' => 'Status perkawinan tidak boleh kosong',
            'tanggal_masuk.required' => 'Tanggal masuk tidak boleh kosong',
            'nama_bank.required' => 'Nama bank tinggal tidak boleh kosong',
            'no_rekening.required' => 'No rekening tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $user = User::create([
            'username' => $request->nik,
            'password' => Hash::make($request->nik),
            'name' => $request->nama_karyawan,
            'email' => $request->nik . '@gmail.com',
            'level' => 2
        ]);

        Karyawan::create([
            'id_user' => $user->id_user,
            'id_jabatan' => $request->id_jabatan,
            'nik' => $request->nik,
            'nama_karyawan' => $request->nama_karyawan,
            'kelamin' => $request->kelamin,
            'agama' => $request->agama,
            'alamat_tinggal' => $request->alamat_tinggal,
            'no_telepon' => $request->no_telepon,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_perkawinan' => $request->status_perkawinan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'nama_bank' => $request->nama_bank,
            'no_rekening' => $request->no_rekening,
            'email' => $request->email,

        ]);

        return $this->setResponse(true, "Sukses membuat karyawan");
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
        $data = Karyawan::find($id);
        $jabatans = Jabatan::all();
        return view('karyawan.action')
            ->with('jabatans', $jabatans)
            ->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id_jabatan' => 'required',
            'nik' => 'required',
            'nama_karyawan' => 'required',
            'kelamin' => 'required',
            'agama' => 'required',
            'alamat_tinggal' => 'required',
            'no_telepon' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'status_perkawinan' => 'required',
            'tanggal_masuk' => 'required|date',
            'nama_bank' => 'required',
            'no_rekening' => 'required',
            'email' => 'required',
        ], [
            'id_jabatan.required' => 'Jabatan tidak boleh kosong',
            'nik.required' => 'NIK tidak boleh kosong',
            'nama_karyawan.required' => 'Nama karyawan tidak boleh kosong',
            'kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'agama.required' => 'Agama tidak boleh kosong',
            'alamat_tinggal.required' => 'Alamat tinggal tidak boleh kosong',
            'no_telepon.required' => 'Nomor telepon tidak boleh kosong',
            'tempat_lahir.required' => 'Tempat lahir tidak boleh kosong',
            'tanggal_lahir.required' => 'Tanggal lahir tidak boleh kosong',
            'status_perkawinan.required' => 'Status perkawinan tidak boleh kosong',
            'tanggal_masuk.required' => 'Tanggal masuk tidak boleh kosong',
            'nama_bank.required' => 'Nama bank tidak boleh kosong',
            'no_rekening.required' => 'No rekening tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->all() as $error) {
                $errors[] = $error;
            }
            return $this->setResponse(false, "Validation Error", $errors);
        }

        $j = Karyawan::where('id_karyawan', $id)->first();

        User::where('id_user', $j->id_user)->update([
            'username' => $request->nik,
            'password' => Hash::make($request->nik),
            'name' => $request->nama_karyawan,
            'email' => $request->nik . '@gmail.com',
        ]);

        Karyawan::where('id_karyawan', $id)->update([
            'id_jabatan' => $request->id_jabatan,
            'nik' => $request->nik,
            'nama_karyawan' => $request->nama_karyawan,
            'kelamin' => $request->kelamin,
            'agama' => $request->agama,
            'alamat_tinggal' => $request->alamat_tinggal,
            'no_telepon' => $request->no_telepon,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_perkawinan' => $request->status_perkawinan,
            'tanggal_masuk' => $request->tanggal_masuk,
            'nama_bank' => $request->nama_bank,
            'no_rekening' => $request->no_rekening,
            'email' => $request->email,
        ]);

        return $this->setResponse(true, "Sukses update karyawan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);
        $user = User::findOrFail($karyawan->id_user);
        $karyawan->delete();
        $user->delete();


        if ($karyawan) {
            return $this->setResponse(true, "Sukses hapus karyawan");
        } else {
            return $this->setResponse(true, "Gagal hapus karyawan");
        }
    }
}
