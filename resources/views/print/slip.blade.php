<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip Gaji</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        h1 {
            margin: 0px;
            /* font-size: 30px; */
        }

        hr.s1 {
            height: 3px;
            border-bottom: 1px solid black;
            border-top: 2px solid black;
            border-left: 0px solid transparent;
            border-right: 0px solid transparent;
        }

        .gaji th,
        {
        border-top: 2px solid black;
        border-bottom: 2px solid black;
        }

        .gaji {
            border-bottom: 1px solid black;
        }

        table .gaji th {
            background-color: #3f6791;
            color: white;
        }

        .gaji th,
        .gaji td,
        .header th,
        .header td {
            padding: 2px;
            text-align: left;
        }

        .gaji th:nth-child(3),
        .gaji td:nth-child(4),
        .gaji td:nth-child(3) {
            text-align: right !important
        }

        .header td:nth-child(1),
        .header td:nth-child(4) {
            width: 35%
        }

        .header td:nth-child(2),
        .header td:nth-child(5) {
            width: 2%
        }

        .header td:nth-child(3),
        .header td:nth-child(6) {
            width: 80%
        }

        .header {
            margin-bottom: 10px;
        }

        .gaji td:nth-child(1),
        .total td:nth-child(1) {
            width: 5%;
            text-align: center
        }

        .gaji td:nth-child(2) {
            width: 70%;
        }

        .total td:nth-child(2) {
            width: 50%;
        }

        .page-break {
            page-break-before: always;
        }

        .bold {
            font-weight: bold;
        }

        .total td {
            text-align: right;
            padding: 4px;
            padding-right: 0px;
        }

        .total td:nth-child(3) {
            text-align: left
        }

        .total td:nth-child(3),
        .total td:nth-child(4) {
            border-bottom: 1px solid black
        }
    </style>
</head>

<body>
    @foreach ($gajis as $gaji)
        <table>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ date('d/m/Y') }}</td>
                <td rowspan="2">
                    <h1 style="text-align: right">SLIP GAJI</h1>
                </td>
            </tr>
            <tr>
                <td>Periode</td>
                <td>:</td>
                <td>{{ $bulan }} {{ $tahun }}</td>
            </tr>
        </table>
        <hr class="s1" />
        <table class="header">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td>{{ $gaji->karyawan->nama_karyawan }}</td>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $gaji->karyawan->alamat_tinggal }}</td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td>{{ $gaji->karyawan->jabatan->nama_jabatan }}</td>
                <td>Telepon</td>
                <td>:</td>
                <td>{{ $gaji->karyawan->no_telepon ?? '-' }}</td>
            </tr>
        </table>
        <table class="gaji">
            <thead>
                <tr>
                    <th>NO</th>
                    <th colspan="2">KETERANGAN</th>
                    <th>JUMLAH</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bold">1</td>
                    <td class="bold">GAJI POKOK</td>
                    <td class="bold">(+)</td>
                    <td class="bold">@currency($gaji->gaji_pokok)</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bold">2</td>
                    <td class="bold">BONUS</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>a)</td>
                    <td>Uang Lembur</td>
                    <td>(+)</td>
                    <td>@currency($gaji->total_uang_lembur)</td>
                </tr>
                {{-- <tr>
                    <td>b)</td>
                    <td>Uang Makan</td>
                    <td>(+)</td>
                    <td>@currency($gaji->total_uang_makan)</td>
                </tr>
                <tr>
                    <td>c)</td>
                    <td>Tunjangan Transportasi</td>
                    <td>(+)</td>
                    <td>@currency($gaji->total_tunjangan_transportasi)</td>
                </tr> --}}
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bold">3</td>
                    <td class="bold">POTONGAN</td>
                    <td class="bold">(-)</td>
                    <td class="bold">@currency($gaji->potongan_gaji)</td>
                </tr>
            </tbody>
        </table>
        <table class="total">
            <tr>
                <td></td>
                <td></td>
                <td class="bold">TOTAL DITERIMA</td>
                <td class="bold">@currency($gaji->total_diterima)</td>
            </tr>
        </table>
        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>

</html>
