@extends('layouts.app')

@section('title', 'Ubah Password')

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Ubah Profile</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Ubah Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Profile</h4>
                    </div>
                    <form id="main-form-delete" action="{{ route('profile.update') }}" method="POST" autocomplete="off"
                        data-reload=true>
                        @csrf
                        {!! method_field('PUT') !!}
                        <div class="box-body">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" readonly disabled
                                    value="{{ $user->username }}">
                                <small class="text-xs text-red">Anda tidak dapat mengubah NIK yang menjadi username
                                    login anda. Silahkan
                                    hubungi admin untuk mengubah NIK anda</small>
                            </div>
                            <div class="form-group required">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" id="email" value="{{ $user->email }}"
                                    name="email">
                            </div>
                            <div class="form-group required">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" value="{{ $user->name }}"
                                    name="name">
                            </div>
                            <div class="form-group">
                                <label for="level">Role</label>
                                <input type="text" class="form-control" id="level" value="{{ $user->getRole() }}"
                                    name="level" readonly disabled>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button id="btn-save" type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Avatar</h4>
                    </div>
                    <form id="main-form-input" action="{{ route('avatar.update') }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        {!! method_field('PUT') !!}
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <img class="profile-user-img img-fluid img-circle m-0 me-25"
                                    src="{{ $user->avatar ? asset('assets/img/avatar/' . $user->avatar) : asset('assets/img/default.png') }}"
                                    alt="User profile picture" style="height: 90px;width:90px">

                                <div class="mb-3" style="width: 100%">
                                    <label for="avatar" class="form-label">Avatar Baru</label>
                                    <input class="form-control form-control" id="avatar" name="avatar" type="file">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button id="btn-save" type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Password</h4>
                    </div>
                    <form id="main-form-delete" action="{{ route('password.update') }}" method="POST" autocomplete="off"
                        data-reload="true">
                        @csrf
                        {!! method_field('PUT') !!}
                        <div class="card-body">
                            <div class="form-group required">
                                <label for="old_password">Password Lama</label>
                                <input type="password" class="form-control" id="old_password" name="old_password">
                            </div>
                            <div class="form-group required">
                                <label for="password">Password Baru</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group required">
                                <label for="password_confirmation">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button id="btn-save" type="submit" class="btn btn-sm btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
