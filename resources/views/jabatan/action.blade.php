<?php
$is_edit = isset($data);
?>

<form id="main-form" class="form-horizontal"
    action="{{ $is_edit ? route('jabatan.update', $data) : route('jabatan.store') }}" role="form" method="POST"
    autocomplete="off" data-reload="true">
    @csrf
    {!! $is_edit ? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Jabatan</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group required">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan"
                            value="{{ isset($data->nama_jabatan) ? $data->nama_jabatan : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="gaji_pokok">Gaji Pokok</label>
                        <input type="text" class="form-control" id="gaji_pokok" name="gaji_pokok"
                            value="{{ isset($data->gaji_pokok) ? $data->gaji_pokok : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="uang_lembur">Uang Lembur (/jam)</label>
                        <input type="text" class="form-control" id="uang_lembur" name="uang_lembur"
                            value="{{ isset($data->uang_lembur) ? $data->uang_lembur : '' }}" required>
                        <small class="text-xs text-muted">Masukkan nominal uang lembur per jam</small>
                    </div>
                    {{-- <div class="form-group required">
                        <label for="tunjangan_transportasi">Tunjangan Transportasi</label>
                        <input type="text" class="form-control" id="tunjangan_transportasi"
                            name="tunjangan_transportasi"
                            value="{{ isset($data->tunjangan_transportasi) ? $data->tunjangan_transportasi : '' }}"
                            required>
                    </div> --}}
                    {{-- <div class="form-group required">
                        <label for="uang_makan">Uang Makan (/hari)</label>
                        <input type="text" class="form-control" id="uang_makan" name="uang_makan"
                            value="{{ isset($data->uang_makan) ? $data->uang_makan : '' }}" required>
                        <small class="text-xs text-muted">Masukkan nominal uang makan per hari</small>
                    </div> --}}
                </div>
            </div>
            <div class="modal-footer modal-footer-uniform d-flex">
                <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" id="btn-save"
                    class="btn btn-sm btn-primary float-end">{{ $is_edit ? 'Update' : 'Simpan' }}</button>
            </div>
        </div>
    </div>
</form>
