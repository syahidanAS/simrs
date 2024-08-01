<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item"> <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button"> <i
                        class="bi bi-list"></i> </a> </li>
        </ul>
        <h5 class="mt-2">{{ $title }}</h5>
        <ul class="navbar-nav ms-auto">
            
            </li>
            <li class="nav-item dropdown user-menu"> <a href="#" class="nav-link dropdown-toggle"
                    data-bs-toggle="dropdown"> <span class="d-none d-md-inline">{{ Auth()->user()->name }}</span></a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <li class="user-header text-bg-primary"> <img src="{{ asset('/assets/images/profile.png') }}"
                            class="rounded-circle shadow" alt="User Image">
                        <p>
                            {{ Auth()->user()->name }}
                        </p>
                    </li>
                    <li class="user-footer"> <a href="#" class="btn btn-default btn-flat">Profile</a> <a id="btnLogout"
                            class="btn btn-default btn-flat float-end">Sign out</a> </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>