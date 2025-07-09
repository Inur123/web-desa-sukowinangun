@extends('user.layouts.app')
@section('title', 'Beranda - Sukowinangun')

@section('content')
    <!-- Hero Section -->
    <section class="pt-16 bg-gradient-to-br from-primary to-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="text-white">
                    <h1 class="text-4xl md:text-6xl font-bold mb-6">
                        Selamat Datang di<br />
                        <span class="text-accent">Kelurahan Sukowinangun</span>
                    </h1>
                    <p class="text-xl mb-8 text-gray-100">
                        Desa yang berkembang dengan semangat gotong royong, teknologi
                        modern, dan pelayanan terbaik untuk seluruh warga.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="layanan.html"
                            class="bg-accent hover:bg-yellow-600 text-white px-8 py-3 rounded-lg font-semibold transition-colors text-center">
                            Layanan Online
                        </a>
                        <a href="profil.html"
                            class="border-2 border-white text-white hover:bg-white hover:text-primary px-8 py-3 rounded-lg font-semibold transition-colors text-center">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>
                <div class="relative">
                    <img src="/placeholder.svg?height=500&width=600" alt="Pemandangan Desa" class="rounded-lg shadow-2xl" />
                    <div class="absolute -bottom-6 -left-6 bg-white p-6 rounded-lg shadow-lg">
                        <div class="flex items-center">
                            <i class="fas fa-users text-primary text-2xl mr-3"></i>
                            <div>
                                <p class="text-2xl font-bold text-gray-800 population-counter" data-target="2547">0</p>
                                <p class="text-gray-600">Total Penduduk</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <!-- Kepala Keluarga -->
                <div class="text-center transform hover:scale-105 transition-transform duration-300">
                    <div
                        class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                        <i class="fas fa-home text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 counter" data-target="847">
                        0
                    </h3>
                    <p class="text-gray-600">Kepala Keluarga</p>
                </div>

                <!-- Sekolah -->
                <div class="text-center transform hover:scale-105 transition-transform duration-300">
                    <div
                        class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                        <i class="fas fa-users text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 counter" data-target="12">
                        0
                    </h3>
                    <p class="text-gray-600">RW</p>
                </div>

                <!-- Puskesmas -->
                <div class="text-center transform hover:scale-105 transition-transform duration-300">
                    <div
                        class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                        <i class="fas fa-home text-accent text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 counter" data-target="3">
                        0
                    </h3>
                    <p class="text-gray-600">RT</p>
                </div>

                <!-- Area Hijau -->
                <div class="text-center transform hover:scale-105 transition-transform duration-300">
                    <div
                        class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                        <i class="fas fa-leaf text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 counter" data-target="95">
                        0
                    </h3>
                    <p class="text-gray-600">Area Hijau</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Services -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">
                    Layanan Unggulan
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Akses cepat ke layanan-layanan utama yang paling sering digunakan
                    warga desa.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <a href="layanan.html"
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-file-alt text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        Surat Keterangan
                    </h3>
                    <p class="text-gray-600">
                        Pengurusan berbagai surat keterangan dengan proses yang mudah dan
                        cepat.
                    </p>
                </a>

                <a href="layanan.html"
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-id-card text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        Administrasi KTP
                    </h3>
                    <p class="text-gray-600">
                        Layanan pembuatan dan perpanjangan KTP serta kartu keluarga.
                    </p>
                </a>

                <a href="layanan.html"
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-handshake text-accent text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Izin Usaha</h3>
                    <p class="text-gray-600">
                        Pengurusan izin usaha mikro dan kecil untuk warga desa.
                    </p>
                </a>
            </div>
        </div>
    </section>
    <!-- Logo Lembaga Desa -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-10">Partner</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-8 items-center justify-center">
                <!-- Karang Taruna -->
                <div class="flex flex-col items-center">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="Karang Taruna"
                        class="w-20 h-20 object-contain mb-3">
                    <p class="text-gray-700 font-semibold">Karang Taruna</p>
                </div>
                <!-- PKK -->
                <div class="flex flex-col items-center">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="PKK" class="w-20 h-20 object-contain mb-3">
                    <p class="text-gray-700 font-semibold">PKK</p>
                </div>
                <!-- BUMDes -->
                <div class="flex flex-col items-center">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="BUMDes" class="w-20 h-20 object-contain mb-3">
                    <p class="text-gray-700 font-semibold">BUMDes</p>
                </div>
                <!-- LPM -->
                <div class="flex flex-col items-center">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="LPM" class="w-20 h-20 object-contain mb-3">
                    <p class="text-gray-700 font-semibold">LPM</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest News -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-16">
                <div>
                    <h2 class="text-4xl font-bold text-gray-800 mb-4">
                        Berita Terkini
                    </h2>
                    <p class="text-xl text-gray-600">
                        Informasi terbaru seputar kegiatan desa.
                    </p>
                </div>
                <a href="{{ route('berita.index') }}"
                    class="bg-primary hover:bg-secondary text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                    Lihat Semua
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($posts as $post)
                    <a href="{{ route('berita.show', $post->slug) }}"
                        class="block group bg-white rounded-xl shadow-lg overflow-hidden border border-transparent hover:border-primary hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
                        <article>
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="w-full aspect-video object-cover">
                            <div class="p-6">
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>{{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') }}</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800 mb-3">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-gray-600 mb-4">
                                    {{ strip_tags($post->summary) }}....
                                </p>

                                <span
                                    class="inline-block text-primary font-semibold group-hover:text-secondary transition-colors">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                                </span>
                            </div>
                        </article>
                    </a>
                @empty
                    <p class="text-gray-600">Belum ada berita tersedia.</p>
                @endforelse
            </div>


        </div>
    </section>


@endsection
