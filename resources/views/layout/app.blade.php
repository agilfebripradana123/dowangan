<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dusun Dowangan</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('template/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

    </style>
        

</head>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const hapusForms = document.querySelectorAll('.form-hapus');

    hapusForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // cegah submit langsung

            const nama = this.getAttribute('data-nama') || 'data ini';

            Swal.fire({
                title: 'Yakin?',
                text: `Kamu akan menghapus ${nama}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // submit form kalau dikonfirmasi
                }
            });
        });
    });
});
</script>
@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: {!! json_encode(session('success')) !!},
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif
@stack('scripts')
<body id="page-top" class="sidebar-toggled">


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('layout.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('layout.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                @yield('content')
                    

                    <!-- Content Row -->

            <!-- End of Main Content -->

            <!-- Footer -->
            @include('layout.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->    

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('template/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('template/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('template/js/sb-admin-2.min.js')}}"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const hapusForms = document.querySelectorAll('.form-hapus');

    hapusForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // cegah submit langsung

            const nama = this.getAttribute('data-nama') || 'data ini';

            Swal.fire({
                title: 'Yakin?',
                text: `Kamu akan menghapus ${nama}`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit(); // submit form kalau dikonfirmasi
                }
            });
        });
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('btnDeleteSelected').addEventListener('click', function () {
        const checked = document.querySelectorAll('input[name="ids[]"]:checked');
        if (checked.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Tidak ada data terpilih',
                text: 'Silakan centang data yang ingin dihapus.'
            });
            return;
        }

        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: `Anda akan menghapus ${checked.length} data terpilih!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('bulkDeleteForm').submit();
            }
        });
    });
</script>

@if (session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: {!! json_encode(session('success')) !!},
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function noAccess() {
    Swal.fire({
      icon: 'error',
      title: 'Akses ditolak',
      text: 'Anda tidak memiliki akses.',
      confirmButtonText: 'OK'
    });
    return false;
  }
</script>

</body>

</html>