<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('spin') }}" class="brand-link">
        <center> <img width="100%" height="70px" src="{{ asset('AdminLTE-3.1.0/dist/img/AdminLTELogo.png') }}" ></center>
    </a>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('manager-spins.index') }}" class="nav-link {{ URL::current() == route('manager-spins.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-gamepad"></i>
                    <p>Vòng quay</p>
                </a>
            </li>
            <li class="nav-header"></li>
            <li class="nav-item"></li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
