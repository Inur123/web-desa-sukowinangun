<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - Kelurahan Sukowinangun</title>
    @stack('meta')
    @hasSection('meta-default')
        @yield('meta-default')
    @else
        <meta name="description"
            content="PEMERINTAH KELURAHAN SUKOWINANGUN: Selamat datang di Website resmi Kelurahan Sukowinangun. Temukan berita, layanan, dan informasi terbaru seputar kelurahan kami.">
        <meta name="keywords"
            content="Kelurahan Sukowinangun, layanan publik, berita kelurahan, informasi desa, pelayanan masyarakat">
        <meta name="author" content="Kelurahan Sukowinangun">
        <link rel="canonical" href="{{ url()->current() }}" />
        <meta property="og:title" content="@yield('title') - Kelurahan Sukowinangun" />
        <meta property="og:description"
            content="Website resmi Kelurahan Sukowinangun. Temukan berita, layanan, dan informasi terbaru seputar kelurahan kami." />
        <meta property="og:image" content="{{ asset('images/logo-desa.png') }}" />
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:type" content="website" />
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="@yield('title') - Kelurahan Sukowinangun" />
        <meta name="twitter:description" content="Website resmi Kelurahan Sukowinangun." />
        <meta name="twitter:image" content="{{ asset('images/logo-desa.png') }}" />
        <meta name="twitter:site" content="@KelurahanSukowinangun" />
        <meta name="theme-color" content="#3b82f6">
        <meta name="msapplication-TileColor" content="#3b82f6">
        <meta name="msapplication-TileImage" content="{{ asset('images/logo-desa.png') }}">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <link rel="apple-touch-icon" href="{{ asset('images/logo-desa.png') }}">
        <link rel="manifest" href="{{ asset('manifest.json') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
    @endif
    <link rel="icon" href="{{ asset('images/logo-desa.png') }}" type="image/png" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        #chat-messages {
            scrollbar-width: thin;
            scrollbar-color: #059669 #f3f4f6;
        }

        #chat-messages::-webkit-scrollbar {
            width: 6px;
        }

        #chat-messages::-webkit-scrollbar-track {
            background: #f3f4f6;
        }

        #chat-messages::-webkit-scrollbar-thumb {
            background-color: #059669;
            border-radius: 3px;
        }
    </style>
</head>
<body class="bg-gray-50">
    @include('user.layouts.navbar')
    <main>
        @yield('content')
    </main>
    @include('user.layouts.footer')
    <button id="back-to-top"
        class="fixed bottom-8 right-8 bg-primary text-white w-12 h-12 rounded-full shadow-lg hover:bg-secondary transition-all duration-300 hidden items-center justify-center">
        <i class="fas fa-arrow-up text-xl"></i>
    </button>
    @include('user.layouts.scripts')
</body>
</html>
