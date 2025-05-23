<?php
$is_edit = isset($data);
?>
{{-- lembur.action  --}}
<form id="main-form" class="form-horizontal"
    action="{{ $is_edit ? route('rekening_karyawan.update', $data) : route('rekening_karyawan.store') }}" role="form"
    method="POST" autocomplete="off" data-reload="true">
    @csrf
    {!! $is_edit ? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Rekening</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group required">
                        <label for="karyawan_id">Karyawan</label>
                        <select class="form-select form-control" id="karyawan_id" name="karyawan_id" required>
                            <option value="" selected disabled>Pilih Karyawan</option>
                            @foreach ($karyawans as $item)
                                <option value="{{ $item->id_karyawan }}"
                                    @if (isset($data->id_karyawan) && $item->id_karyawan == $data->id_karyawan) selected @endif>
                                    {{ $item->nama_karyawan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group required">
                        <label for="bank_name">Bank</label>
                        <input type="text" class="form-control" id="bank_name" name="bank_name"
                            value="{{ isset($data->bank_name) ? $data->bank_name : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="rekening_number">Nomor Rekening</label>
                        <input type="number" class="form-control" id="rekening_number" name="rekening_number"
                            value="{{ isset($data->rekening_number) ? $data->rekening_number : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="pemilik_rekening">Pemilik Rekening</label>
                        <input type="text" class="form-control" id="pemilik_rekening" name="pemilik_rekening"
                            value="{{ isset($data->pemilik_rekening) ? $data->pemilik_rekening : '' }}" required>
                    </div>
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
