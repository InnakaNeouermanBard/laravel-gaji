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
        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $data_karyawan }}</h3>
                        <p>Data Karyawan</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="nav-icon fas fa-user-alt"></i> --}}
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $data_admin }}</h3>
                        <p>Data Admin</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="nav-icon fas fa-users"></i> --}}
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $data_jabatan }}</h3>
                        <p>Data Jabatan</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="nav-icon fas fa-graduation-cap"></i> --}}
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $data_kehadiran }}</h3>
                        <p>Data Kehadiran</p>
                    </div>
                    <div class="icon">
                        {{-- <i class="nav-icon fas fa-calendar"></i> --}}
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
