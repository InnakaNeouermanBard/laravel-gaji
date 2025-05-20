@extends('layouts.app')

@section('title', 'User')

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">User</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Master Data</i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User</li>
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
                                User
                            </h4>
                            <div class="box-tools">
                                @if (auth()->user()->level == 0)
                                    <a href="#" class="btn btn-sm btn-primary mt-1 ajax_modal"
                                        data-url="{{ route('user.create') }}"><i class="fa fa-plus"></i>
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
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        @if (auth()->user()->level == 0)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->getRole() }}</td>
                                            @if (auth()->user()->level == 0)
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="#"
                                                            data-url="{{ route('user.edit', $user->id_user) }}"
                                                            class="btn btn-sm btn-warning ajax_modal"><i
                                                                class="fa fa-pencil"></i></a>
                                                        @if ($user->level != '2')
                                                            <form data-reload="true" id="main-form-delete"
                                                                action="{{ route('user.destroy', $user) }}" method="POST"
                                                                class="ms-1 delete-form">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="confirm-text btn btn-sm btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @endif
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
