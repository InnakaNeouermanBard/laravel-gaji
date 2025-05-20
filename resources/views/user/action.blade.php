<?php
$is_edit = isset($data);
?>

<form id="main-form" class="form-horizontal" action="{{ $is_edit ? route('user.update', $data) : route('user.store') }}"
    role="form" method="POST" autocomplete="off" data-reload="true">
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
                    <div class="col-12">
                        <div class="form-group required">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ isset($data->username) ? $data->username : '' }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group required">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ isset($data->name) ? $data->name : '' }}" required>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group required">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="{{ isset($data->email) ? $data->email : '' }}" required>
                        </div>
                    </div>
                    @if (isset($data->level) && $data->level == '2')
                        <input type="hidden" name="level" value="{{ $data->level }}" />
                    @else
                        <div class="col-12">
                            <div class="form-group required">
                                <label for="level">Jabatan</label>
                                <select class="form-select form-control" id="level" name="level">
                                    <option value="" selected disabled>Pilih Jabatan</option>
                                    <option value="0" @if (isset($data->level) && $data->level == '0') selected @endif>
                                        Admin</option>
                                    <option value="1" @if (isset($data->level) && $data->level == '1') selected @endif>
                                        Manager Keuangan</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" />
                        </div>
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
