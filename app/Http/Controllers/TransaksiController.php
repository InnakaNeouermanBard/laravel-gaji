<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $karyawans = Karyawan::all();
        return view('transaksi.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'jumlah_gaji' => 'required|numeric',
            'status_pembayaran' => 'required|in:pending,success,failed',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $buktiPembayaran = $request->file('bukti_pembayaran')->store('bukti_pembayaran');

        Transaksi::create([
            'karyawan_id' => $request->karyawan_id,
            'jumlah_gaji' => $request->jumlah_gaji,
            'status_pembayaran' => $request->status_pembayaran,
            'bukti_pembayaran' => $buktiPembayaran,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }

    public function edit(Transaksi $transaksi)
    {
        $karyawans = Karyawan::all();
        return view('transaksi.edit', compact('transaksi', 'karyawans'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'jumlah_gaji' => 'required|numeric',
            'status_pembayaran' => 'required|in:pending,success,failed',
            'bukti_pembayaran' => 'nullable|image|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        if ($request->hasFile('bukti_pembayaran')) {
            $buktiPembayaran = $request->file('bukti_pembayaran')->store('bukti_pembayaran');
            $transaksi->update(['bukti_pembayaran' => $buktiPembayaran]);
        }

        $transaksi->update($request->except('bukti_pembayaran'));

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus');
    }
}
