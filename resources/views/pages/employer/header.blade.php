<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="user-panel d-flex">
                <div class="image">
                    <a class="nav-link scrollto" href="#">
                        <span class="profile-ic"><i class="fa fa-user" aria-hidden="true"></i></span> {{ Auth::user()->name }}
                    </a>
                </div>
            </div>
        </li>
    </ul>
</nav>