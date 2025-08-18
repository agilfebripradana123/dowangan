@extends('layout.app')

@section('content')
@if (session('export_empty'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'info',
            title: 'Export Dibatalkan',
            text: '{{ session('export_empty') }}',
            confirmButtonText: 'Oke',
            confirmButtonColor: '#3085d6',
        });
    </script>
@endif

<div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
    <h1 class="h4 text-gray-800 mb-2">Data Penduduk Dowangan, Banyuraden, Gamping, Sleman.</h1>   
</div>

 <form id="filterForm" action="{{ route('admin.data.index') }}" method="GET" class="mb-4">
    <div class="row g-2 align-items-end">

        {{-- Kolom kiri: perPage, RT, RW --}}
        <div class="col-12 col-md-6">
            <div class="row g-2 mb-2">
                <div class="col-12 col-md-auto mb-2">
                    <select name="perPage" class="form-control" onchange="this.form.submit()">
                        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25 data</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50 data</option>
                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100 data</option>
                        <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>Tampilkan Semua</option>
                    </select>
                </div>

                <div class="col-12 col-md-auto">
                    <select name="rt" class="form-control" onchange="this.form.submit()">
                        <option value="">Pilih RT</option>
                        @foreach(range(1, 10) as $rt)
                            @php $val = str_pad($rt, 2, '0', STR_PAD_LEFT); @endphp
                            <option value="{{ $val }}" {{ request('rt') == $val ? 'selected' : '' }}>RT {{ $val }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 col-md-auto mb-2">
                    <select name="rw" class="form-control" onchange="this.form.submit()">
                        <option value="">Pilih RW</option>
                        @foreach(range(1, 10) as $rw)
                            @php $val = str_pad($rw, 2, '0', STR_PAD_LEFT); @endphp
                            <option value="{{ $val }}" {{ request('rw') == $val ? 'selected' : '' }}>RW {{ $val }}</option>
                        @endforeach
                    </select>
                </div>
                        <div class="col-12 col-md-auto">
                        <select name="golongan_darah" class="form-control" onchange="this.form.submit()">
                            <option value="">Golongan Darah</option>
                            @foreach (['A','B','AB','O','-'] as $gol)
                                <option value="{{ $gol }}" {{ request('golongan_darah') === $gol ? 'selected' : '' }}>
                                    {{ $gol }}
                                </option>
                            @endforeach
                        </select>
                        </div>

            </div>
        </div>

        {{-- Kolom kanan: search, tombol --}}
        <div class="col-12 col-md-6">
            <div class="row g-2">
                <div class="col mb-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari data...">
                </div>

                <div class="col-md-auto mb-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Filter
                    </button>
                </div>

                <div class="col-md-auto">
                    <a href="{{ route('admin.data.index') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-sync-alt"></i> Reset
                    </a>
                </div>
            </div>
        </div>

    </div>
</form>


<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
    {{-- Form Sorting --}}
    <form id="sortForm" action="{{ route('admin.data.index') }}" method="GET" class="d-flex flex-wrap align-items-center gap-2 mb-2">
        {{-- Hidden inputs supaya filter sebelumnya tidak hilang --}}
        @foreach (['search', 'rt', 'rw', 'perPage', 'golongan_darah'] as $filter)
            @if(request($filter))
                <input type="hidden" name="{{ $filter }}" value="{{ request($filter) }}">
            @endif
        @endforeach

        <label for="sort" class="fw-semibold mb-0">Urutkan:</label>
        <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
            <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
            <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
            <option value="tanggal_asc" {{ request('sort') == 'tanggal_asc' ? 'selected' : '' }}>Tanggal Input (Terlama)</option>
            <option value="tanggal_desc" {{ request('sort') == 'tanggal_desc' ? 'selected' : '' }}>Tanggal Input (Terbaru)</option>
        </select>
    </form>

    {{-- Aksi Tambah & Download --}}
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('admin.data.create') }}" class="btn btn-primary mr-2 mb-2">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Data
        </a>
        <a href="{{ route('admin.data.export', request()->only('rt', 'rw', 'search','golongan_darah')) }}" class="btn btn-success mb-2">
            <i class="fas fa-file-excel"></i> Download Excel
        </a>
    </div>
</div>


 @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="table-responsive">
    <table class="table table-bordered table-striped table-sm text-sm align-middle text-nowrap">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>No KK</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>RT/RW</th>
                <th>Tempat/Tgl Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Gol. Darah</th>
                <th>Agama</th>
                <th>Status Perkawinan</th>
                <th>Status Keluarga</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Kewarganegaraan</th>
                <th>Disabilitas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($datadowangan as $index => $item)
                <tr>
                    <td>{{ $datadowangan->firstItem() + $index }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->no_kk }}</td>
                    <td>{{ $item->nama_lengkap }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->rt }}/{{ $item->rw }}</td>
                    <td>{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                    <td>{{ $item->jenis_kelamin }}</td>
                    <td>{{ $item->golongan_darah ?? '-' }}</td>
                    <td>{{ $item->agama ?? '-' }}</td>
                    <td>{{ $item->status_perkawinan }}</td>
                    <td>{{ $item->status_keluarga ?? '-' }}</td>
                    <td>{{ $item->pendidikan_terakhir ?? '-' }}</td>
                    <td>{{ $item->pekerjaan ?? '-' }}</td>
                    <td>{{ $item->kewarganegaraan }}</td>
                    <td>{{ $item->disabilitas ? 'Ya' : 'Tidak' }}</td>
                    <td class="text-nowrap">
                        <a href="{{ route('admin.data.edit', $item->id) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('admin.data.destroy', $item->id) }}" method="POST" class="d-inline form-hapus" data-nama="{{ $item->nama_lengkap }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="17" class="text-center text-danger">
                        Data tidak ditemukan.
                    </td>
                </tr>
            @endforelse


        </tbody>
    </table>

</div>
<div class="mt-3 d-flex justify-content-center">
    {{ $datadowangan->links() }}
</div>
@endsection
<script>
    // Semua form
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            document.body.classList.remove('sidebar-toggled');
            document.querySelector('.sidebar').classList.remove('toggled');
        });
    });

    // Jika mau lebih aman: khusus hanya sidebar ketika tombol sort atau filter ditekan
    ['filterForm', 'sortForm'].forEach(function (formId) {
        const form = document.getElementById(formId);
        if (form) {
            form.addEventListener('submit', function () {
                document.body.classList.remove('sidebar-toggled');
                document.querySelector('.sidebar').classList.remove('toggled');
            });
        }
    });
</script>

