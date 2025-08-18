@extends('layout.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800">Edit Data Penduduk</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.data.update', $data->id) }}" method="POST">

    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="nik">NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ old('nik', $data->nik) }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="no_kk">No KK</label>
            <input type="text" name="no_kk" class="form-control" value="{{ old('no_kk', $data->no_kk) }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $data->nama_lengkap) }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" class="form-control" 
                value="{{ old('alamat', $data->alamat ?? 'Dowangan, Banyuraden, Gamping, Sleman') }}">
        </div>
        <div class="col-md-3 mb-3">
            <label for="rt">RT</label>
            <input type="text" name="rt" class="form-control" value="{{ old('rt', $data->rt) }}">
        </div>
        <div class="col-md-3 mb-3">
            <label for="rw">RW</label>
            <input type="text" name="rw" class="form-control" value="{{ old('rw', $data->rw) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $data->tempat_lahir) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $data->tanggal_lahir) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="golongan_darah">Golongan Darah</label>
            <select name="golongan_darah" class="form-control">
                <option value="">-- Pilih --</option>
                @foreach (['A', 'B', 'AB', 'O', '-'] as $gol)
                    <option value="{{ $gol }}" {{ old('golongan_darah', $data->golongan_darah) == $gol ? 'selected' : '' }}>{{ $gol }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="agama">Agama</label>
            <input type="text" name="agama" class="form-control" value="{{ old('agama', $data->agama) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="status_perkawinan">Status Perkawinan</label>
            <select name="status_perkawinan" class="form-control" required>
                <option value="">-- Pilih --</option>
                @foreach (['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                    <option value="{{ $status }}" {{ old('status_perkawinan', $data->status_perkawinan) == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="status_keluarga">Status Keluarga</label>
            <select name="status_keluarga" class="form-control">
                <option value="">-- Pilih Status Keluarga --</option>
                <option value="Kepala Keluarga" {{ old('status_keluarga', $data->status_keluarga) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                <option value="Istri" {{ old('status_keluarga', $data->status_keluarga) == 'Istri' ? 'selected' : '' }}>Istri</option>
                <option value="Anak" {{ old('status_keluarga', $data->status_keluarga) == 'Anak' ? 'selected' : '' }}>Anak</option>
                <option value="Anggota Keluarga Lain" {{ old('status_keluarga', $data->status_keluarga) == 'Anggota Keluarga Lain' ? 'selected' : '' }}>Anggota Keluarga Lain</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="pendidikan_terakhir">Pendidikan Terakhir</label>
            <select name="pendidikan_terakhir" id="pendidikan_terakhir" class="form-control mb-2" onchange="toggleCustomPendidikan(this.value)">
                <option value="">-- Pilih Pendidikan --</option>
                <option value="SD" {{ old('pendidikan_terakhir', $data->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}>SD</option>
                <option value="SMP" {{ old('pendidikan_terakhir', $data->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}>SMP</option>
                <option value="SMA/SMK" {{ old('pendidikan_terakhir', $data->pendidikan_terakhir) == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                <option value="Diploma" {{ old('pendidikan_terakhir', $data->pendidikan_terakhir) == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                <option value="Sarjana (S1)" {{ old('pendidikan_terakhir', $data->pendidikan_terakhir) == 'Sarjana (S1)' ? 'selected' : '' }}>Sarjana (S1)</option>
                <option value="Magister (S2)" {{ old('pendidikan_terakhir', $data->pendidikan_terakhir) == 'Magister (S2)' ? 'selected' : '' }}>Magister (S2)</option>
                <option value="Doktor (S3)" {{ old('pendidikan_terakhir', $data->pendidikan_terakhir) == 'Doktor (S3)' ? 'selected' : '' }}>Doktor (S3)</option>
                <option value="Lainnya" {{ old('pendidikan_terakhir', $data->pendidikan_terakhir) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
            
        </div>
        
        <div class="col-md-6 mb-3">
            <label for="pekerjaan">Pekerjaan</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $data->pekerjaan) }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="kewarganegaraan">Kewarganegaraan</label>
            <input type="text" name="kewarganegaraan" class="form-control" value="{{ old('kewarganegaraan', $data->kewarganegaraan ?? 'WNI') }}">
        </div>
        <div class="col-md-6 mb-3">
            <label for="disabilitas">Disabilitas</label>
            @php
                $disabilitas = old('disabilitas', $data->disabilitas ?? 0);
            @endphp
            <select name="disabilitas" class="form-control">
                <option value="0" {{ $disabilitas == 0 ? 'selected' : '' }}>Tidak</option>
                <option value="1" {{ $disabilitas == 1 ? 'selected' : '' }}>Ya</option>
            </select>
        </div>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('admin.data.index') }}" class="btn btn-secondary">Batal</a>

</form>

</div>
@endsection
