@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Dashboard</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="alert bg-warning alert-dismissible">
            Selamat datang, Anda login sebagai karyawan
        </div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column">
                        <h3 class="card-title mt-1">
                            Data Karyawan
                        </h3>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-30">
                <div class="row align-items-center">
                    <div class="col-12 col-md-3">
                        <img src="{{ asset('assets/img/avatar/' . $profile->avatar) }}" alt="user" height="200" />
                    </div>
                    <div class="col-12 col-md-9">
                        <table class="table table-full-width">
                            <tbody>
                                <tr>
                                    <td>Nama Karyawan</td>
                                    <td>:</td>
                                    <td>{{ $profile->karyawan->nama_karyawan }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>:</td>
                                    <td>{{ $profile->karyawan->jabatan->nama_jabatan }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Masuk</td>
                                    <td>:</td>
                                    <td>{{ \Carbon\Carbon::parse($profile->karyawan->tanggal_masuk)->locale('id')->isoFormat('DD MMMM Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>No Telp</td>
                                    <td>:</td>
                                    <td>{{ $profile->karyawan->no_telepon ?? '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
