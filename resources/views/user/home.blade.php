@extends('layout.user')

@section('content')

 <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Selamat datang di sistem informasi</div>
                <div class="masthead-heading text-uppercase">Dusun Dowangan</div>
                <div class="masthead-subheading">Banyuraden, Gamping, Sleman</div>
            </div>
        </header>
        <section class="page-section" id="profil">
    <div class="container px-4">
        <!-- Judul di tengah -->
        <div class="text-center">
            <h1 class="text-uppercase">Profil</h1>
        </div>

        <!-- Isi rata kiri -->
        <div class="text-start">
            @include('user.profil')
        </div>
    </div>
</section>

<section class="page-section" id="konten">
  <div class="container px-4">
    <div class="text-center">
      <h1 class="text-uppercase">Konten</h1>
    </div>

<div class="swiper mySwiper mt-4">
  <div class="swiper-wrapper mt-4">
@foreach($contents as $content)
  @php
    $shortDesc = \Illuminate\Support\Str::limit($content->description, 100);
    $videoId = getYoutubeId($content->youtube_url ?? '');
    $thumbs = $videoId ? [
        "https://img.youtube.com/vi/{$videoId}/maxresdefault.jpg",
        "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg",
        "https://img.youtube.com/vi/{$videoId}/mqdefault.jpg",
        "https://img.youtube.com/vi/{$videoId}/default.jpg",
    ] : [];
    $watchUrl = $videoId ? "https://www.youtube.com/watch?v={$videoId}" : '#';
  @endphp

  <div class="swiper-slide">
    <!-- Jadikan seluruh card sebagai tombol pembuka modal -->
    <a href="javascript:void(0)"
       class="card text-decoration-none text-dark"
       data-bs-toggle="modal"
       data-bs-target="#detailModal"
       data-title="{{ $content->title }}"
       data-image="{{ asset('storage/' . $content->image) }}"
       data-description="{{ e($content->description) }}"
       data-youtube="{{ $content->youtube_url }}"
       data-watch="{{ $watchUrl }}"
       data-thumb="{{ $thumbs[0] ?? '' }}"
       data-fallback="{{ isset($thumbs[1]) ? implode('|', array_slice($thumbs,1)) : '' }}">
      <img src="{{ asset('storage/' . $content->image) }}"
           class="card-img-top"
           style="height:300px;object-fit:cover"
           alt="{{ $content->title }}">
      <div class="card-body">
        <h5 class="card-title mb-2">{{ $content->title }}</h5>
        <p class="card-text mb-0">
          {{ $shortDesc }}
          @if(strlen($content->description) > 100)
            <span class="text-primary"></span>
          @endif
        </p>
        @if(strlen($content->description) > 100)
          <span class="btn btn-link p-0 mt-2 d-inline-block"
                data-bs-toggle="modal"
                data-bs-target="#detailModal"
                data-title="{{ $content->title }}"
                data-image="{{ asset('storage/' . $content->image) }}"
                data-description="{{ e($content->description) }}"
                data-youtube="{{ $content->youtube_url }}"
                data-watch="{{ $watchUrl }}"
                data-thumb="{{ $thumbs[0] ?? '' }}"
                data-fallback="{{ isset($thumbs[1]) ? implode('|', array_slice($thumbs,1)) : '' }}">
            Lihat Selengkapnya
          </span>
        @endif
      </div>
    </a>
  </div>
@endforeach
  </div>

  <div class="swiper-button-next"></div>
  <div class="swiper-button-prev"></div>
  <div class="swiper-pagination"></div>
</div>

</section>
<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailModalLabel">Judul Konten</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        <img id="modalImage" src="" alt="" class="img-fluid mb-3 modal-img-fixed" style="object-fit:cover">
        <p id="modalDescription" class="text-start"></p>
        <p class="mb-2">Tonton videonya di bawah:</p>
        <a id="modalYoutube" referrerpolicy="no-referrer" href="#" target="_blank" class="d-inline-flex align-items-center justify-content-center mx-auto" style="display:none">
          <img id="modalYoutubeThumb" src="" alt="Thumbnail YouTube" class="img-fluid modal-img-fixed me-2" style="object-fit:cover;max-height:250px">
        </a>
      </div>
    </div>
  </div>
