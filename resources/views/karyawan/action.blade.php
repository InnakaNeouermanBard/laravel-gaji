<?php
$is_edit = isset($data);
?>

<form id="main-form" class="form-horizontal"
    action="{{ $is_edit ? route('karyawan.update', $data) : route('karyawan.store') }}" role="form" method="POST"
    autocomplete="off" data-reload="true">
    @csrf
    {!! $is_edit ? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $is_edit ? 'Edit' : 'Tambah' }} Karyawan</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group required">
                            <label for="id_jabatan">Jabatan</label>
                            <select class="form-select form-control" id="id_jabatan" name="id_jabatan">
                                <option value="" selected disabled>Pilih Jabatan</option>
                                @foreach ($jabatans as $item)
                                    <option value="{{ $item->id_jabatan }}"
                                        @if (isset($data->id_jabatan) && $item->id_jabatan == $data->id_jabatan) selected @endif>
                                        {{ $item->nama_jabatan }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group required">
                            <label for="no_telepon">No Telepon</label>
                            <input type="text" class="form-control" id="no_telepon" name="no_telepon"
                                value="{{ isset($data->no_telepon) ? $data->no_telepon : '' }}" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group required">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik"
                                value="{{ isset($data->nik) ? $data->nik : '' }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group required">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                value="{{ isset($data->tempat_lahir) ? $data->tempat_lahir : '' }}" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group required">
                            <label for="nama_karyawan">Nama Karyawan</label>
                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan"
                                value="{{ isset($data->nama_karyawan) ? $data->nama_karyawan : '' }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group required">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                value="{{ isset($data->tanggal_lahir) ? $data->tanggal_lahir : '' }}" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group required">
                            <label for="kelamin">Jenis Kelamin</label>
                            <select class="form-select form-control" id="kelamin" name="kelamin">
                                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                                <option value="L" @if (isset($data->kelamin) && $data->kelamin == 'L') selected @endif>
                                    Laki-Laki</option>
                                <option value="P" @if (isset($data->kelamin) && $data->kelamin == 'P') selected @endif>
                                    Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group required">
                            <label for="status_perkawinan">Status Perkawinan</label>
                            <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan"
                                value="{{ isset($data->status_perkawinan) ? $data->status_perkawinan : '' }}" required>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group required">
                            <label for="agama">Agama</label>
                            <select class="form-select form-control" id="agama" name="agama">
                                <option value="" selected disabled>Pilih Agama</option>
                                <option value="Islam" @if (isset($data->agama) && $data->agama == 'Islam') selected @endif>Islam
                                </option>
                                <option value="Kristen" @if (isset($data->agama) && $data->agama == 'Kristen') selected @endif>
                                    Kristen</option>
                                <option value="Katolik" @if (isset($data->agama) && $data->agama == 'Katolik') selected @endif>
                                    Katolik</option>
                                <option value="Hindu" @if (isset($data->agama) && $data->agama == 'Hindu') selected @endif>Hindu
                                </option>
                                <option value="Budha" @if (isset($data->agama) && $data->agama == 'Budha') selected @endif>Budha
                                </option>
                                <option value="Lainnya" @if (isset($data->agama) && $data->agama == 'Lainnya') selected @endif>
                                    Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group required">
                            <label for="tanggal_masuk">Tanggal Masuk</label>
                            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk"
                                value="{{ isset($data->tanggal_masuk) ? $data->tanggal_masuk : '' }}" required>
                        </div>
                    </div>
                    <div class="form-group required">
                        <label for="alamat_tinggal">Alamat Tinggal</label>
                        <textarea rows="10" type="text" class="form-control" id="alamat_tinggal" name="alamat_tinggal" required>{{ isset($data->alamat_tinggal) ? $data->alamat_tinggal : '' }}</textarea>
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
