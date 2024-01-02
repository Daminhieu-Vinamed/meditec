<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar navbar-expand-lg bg-grey-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="{{ asset('dist/images/logo-header.png') }}" class="light-logo" alt="homepage" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img src="{{ asset('dist/images/menu-bar.svg') }}" alt="">
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <div class="d-flex align-items-center">
                <span class="full-name-user-header align-sub">{{session()->get('user')->Name}}</span>
                <div class="flex-shrink-0 dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="true">
                        <img src="{{ session()->get('user')->Gender === config('constants.sex.man') ? asset('dist/images/man.png') : asset('dist/images/woman.png') }}" alt="user" class="rounded-circle" width="31">
                    </a>
                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser" data-popper-placement="bottom-end">
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
            </div>
        </div>
    </nav>
</header>
  