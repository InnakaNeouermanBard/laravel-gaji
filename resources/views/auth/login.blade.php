@extends('layouts.auth')
@section('content')
    <div class="auth-2-outer row align-items-center h-p100 m-0">
        <div class="auth-2">
            <div class="auth-logo fs-30">
                <a href="/"><b>Mahesa Art Studio</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="auth-body">
                <p class="auth-msg">Masuk untuk mengelola sistem</p>

                <form action="{{ route('login') }}" method="post" class="form-element" autocomplete="off" id="login-form">
                    @csrf
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" placeholder="Username" name="username" required />
                        <span class="ion ion-account form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" required />
                        <span class="ion ion-locked form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-rounded mt-10 btn-success">SIGN IN</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
