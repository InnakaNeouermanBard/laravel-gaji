<?php

namespace App\Exports;

use App\Models\Absensi;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AbsensiExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize, WithTitle
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        if ($this->bulan && $this->tahun) {
            $periode = Carbon::createFromDate($this->tahun, $this->bulan, 1)->locale('id')->isoFormat('MMMM Y');
            return 'Absensi ' . $periode;
        }

        return 'Absensi Karyawan';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->bulan && $this->tahun) {
            return Absensi::with('karyawan.jabatan')
                ->whereMonth('bulan', $this->bulan)
                ->whereYear('bulan', $this->tahun)
                ->get();
        }

        return Absensi::with('karyawan.jabatan')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'No',
            'Periode',
            'NIK',
            'Nama Karyawan',
            'Jenis Kelamin',
            'Jabatan',
            'Hadir',
            'Izin',
            'Alpha',
        ];
    }

    /**
     * @param mixed $row
     * 
     * @return array
     */
    public function map($row): array
    {
        static $counter = 0;
        $counter++;

        return [
            $counter,
            Carbon::parse($row->bulan)->locale('id')->isoFormat('MMMM Y'),
            $row->karyawan->nik,
            $row->karyawan->nama_karyawan,
            $row->karyawan->kelamin == 'L' ? 'Laki-Laki' : 'Perempuan',
            $row->karyawan->jabatan->nama_jabatan,
            $row->masuk,
            $row->izin,
            $row->alpha,
        ];
    }

    /**
     * @param Worksheet $sheet
     * 
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $periode = $this->bulan && $this->tahun ?
            Carbon::createFromDate($this->tahun, $this->bulan, 1)->locale('id')->isoFormat('MMMM Y') :
            'Semua Periode';

        $sheet->mergeCells('A1:I1');
        $sheet->setCellValue('A1', 'DATA ABSENSI KARYAWAN PERIODE ' . strtoupper($periode));
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Style untuk heading
        $sheet->getStyle('A2:I2')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => '4472C4',
                ],
            ],
            'font' => [
                'color' => [
                    'rgb' => 'FFFFFF',
                ],
            ],
        ]);

        // Border untuk semua data
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('A2:I' . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        return [
            2 => ['font' => ['bold' => true]],
        ];
    }
}
