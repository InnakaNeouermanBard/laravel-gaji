{{-- action.blade  --}}
<?php
$is_edit = isset($data);
?>

<form id="main-form" class="form-horizontal"
    action="{{ $is_edit ? route('absensi.update', $data) : route('absensi.store') }}" role="form" method="POST"
    autocomplete="off" data-reload="true">
    @csrf
    {!! $is_edit ? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Absensi</h5>
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
                        <label for="bulan">Bulan</label>
                        <input type="month" class="form-control" id="bulan" name="bulan"
                            value="{{ isset($data->bulan) ? $data->bulan : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="masuk">Masuk</label>
                        <input type="text" class="form-control" id="masuk" name="masuk"
                            value="{{ isset($data->masuk) ? $data->masuk : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="izin">Izin</label>
                        <input type="text" class="form-control" id="izin" name="izin"
                            value="{{ isset($data->izin) ? $data->izin : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="alpha">Alpha</label>
                        <input type="text" class="form-control" id="alpha" name="alpha"
                            value="{{ isset($data->alpha) ? $data->alpha : '' }}" required>
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
