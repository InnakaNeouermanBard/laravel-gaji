<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Mahesa Art Studio - Management System" />
    <meta name="author" content="" />
    <link rel="icon" href="{{ asset('images/MahesaLogo.png') }}" />

    <title>@yield('title', 'Login') - Mahesa Art Studio</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap CSS (if not using vendors_css) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vendors Style (Keep your existing styles) -->
    <link rel="stylesheet" href="{{ asset('css/vendors_css.css') }}" />

    <!-- Style (Keep your existing styles) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/skin_color.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />

    <!-- Custom Styles -->
    @stack('styles')
</head>

<body class="hold-transition theme-primary">

    @yield('content')

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <!-- Vendor JS (Keep your existing scripts) -->
    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>

    <!-- Custom Scripts -->
    @stack('scripts')

</body>

</html>
