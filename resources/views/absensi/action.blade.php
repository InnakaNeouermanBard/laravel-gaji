<?php
// FILE 1: action.blade.php (Fixed)
$is_edit = isset($data);
?>

<form id="main-form" class="form-horizontal"
    action="{{ $is_edit ? route('absensi.update', $data->id_absensi) : route('absensi.store') }}" role="form"
    method="POST" autocomplete="off" data-reload="true">
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
                        <input type="number" class="form-control" id="masuk" name="masuk" min="0"
                            max="31" value="{{ isset($data->masuk) ? $data->masuk : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="izin">Izin</label>
                        <input type="number" class="form-control" id="izin" name="izin" min="0"
                            max="31" value="{{ isset($data->izin) ? $data->izin : '' }}" required>
                    </div>
                    <div class="form-group required">
                        <label for="alpha">Alpha</label>
                        <input type="number" class="form-control" id="alpha" name="alpha" min="0"
                            max="31" value="{{ isset($data->alpha) ? $data->alpha : '' }}" required>
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

<script>
    $(document).ready(function() {
        // Validasi form sebelum submit
        $('#main-form').on('submit', function(e) {
            let masuk = parseInt($('#masuk').val()) || 0;
            let izin = parseInt($('#izin').val()) || 0;
            let alpha = parseInt($('#alpha').val()) || 0;
            let total = masuk + izin + alpha;

            // Validasi total hari tidak lebih dari 31
            if (total > 31) {
                e.preventDefault();
                toastr.error('Total hari masuk, izin, dan alpha tidak boleh lebih dari 31 hari');
                return false;
            }

            // Validasi karyawan dan bulan yang sama
            if (!$('#id_karyawan').val() || !$('#bulan').val()) {
                e.preventDefault();
                toastr.error('Karyawan dan bulan harus dipilih');
                return false;
            }
        });

        // Auto calculate sisa hari
        $('#masuk, #izin, #alpha').on('input', function() {
            let masuk = parseInt($('#masuk').val()) || 0;
            let izin = parseInt($('#izin').val()) || 0;
            let alpha = parseInt($('#alpha').val()) || 0;
            let total = masuk + izin + alpha;

            if (total > 31) {
                $(this).addClass('is-invalid');
                toastr.warning('Total hari tidak boleh lebih dari 31');
            } else {
                $('#masuk, #izin, #alpha').removeClass('is-invalid');
            }
        });
    });
</script>
