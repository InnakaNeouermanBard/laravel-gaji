{{-- index.blade.php (versi modern) --}}
@extends('layouts.app')

@section('title', 'Absensi Karyawan')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
    <style>
        .card-stats {
            transition: all 0.3s ease;
            border-radius: 10px;
            overflow: hidden;
        }

        .card-stats:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-stats .card-body {
            padding: 20px;
        }

        .card-stats .icon-big {
            font-size: 3rem;
            line-height: 1;
            width: 65px;
            height: 65px;
            text-align: center;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-stats .card-category {
            font-size: 14px;
            color: #777;
            margin-bottom: 10px;
        }

        .card-stats .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        .bg-gradient-primary {
            background: linear-gradient(45deg, #4e73df, #224abe);
        }

        .bg-gradient-success {
            background: linear-gradient(45deg, #1cc88a, #13855c);
        }

        .bg-gradient-warning {
            background: linear-gradient(45deg, #f6c23e, #dda20a);
        }

        .bg-gradient-danger {
            background: linear-gradient(45deg, #e74a3b, #be2617);
        }

        .btn-modern {
            border-radius: 50px;
            text-transform: uppercase;
            font-weight: 500;
            font-size: 12px;
            padding: 7px 18px;
            transition: all 0.3s ease;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        .datatables-card {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .datatables-card .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px;
        }

        .filter-container {
            background-color: #f8f9fc;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
        }

        .badge-modern {
            padding: 8px 12px;
            font-weight: 400;
            border-radius: 30px;
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">Absensi Karyawan</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="mdi mdi-home-outline"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Transaksi</i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Absensi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <!-- Dashboard Stats -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-stats shadow border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="icon-big text-white bg-gradient-primary">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                            <div class="col ml-3">
                                <div class="card-category">Total Karyawan</div>
                                <div class="card-title" id="total-karyawan">
                                    {{ $absensis->pluck('karyawan.id_karyawan')->unique()->count() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-stats shadow border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="icon-big text-white bg-gradient-success">
                                    <i class="fa fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="col ml-3">
                                <div class="card-category">Total Hadir</div>
                                <div class="card-title" id="total-hadir">{{ $absensis->sum('masuk') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-stats shadow border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="icon-big text-white bg-gradient-warning">
                                    <i class="fa fa-calendar-minus-o"></i>
                                </div>
                            </div>
                            <div class="col ml-3">
                                <div class="card-category">Total Izin</div>
                                <div class="card-title" id="total-izin">{{ $absensis->sum('izin') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card-stats shadow border-0">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="icon-big text-white bg-gradient-danger">
                                    <i class="fa fa-times-circle"></i>
                                </div>
                            </div>
                            <div class="col ml-3">
                                <div class="card-category">Total Alpha</div>
                                <div class="card-title" id="total-alpha">{{ $absensis->sum('alpha') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter and Table Card -->
        <div class="row">
            <div class="col-12">
                <div class="datatables-card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0 font-weight-bold text-primary">Data Absensi Karyawan</h5>
                            <div>
                                <a href="#" class="btn btn-sm btn-success btn-modern me-1" id="btn-export"
                                    onclick="event.preventDefault(); document.getElementById('export-form').submit();">
                                    <i class="fa fa-file-excel-o me-1"></i> Export
                                </a>
                                <a href="#" class="btn btn-sm btn-warning btn-modern me-1 ajax_modal"
                                    data-url="{{ route('absensi.import.form') }}">
                                    <i class="fa fa-upload me-1"></i> Import
                                </a>
                                <a href="#" class="btn btn-sm btn-primary btn-modern ajax_modal"
                                    data-url="{{ route('absensi.create') }}">
                                    <i class="fa fa-plus me-1"></i> Tambah
                                </a>

                                <form id="export-form" action="{{ route('absensi.export') }}" method="GET"
                                    style="display: none;">
                                    <input type="hidden" name="bulan" id="export-bulan"
                                        value="{{ request()->get('bulan', date('n')) }}">
                                    <input type="hidden" name="tahun" id="export-tahun"
                                        value="{{ request()->get('tahun', date('Y')) }}">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Filter Section -->
                        <div class="filter-container mb-4">
                            <form id="filter-form" method="GET">
                                <div class="row align-items-center">
                                    <div class="col-md-4 mb-2 mb-md-0">
                                        <div class="d-flex align-items-center">
                                            <label class="me-2 mb-0 text-nowrap" for="bulan">Bulan:</label>
                                            <select class="form-select form-control month-filter" name="bulan"
                                                id="bulan">
                                                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $bulan)
                                                    <option value="{{ $loop->index + 1 }}"
                                                        {{ $loop->index + 1 == request()->get('bulan', date('n')) ? 'selected' : '' }}>
                                                        {{ $bulan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2 mb-md-0">
                                        <div class="d-flex align-items-center">
                                            <label class="me-2 mb-0 text-nowrap" for="tahun">Tahun:</label>
                                            <select class="form-select form-control year-filter" name="tahun"
                                                id="tahun">
                                                @for ($tahun = date('Y') - 5; $tahun <= date('Y'); $tahun++)
                                                    <option value="{{ $tahun }}"
                                                        {{ $tahun == request()->get('tahun', date('Y')) ? 'selected' : '' }}>
                                                        {{ $tahun }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary btn-modern me-2">
                                                <i class="fa fa-filter me-1"></i> Filter
                                            </button>
                                            @if (request()->has('bulan') || request()->has('tahun'))
                                                <a href="{{ route('absensi.index') }}"
                                                    class="btn btn-outline-secondary btn-modern">
                                                    <i class="fa fa-refresh me-1"></i> Reset
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Alert status filter -->
                        @if (request()->has('bulan') && request()->has('tahun'))
                            <div class="alert alert-info alert-dismissible fade show">
                                <i class="fa fa-info-circle me-1"></i>
                                Menampilkan data kehadiran karyawan bulan
                                <strong>{{ \Carbon\Carbon::createFromFormat('m', request()->get('bulan'))->locale('id')->isoFormat('MMMM') }}</strong>
                                tahun <strong>{{ request()->get('tahun') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <!-- Data Table -->
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="dataTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Periode</th>
                                        <th>NIK</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jabatan</th>
                                        <th>Hadir</th>
                                        <th>Izin</th>
                                        <th>Alpha</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($absensis as $index => $absensi)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($absensi->bulan)->locale('id')->isoFormat('MMMM Y') }}
                                            </td>
                                            <td>{{ $absensi->karyawan->nik }}</td>
                                            <td>{{ $absensi->karyawan->nama_karyawan }}</td>
                                            <td>
                                                @if ($absensi->karyawan->kelamin == 'L')
                                                    <span class="badge bg-primary badge-modern">Laki-Laki</span>
                                                @else
                                                    <span class="badge bg-info badge-modern">Perempuan</span>
                                                @endif
                                            </td>
                                            <td>{{ $absensi->karyawan->jabatan->nama_jabatan }}</td>
                                            <td>
                                                <span class="badge bg-success badge-modern">{{ $absensi->masuk }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-warning badge-modern">{{ $absensi->izin }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger badge-modern">{{ $absensi->alpha }}</span>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="#"
                                                        data-url="{{ route('absensi.edit', $absensi->id_absensi) }}"
                                                        class="btn btn-sm btn-warning ajax_modal me-1">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>
                                                    <form data-reload="true"
                                                        id="main-form-delete-{{ $absensi->id_absensi }}"
                                                        action="{{ route('absensi.destroy', $absensi) }}" method="POST"
                                                        class="delete-form">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>

    <script>
        $(document).ready(function() {
            // DataTable initialization
            $('#dataTable').DataTable({
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Cari data...",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ data",
                    infoEmpty: "Tidak ada data yang tersedia",
                    infoFiltered: "(difilter dari _MAX_ total data)",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Selanjutnya",
                        previous: "Sebelumnya"
                    },
                },
            });

            // Update export form saat filter berubah
            $('#bulan, #tahun').change(function() {
                $('#export-bulan').val($('#bulan').val());
                $('#export-tahun').val($('#tahun').val());
            });

            // Konfirmasi hapus dengan form submit langsung
            $('.confirm-text').click(function(e) {
                e.preventDefault();

                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    var form = $(this).closest('form');
                    form.attr('data-reload', 'true'); // Pastikan attr ini ada
                    form.submit();
                }
            });

            // Flash messages untuk notifikasi
            setTimeout(function() {
                $('.alert-success, .alert-danger, .alert-info').fadeOut('slow');
            }, 5000); // Notifikasi akan hilang setelah 5 detik
        });
    </script>
@endsection
