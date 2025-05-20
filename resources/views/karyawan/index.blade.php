@extends('layouts.app')

@section('title', 'Karyawan')

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Karyawan</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Master Data</i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Karyawan</li>
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
                            <h4 class="box-title mt-1">
                                Karyawan
                            </h4>
                            <div class="box-tools">
                                @if (auth()->user()->level == 0)
                                    <a href="#" class="btn btn-sm btn-primary mt-1 ajax_modal"
                                        data-url="{{ route('karyawan.create') }}"><i class="fa fa-plus"></i>
                                        Tambah</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsives">
                            <table class="table table-striped table-hover table-full-width" id="main_table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jabatan</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Status</th>
                                        @if (auth()->user()->level == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($karyawans as $index => $karyawan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $karyawan->nik }}</td>
                                            <td>{{ $karyawan->nama_karyawan }}</td>
                                            <td>
                                                @if ($karyawan->kelamin == 'L')
                                                    Laki-Laki
                                                @else
                                                    Perempuan
                                                @endif
                                            </td>
                                            <td>{{ $karyawan->jabatan->nama_jabatan }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($karyawan->tanggal_masuk)->locale('id')->isoFormat('DD MMMM Y') }}
                                            </td>
                                            <td>{{ $karyawan->status_perkawinan }}</td>
                                            @if (auth()->user()->level == 0)
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#"
                                                            data-url="{{ route('karyawan.edit', $karyawan->id_karyawan) }}"
                                                            class="btn btn-sm btn-warning ajax_modal"><i
                                                                class="fa fa-pencil"></i></a>
                                                        <form data-reload="true" id="main-form-delete"
                                                            action="{{ route('karyawan.destroy', $karyawan) }}"
                                                            method="POST" class="ms-1 delete-form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="confirm-text btn btn-sm btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
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
