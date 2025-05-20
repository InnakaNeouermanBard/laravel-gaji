<?php

namespace App\Imports;

use App\Models\Absensi;
use App\Models\Karyawan;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\Importable;

class AbsensiImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Cari karyawan berdasarkan NIK
        $karyawan = Karyawan::where('nik', $row['nik'])->first();

        if (!$karyawan) {
            return null;
        }

        // Format bulan
        $tanggal = Carbon::createFromDate($this->tahun, $this->bulan, 1)->format('Y-m-d');

        // Cek apakah data sudah ada
        $existingAbsensi = Absensi::where('id_karyawan', $karyawan->id_karyawan)
            ->whereMonth('bulan', $this->bulan)
            ->whereYear('bulan', $this->tahun)
            ->first();

        // Update jika sudah ada
        if ($existingAbsensi) {
            $existingAbsensi->update([
                'masuk' => $row['hadir'],
                'izin' => $row['izin'],
                'alpha' => $row['alpha'],
            ]);
            return null;
        }

        // Buat baru jika belum ada
        return new Absensi([
            'id_karyawan' => $karyawan->id_karyawan,
            'bulan' => $tanggal,
            'masuk' => $row['hadir'],
            'izin' => $row['izin'],
            'alpha' => $row['alpha'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nik' => 'required',
            'hadir' => 'required|numeric',
            'izin' => 'required|numeric',
            'alpha' => 'required|numeric',
        ];
    }
}
