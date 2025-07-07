<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <img class="h-10 w-15" src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa" />
                </div>
                <div class="ml-3">
                    <h1 class="text-xl font-bold text-primary">Kelurahan Sukowinangun</h1>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="{{ route('home') }}" class="text-primary hover:text-secondary px-3 py-2 rounded-md text-sm font-medium transition-colors bg-primary/10">Beranda</a>
                    <a href="" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Profil</a>
                    <a href="" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Layanan</a>
                    <a href="" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Berita</a>
                    <a href="" class="text-gray-700 hover:text-primary px-3 py-2 rounded-md text-sm font-medium transition-colors">Kontak</a>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-primary focus:outline-none focus:text-primary">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
            <a href="{{ route('home') }}" class="text-primary block px-3 py-2 rounded-md text-base font-medium bg-primary/10">Beranda</a>
            <a href="" class="text-gray-700 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Profil</a>
            <a href="" class="text-gray-700 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Layanan</a>
            <a href="" class="text-gray-700 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Berita</a>
            <a href="" class="text-gray-700 hover:text-primary block px-3 py-2 rounded-md text-base font-medium">Kontak</a>
        </div>
    </div>
</nav>
