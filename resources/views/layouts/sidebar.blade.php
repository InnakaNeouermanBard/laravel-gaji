<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">

                    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('images/svg-icon/sidebar-menu/dashboard.svg') }}" class="svg-icon"
                                alt="" />
                            <span>
                                Dashboard
                            </span>
                        </a>
                    </li>
                    @if (auth()->user()->level != 2)
                        <li class="treeview">
                            <a href="#">
                                <img src="{{ asset('images/svg-icon/sidebar-menu/uielements.svg') }}" class="svg-icon"
                                    alt="" />
                                <span>Master Data</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @if (auth()->user()->level == 0)
                                    <li class="{{ request()->routeIs('jabatan.*') ? 'active' : '' }}">
                                        <a href="{{ route('jabatan.index') }}">
                                            <i class="ti-more"></i>
                                            <span>Jabatan</span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->level != 2)
                                    <li class="{{ request()->routeIs('karyawan.*') ? 'active' : '' }}">
                                        <a href="{{ route('karyawan.index') }}">
                                            <i class="ti-more"></i>
                                            <span>Karyawan</span>
                                        </a>
                                    </li>
                                @endif
                                @if (auth()->user()->level == 0)
                                    <li class="{{ request()->routeIs('user.*') ? 'active' : '' }}">
                                        <a href="{{ route('user.index') }}">
                                            <i class="ti-more"></i>
                                            <span>User</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                    <li class="treeview">
                        <a href="#">
                            <img src="{{ asset('images/svg-icon/sidebar-menu/transactions.svg') }}" class="svg-icon"
                                alt="" />
                            <span>Transaksi</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if (auth()->user()->level == 0)
                                <li class="{{ request()->routeIs('absensi.*') ? 'active' : '' }}">
                                    <a href="{{ route('absensi.index') }}">
                                        <i class="ti-more"></i>
                                        <span>Absensi</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('lembur.*') ? 'active' : '' }}">
                                    <a href="{{ route('lembur.index') }}">
                                        <i class="ti-more"></i>
                                        <span>Lembur</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('potong-gaji.*') ? 'active' : '' }}">
                                    <a href="{{ route('potong-gaji.index') }}">
                                        <i class="ti-more"></i>
                                        <span>Potong Gaji</span>
                                    </a>
                                </li>
                            @endif
                            <li class="{{ request()->routeIs('gaji.*') ? 'active' : '' }}">
                                <a href="{{ route('gaji.index') }}">
                                    <i class="ti-more"></i>
                                    <span>Gaji</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <img src="{{ asset('images/svg-icon/sidebar-menu/pages.svg') }}" class="svg-icon"
                                alt="" />
                            <span>Laporan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @if (auth()->user()->level == 0)
                                <li class="{{ request()->routeIs('laporan.gaji') ? 'active' : '' }}">
                                    <a href="{{ route('laporan.gaji') }}">
                                        <i class="ti-more"></i>
                                        <span>Gaji</span>
                                    </a>
                                </li>
                                <li class="{{ request()->routeIs('laporan.absen') ? 'active' : '' }}">
                                    <a href="{{ route('laporan.absen') }}">
                                        <i class="ti-more"></i>
                                        <span>Absen</span>
                                    </a>
                                </li>
                            @endif
                            <li class="{{ request()->routeIs('slip.gaji') ? 'active' : '' }}">
                                <a href="{{ route('slip.gaji') }}">
                                    <i class="ti-more"></i>
                                    <span>Slip Gaji</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item {{ request()->routeIs('ubah-profile') ? 'active' : '' }}">
                        <a href="{{ route('ubah-profile') }}">
                            <img src="{{ asset('images/svg-icon/settings.svg') }}" class="svg-icon" alt="" />
                            <span>
                                Ubah Profile
                            </span>
                        </a>
                    </li>
                    <form action="{{ route('logout') }}" id="logout" method="POST">
                        @csrf
                    </form>
                    <li class="nav-item">
                        <a id="logout-link" class="nav-link" style="cursor: pointer">
                            <img src="{{ asset('images/svg-icon/sidebar-menu/authentication.svg') }}" class="svg-icon"
                                alt="" />
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('logout-link').addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah submit langsung
            Swal.fire({
                title: 'Yakin ingin Logout?',
                text: "Anda akan keluar dari sistem saat ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    confirmButton: 'btn btn-primary me-2',
                    cancelButton: 'btn btn-outline-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika user klik Ya, submit form logout
                    document.getElementById('logout').submit();
                }
            });
        });
    </script>
</aside>