</div>

<style>
  /* Ukuran tetap dan rata tengah untuk gambar modal */
  .modal-img-fixed {
    width: 250px;      /* sesuaikan ukuran yang kamu mau */
    height: 150px;     /* sesuaikan tinggi supaya proporsional */
    display: block;
    margin-left: auto;
    margin-right: auto;
    border-radius: 8px;
  }
</style>





<section class="page-section bg-light" id="maps">
    <div class="container px-4">
        <div class="text-center mb-4">
            <h1 class="text-uppercase">Maps</h1>
        </div>
        <div class="ratio ratio-16x9">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.051069843684!2d110.32574422476594!3d-7.784410392235324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7af7e24e02af25%3A0x1c533451626ead74!2sDowangan%2C%20Banyuraden%2C%20Kec.%20Gamping%2C%20Kabupaten%20Sleman%2C%20Daerah%20Istimewa%20Yogyakarta!5e0!3m2!1sid!2sid!4v1754417335183!5m2!1sid!2sid"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<section class="page-section" id="data">
    <div class="container px-4">
        <div class="text-center">
            <h1 class="text-uppercase">Data Penduduk</h1>
        </div>
        {{-- Pastikan variabel $data dikirim ke partial --}}
        @include('user.data', ['data' => $data])
    </div>
</section>

<script>
(function () {
  const modalEl  = document.getElementById('detailModal');
  const modalImg = modalEl.querySelector('#modalImage');
  const modalTitle = modalEl.querySelector('#detailModalLabel');
  const modalDesc  = modalEl.querySelector('#modalDescription');
  const linkYt = modalEl.querySelector('#modalYoutube');
  const imgYt  = modalEl.querySelector('#modalYoutubeThumb');

  function setupThumbFallback(img, link) {
    img.onerror = function () {
      const list = (img.dataset.fallback || '').split('|').filter(Boolean);
      if (list.length) {
        img.dataset.fallback = list.slice(1).join('|');
        img.src = list[0];               // coba URL berikutnya
      } else {
        img.onerror = null;
        img.style.display = 'none';
        link.style.display = 'none';
        link.removeAttribute('href');
      }
    };
  }

  modalEl.addEventListener('show.bs.modal', function (event) {
    const t = event.relatedTarget;
    if (!t) return;

    const title = t.getAttribute('data-title') || '';
    const image = t.getAttribute('data-image') || '';
    const desc  = t.getAttribute('data-description') || '';
    const watch = t.getAttribute('data-watch') || '#';
    const thumb = t.getAttribute('data-thumb') || '';
    const fb    = t.getAttribute('data-fallback') || '';

    modalTitle.textContent = title;
    modalImg.src = image;
    modalDesc.textContent = desc;

    if (thumb) {
      // pasang fallback DULU, baru set src
      imgYt.dataset.fallback = fb;
      setupThumbFallback(imgYt, linkYt);

      linkYt.href = watch;
      linkYt.style.display = 'inline-flex';

      imgYt.style.display = '';
      imgYt.src = thumb;                 // set setelah onerror terpasang
    } else {
      imgYt.style.display = 'none';
      linkYt.style.display = 'none';
      linkYt.removeAttribute('href');
      imgYt.onerror = null;
      imgYt.removeAttribute('data-fallback');
    }
  });
})();
</script>


<style>
.swiper-slide .card {
  height: 100%;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
  transition: transform 0.3s ease;
}

.swiper-slide .card:hover {
  transform: translateY(-5px);
  border-radius: 8px;
}

.swiper-slide img {
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  height: 150px;
  object-fit: cover;
}

.swiper-button-prev,
.swiper-button-next {
  top: 90% !important;
  width: 60px;
  height: 60px;
  border-radius: 10%;
  color: white;
  z-index: 10;
  transition: background-color 0.3s ease;
}

</style>
