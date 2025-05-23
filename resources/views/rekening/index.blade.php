@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Rekening Karyawan</h2>
        <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#rekeningModal">Tambah Rekening
            Karyawan</button>

        <table class="table table-bordered mt-3" id="rekening-table">
            <thead>
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Nama Bank</th>
                    <th>Nomor Rekening</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rekeningKaryawans as $rekening => $item)
                    <tr>

                        <td>{{ $item->karyawan->nama_lengkap }}</td>
                        <td>{{ $item->bank_name }}</td>
                        <td>{{ $item->rekening_number }}</td>
                        <td>{{ $item->pemilik_rekening }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2 class="mt-5">Daftar Transaksi</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#transaksiModal">Tambah Transaksi</button>

        <table class="table table-bordered mt-3" id="transaksi-table">
            <thead>
                <tr>
                    <th>Nama Karyawan</th>
                    <th>Jumlah Gaji</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data transaksi akan ditampilkan di sini -->
            </tbody>
        </table>
    </div>

    <!-- Modal Rekening Karyawan -->
    <div class="modal fade" id="rekeningModal" tabindex="-1" aria-labelledby="rekeningModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rekeningModalLabel">Tambah Rekening Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="rekeningForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="karyawan_id" class="form-label">Karyawan</label>
                            <select id="karyawan_id" class="form-select" required>
                                <!-- Karyawan akan dimuat di sini -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Nama Bank</label>
                            <input type="text" class="form-control" id="bank_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="rekening_number" class="form-label">Nomor Rekening</label>
                            <input type="text" class="form-control" id="rekening_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="pemilik_rekening" class="form-label">Pemilik Rekening</label>
                            <input type="text" class="form-control" id="pemilik_rekening" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Transaksi -->
    <div class="modal fade" id="transaksiModal" tabindex="-1" aria-labelledby="transaksiModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transaksiModalLabel">Tambah Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="transaksiForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="karyawan_id" class="form-label">Karyawan</label>
                            <select id="transaksi_karyawan_id" class="form-select" required>
                                <!-- Karyawan akan dimuat di sini -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_gaji" class="form-label">Jumlah Gaji</label>
                            <input type="number" class="form-control" id="jumlah_gaji" required>
                        </div>
                        <div class="mb-3">
                            <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                            <select class="form-select" id="status_pembayaran" required>
                                <option value="pending">Pending</option>
                                <option value="success">Success</option>
                                <option value="failed">Failed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                            <input type="file" class="form-control" id="bukti_pembayaran">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        loadRekeningKaryawan();
        loadTransaksi();

        document.querySelector('#rekeningForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const data = {
                karyawan_id: document.querySelector('#karyawan_id').value,
                bank_name: document.querySelector('#bank_name').value,
                rekening_number: document.querySelector('#rekening_number').value,
                pemilik_rekening: document.querySelector('#pemilik_rekening').value,
            };
            storeRekening(data);
        });

        document.querySelector('#transaksiForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const data = {
                karyawan_id: document.querySelector('#transaksi_karyawan_id').value,
                jumlah_gaji: document.querySelector('#jumlah_gaji').value,
                status_pembayaran: document.querySelector('#status_pembayaran').value,
                bukti_pembayaran: document.querySelector('#bukti_pembayaran').files[0],
            };
            storeTransaksi(data);
        });
    });

    // Fungsi untuk memuat rekening karyawan
    function loadRekeningKaryawan() {
        fetch('/rekening_karyawan')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#rekening-table tbody');
                tableBody.innerHTML = '';
                data.forEach(rekening => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td>${rekening.karyawan.nama}</td>
                    <td>${rekening.bank_name}</td>
                    <td>${rekening.rekening_number}</td>
                    <td>
                        <button class="btn btn-warning" onclick="editRekening(${rekening.id})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteRekening(${rekening.id})">Hapus</button>
                    </td>
                `;
                    tableBody.appendChild(row);
                });
            });
    }

    // Fungsi untuk memuat transaksi
    function loadTransaksi() {
        fetch('/transaksi')
            .then(response => response.json())
            .then(data => {
                const tableBody = document.querySelector('#transaksi-table tbody');
                tableBody.innerHTML = '';
                data.forEach(transaksi => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td>${transaksi.karyawan.nama}</td>
                    <td>Rp ${transaksi.jumlah_gaji}</td>
                    <td>${transaksi.status_pembayaran}</td>
                    <td>
                        <button class="btn btn-warning" onclick="editTransaksi(${transaksi.id})">Edit</button>
                        <button class="btn btn-danger" onclick="deleteTransaksi(${transaksi.id})">Hapus</button>
                    </td>
                `;
                    tableBody.appendChild(row);
                });
            });
    }

    // Fungsi untuk menyimpan rekening
    function storeRekening(data) {
        fetch('/rekening_karyawan', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                loadRekeningKaryawan();
                $('#rekeningModal').modal('hide');
            });
    }

    // Fungsi untuk menyimpan transaksi
    function storeTransaksi(data) {
        const formData = new FormData();
        formData.append('karyawan_id', data.karyawan_id);
        formData.append('jumlah_gaji', data.jumlah_gaji);
        formData.append('status_pembayaran', data.status_pembayaran);
        formData.append('bukti_pembayaran', data.bukti_pembayaran);

        fetch('/transaksi', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                loadTransaksi();
                $('#transaksiModal').modal('hide');
            });
    }

    // Fungsi untuk mengedit rekening
    function editRekening(id) {
        fetch(`/rekening_karyawan/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.querySelector('#karyawan_id').value = data.karyawan_id;
                document.querySelector('#bank_name').value = data.bank_name;
                document.querySelector('#rekening_number').value = data.rekening_number;
                document.querySelector('#pemilik_rekening').value = data.pemilik_rekening;
                $('#rekeningModal').modal('show');
            });
    }

    // Fungsi untuk menghapus rekening
    function deleteRekening(id) {
        fetch(`/rekening_karyawan/${id}`, {
                method: 'DELETE',
            })
            .then(() => {
                loadRekeningKaryawan();
            });
    }

    // Fungsi untuk mengedit transaksi
    function editTransaksi(id) {
        fetch(`/transaksi/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                document.querySelector('#transaksi_karyawan_id').value = data.karyawan_id;
                document.querySelector('#jumlah_gaji').value = data.jumlah_gaji;
                document.querySelector('#status_pembayaran').value = data.status_pembayaran;
                $('#transaksiModal').modal('show');
            });
    }

    // Fungsi untuk menghapus transaksi
    function deleteTransaksi(id) {
        fetch(`/transaksi/${id}`, {
                method: 'DELETE',
            })
            .then(() => {
                loadTransaksi();
            });
    }
</script>
