@extends('layouts.app')

@section('title', 'Lembur')

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Lembur</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Transaksi</i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Lembur</li>
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
                                    Lembur
                                </h4>
                            </div>
                            <div class="box-tools">
                                <a href="#" class="btn btn-sm btn-primary mt-1 ajax_modal"
                                    data-url="{{ route('lembur.create') }}"><i class="fa fa-plus"></i>
                                    Tambah</a>
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
                                        <th>Tanggal</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jam</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lemburs as $index => $lembur)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($lembur->tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                                            </td>
                                            <td>{{ $lembur->karyawan->nik }}</td>
                                            <td>{{ $lembur->karyawan->nama_karyawan }}</td>
                                            <td>{{ $lembur->jam }}</td>
                                            <td>{{ $lembur->keterangan ?? '-' }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#"
                                                        data-url="{{ route('lembur.edit', $lembur->id_lembur) }}"
                                                        class="btn btn-sm btn-warning ajax_modal"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <form data-reload="true" id="main-form-delete"
                                                        action="{{ route('lembur.destroy', $lembur) }}" method="POST"
                                                        class="ms-1 delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="confirm-text btn btn-sm btn-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
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
