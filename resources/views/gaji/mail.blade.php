<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2c3e50;
        }

        p {
            font-size: 16px;
        }

        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f8f8f8;
        }

        .footer {
            font-size: 12px;
            color: #777;
            text-align: center;
            margin-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2ecc71;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }

        .button:hover {
            background-color: #27ae60;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Halo, {{ $karyawan }}!</h1>
        <p>Gaji Anda untuk periode {{ $periode }} telah dibayar dengan rincian sebagai berikut:</p>

        <table>
            <tr>
                <th>Gaji Pokok</th>
                <td>Rp {{ number_format($gaji->gaji_pokok, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Potongan Gaji</th>
                <td>Rp {{ number_format($gaji->potongan_gaji, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Lembur</th>
                <td>Rp {{ number_format($gaji->total_lembur, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Total Bonus</th>
                <td>Rp {{ number_format($gaji->total_bonus, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th><strong>Total Gaji</strong></th>
                <td><strong>Rp
                        {{ number_format($gaji->gaji_pokok + $gaji->total_bonus - $gaji->potongan_gaji, 0, ',', '.') }}</strong>
                </td>
            </tr>
        </table>

        <p>Terima kasih telah bekerja dengan kami. Jika Anda memiliki pertanyaan lebih lanjut, jangan ragu untuk
            menghubungi kami.</p>

        <a href="#" class="button">Lihat Rincian Pembayaran</a>

        <div class="footer">
            <p>Salam,<br> Tim Penggajian</p>
        </div>
    </div>
</body>

</html>
