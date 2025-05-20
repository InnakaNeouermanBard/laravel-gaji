<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Absen</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        table th {
            background-color: #3f6791;
            color: white;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2>Laporan Absensi Karyawan Bulan {{ $data['bulan'] }} Tahun {{ $data['tahun'] }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Hadir</th>
                <th>Izin</th>
                <th>Alpha</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data['absensis'] as $index => $absensi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $absensi->karyawan->nik }}</td>
                    <td>{{ $absensi->karyawan->nama_karyawan }}</td>
                    <td>
                        @if ($absensi->karyawan->kelamin == 'L')
                            Laki-Laki
                        @else
                            Perempuan
                        @endif
                    </td>
                    <td>{{ $absensi->karyawan->jabatan->nama_jabatan }}</td>
                    <td>{{ $absensi->masuk }}</td>
                    <td>{{ $absensi->izin }}</td>
                    <td>{{ $absensi->alpha }}</td>
                </tr>
            @empty
                <tr>
                    <td style="text-align: center" colspan="8">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
