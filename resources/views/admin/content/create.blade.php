@extends('layout.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h4 text-gray-800 mb-0">Tambah Konten</h1>
    <a href="{{ route('admin.content.index') }}" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header">
        <strong>Form Tambah Konten</strong>
    </div>
    <div class="card-body">
        {{-- Error Alert --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.content.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Judul --}}
            <div class="mb-3">
                <label class="form-label">Judul <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control"
                       value="{{ old('title') }}" placeholder="Masukkan judul" required>
            </div>

            {{-- Deskripsi --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control" rows="4"
                          placeholder="Masukkan deskripsi" required>{{ old('description') }}</textarea>
            </div>

            {{-- Foto --}}
            <div class="mb-3">
                <label class="form-label">Foto <span class="text-danger">*</span></label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
                <div class="form-text">Format: JPG, PNG, maksimal 2MB</div>
            </div>

            {{-- Link YouTube --}}
            <div class="mb-3">
                <label class="form-label">Link Video YouTube</label>
                <input type="url" name="youtube_url" class="form-control"
                       value="{{ old('youtube_url') }}" placeholder="https://www.youtube.com/watch?v=xxxxxx">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
                <a href="{{ route('admin.content.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
