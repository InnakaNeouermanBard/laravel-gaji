<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="icon" href="{{ asset('images/MahesaLogo.png') }}" />

    <title>Penggajian | @yield('title')</title>

    <!-- Vendors Style -->
    <link rel="stylesheet" href="{{ asset('css/vendors_css.css') }}" />

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/skin_color.css') }}" />
    {{-- <link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}" />
    <style>
        .template {
            position: 'absolute';
            height: 0px;
            z-index: 1;
        }

        .floating {
            position: 'absolute';
            z-index: 2;
        }

        .clicked g {
            cursor: pointer;
        }

        .theme-primary .label-white {
            background-color: white !important;
            color: black !important;
        }

        /* Style for required fields */
        .required label::after {
            content: '*';
            color: red;
            margin-left: 3px;
        }

        /* Hide asterisk for non-required fields */

        #main-table .dataTables_filter input {
            background-color: red !important;
        }

        .dark-mode .swal2-popup {
            background-color: #112547;
            color: #e9ecef;
        }

        .swal2-content {
            color: #e9ecef !important;
        }
    </style>
</head>

<body class="hold-transition dark-skin dark-mode sidebar-mini theme-primary fixed">
    <div class="wrapper">
        @include('layouts.navbar')
        <!-- comment -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="container-full">
                <!-- Content Header (Page header) -->
                @yield('content')
                <!-- /.content -->
            </div>
        </div>
        <!-- /.content-wrapper -->


        <footer class="main-footer">
            &copy;{{ date('Y') }}
            <a href="#">PT Mahesa Art Studio</a>. Bekasi Utara.
        </footer>
    </div>

    <!-- Page Content overlay -->

    <!-- Vendor JS -->
    <script src="{{ asset('js/vendors.min.js') }}"></script>
    <script src="{{ asset('js/pages/chat-popup.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('js/jquery-validation/jquery.validate.min.js') }}"></script>

    <!-- Crypto Tokenizer Admin App -->
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/jquery-validation/localization/messages_id.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('js/sweetalert/sweetalert2.all.min.js') }}" type="text/javascript"></script>

    @stack('scripts')

    <!-- modal -->
    <div class="modal center-modal fade" id="ajax-modal"></div>

    <script>
        $(function() {
            $("#main_table").DataTable({
                "lengthChange": false,
                "autoWidth": true,
            })
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
    <script>
        var $modal = $('#ajax-modal')

        function isJSON(str) {
            if (typeof str == 'string') {
                return false
            } else {
                return true
            }
        }

        var hl = function(element, errorClass, validClass) {
            $(element).removeClass('is-valid').addClass('is-invalid')
            let elem = $(element)
            if (elem.hasClass('select2-offscreen')) {
                $('#s2id_' + elem.attr('id') + ' ul').addClass(errorClass)
            }
        }
        var uhl = function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid')
            let elem = $(element)
            if (elem.hasClass('select2-offscreen')) {
                $('#s2id_' + elem.attr('id') + ' ul').removeClass(errorClass)
            }
        }
        var sc = function(label, element) {
            label.remove()
            $(element).removeClass('is-invalid')
        }
        var erp = function(error, element) {
            // render error placement for each input type
            if (element.is('select') && (element.hasClass('select2') || element.hasClass(
                    'select2-hidden-accessible'))) {
                $(element).parent().append(error)
            } else if (element.is('select') || element.attr('type') == 'radio' || element.attr('type') == 'checkbox' ||
                element.attr('type') == 'textarea') {
                // for chosen elements, need to insert the error after the chosen container
                //} else if (element.is("select") || element.attr("type") == "radio" || element.attr("type") == "checkbox" || element.attr("type") == "file" || element.attr("type") == "textarea") { // for chosen elements, need to insert the error after the chosen container
                error.insertAfter($(element).closest('.form-group').children('div').children().last())
            } else if (element.is('select')) {
                error.appendTo($(element).parent())
            } else if (element.hasClass('ckeditor')) {
                error.appendTo($(element).closest('.form-group'))
            } else if ($(element).parent().hasClass('input-group')) {
                $(element).parent().append(error)
            } else if ($(element).parent().hasClass('custom-file')) {
                $(element).parent().parent().append(error)
            } else {
                error.insertAfter(element)
            }
        }

        function resetForm(el, exc) {
            exc = (typeof exc != 'undefined') ? exc : '';
            $('.select2, .selectbox', el).not(exc).val("").trigger("change");
            $(':input', el).not(':button, :submit, :reset, :radio' + ((exc.length > 0) ? ',' + exc : '')).val('').prop(
                'selected', false);
            $('label.custom-file-label').text('');
        }

        function getError(data) {
            if (data.hasOwnProperty('success')) {
                if (!data.success) {
                    if (data?.message?.toLowerCase().includes('validation')) {
                        const datas = data?.data;
                        for (const key in datas) {
                            if (datas.hasOwnProperty(key)) {
                                const element = datas[key];
                                toastr.error(element);
                            }
                        }
                    } else {
                        toastr.error(data.message);
                    }
                }
            } else {
                toastr.error(data.message);
            }
        }

        function showLoadingButton(btn) {
            btn.attr('disabled', true);
            btn.html('<i class="fa fa-spinner fa-spin"></i>');
        }

        function hideLoadingButton(btn) {
            btn.attr('disabled', false);
            btn.html('Simpan');
        }

        //#GetIconPicker on click
        // $(document).on('click', '#GetIconPicker', function(e) {
        //     // alert('ok')
        // })

        $(document).on('submit', '#main-form-file', function(e) {
            e.preventDefault();
            var form = $(this);
            //get the data-reload="true" attribute
            var reload = form.data('reload');
            var btn_save = $(this).find('#btn-save');
            var url = form.attr('action');
            var method = form.attr('method');
            var formData = new FormData(this); // Create FormData object from the form

            // If you want to append additional data to FormData dynamically
            // formData.append('key', 'value');

            $.ajax({
                url: url,
                method: method,
                data: formData, // Pass formData directly
                processData: false, // Important: Don't process the data
                contentType: false, // Important: Don't set contentType
                beforeSend: function() {
                    showLoadingButton(btn_save);
                },
                success: function(data) {
                    // unblockUI(form);
                    // setFormMessage('.form-message', data);
                    hideLoadingButton(btn_save);
                    if (data.success) {
                        resetForm('#form-master');
                        toastr.success(data.message);
                        if (reload) {
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        } else {
                            dataMaster.draw(false);
                        }
                    } else {
                        getError(data);
                    }
                    closeModal($modal, data);
                }
            });
        });


        $(document).on('submit', '#main-form-input', function(e) {
            e.preventDefault();
            var form = $(this);
            var btn_save = $(this).find('#btn-save');
            var url = form.attr('action');
            var method = form.attr('method');
            let formData = new FormData($('#main-form-input')[0]);

            $.ajax({
                url: url,
                method: method,
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                beforeSend: function() {
                    showLoadingButton(btn_save);
                },
                success: function(data) {
                    // unblockUI(form);
                    // setFormMessage('.form-message', data);
                    hideLoadingButton(btn_save);
                    if (data.success) {
                        resetForm('#form-master');
                        toastr.success(data.message);
                        // dataMaster.draw(false);
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        getError(data)
                    }
                    closeModal($modal, data);
                }
            });
        });

        $(".confirm-text").on("click", function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah yakin untuk menghapus data ini?',
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: !1,
                allowOutsideClick: false,
            }).then(function(t) {
                if (t.value) {
                    // If user confirms deletion, submit the associated form
                    deleteButton.closest("form").submit();
                }
            });
        })

        $(".acc-text").on("click", function(e) {
            e.preventDefault();
            var accButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Approve',
                text: 'Apakah yakin untuk approve gaji ini?',
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: !1,
                allowOutsideClick: false,
            }).then(function(t) {
                if (t.value) {
                    // If user confirms deletion, submit the associated form
                    accButton.closest("form").submit();
                }
            });
        })

        $(".tolak-text").on("click", function(e) {
            e.preventDefault();
            var accButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Tolak',
                text: 'Apakah yakin untuk menolak gaji ini?',
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ml-1",
                buttonsStyling: !1,
                allowOutsideClick: false,
            }).then(function(t) {
                if (t.value) {
                    // If user confirms deletion, submit the associated form
                    accButton.closest("form").submit();
                }
            });
        })

        $('body').on('click', '.ajax_modal', function(ev) {
            ev.preventDefault()
            let u = $(this).data('url')

            //fetch with ajax
            $.ajax({
                url: u,
                type: 'GET',
                success: function(response) {
                    if (!isJSON(response)) {
                        $modal.html(response)
                        $modal.modal('show')
                    } else {
                        toastr.error(response?.message)
                    }
                },
                error: function(error) {
                    toastr.error(error.responseJSON.error)
                }
            })
        })

        $('#ajax-modal').on('show.bs.modal', function(e) {
            var rules = {}

            // Iterate over input blocks with the class 'required' inside the modal
            $('.input-blockss').each(function() {
                if ($(this).find('[required]').length > 0) {
                    // Get the input element inside the current input block
                    var formElements = $(this).find('input, select, textarea')

                    // Iterate over each form element
                    formElements.each(function() {
                        // Get the element's name attribute
                        var fieldName = $(this).attr('name')

                        // Add the rule to the rules object
                        rules[fieldName] = {
                            required: true
                        }
                    })
                }
            })

            //console.log(rules)

            // Initialize form validation with dynamic rules for the form inside the modal
            $('#main-form', this).validate({
                rules: rules,
                submitHandler: function(form) {
                    e.preventDefault();
                    var reload = $(form).data('reload');
                    var btn_save = $(form).find('#btn-save');
                    var url = $(form).attr('action');
                    var method = $(form).attr('method');
                    var data = $(form).serialize();

                    $.ajax({
                        url: url,
                        method: method,
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            showLoadingButton(btn_save);
                        },
                        success: function(data) {
                            hideLoadingButton(btn_save);
                            if (data.success) {
                                resetForm('#form-master');
                                toastr.success(data.message);
                                if (reload) {
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1000);
                                } else {
                                    dataMaster.draw(false);
                                }
                            } else {
                                getError(data);
                            }
                            closeModal($modal, data);
                        }
                    });
                },
                validClass: 'valid-feedback',
                errorElement: 'div',
                errorClass: 'invalid-feedback',
                errorPlacement: erp,
                highlight: hl,
                unhighlight: uhl,
                success: sc
            })
        })

        $(document).on('submit', '#main-form-delete', function(e) {
            e.preventDefault();
            var form = $(this);
            //get the data-reload="true" attribute
            var reload = form.data('reload');
            var back = form.data('back');
            var btn_save = $(this).find('#btn-save');
            var url = form.attr('action');
            var method = form.attr('method');
            var data = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: data,
                dataType: 'json',
                beforeSend: function() {
                    showLoadingButton(btn_save);
                },
                success: function(data) {
                    // unblockUI(form);
                    // setFormMessage('.form-message', data);
                    hideLoadingButton(btn_save);
                    if (data.success) {
                        resetForm('#form-master');
                        toastr.success(data.message);
                        if (reload) {
                            setTimeout(() => {
                                location.reload();
                            }, 800);
                        } else if (back) {
                            setTimeout(() => {
                                location.href = back;
                            }, 800)
                        } else {
                            dataMaster.draw(false);
                        }
                    } else {
                        getError(data)
                    }
                },
                error: function(err) {
                    // console.log(err)
                    hideLoadingButton(btn_save);
                    toastr.error(err.statusText)
                }
            });
        });

        $(".confirm-text").on("click", function(e) {
            e.preventDefault();
            var deleteButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: 'Apakah yakin untuk menghapus data ini?',
                type: "warning",
                color: '#ffffff',
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: "btn btn-sm btn-primary",
                cancelButtonClass: "btn btn-sm btn-danger ms-1",
                buttonsStyling: !1,
                allowOutsideClick: false,
            }).then(function(t) {
                if (t.value) {
                    // If user confirms deletion, submit the associated form
                    deleteButton.closest("form").submit();
                }
            });
        })

        $(".acc-text").on("click", function(e) {
            e.preventDefault();
            var accButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Approve',
                text: 'Apakah yakin untuk approve gaji ini?',
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ms-1",
                buttonsStyling: !1,
                allowOutsideClick: false,
            }).then(function(t) {
                if (t.value) {
                    // If user confirms deletion, submit the associated form
                    accButton.closest("form").submit();
                }
            });
        })

        $(".tolak-text").on("click", function(e) {
            e.preventDefault();
            var accButton = $(this);
            Swal.fire({
                title: 'Konfirmasi Tolak',
                text: 'Apakah yakin untuk menolak gaji ini?',
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                confirmButtonClass: "btn btn-primary",
                cancelButtonClass: "btn btn-danger ms-1",
                buttonsStyling: !1,
                allowOutsideClick: false,
            }).then(function(t) {
                if (t.value) {
                    // If user confirms deletion, submit the associated form
                    accButton.closest("form").submit();
                }
            });
        })
    </script>

    @if (Session::has('error'))
        <script>
            toastr.error('{!! Session::get('error') !!}');
        </script>
    @endif

    @if (Session::has('warning'))
        <script>
            toastr.warning('{!! Session::get('warning') !!}');
        </script>
    @endif
</body>

</html>
