@extends('layouts.auth')

@section('content')
    <!-- Animated Background -->
    <div class="bg-animation">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Login Container -->
    <div class="login-container">
        <div class="login-card">
            <!-- Loading Overlay -->
            <div class="loading-overlay" id="loadingOverlay">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>

            <!-- Brand Section -->
            <div class="brand-section">
                <div class="brand-logo">
                    <img src="{{ asset('images/MahesaLogo.png') }}" alt="">
                </div>
                <h1 class="brand-title">Mahesa Art Studio</h1>
                <p class="brand-subtitle">Masuk untuk mengelola sistem</p>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="post" class="form-element" autocomplete="off" id="login-form">
                @csrf

                <div class="form-group">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" class="form-control" placeholder="Username" name="username" required
                        autocomplete="username" value="{{ old('username') }}" />
                    @error('username')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" class="form-control" placeholder="Password" name="password" required
                        autocomplete="current-password" />
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <button type="submit" class="btn btn-login" id="loginBtn">
                    <span id="btnText">Sign In</span>
                </button>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
        }

        /* Override any existing background */
        .hold-transition {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            background-image: none !important;
        }

        /* Animated background particles */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .particle:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 120px;
            height: 120px;
            left: 20%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 60px;
            height: 60px;
            left: 70%;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            width: 100px;
            height: 100px;
            left: 80%;
            animation-delay: 1s;
        }

        .particle:nth-child(5) {
            width: 40px;
            height: 40px;
            left: 90%;
            animation-delay: 3s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
                opacity: 0.3;
            }

            50% {
                transform: translateY(-100px) rotate(180deg);
                opacity: 0.8;
            }
        }

        .login-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 450px;
            margin: 0 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 3rem 2.5rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            animation: slideUp 0.8s ease-out;
            position: relative;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 35px 70px rgba(0, 0, 0, 0.2);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .brand-section {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .brand-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            animation: pulse 2s infinite;
        }

        .brand-logo i {
            font-size: 2rem;
            color: white;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .brand-title {
            font-size: 1.8rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
        }

        .brand-subtitle {
            color: #6c757d;
            font-size: 0.95rem;
            font-weight: 400;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-control {
            background: rgba(248, 249, 250, 0.8) !important;
            border: 2px solid #e9ecef !important;
            border-radius: 12px !important;
            padding: 1rem 1rem 1rem 3rem !important;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05) !important;
            height: auto !important;
        }

        .form-control:focus {
            background: white !important;
            border-color: #667eea !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
            outline: none !important;
        }

        .form-control::placeholder {
            color: #adb5bd;
            font-weight: 400;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.1rem;
            z-index: 3;
        }

        .btn-login {
            background: linear-gradient(135deg, #1c40e0 0%, #f1e4ff 100%) !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 1rem 2rem !important;
            font-size: 1rem;
            font-weight: 600;
            color: white !important;
            width: 100%;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 15px 35px rgb(0, 36, 198) !important;
            background: linear-gradient(135deg, #0d35e6 0%, #dbcaed 100%) !important;
            color: white !important;
        }

        .btn-login:active {
            transform: translateY(0) !important;
        }

        .btn-login:disabled {
            opacity: 0.7 !important;
            cursor: not-allowed !important;
            transform: none !important;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }

        /* Loading animation */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: none;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            z-index: 10;
        }

        .loading-overlay.show {
            display: flex !important;
        }

        /* Alert styles */
        .alert {
            border-radius: 10px;
            border: none;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border-left: 4px solid #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        /* Mobile Responsiveness */
        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
                border-radius: 15px;
            }

            .brand-title {
                font-size: 1.5rem;
            }

            .brand-logo {
                width: 60px;
                height: 60px;
            }

            .brand-logo i {
                font-size: 1.5rem;
            }

            .form-control {
                padding: 0.875rem 0.875rem 0.875rem 2.5rem !important;
            }

            .input-icon {
                left: 0.875rem;
            }

            .btn-login {
                padding: 0.875rem 1.5rem !important;
            }
        }

        @media (max-width: 480px) {
            .login-container {
                margin: 0 10px;
            }

            .login-card {
                padding: 1.5rem 1rem;
            }
        }

        /* Override auth-2-outer if exists */
        .auth-2-outer {
            width: 100% !important;
            height: 100vh !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Hide old auth-2 styles */
        .auth-2:not(.login-card) {
            display: none !important;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Configure toastr if available
            if (typeof toastr !== 'undefined') {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
            }

            // Form submission (keeping your original AJAX logic)
            $('#login-form').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const url = form.attr('action');
                const method = form.attr('method');
                const loginBtn = $('#loginBtn');
                const btnText = $('#btnText');
                const loadingOverlay = $('#loadingOverlay');
                let data = form.serialize();
                data += '&_token={{ csrf_token() }}';

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    beforeSend: function() {
                        // Show loading state
                        loginBtn.prop('disabled', true);
                        btnText.html(
                            '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Signing In...'
                        );
                        loadingOverlay.addClass('show');
                    },
                    success: function(response) {
                        console.log(response);
                        loadingOverlay.removeClass('show');

                        if (response.success) {
                            if (typeof toastr !== 'undefined') {
                                toastr.success(response.message);
                            }
                            setTimeout(() => {
                                window.location.href = response.data.redirect;
                            }, 1000);
                        } else {
                            if (typeof toastr !== 'undefined') {
                                toastr.error(response.message);
                            }
                            resetButton();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        loadingOverlay.removeClass('show');

                        if (typeof toastr !== 'undefined') {
                            toastr.error(xhr.responseJSON?.message || 'An error occurred');
                        }
                        resetButton();
                    }
                });

                function resetButton() {
                    loginBtn.prop('disabled', false);
                    btnText.html('Sign In');
                }
            });

            // Input focus animations
            $('.form-control').on('focus', function() {
                $(this).parent().find('.input-icon').css('color', '#667eea');
            });

            $('.form-control').on('blur', function() {
                $(this).parent().find('.input-icon').css('color', '#6c757d');
            });
        });
    </script>
@endpush
