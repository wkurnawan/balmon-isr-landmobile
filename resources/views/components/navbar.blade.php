<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="text-primary mb-0"><img src="{{ asset('dashmin') }}/assets/img/kominfo.png" alt="logo_kominfo.png"
                style="width: 40px; height: 40px;"></h2>
    </a>
    <a href="#" class="sidebar-toggler flex-shrink-0">
        <i class="fa fa-bars"></i>
    </a>
    <div class="navbar-nav align-items-center ms-auto">
        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                @if (Auth::user()->avatar == null)
                    <img class="rounded-circle me-lg-2" src="{{ asset('dashmin') }}/assets/img/profile.jpg"
                        alt="user-profile" style="width: 40px; height: 40px;">
                @elseif (Auth::user()->avatar != null)
                    <img class="rounded-circle me-lg-2" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}"
                        alt="user-profile" style="width: 40px; height: 40px;">
                @endif
                <span class="d-none d-lg-inline-flex">{{ Auth::user()->username }}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                <a href="{{ route('users.edit.profile') }}" class="dropdown-item">My Profile</a>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="dropdown-item">Log Out</a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</nav>
