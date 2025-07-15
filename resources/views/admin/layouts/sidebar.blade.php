<div class="sidebar bg-white w-64 shadow-lg flex flex-col z-50">
    <!-- Logo -->
    <div class="p-5 border-b border-gray-200">
        <div class="flex items-center">
            <img class="h-10 w-10 mr-3" src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa">
            <div>
                <h1 class="text-lg font-bold text-primary">HaloSuko</h1>
                <p class="text-sm text-gray-600">Kelurahan Sukowinangun</p>
            </div>
        </div>
    </div>
    <!-- Navigation -->
    <nav class="flex-1 p-4 overflow-y-auto">
        <ul class="space-y-2">
            <li>
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-lg font-medium
                {{ request()->routeIs('dashboard') ? 'text-primary bg-primary/10' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('posts.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg font-medium
                {{ request()->routeIs('posts.*') ? 'text-primary bg-primary/10' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                    <i class="fas fa-newspaper mr-3"></i>
                    <span>Kelola Berita</span>
                </a>
            </li>
            <li>
                <a href="{{ route('arsip-surat.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg font-medium
                    {{ request()->routeIs('arsip-surat.*') ? 'text-primary bg-primary/10' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                    <i class="fas fa-archive mr-3"></i>
                    <span>Arsip Surat</span>
                </a>

            </li>
            <!-- Menu Layanan dengan Dropdown -->
@php
    // Cek apakah salah satu dari submenu aktif
    $isLayananActive = request()->routeIs('sku.*') ||
                       request()->routeIs('domisili.*') ||
                       request()->routeIs('sktm.*') ||
                       request()->routeIs('belum-menikah.*') ||
                       request()->routeIs('skck.*') ||
                       request()->routeIs('harga-tanah.*') ||
                       request()->routeIs('kehilangan.*') ||
                       request()->routeIs('kelahiran.*') ||
                       request()->routeIs('kematian.*') ||
                       request()->routeIs('penghasilan.*') ||
                       request()->routeIs('lainnya');
@endphp

<li class="dropdown-container">
    <button onclick="toggleDropdown(this)"
        class="flex items-center justify-between w-full px-4 py-3 rounded-lg font-medium
        {{ $isLayananActive ? 'text-primary bg-primary/10' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
        <div class="flex items-center">
            <i class="fas fa-concierge-bell mr-3"></i>
            <span>Layanan</span>
        </div>
        <i class="fas fa-chevron-down text-xs transition-transform duration-200 dropdown-icon"></i>
    </button>

    <!-- Submenu Dropdown -->
    <ul class="ml-4 mt-1 space-y-1 dropdown-menu {{ $isLayananActive ? '' : 'hidden' }}">
        <li>
            <a href="{{ route('sku.index') }}"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('sku.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>Pengajuan SKU</span>
            </a>
        </li>
        <li>
            <a href="{{ route('domisili.index') }}"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('domisili.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>Surat Domisili</span>
            </a>
        </li>
        <li>
            <a href="{{ route('sktm.index') }}"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('sktm.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>SKTM</span>
            </a>
        </li>
        <li>
            <a href="{{ route('belum-menikah.index') }}"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('belum-menikah.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>Suket Belum Menikah</span>
            </a>
        </li>
        <li>
            <a href="{{ route('skck.index') }}"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('skck.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>Surat Pengantar SKCK</span>
            </a>
        </li>
        <li>
            <a href="{{ route('harga-tanah.index') }}"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('harga-tanah.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>Suket Harga Tanah</span>
            </a>
        </li>
        <li>
            <a href="{{ route('kehilangan.index') }}"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('kehilangan.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>Suket Kehilangan</span>
            </a>
        </li>
        <li>
            <a href="{{ route('kelahiran.index') }}"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('kelahiran.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>Suket Kelahiran</span>
            </a>
        </li>
        <li>
            <a href="{{ route('kematian.index') }}"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('kematian.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>Suket Kematian</span>
            </a>
        </li>
        <li>
            <a href="{{ route('penghasilan.index') }}"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('penghasilan.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>Suket Penghasilan</span>
            </a>
        </li>
        <li>
            <a href="#"
                class="flex items-center px-4 py-2 rounded-lg text-sm font-medium
                {{ request()->routeIs('lainnya.*') ? 'text-primary bg-primary/10 font-semibold' : 'text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors' }}">
                <span>Suket Lainnya</span>
            </a>
        </li>
    </ul>
</li>

        </ul>
    </nav>
    <!-- User Info -->
    <div class="p-4 border-t border-gray-200 mt-auto">
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
                class="w-full mt-3 px-4 py-2 text-sm text-gray-600 hover:text-red-600 transition-colors cursor-pointer">
                <i class="fas fa-sign-out-alt mr-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>
