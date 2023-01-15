<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon">
            <img src="/assets/favicon-32x32.png" alt="ArlCraft">
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard.index') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @if (Auth::user()->isAdmin)
        <!-- Heading -->
        <div class="sidebar-heading">
            Admin
        </div>

        <!-- Nav Item - Admin -->
        <li class="nav-item {{ Request::is('admin') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.index') }}">
                <i class="fas fa-user-shield"></i>
                <span>My Admin</span>
            </a>
        </li>

        <!-- Nav Item - Video -->
        <li class="nav-item {{ Request::is('admin/video*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.video.index') }}">
                <i class="fab fa-youtube"></i>
                <span>Videos</span>
            </a>
        </li>

        <!-- Nav Item - User -->
        <li class="nav-item {{ Request::is('admin/user*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.user.index') }}">
                <i class="fas fa-user-edit"></i>
                <span>Users</span>
            </a>
        </li>

        <!-- Nav Item - User -->
        <li class="nav-item {{ Request::is('admin/event*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.event.index') }}">
                <i class="fas fa-user-edit"></i>
                <span>Events</span>
            </a>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Servers</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Players</h6>
                    <a class="collapse-item" href="{{ route('admin.server.ban') }}">Ban Players</a>
                    <a class="collapse-item" href="{{ route('admin.server.sendCommand') }}">Send Command</a>
                    <a class="collapse-item" href="{{ route('admin.server.setRanks') }}">Set Ranks</a>
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item" href="blank.html">Blank Page</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->