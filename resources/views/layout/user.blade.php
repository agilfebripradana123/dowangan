<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dusun Dowangan</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <!-- Google fonts-->
             <link href="{{asset('template/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

        <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('template_home/css/styles.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
/>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

<script>
  const swiper = new Swiper('.mySwiper', {
    slidesPerView: 2,
    spaceBetween: 20,
    loop: true,
    speed: 1000, // durasi transisi (ms) => makin besar makin smooth
    autoplay: {
      delay: 3000, // jeda antar slide
      disableOnInteraction: false,
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 15,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      1200: {
        slidesPerView: 2,
        spaceBetween: 25,
      },
    },
  });
</script>

    </head>
    <body id="page-top">
        <!-- Navigation-->
        @include('layout.usernav')
        <main>
        @yield('content')
        </main>
        <!-- Footer-->
        @include('layout.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('template_home/js/scripts.js') }}"></script>
    </body>
</html>

