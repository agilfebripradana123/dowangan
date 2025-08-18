
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