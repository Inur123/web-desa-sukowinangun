@extends('user.layouts.app')
@section('title', 'Beranda - Sukowinangun')

@section('content')
    <style>
        .typing-cursor {
            font-weight: bold;
            color: #f59e0b;
            margin-left: 2px;
        }

        .typing-cursor.blinking {
            animation: blink 1s step-start infinite;
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0;
            }
        }

        #typing-text {
            display: inline-block;
            min-width: 20ch;
            /* Responsive min-width for mobile */
            white-space: nowrap;
        }

        @media (min-width: 640px) {
            #typing-text {
                min-width: 28ch;
            }
        }

        /* Text truncation utility */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
    <section class="pt-16 bg-gradient-to-br from-primary to-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 items-center" data-aos="zoom-in">
                <div class="text-white">
                    <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 sm:mb-6 leading-tight">
                        Selamat Datang di<br />
                        <span id="typing-text" class="text-accent text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold whitespace-nowrap"></span>
                    </h1>
                    <p class="text-base sm:text-lg md:text-xl mb-6 sm:mb-8 text-gray-100 leading-relaxed">
                        Desa yang berkembang dengan semangat gotong royong, teknologi
                        modern, dan pelayanan terbaik untuk seluruh warga.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <a href="{{ route('layanan.index') }}"
                            class="bg-accent hover:bg-yellow-600 text-white px-6 sm:px-8 py-3 rounded-lg font-semibold transition-colors text-center text-sm sm:text-base">
                            Layanan Online
                        </a>
                        <a href="{{ route('profile.index') }}"
                            class="border-2 border-white text-white hover:bg-white hover:text-primary px-6 sm:px-8 py-3 rounded-lg font-semibold transition-colors text-center text-sm sm:text-base">
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                    <div class="lg:hidden mt-6 sm:mt-8 bg-white p-4 sm:p-6 rounded-lg shadow-lg w-full max-w-xs mx-auto">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-users text-primary text-xl sm:text-2xl mr-2 sm:mr-3"></i>
                            <div>
                                <p class="text-xl sm:text-2xl font-bold text-gray-800 population-counter" data-target="2547">0</p>
                                <p class="text-gray-600 text-sm sm:text-base">Total Penduduk</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative hidden lg:block">
                    <div class="absolute -bottom-6 -left-6 bg-white p-4 sm:p-6 rounded-lg shadow-lg">
                        <div class="flex items-center">
                            <i class="fas fa-users text-primary text-xl sm:text-2xl mr-2 sm:mr-3"></i>
                            <div>
                                <p class="text-xl sm:text-2xl font-bold text-gray-800 population-counter" data-target="2547">0</p>
                                <p class="text-gray-600 text-sm sm:text-base">Total Penduduk</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-12 sm:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="zoom-in">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                <div class="text-center transform hover:scale-105 transition-transform duration-300">
                    <div
                        class="bg-primary/10 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 animate-pulse">
                        <i class="fas fa-home text-primary text-lg sm:text-2xl"></i>
                    </div>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 counter population-counter" data-target="847">
                        0
                    </h3>
                    <p class="text-gray-600 text-xs sm:text-sm lg:text-base">Kepala Keluarga</p>
                </div>
                <div class="text-center transform hover:scale-105 transition-transform duration-300">
                    <div
                        class="bg-secondary/10 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 animate-pulse">
                        <i class="fas fa-users text-secondary text-lg sm:text-2xl"></i>
                    </div>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 counter population-counter" data-target="12">
                        0
                    </h3>
                    <p class="text-gray-600 text-xs sm:text-sm lg:text-base">RW</p>
                </div>
                <div class="text-center transform hover:scale-105 transition-transform duration-300">
                    <div
                        class="bg-accent/10 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 animate-pulse">
                        <i class="fas fa-home text-accent text-lg sm:text-2xl"></i>
                    </div>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 counter population-counter" data-target="3">
                        0
                    </h3>
                    <p class="text-gray-600 text-xs sm:text-sm lg:text-base">RT</p>
                </div>
                <div class="text-center transform hover:scale-105 transition-transform duration-300">
                    <div
                        class="bg-blue-100 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mx-auto mb-3 sm:mb-4 animate-pulse">
                        <i class="fas fa-tasks text-blue-600 text-lg sm:text-2xl"></i>
                    </div>
                    <h3 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 counter population-counter" data-target="11">
                        0
                    </h3>
                    <p class="text-gray-600 text-xs sm:text-sm lg:text-base">Total Layanan</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16" data-aos="fade-up">
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800 mb-3 sm:mb-4">
                    Layanan Unggulan
                </h2>
                <p class="text-base sm:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto px-4 sm:px-0">
                    Akses cepat ke layanan-layanan utama yang paling sering digunakan
                    warga desa.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                <a href="{{ route('lainnya.create') }}"
                    class="bg-white p-6 sm:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100"
                    data-aos="zoom-in" data-aos-delay="30">
                    <div class="bg-primary/10 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mb-4 sm:mb-6">
                        <i class="fas fa-file text-indigo-500 text-lg sm:text-2xl"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 sm:mb-4">
                        Surat Keterangan Lainnya
                    </h3>
                    <p class="text-gray-600 text-sm sm:text-base">
                        Pengurusan berbagai surat keterangan dengan proses yang mudah dan
                        cepat.
                    </p>
                </a>
                <a href="{{ route('layanan.index') }}"
                    class="bg-white p-6 sm:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100"
                    data-aos="zoom-in" data-aos-delay="30">
                    <div class="bg-secondary/10 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mb-4 sm:mb-6">
                        <i class="fas fa-id-card text-secondary text-lg sm:text-2xl"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 sm:mb-4">
                        Administrasi KTP
                    </h3>
                    <p class="text-gray-600 text-sm sm:text-base">
                        Layanan pembuatan dan perpanjangan KTP serta kartu keluarga.
                    </p>
                </a>
                <a href="{{ route('layanan.index') }}"
                    class="bg-white p-6 sm:p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100" data-aos="zoom-in"
                    data-aos-delay="30">
                    <div class="bg-accent/10 w-12 h-12 sm:w-16 sm:h-16 rounded-full flex items-center justify-center mb-4 sm:mb-6">
                        <i class="fas fa-handshake text-accent text-lg sm:text-2xl"></i>
                    </div>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 sm:mb-4">Izin Usaha</h3>
                    <p class="text-gray-600 text-sm sm:text-base">
                        Pengurusan izin usaha mikro dan kecil untuk warga desa.
                    </p>
                </a>
            </div>
            <div class="text-center mt-8 sm:mt-12" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('layanan.index') }}"
                    class="inline-block px-6 sm:px-8 py-3 bg-primary text-white font-medium rounded-lg hover:bg-primary-dark transition-colors text-sm sm:text-base">
                    Lihat Semua Layanan
                </a>
            </div>
        </div>
    </section>
    <section class="py-16 sm:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800 mb-8 sm:mb-10" data-aos="fade-up">Partner</h2>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 sm:gap-8 items-center justify-center">
                <div class="flex flex-col items-center" data-aos="fade-right" data-aos-delay="100">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="Karang Taruna"
                        class="w-16 h-16 sm:w-20 sm:h-20 object-contain mb-2 sm:mb-3">
                    <p class="text-gray-700 font-semibold text-sm sm:text-base">Karang Taruna</p>
                </div>
                <div class="flex flex-col items-center" data-aos="fade-right" data-aos-delay="200">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="PKK" class="w-16 h-16 sm:w-20 sm:h-20 object-contain mb-2 sm:mb-3">
                    <p class="text-gray-700 font-semibold text-sm sm:text-base">PKK</p>
                </div>
                <div class="flex flex-col items-center" data-aos="fade-right" data-aos-delay="300">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="BUMDes" class="w-16 h-16 sm:w-20 sm:h-20 object-contain mb-2 sm:mb-3">
                    <p class="text-gray-700 font-semibold text-sm sm:text-base">BUMDes</p>
                </div>
                <div class="flex flex-col items-center" data-aos="fade-right" data-aos-delay="400">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="LPM" class="w-16 h-16 sm:w-20 sm:h-20 object-contain mb-2 sm:mb-3">
                    <p class="text-gray-700 font-semibold text-sm sm:text-base">LPM</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-16 sm:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-12 sm:mb-16 gap-4">
                <div data-aos="fade-right" data-aos-delay="100" data-aos-duration="800">
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800 mb-3 sm:mb-4">
                        Berita Terkini
                    </h2>
                    <p class="text-base sm:text-lg lg:text-xl text-gray-600">
                        Informasi terbaru seputar kegiatan desa.
                    </p>
                </div>
                <a href="{{ route('berita.index') }}"
                    class="bg-primary hover:bg-secondary text-white px-4 sm:px-6 py-2 sm:py-3 rounded-lg font-semibold transition-colors text-sm sm:text-base whitespace-nowrap"
                    data-aos="fade-left" data-aos-delay="200" data-aos-duration="800">
                    Lihat Semua
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                @forelse ($posts as $index => $post)
                    <a href="{{ route('berita.show', $post->slug) }}"
                        class="block group bg-white rounded-xl shadow-lg overflow-hidden border border-transparent hover:border-primary hover:shadow-xl hover:scale-[1.02] transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="{{ 100 * $index }}" data-aos-duration="800">
                        <article>
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="w-full aspect-video object-cover">
                            <div class="p-4 sm:p-6">
                                <div class="flex items-center text-xs sm:text-sm text-gray-500 mb-2 sm:mb-3">
                                    <i class="fas fa-calendar mr-1 sm:mr-2"></i>
                                    <span>{{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') }}</span>
                                </div>
                                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2 sm:mb-3 line-clamp-2">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-gray-600 mb-3 sm:mb-4 text-sm sm:text-base line-clamp-3">
                                    {{ strip_tags($post->summary) }}....
                                </p>

                                <span
                                    class="inline-block text-primary font-semibold group-hover:text-secondary transition-colors text-sm sm:text-base">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-1 sm:ml-2"></i>
                                </span>
                            </div>
                        </article>
                    </a>
                @empty
                    <div class="col-span-full text-center py-8">
                        <p class="text-gray-600 text-sm sm:text-base">Belum ada berita tersedia.</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const text = "Kelurahan Sukowinangun";
            const target = document.getElementById("typing-text");
            let index = 0;
            let isDeleting = false;
            let cursor;
            cursor = document.createElement("span");
            cursor.classList.add("typing-cursor");
            cursor.textContent = "|";
            target.appendChild(cursor);
            function type() {
                target.childNodes[0].nodeValue = text.substring(0, index);
                if (isDeleting) {
                    index--;
                    cursor.classList.remove("blinking");
                } else {
                    index++;
                    cursor.classList.remove("blinking");
                }
                if (index === text.length + 1) {
                    isDeleting = true;
                    cursor.classList.add("blinking");
                    setTimeout(type, 1500);
                } else if (index === 0) {
                    isDeleting = false;
                    setTimeout(type, 500);
                } else {
                    setTimeout(type, isDeleting ? 50 : 100);
                }
            }
            target.insertBefore(document.createTextNode(""), cursor);
            type();
        });
    </script>
@endsection
