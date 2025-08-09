<style>
    .text-primary-with-shimmer {
        position: relative;
        color: #2563eb;
        /* contoh warna primary (blue-600) */
        font-weight: bold;
        font-size: 1.25rem;
        /* text-xl */
        overflow: hidden;
        /* supaya shimmer gak keluar */
    }

    .text-primary-with-shimmer::before {
        content: '';
        position: absolute;
        top: 0;
        left: -150%;
        width: 150%;
        height: 100%;
        pointer-events: none;

        background: linear-gradient(120deg,
                transparent 0%,
                rgba(255, 255, 255, 0.6) 50%,
                transparent 100%);
        animation: shimmerMove 3s linear infinite;
    }

    @keyframes shimmerMove {
        0% {
            left: -150%;
        }

        100% {
            left: 150%;
        }
    }
</style>
<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="flex items-center cursor-pointer">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10" src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa" />
                </div>

                <div class="ml-3">
                    <h1 class="text-xl font-bold text-primary-with-shimmer">
                        Kelurahan Sukowinangun
                    </h1>
                </div>
            </a>
            <div class="flex items-center">
                <button id="menu-button"
                    class="md:hidden text-gray-700 hover:text-primary focus:outline-none focus:text-primary"
                    aria-label="Toggle navigation menu">
                    <i id="menu-icon" class="fas fa-bars text-xl"></i>
                </button>
                <div id="nav-menu"
                    class="hidden md:flex md:items-baseline md:space-x-4 absolute md:static top-16 left-0 w-full md:w-auto bg-white md:bg-transparent border-t md:border-none px-2 md:px-0 pt-2 md:pt-0 pb-3 md:pb-0">
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary' }} block md:inline-block px-3 py-2 rounded-md text-base md:text-sm font-medium transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('profile.index') }}"
                        class="{{ request()->routeIs('profile.index') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary' }} block md:inline-block px-3 py-2 rounded-md text-base md:text-sm font-medium transition-colors">
                        Profil
                    </a>
                    <a href="{{ route('layanan.index') }}"
                        class="{{ request()->is('layanan*') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary' }} block md:inline-block px-3 py-2 rounded-md text-base md:text-sm font-medium transition-colors">
                        Layanan
                    </a>
                    <a href="{{ route('berita.index') }}"
                        class="{{ request()->is('berita*') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary' }} block md:inline-block px-3 py-2 rounded-md text-base md:text-sm font-medium transition-colors">
                        Berita
                    </a>
                    <a href="{{ route('kontak.index') }}"
                        class="{{ request()->routeIs('kontak.index') ? 'text-primary bg-primary/10' : 'text-gray-700 hover:text-primary' }} block md:inline-block px-3 py-2 rounded-md text-base md:text-sm font-medium transition-colors">
                        Kontak
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
