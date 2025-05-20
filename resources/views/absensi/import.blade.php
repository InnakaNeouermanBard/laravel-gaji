{{-- import.blade.php --}}
<form id="main-form" class="form-horizontal" action="{{ route('absensi.import.process') }}" role="form" method="POST"
    autocomplete="off" data-reload="true" enctype="multipart/form-data">
    @csrf
    <div id="modal-master" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Data Absensi</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <p><i class="fa fa-info-circle"></i> Petunjuk Import:</p>
                            <ol>
                                <li>Download template Excel terlebih dahulu <a
                                        href="{{ route('absensi.import.template') }}"
                                        class="btn btn-sm btn-outline-primary ms-2"><i class="fa fa-download"></i>
                                        Download Template</a></li>
                                <li>Isi data sesuai format yang ada di template</li>
                                <li>Pastikan NIK karyawan sudah terdaftar di sistem</li>
                                <li>Format kolom: NIK, Hadir, Izin, Alpha</li>
                                <li>Upload file yang sudah diisi</li>
                            </ol>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group required">
                            <label for="bulan">Bulan</label>
                            <select class="form-select form-control" id="bulan" name="bulan" required>
                                <option value="" selected disabled>Pilih Bulan</option>
                                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $bulan)
                                    <option value="{{ $index + 1 }}">{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="form-group required">
                            <label for="tahun">Tahun</label>
                            <select class="form-select form-control" id="tahun" name="tahun" required>
                                <option value="" selected disabled>Pilih Tahun</option>
                                @for ($tahun = date('Y') - 5; $tahun <= date('Y'); $tahun++)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="form-group required">
                            <label for="file">File Excel/CSV</label>
                            <div class="input-group">
                                <input type="file" class="form-control" id="file" name="file"
                                    accept=".xlsx,.xls,.csv" required>
                                <span class="input-group-text"><i class="fa fa-file-excel-o"></i></span>
                            </div>
                            <small class="text-muted">Format yang didukung: .xlsx, .xls, .csv</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer modal-footer-uniform d-flex">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" id="btn-save" class="btn btn-sm btn-primary float-end">Import Data</button>
            </div>
        </div>
    </div>
</form>
