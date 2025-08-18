

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-3">
  <h1 class="h4 text-gray-800 mb-0">Manajemen Konten</h1>
  <a href="{{ route('admin.content.create') }}" class="btn btn-sm btn-primary">Tambah Konten</a>

</div>

{{-- Flash messages --}}
@if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if(session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="card">
  <div class="card-header">
    <strong>Daftar Konten</strong>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-sm align-middle text-nowrap">
        <thead class="thead-light">
          <tr>
            <th width="5%">#</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Foto</th>
            <th>Video</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($contents as $i => $content)
            @php
              // Buat URL YouTube valid kalau yang tersimpan hanya ID
              $videoId = null;
              $youtubeUrl = $content->youtube_url;
              if ($youtubeUrl) {
                // ambil ID dengan regex sederhana
                if (preg_match('~(?:youtu\.be/|v=|embed/)([A-Za-z0-9_\-]{6,})~', $youtubeUrl, $m)) {
                  $videoId = $m[1];
                } elseif (!str_starts_with($youtubeUrl, 'http')) {
                  $videoId = $youtubeUrl;
                }
              }
              if ($videoId && !str_starts_with((string)$youtubeUrl, 'http')) {
                $youtubeUrl = "https://www.youtube.com/watch?v={$videoId}";
              }
            @endphp
            <tr>
              <td>{{ ($contents instanceof \Illuminate\Pagination\LengthAwarePaginator)
                    ? $contents->firstItem() + $i : $i + 1 }}</td>
              <td class="fw-bold">{{ $content->title }}</td>
              <td>{{ \Illuminate\Support\Str::limit($content->description, 80) }}</td>
              <td>
                @if($content->image)
                  <img src="{{ asset('storage/'.$content->image) }}" 
         alt="{{ $content->title }}"
         style="max-width: 150px; height: auto; border-radius: 6px; object-fit: cover; border: 1px solid #ddd; padding: 2px;">
                @else
                  <span class="text-muted">—</span>
                @endif
              </td>
              <td>
                @if($youtubeUrl)
                  <a href="{{ $youtubeUrl }}" target="_blank">Lihat Video</a>
                @else
                  <span class="text-muted">—</span>
                @endif
              </td>
              <td>
                <a href="{{ route('admin.content.edit', $content->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.content.destroy', $content->id) }}"
                      method="POST" class="d-inline delete-form"
                      data-title="{{ $content->title }}">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center text-muted">Belum ada konten.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.delete-form').forEach(function(form){
  form.addEventListener('submit', function(e){
    e.preventDefault();
    const title = form.getAttribute('data-title') || 'item ini';
    Swal.fire({
      title: 'Yakin hapus?',
      text: 'Konten "' + title + '" akan dihapus permanen.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, hapus',
      cancelButtonText: 'Batal'
    }).then((res) => {
      if (res.isConfirmed) form.submit();
    });
  });
});
</script>
@endsection
