<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <link rel="icon" type="image/svg+xml" href="/vite.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title inertia>{{ config('app.name', 'Laravel App') }}</title>

    <!-- TOKEN SEARCH ENGINE -->
    <!--<meta content='#tokenyandex' name='yandex-verification'/>
    <meta content='#tokenbing' name='msvalidate.01'/>
    <meta content='#tokengoogle' name='google-site-verification'/> -->

    <!-- LANGUAGE DIRECTORY -->
    <link rel="alternate" hreflang="en" lang="en" href="{{ route('welcome') }}" />
    <link rel="alternate" hreflang="id" lang="id" href="{{ route('welcome') }}" />

    <!-- <meta itemprop="name" content="Bootstrap Gallery - free examples, templates &amp; tutorial"/>
    <meta itemprop="description" content="Responsive galleries created with Bootstrap 5. Image gallery, video gallery, photo gallery, full-page, eCommerce, lightbox, slider, thumbnails, &amp; more."/>
    <meta itemprop="image" content="https://mdbcdn.b-cdn.net/docs/standard/extended/gallery/src/assets/featured.jpg"/> -->

    <!-- <meta property="og:title" content="Judul Konten Anda">
    <meta property="og:description" content="Deskripsi Konten Anda">
    <meta property="og:image" content="URL_GAMBAR_KONTEN">
    <meta property="og:url" content="URL_HALAMAN_KONTEN">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Dian Nugroho | Official" />
    <meta property="og:locale" content="id_ID" />

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Judul Konten Anda">
    <meta name="twitter:description" content="Deskripsi Konten Anda">
    <meta name="twitter:image" content="URL_GAMBAR_KONTEN"> -->

    <meta name="description" content="Personal Website (Website Pribadi) milik Dian Adi Nugroho yang dibuat menggunakan VueJS3 beserta tailwind. Website ini dibuat dengan tujuan untuk showcase skill dalam membangun website Front End Web Development." />
    <meta name="keywords" content="dianadi021, dianskuad, dian skuad, dian nugroho, dian adi nugroho" />
    <!-- <meta name="image" content="#" /> -->
    <meta name="author" content="Dian Nugroho" />
    <meta name="language" content="Indonesia" />
    <meta name="language" content="English" />
    <meta name="geo.placename" content="Indonesia" />
    <meta name="geo.country" content="id" />
    <meta name="webcrawlers" content="all" />
    <meta name="rating" content="general" />
    <meta name="spiders" content="all" />

    <script src="{{ asset('/assets/vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('/assets/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/moment/id.min.js') }}"></script>

    <script src="{{ asset('/assets/vendor/tostr/toastr.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/font-awesome/all.min.js') }}"></script>
    <script src="{{ asset('/assets/vendor/sweetalert/sweetalert2@11.js') }}"></script>
    
    <link rel="stylesheet" href="{{ asset("/assets/scripts/css/app.css") }}" media="all">

    <!-- Scripts -->
    @routes
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/js/app.js', "resources/js/**/{$page['component']}.vue"])
    @endif
    @inertiaHead
</head>

<body class="w-full flex flex-wrap">
    <div class="w-full">
        @inertia
    </div>

    <script src="{{ asset('/assets/scripts/js/controller.js') }}"></script>
</body>

</html>
