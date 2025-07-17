<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title') - Kelurahan Sukowinangun</title>

    {{-- Meta khusus halaman (dari @push('meta')) --}}
    @stack('meta')

    {{-- Meta default jika tidak ada section meta-default --}}
    @hasSection('meta-default')
        @yield('meta-default')
    @else
        <meta name="description"
            content="Website resmi Kelurahan Sukowinangun. Temukan berita, layanan, dan informasi terbaru seputar kelurahan kami.">
        <meta name="keywords"
            content="Kelurahan Sukowinangun, Desa Sukowinangun, Berita Desa, Layanan Masyarakat, Pemerintahan Desa">
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
    @endif

    <link rel="icon" href="{{ asset('images/logo-desa.png') }}" type="image/png" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
