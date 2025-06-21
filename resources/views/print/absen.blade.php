<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Absensi Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #ffffff;
            padding: 30px;
            border-bottom: 2px solid #4a90e2;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo {
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 8px;
        }

        .company-info h1 {
            color: #333;
            font-size: 24px;
            margin: 0 0 8px 0;
        }

        .company-info .address {
            color: #666;
            font-size: 14px;
            line-height: 1.4;
        }

        .report-title {
            background: #f8f9fa;
            padding: 25px 30px;
            text-align: center;
        }

        .report-title h2 {
            color: #333;
            font-size: 20px;
            margin: 0 0 10px 0;
        }

        .period-info {
            color: #666;
            font-size: 14px;
        }

        .table-container {
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th {
            background: #4a90e2;
            color: white;
            padding: 12px 8px;
            text-align: center;
            font-weight: 600;
            font-size: 14px;
        }

        td {
            padding: 10px 8px;
            text-align: center;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .text-left {
            text-align: left;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f0f8ff;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #999;
            font-style: italic;
        }

        .footer {
            background: #f8f9fa;
            padding: 15px 30px;
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #eee;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .company-info h1 {
                font-size: 20px;
            }

            .table-container {
                padding: 15px;
                overflow-x: auto;
            }

            th,
            td {
                padding: 8px 4px;
                font-size: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div class="company-info">
                    <h1>CV. Mahesa Art Studio</h1>
                    <div class="address">
                        Jl. Raya Rw. Bugel No.30, Harapan Jaya<br>
                        Kec. Bekasi Utara, Kota Bekasi, Jawa Barat 17124
                    </div>
                </div>
            </div>
        </div>

        <!-- Judul Laporan -->
        <div class="report-title">
            <h2>LAPORAN ABSENSI Pegawai</h2>
            <div class="period-info">
                Periode: <strong>{{ $data['bulan'] }} {{ $data['tahun'] }}</strong>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="12%">NIK</th>
                        <th width="25%">Nama Karyawan</th>
                        <th width="15%">Jenis Kelamin</th>
                        <th width="20%">Jabatan</th>
                        <th width="8%">Hadir</th>
                        <th width="8%">Izin</th>
                        <th width="7%">Alpha</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data['absensis'] as $index => $absensi)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $absensi->karyawan->nik }}</td>
                            <td class="text-left">{{ $absensi->karyawan->nama_karyawan }}</td>
                            <td>
                                @if ($absensi->karyawan->kelamin == 'L')
                                    Laki-Laki
                                @else
                                    Perempuan
                                @endif
                            </td>
                            <td class="text-left">{{ $absensi->karyawan->jabatan->nama_jabatan }}</td>
                            <td><strong>{{ $absensi->masuk }}</strong></td>
                            <td><strong>{{ $absensi->izin }}</strong></td>
                            <td><strong>{{ $absensi->alpha }}</strong></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="no-data">
                                Tidak ada data absensi untuk periode ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>CV. Mahesa Art Studio - Dicetak pada {{ date('m/d/Y H:i') }} WIB</p>
        </div>
    </div>
</body>

</html>
