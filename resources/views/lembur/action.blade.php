<?php
$is_edit = isset($data);
?>

<form id="main-form" class="form-horizontal"
    action="{{ $is_edit ? route('lembur.update', $data) : route('lembur.store') }}" role="form" method="POST"
    autocomplete="off" data-reload="true">
    @csrf
    {!! $is_edit ? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Lembur</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group required">
                        <label for="id_karyawan">Karyawan</label>
                        <select class="form-select form-control" id="id_karyawan" name="id_karyawan" required>
                            <option value="" selected disabled>Pilih Karyawan</option>
                            @foreach ($karyawans as $item)
                                <option value="{{ $item->id_karyawan }}"
                                    @if (isset($data->id_karyawan) && $item->id_karyawan == $data->id_karyawan) selected @endif>
                                    {{ $item->nama_karyawan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group required">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="{{ isset($data->tanggal) ? $data->tanggal : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="jam">Jumlah Jam</label>
                        <input type="text" class="form-control" id="jam" name="jam"
                            value="{{ isset($data->jam) ? $data->jam : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan"
                            value="{{ isset($data->keterangan) ? $data->keterangan : '' }}" required>
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
