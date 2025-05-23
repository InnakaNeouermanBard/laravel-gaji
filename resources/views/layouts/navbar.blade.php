<header class="main-header">
    <div class="d-flex align-items-center logo-box justify-content-start">
        <a href="#" class="waves-effect waves-light nav-link rounded d-none d-md-inline-block push-btn"
            data-toggle="push-menu" role="button">
            <img src="{{ asset('images/svg-icon/collapse.svg') }}" class="img-fluid svg-icon" alt="" />
        </a>
        <!-- Logo -->
        <a href="{{ route('dashboard') }}" class="logo">
            <div class="logo-lg fs-4 fw-bold">Penggajian</div>
        </a>
    </div>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <div class="app-menu">
            <ul class="header-megamenu nav">
                <li class="btn-group nav-item d-md-none">
                    <a href="#" class="waves-effect waves-light nav-link push-btn btn-outline no-border"
                        data-toggle="push-menu" role="button">
                        <img src="{{ asset('images/svg-icon/collapse.svg') }}" class="img-fluid svg-icon"
                            alt="" />
                    </a>
                </li>
                <li class="btn-group nav-item">
                    <a href="#" data-provide="fullscreen"
                        class="waves-effect waves-light nav-link btn-outline no-border full-screen" title="Full Screen">
                        <img src="{{ asset('images/svg-icon/fullscreen.svg') }}" class="img-fluid svg-icon"
                            alt="" />
                    </a>
                </li>
                <li class="btn-group d-lg-inline-flex d-none">
                    <div class="app-menu"></div>
                </li>
            </ul>
        </div>

        <div class="navbar-custom-menu r-side">
            <ul class="nav navbar-nav">
                <!-- Notifications -->


                <!-- User Account-->
                {{-- <li class="dropdown user user-menu">
                    <a href="#" class="waves-effect waves-light dropdown-toggle btn-outline no-border"
                        data-bs-toggle="dropdown" title="User">
                        <img src="{{ asset('images/svg-icon/user.svg') }}" class="rounded svg-icon" alt="" />
                    </a>
                    <ul class="dropdown-menu animated flipInX">
                        <li class="user-body">
                            <a class="dropdown-item" href="#"><i class="ti-user text-muted me-2"></i> Profile</a>
                            <a class="dropdown-item" href="#"><i class="ti-wallet text-muted me-2"></i> My
                                Wallet</a>
                            <a class="dropdown-item" href="#"><i class="ti-settings text-muted me-2"></i>
                                Settings</a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="post" id="logout">
                                @csrf
                                <a class="dropdown-item" href="#" onclick="logout.submit()">
                                    <i class="ti-lock text-muted me-2"></i> Logout
                                </a>
                            </form>
                        </li>
                    </ul>
                </li> --}}
                <li class="dropdown d-flex align-items-center me-2 fw-bold">
                    {{ auth()->user()->name }}
                </li>
            </ul>
        </div>
    </nav>
</header>
