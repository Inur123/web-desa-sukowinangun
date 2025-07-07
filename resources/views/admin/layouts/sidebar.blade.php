<div class="bg-white w-64 shadow-lg flex flex-col">
    <!-- Logo -->
    <div class="p-5 border-b border-gray-200">
        <div class="flex items-center">
            <img class="h-10 w-10 mr-3" src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa">
            <div>
                <h1 class="text-lg font-bold text-primary">Dashboard</h1>
                <p class="text-sm text-gray-600">Desa Maju Sejahtera</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 p-4">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 text-primary bg-primary/10 rounded-lg font-medium">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href=""
                    class="flex items-center px-4 py-3 text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors">
                    <i class="fas fa-newspaper mr-3"></i>
                    <span>Kelola Berita</span>
                </a>
            </li>
            <li>
                <a href="/"
                    class="flex items-center px-4 py-3 text-gray-600 hover:text-primary hover:bg-gray-50 rounded-lg transition-colors">
                    <i class="fas fa-globe mr-3"></i>
                    <span>Lihat Website</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- User Info -->
    <div class="p-4 border-t border-gray-200">
        <div class="flex items-center">
            <div
                class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-sm uppercase">
                {{ collect(explode(' ', Auth::user()->name))->take(2)->map(fn($n) => substr($n, 0, 1))->implode('') }}
            </div>

            <div class="ml-3">
                <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500">Administrator</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit"
                class="w-full mt-3 px-4 py-2 text-sm text-gray-600 hover:text-red-600 transition-colors">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>
