<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="{{ asset('images/MahesaLogo.png') }}" />

    <title>Login</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('css/vendors_css.css') }}" />

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/skin_color.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />

    <style>
        /* Menata form login lebih kecil dan di tengah */
        .auth-2-outer {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .auth-2 {
            background: rgb(255, 255, 255);
            /* Transparan dengan latar belakang putih */
            border-radius: 8px;
            padding: 20px;
            max-width: 400px;
            /* Membatasi lebar form agar lebih kecil */
            width: 100%;
            /* Agar responsive di berbagai perangkat */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            height: 50vh;
        }

        body {
            background-image: url('{{ asset('images/bgMahesaArt.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="hold-transition theme-primary bg-img">
    @yield('content')
    <!-- Vendor JS -->
    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script>
        //jquery onready
        $(document).ready(function() {
            //jquery onsubmit form
            $('#login-form').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const url = form.attr('action');
                const method = form.attr('method');
                let data = form.serialize();
                //add _token to data
                data += '&_token={{ csrf_token() }}';

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
                    beforeSend: function() {
                        //disable button
                        form.find('button').prop('disabled', true);
                        //add loading spinner
                        form.find('button').html(
                            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>'
                        );
                    },
                    success: function(response) {
                        console.log(response);
                        // const url = "{{ url('/') }}"
                        if (response.success) {
                            toastr.success(response.message);
                            setTimeout(() => {
                                window.location.href = response.data.redirect;
                            }, 1000);
                        } else {
                            toastr.error(response.message);
                        }
                        //enable button
                        form.find('button').prop('disabled', false);
                        //remove loading spinner
                        form.find('button').html('Sign In');
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        //enable button
                        form.find('button').prop('disabled', false);
                        //remove loading spinner
                        form.find('button').html('Sign In');
                        toastr.error(xhr.responseJSON.message);
                    }
                })
            })
        })
    </script>
</body>

</html>
