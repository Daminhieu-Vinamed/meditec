<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md navbar-light">
        <div class="navbar-header" data-logobg="skin5">
            {{-- <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a> --}}
            <div class="navbar-brand">
                <a href="index.html" class="logo">
                    <b class="logo-icon">
                        <img src="{{ asset('dist/images/logo-icon.png') }}" alt="homepage" class="dark-logo" />
                        <img src="{{ asset('dist/images/logo-icon.png') }}" alt="homepage" class="light-logo" />
                    </b>
                    <span class="logo-text">
                        <img src="{{ asset('dist/images/logo-text.png') }}" alt="homepage" class="dark-logo" />
                        <img src="{{ asset('dist/images/logo-light-text.png') }}" class="light-logo" alt="homepage" />
                    </span>
                </a>
            </div> 
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
            {{-- <ul class="navbar-nav float-start me-auto"> --}}
                {{-- <li class="nav-item search-box">
                    <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-magnify font-20 me-1"></i>
                            <div class="ms-1 d-none d-sm-block">
                                <span>Search</span>
                            </div>
                        </div>
                    </a>
                    <form class="app-search position-absolute">
                        <input type="text" class="form-control" placeholder="Search &amp; enter">
                        <a class="srh-btn">
                            <i class="ti-close"></i>
                        </a>
                    </form>
                </li> --}}
                <marquee><h1>CHÀO MỪNG BẠN ĐẾN VỚI HỆ THỐNG QUẢN LÝ NHÀ MÁY MEDITEC</h1></marquee>
            {{-- </ul> --}}
            <ul class="navbar-nav float-end">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="full-name-user-header align-sub">{{session()->get('user')->Name}}</span>
                        <img src="{{ session()->get('user')->Gender === config('constants.sex.man') ? asset('dist/images/man.png') : asset('dist/images/woman.png') }}" alt="user" class="rounded-circle" width="31">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dd animated" aria-labelledby="navbarDropdown">
                        {{-- <a class="dropdown-item" href="javascript:void(0)"><i class="ti-user me-1 ms-1"></i>My Profile</a>
                        <a class="dropdown-item" href="{{ route('list.approval-vote') }}"><i class="ti-list me-1 ms-1"></i>Xem danh sách các phiếu cần duyệt</a> --}}
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="fa-solid fa-right-from-bracket"></i> Đăng xuất</a>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>