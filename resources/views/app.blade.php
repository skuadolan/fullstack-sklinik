<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config("app.name", "Laravel") }}</title>

         <!-- TOKEN SEARCH ENGINE -->
        <!-- <meta content='#tokenyandex' name='yandex-verification'/>
        <meta content='#tokenbing' name='msvalidate.01'/>
        <meta content='#tokengoogle' name='google-site-verification'/> -->

        <!-- LANGUAGE DIRECTORY -->
        <link rel="alternate" hreflang="en" lang="en" href="/" />
        <link rel="alternate" hreflang="id" lang="id" href="/" />

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

        <link rel="stylesheet" href="<?= asset("assets/scripts/vendor/font-awesome/@7.3.1/all.min.css") ?>" />
        <script src="<?= asset("assets/scripts/vendor/font-awesome/@7.3.1/all.min.js") ?>"></script>

        <!-- Scripts -->
        @routes
        @vite(["resources/js/app.ts", "resources/js/Pages/{$page["component"]}.vue"])
        @inertiaHead
    </head>

    <body class="font-sans antialiased">
        @inertia
    </body>

</html>
