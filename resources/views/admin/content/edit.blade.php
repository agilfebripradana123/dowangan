@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Konten</h2>
    <form action="{{ route('admin.content.update', $content->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $content->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $content->description) }}</textarea>
        </div>

        <div class="mb-3">
                    <label>Link Video YouTube</label>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url', $content->youtube_url ?? '') }}" class="form-control" placeholder="Masukkan link YouTube">

                </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar (biarkan kosong jika tidak ingin ganti)</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('admin.content.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
