<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class GenerateAbsensiTemplate extends Command
{
    protected $signature = 'generate:absensi-template';
    protected $description = 'Generate template Excel untuk import absensi';

    public function handle()
    {
        $this->info('Generating absensi template...');

        // Pastikan direktori template ada
        $templateDir = public_path('templates');
        if (!file_exists($templateDir)) {
            $this->info('Creating templates directory...');
            if (!mkdir($templateDir, 0755, true)) {
                $this->error('Failed to create templates directory!');
                return Command::FAILURE;
            }
        }

        // Inisialisasi objek spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul
        $sheet->setCellValue('A1', 'TEMPLATE IMPORT ABSENSI KARYAWAN');
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set header kolom
        $sheet->setCellValue('A2', 'NIK');
        $sheet->setCellValue('B2', 'HADIR');
        $sheet->setCellValue('C2', 'IZIN');
        $sheet->setCellValue('D2', 'ALPHA');

        // Style untuk header
        $styleHeader = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ];
        $sheet->getStyle('A2:D2')->applyFromArray($styleHeader);

        // Tambahkan beberapa baris contoh data
        $contohData = [
            ['123456789', 22, 0, 0],
            ['987654321', 20, 2, 0],
        ];

        $row = 3;
        foreach ($contohData as $data) {
            $sheet->setCellValue('A' . $row, $data[0]);
            $sheet->setCellValue('B' . $row, $data[1]);
            $sheet->setCellValue('C' . $row, $data[2]);
            $sheet->setCellValue('D' . $row, $data[3]);
            $row++;
        }

        // Style untuk contoh data
        $styleData = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];
        $sheet->getStyle('A3:D' . ($row - 1))->applyFromArray($styleData);

        // Tambahkan catatan
        $sheet->setCellValue('A' . ($row + 1), 'Catatan:');
        $sheet->setCellValue('A' . ($row + 2), '1. NIK harus sesuai dengan data karyawan yang ada di sistem');
        $sheet->setCellValue('A' . ($row + 3), '2. Hadir, Izin, dan Alpha harus berupa angka');
        $sheet->mergeCells('A' . ($row + 1) . ':D' . ($row + 1));
        $sheet->mergeCells('A' . ($row + 2) . ':D' . ($row + 2));
        $sheet->mergeCells('A' . ($row + 3) . ':D' . ($row + 3));

        // Auto size kolom
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

        $outputPath = public_path('templates/template_absensi.xlsx');

        try {
            // Simpan file
            $writer = new Xlsx($spreadsheet);
            $writer->save($outputPath);

            $this->info('Template berhasil dibuat di ' . $outputPath);
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Error saat membuat template: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
