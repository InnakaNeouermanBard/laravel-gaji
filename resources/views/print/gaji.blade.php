<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Gaji</title>
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
    <h2>Laporan Gaji Karyawan Bulan {{ $data['bulan'] }} Tahun {{ $data['tahun'] }}</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Jabatan</th>
                <th>Gaji Pokok</th>
                <th>Total Bonus</th>
                <th>Potongan</th>
                <th>Total Gaji</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data['gajis'] as $index => $gaji)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $gaji->karyawan->nik }}</td>
                    <td>{{ $gaji->karyawan->nama_karyawan }}</td>
                    <td>
                        @if ($gaji->karyawan->kelamin == 'L')
                            Laki-Laki
                        @else
                            Perempuan
                        @endif
                    </td>
                    <td>{{ $gaji->karyawan->jabatan->nama_jabatan }}</td>
                    <td>@currency($gaji->gaji_pokok)</td>
                    <td>@currency($gaji->total_bonus)</td>
                    <td>@currency($gaji->potongan_gaji)</td>
                    <td>@currency($gaji->total_gaji)</td>
                </tr>
            @empty
                <tr>
                    <td style="text-align: center" colspan="9">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>
