@extends('layouts.app')

@section('title', 'Slip Gaji')

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Slip Gaji</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Laporan</i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Slip Gaji</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <h4 class="box-title mt-1">
                                    Slip Gaji
                                </h4>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        Filter slip gaji karyawan
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="col-12">
                                {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                                <form method="POST" action="{{ route('slip.gaji.print') }}">
                                    <div class="row mb-1">
                                        @csrf
                                        <div class="form-group col-4 d-flex flex-row align-items-center">
                                            <label class="mb-0 me-10" for="">Bulan</label>
                                            <select class="form-control month-filter" name="bulan">
                                                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                                    <option value="{{ $loop->index + 1 }}"
                                                        {{ $loop->index == date('n') - 1 ? 'selected' : '' }}>
                                                        {{ $bulan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-4 d-flex flex-row align-items-center">
                                            <label class="mb-0 me-10" for="">Tahun</label>
                                            <select class="form-control year-filter" name="tahun">
                                                @for ($tahun = date('Y') - 5; $tahun <= date('Y'); $tahun++)
                                                    <option value="{{ $tahun }}"
                                                        {{ $tahun == date('Y') ? 'selected' : '' }}>
                                                        {{ $tahun }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group col-4 d-flex flex-row align-items-center">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Cetak Slip Gaji</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
