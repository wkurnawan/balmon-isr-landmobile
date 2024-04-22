<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="https://www.kominfo.go.id/" class="navbar-brand mx-4 mb-3">
            <h6 class="text-primary"><img src="{{ asset('dashmin') }}/assets/img/kominfo.png" alt="logo_kominfo.png"
                    style="width: 40px; height: 40px;"> ISR - LANDMOBILE</h6>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                @if (Auth::user()->avatar == null)
                    <img class="rounded-circle" src="{{ asset('dashmin') }}/assets/img/profile.jpg" alt="user-profile"
                        style="width: 40px; height: 40px;">
                @elseif (Auth::user()->avatar != null)
                    <img class="rounded-circle" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}"
                        alt="user-profile" style="width: 40px; height: 40px;">
                @endif
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->username }}</h6>
                <span>{{ Auth::user()->role }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="/home" class="nav-item nav-link {{ Request::is('home*') ? 'active' : '' }}"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>

            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'pimpinan')
                <a href="/menu/data-users"
                    class="nav-item nav-link {{ Request::is('menu/data-users*') ? 'active' : '' }}"><i
                        class="fa fa-users me-2"></i>Data Users</a>
            @endif
            <a href="/menu/data-landmobiles"
                class="nav-item nav-link {{ Request::is('menu/data-landmobile*') ? 'active' : '' }}"><i
                    class="fa fa-walkie-talkie me-2"></i>Data Landmobile</a>
            <a href="/menu/grafik-isr"
                class="nav-item nav-link {{ Request::is('menu/grafik-isr*') ? 'active' : '' }}"><i
                    class="fa fa-chart-bar me-2"></i>Grafik</a>
        </div>
    </nav>
</div>
