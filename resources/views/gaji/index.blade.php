{{-- index  --}}
@extends('layouts.app')

@section('title', 'Gaji')

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Gaji</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Transaksi</i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Gaji</li>
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
                                    Gaji
                                </h4>
                            </div>
                            <div class="box-tools">
                                @if (auth()->user()->level == 0)
                                    <a href="#" class="btn btn-sm btn-primary mt-1 ajax_modal"
                                        data-url="{{ route('gaji.create') }}"><i class="fa fa-plus"></i>
                                        Tambah</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        Filter data gaji karyawan
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="col-12">
                                {{-- <li><a class="dropdown-item" href="#">Action</a></li> --}}
                                <form>
                                    <div class="mb-1 d-flex flex-row">
                                        {{-- @csrf --}}
                                        <div class="form-group d-flex flex-row align-items-center">
                                            <label class="mb-0 me-2" for="">Bulan</label>
                                            <select class="form-control month-filter" name="bulan">
                                                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                                    <option value="{{ $loop->index + 1 }}"
                                                        {{ $loop->index == date('n') - 1 ? 'selected' : '' }}>
                                                        {{ $bulan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group d-flex flex-row align-items-center ms-2">
                                            <label class="mb-0 me-2" for="">Tahun</label>
                                            <select class="form-control year-filter" name="tahun">
                                                @for ($tahun = date('Y') - 5; $tahun <= date('Y'); $tahun++)
                                                    <option value="{{ $tahun }}"
                                                        {{ $tahun == date('Y') ? 'selected' : '' }}>
                                                        {{ $tahun }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="form-group d-flex flex-row align-items-center ms-2">
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                Tampilkan Data</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="alert alert-info alert-dismissible">
                            @if (request()->has('bulan') && request()->has('tahun'))
                                Menampilkan data gaji karyawan bulan
                                {{ \Carbon\Carbon::createFromFormat('m', request()->get('bulan'))->locale('id')->isoFormat('MMMM') }}
                                tahun
                                {{ request()->get('tahun') }}. <a class="badge badge-pill badge-dark"
                                    href="{{ route('gaji.index') }}">Reset</a>
                            @else
                                Menampilkan data gaji karyawan bulan semua
                            @endif
                        </div>

                        <div class="table-responsives">
                            <table class="table table-striped table-hover table-full-width" id="main_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Periode</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jabatan</th>
                                        <th>Gaji Pokok</th>
                                        <th>Potongan</th>
                                        <th>Total Gaji</th>
                                        <th>Status</th>
                                        @if (auth()->user()->level != 2)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gajis as $index => $gaji)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($gaji->periode_gaji)->locale('id')->isoFormat('MMMM Y') }}
                                            </td>
                                            <td>{{ $gaji->karyawan->nik }}</td>
                                            <td>{{ $gaji->karyawan->nama_karyawan }}</td>
                                            <td>
                                                @if ($gaji->karyawan->kelamin == 'L')
                                                    Laki-Laki
                                                @else
                                                    Perempuan
                                                @endif
                                            </td>
                                            <td>{{ $gaji->karyawan->jabatan->nama_jabatan }}</td>
                                            <td>@currency($gaji->gaji_pokok)</td>
                                            <td>@currency($gaji->potongan_gaji)</td>
                                            <td>@currency($gaji->total_gaji)</td>
                                            <td>
                                                @if ($gaji->status == 0)
                                                    <span class="badge badge-info">Pending</span>
                                                @elseif ($gaji->status == 1)
                                                    <span class="badge badge-success">Acc</span>
                                                @else
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            @if (auth()->user()->level != 2)
                                                <td>
                                                    @if (auth()->user()->level == 1)
                                                        <div class="d-flex">
                                                            @if ($gaji->status == 0)
                                                                <form data-reload="true" id="main-form-delete"
                                                                    action="{{ route('gaji.approve', $gaji->id_gaji) }}"
                                                                    method="POST" class="ms-1 acc-form">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button class="acc-text btn btn-sm btn-success">
                                                                        <i class="fa fa-check"></i>
                                                                    </button>
                                                                </form>
                                                                <form data-reload="true" id="main-form-delete"
                                                                    action="{{ route('gaji.decline', $gaji->id_gaji) }}"
                                                                    method="POST" class="ms-1 acc-form">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <button class="tolak-text btn btn-sm btn-danger">
                                                                        <i class="fa fa-times-circle"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    @if (auth()->user()->level == 0)
                                                        <div class="d-flex">
                                                            <a href="#"
                                                                data-url="{{ route('gaji.edit', $gaji->id_gaji) }}"
                                                                class="btn btn-sm btn-warning ajax_modal"><i
                                                                    class="fa fa-pencil"></i></a>
                                                            <form data-reload="true" id="main-form-delete"
                                                                action="{{ route('gaji.destroy', $gaji) }}" method="POST"
                                                                class="ms-1 delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="confirm-text btn btn-sm btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- {{ $asets->links('vendor.pagination.bootstrap-4') }} --}}
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
