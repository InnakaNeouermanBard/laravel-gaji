<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Rekening;
use Illuminate\Http\Request;
use App\Models\RekeningKaryawan;

class RekeningKaryawanController extends Controller
{
    public function index()
    {
        $rekeningKaryawans = RekeningKaryawan::all();
        $karyawan = $this->getKaryawans();
        return view('rekening.index', compact('rekeningKaryawans', 'karyawan'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('rekening_karyawan.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'bank_name' => 'required|string|max:255',
            'rekening_number' => 'required|string|max:255|unique:rekening_karyawan',
            'pemilik_rekening' => 'required|string|max:255',
        ]);

        RekeningKaryawan::create($request->all());

        return redirect()->route('rekening_karyawan.index')->with('success', 'Rekening karyawan berhasil ditambahkan');
    }

    public function edit(RekeningKaryawan $rekeningKaryawan)
    {
        $karyawans = Karyawan::all();
        return view('rekening_karyawan.edit', compact('rekeningKaryawan', 'karyawans'));
    }

    public function update(Request $request, RekeningKaryawan $rekeningKaryawan)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'bank_name' => 'required|string|max:255',
            'rekening_number' => 'required|string|max:255|unique:rekening_karyawan,rekening_number,' . $rekeningKaryawan->id,
            'pemilik_rekening' => 'required|string|max:255',
        ]);

        $rekeningKaryawan->update($request->all());

        return redirect()->route('rekening_karyawan.index')->with('success', 'Rekening karyawan berhasil diperbarui');
    }

    public function destroy(RekeningKaryawan $rekeningKaryawan)
    {
        $rekeningKaryawan->delete();

        return redirect()->route('rekening_karyawan.index')->with('success', 'Rekening karyawan berhasil dihapus');
    }
}
