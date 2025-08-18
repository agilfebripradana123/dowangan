@php $role = Auth::user()->role ?? null; @endphp

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
        <a class="nav-link"
           href="{{ $role === 'admin' ? route('admin.dashboard') : '#' }}"
           @if($role !== 'admin') onclick="return noAccess()" @endif>
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        MANAJEMEN DATA
    </div>

    <!-- Nav Item - Charts (Konten: admin & pemuda boleh) -->
    <li class="nav-item {{ request()->is('admin/content*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.content.index') }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Konten</span>
        </a>
    </li>

    <!-- Nav Item - Tables (Data: admin saja) -->
    <li class="nav-item {{ request()->is('admin/data*') ? 'active' : '' }}">
        <a class="nav-link"
           href="{{ $role === 'admin' ? route('admin.data.index') : '#' }}"
           @if($role !== 'admin') onclick="return noAccess()" @endif>
            <i class="fas fa-fw fa-table"></i>
            <span>Data Penduduk</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
