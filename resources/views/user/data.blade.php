<h2 class="h4 mb-4 mt-4">Data Penduduk Dowangan, Banyuraden, Gamping, Sleman.</h2>
{{-- resources/views/user/data.blade.php --}}
    <form id="filterForm" action="{{ route('user.data') }}#data" method="GET">

    <div class="row g-2 align-items-end">

        {{-- Kolom kiri: PerPage, RT, RW --}}
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

                <div class="col-12 col-md-auto">
                    <select name="rw" class="form-control" onchange="this.form.submit()">
                        <option value="">Pilih RW</option>
                        @foreach(range(1, 10) as $rw)
                            @php $val = str_pad($rw, 2, '0', STR_PAD_LEFT); @endphp
                            <option value="{{ $val }}" {{ request('rw') == $val ? 'selected' : '' }}>RW {{ $val }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- Kolom kanan: Search + tombol --}}
        <div class="col-12 col-md-6">
            <div class="row g-2 ">
                <div class="col mb-2">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari data...">
                </div>
                <div class="col-md-auto mb-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
                <div class="col-md-auto mb-2">
                    <a href="{{ route('user.data') }}#data" class="btn btn-secondary w-100">
                        <i class="fas fa-sync-alt"></i> Reset
                    </a>
                </div>
            </div>
        </div>

    </div>
    
</form>

    <div class="d-flex justify-content-between align-items-center">
    <form id="sortForm" action="{{ route('user.data') }}#data" method="GET" class="mb-4 text-start">
        @foreach (['search', 'rt', 'rw', 'perPage'] as $filter)
            @if(request($filter))
                <input type="hidden" name="{{ $filter }}" value="{{ request($filter) }}">
            @endif
        @endforeach

        <div class="d-flex align-items-center flex-wrap gap-2">
            <label for="sort" class="fw-semibold mb-0">Urutkan:</label>
            <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                <option value="nama_asc" {{ request('sort') == 'nama_asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                <option value="nama_desc" {{ request('sort') == 'nama_desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                <option value="tanggal_asc" {{ request('sort') == 'tanggal_asc' ? 'selected' : '' }}>Tanggal Input (Terlama)</option>
                <option value="tanggal_desc" {{ request('sort') == 'tanggal_desc' ? 'selected' : '' }}>Tanggal Input (Terbaru)</option>
            </select>
        </div>
    </form>
    </div>

<div class="table-responsive" id="data">
    <table class="table table-bordered table-striped table-sm text-sm align-middle text-nowrap">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama Lengkap</th>
                <th>Alamat</th>
                <th>RT/RW</th>
                <th>Jenis Kelamin</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $index => $item)
                <tr>
                    <td>{{ ($data->currentPage() - 1) * $data->perPage() + $index + 1 }}</td>
                    <td>{{ mask($item->nik) }}</td>
                    <td>{{ ($item->nama_lengkap) }}</td>
                    <td>{{ ($item->alamat) }}</td>
                    <td>{{ ($item->rt) }}/{{ mask($item->rw) }}</td>
                    <td>{{ ($item->jenis_kelamin) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-danger">Belum ada data.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-3 d-flex justify-content-center"id="page">
    {{ $data->appends(request()->query())->fragment('page')->links() }}
</div>


