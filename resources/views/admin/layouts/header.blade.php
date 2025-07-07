<header class="bg-white shadow-sm border-b border-gray-200 px-6 py-4">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
            <p class="text-gray-600">@yield('page-description', 'Selamat datang di panel admin Desa Maju Sejahtera')</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="text-right">
                <p class="text-sm text-gray-600">Hari ini</p>
                <p class="text-lg font-semibold text-gray-800" id="currentDate"></p>
            </div>
            <div class="bg-primary/10 p-3 rounded-lg">
                <i class="fas fa-calendar text-primary text-xl"></i>
            </div>
        </div>
    </div>
</header>
