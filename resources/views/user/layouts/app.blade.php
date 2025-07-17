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
    <button id="chatbot-button"
        class="fixed bottom-24 right-8 bg-primary text-white w-12 h-12 rounded-full shadow-lg hover:bg-secondary transition-all duration-300 flex items-center justify-center">
        <i class="fas fa-comments text-xl"></i>
    </button>
    <div id="chatbot-modal"
        class="fixed bottom-32 right-8 w-80 bg-white rounded-lg shadow-xl hidden flex-col z-50 border border-gray-200">
        <div class="bg-primary text-white p-3 rounded-t-lg flex justify-between items-center">
            <h3 class="font-semibold">Chatbot Desa</h3>
            <button id="close-chatbot" class="text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4 h-64 overflow-y-auto" id="chatbot-messages">
            <div class="bg-gray-100 p-3 rounded-lg mb-2">
                <p class="text-sm">
                    Halo! Saya Chatbot Desa Maju Sejahtera. Silakan pilih pertanyaan Anda:
                </p>
            </div>
            <div class="space-y-2 mt-2">
                <button
                    class="chatbot-question w-full text-left bg-gray-50 hover:bg-gray-100 p-2 rounded text-sm text-gray-700 border border-gray-200">
                    Bagaimana cara mengurus surat keterangan?
                </button>
                <button
                    class="chatbot-question w-full text-left bg-gray-50 hover:bg-gray-100 p-2 rounded text-sm text-gray-700 border border-gray-200">
                    Jam berapa kantor desa buka?
                </button>
                <button
                    class="chatbot-question w-full text-left bg-gray-50 hover:bg-gray-100 p-2 rounded text-sm text-gray-700 border border-gray-200">
                    Apa syarat pembuatan KTP baru?
                </button>
                <button
                    class="chatbot-question w-full text-left bg-gray-50 hover:bg-gray-100 p-2 rounded text-sm text-gray-700 border border-gray-200">
                    Bagaimana prosedur pengaduan?
                </button>
            </div>
        </div>
        <div class="p-3 border-t border-gray-200">
            <div class="flex">
                <input type="text" id="chatbot-input" placeholder="Ketik pertanyaan Anda..."
                    class="flex-1 border border-gray-300 rounded-l-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-sm" />
                <button id="send-chatbot"
                    class="bg-primary text-white px-3 py-2 rounded-r-lg hover:bg-secondary transition-colors">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>
    @include('user.layouts.scripts')
</body>

</html>
