
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
    <i class="fa fa-bars"></i>
</button>
 <ul class="navbar-nav ml-auto">
        <!-- Sapaan -->
        <li class="nav-item mr-3 d-flex align-items-center">
            <span class="text-dark">
                Halo, {{ Auth::user()->name ?? 'Pengguna' }}
            </span>
        </li>

        <!-- Tombol Logout -->
        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="button" id="btn-logout" class="btn btn-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
    </ul>

</nav>




</nav>
                {{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('btn-logout').addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Yakin mau logout?',
        text: "Kamu akan keluar dari sistem.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('logout-form').submit();
        }
    });
});
</script>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">


            <!-- Sidebar - Brand -->
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                MANAJEMEN DATA
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item {{ request()->is('content*') ? 'active' : '' }}">
                <a class="nav-link" href="/content">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Konten</span>
                </a>
            </li>


            <!-- Nav Item - Tables -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

          
        </ul>
        <!-- End of Sidebar -->