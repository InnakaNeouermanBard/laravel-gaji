@extends('layouts.app')

@section('title', 'Jabatan')

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Jabatan</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Master Data</i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Jabatan</li>
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
                                Jabatan
                            </h4>
                            <div class="box-tools">
                                <a href="#" class="btn btn-sm btn-primary mt-1 ajax_modal"
                                    data-url="{{ route('jabatan.create') }}"><i class="fa fa-plus"></i>
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
                                        <th>Nama Jabatan</th>
                                        <th>Gaji Pokok</th>
                                        {{-- <th>Tunjangan Transportasi</th>
                                        <th>Uang Makan</th> --}}
                                        <th>Uang Lembur</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jabatans as $index => $jabatan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $jabatan->nama_jabatan }}</td>
                                            <td>@currency($jabatan->gaji_pokok)</td>
                                            {{-- <td>@currency($jabatan->tunjangan_transportasi)</td>
                                            <td>@currency($jabatan->uang_makan)/hari</td> --}}
                                            <td>@currency($jabatan->uang_lembur)/jam</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#"
                                                        data-url="{{ route('jabatan.edit', $jabatan->id_jabatan) }}"
                                                        class="btn btn-sm btn-warning ajax_modal"><i
                                                            class="fa fa-pencil"></i></a>
                                                    <form data-reload="true" id="main-form-delete"
                                                        action="{{ route('jabatan.destroy', $jabatan) }}" method="POST"
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
