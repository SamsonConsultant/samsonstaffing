<header id="header" class="d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">
        <h1 class="logo">
            <a href="{{ url('/') }}" target="_blank">
                {{ get_site_title() }}
            </a>
        </h1>
        <nav id="navbar" class="navbar">
            <ul>
                <li>
                    <a class="nav-link scrollto" href="#">
                        <span class="profile-ic"><i class="fa fa-user" aria-hidden="true"></i></span> Profile
                    </a>
                </li>
                <li>
                    <a class="btn btn-logout" href="{{ route('admin.logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
    </div>

    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</header>