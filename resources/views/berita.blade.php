@extends('user.layouts.app')
@section('title', 'Berita - Sukowinangun')

@section('content')

    <!-- Page Header -->
    <section class="pt-16 bg-gradient-to-r from-primary to-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="text-center text-white">
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4">Berita</h1>
                <p class="text-base sm:text-lg md:text-xl text-gray-100 max-w-3xl mx-auto px-2 sm:px-0">
                    Informasi terkini seputar kegiatan dan perkembangan di Kelurahan Sukowinangun. Dapatkan berita terbaru
                    dan penting yang mempengaruhi masyarakat kita.
                </p>
            </div>
        </div>
    </section>

    <!-- Featured News -->
    <section class="py-12 sm:py-16 md:py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8 sm:mb-12">
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3 sm:mb-4">Berita Utama</h2>
            </div>

            @if ($mostViewedPost)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-10 md:gap-12 mb-12 sm:mb-16">
                    <div class="h-full border border-gray-200 rounded-lg overflow-hidden shadow-md">
                        <img src="{{ asset('storage/' . $mostViewedPost->image) }}" alt="{{ $mostViewedPost->title }}"
                            class="w-full h-auto sm:h-full max-h-[400px] object-cover rounded-lg shadow-lg">
                    </div>
                    <div class="flex flex-col justify-center">
                        <div class="flex items-center text-xs sm:text-sm text-gray-500 mb-2 sm:mb-3">
                            <i class="fas fa-calendar mr-1 sm:mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($mostViewedPost->published_at)->translatedFormat('d F Y') }}</span>
                            <span class="mx-1 sm:mx-2">•</span>
                            <i class="fas fa-user mr-1 sm:mr-2"></i>
                            <span>{{ $mostViewedPost->author ?? 'Admin Desa' }}</span>
                        </div>
                        <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-3 sm:mb-4">
                            {{ $mostViewedPost->title }}
                        </h2>
                        <p class="text-gray-600 mb-4 sm:mb-6 leading-relaxed text-sm sm:text-base">
                            {{ $mostViewedPost->summary }}...
                        </p>
                        <div class="flex items-center">
                            <span
                                class="bg-primary/10 text-primary px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-semibold mr-2 sm:mr-3">
                                {{ $mostViewedPost->category ?? 'Umum' }}
                            </span>
                        </div>
                        <div class="mt-3 sm:mt-4">
                            <a href="{{ route('berita.show', $mostViewedPost->slug) }}"
                                class="inline-block text-primary font-semibold text-sm sm:text-base hover:text-secondary transition-colors">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-1 sm:ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-gray-600 text-center py-8">Tidak ada berita utama saat ini.</p>
            @endif
        </div>
    </section>

    <!-- Latest News -->
    <section class="py-8 sm:py-12 md:py-16 lg:py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 xs:px-6 sm:px-8 lg:px-10">
            <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">
                <h2 class="text-xl xs:text-2xl sm:text-3xl font-bold text-gray-800 mb-2 xs:mb-3 sm:mb-4">Berita Terbaru</h2>
            </div>

            <div
                class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 xs:gap-5 sm:gap-6 md:gap-7 lg:gap-8">
                @forelse ($posts as $post)
                    <a href="{{ route('berita.show', $post->slug) }}"
                        class="block group bg-white rounded-lg sm:rounded-xl shadow-sm xs:shadow-md sm:shadow-lg overflow-hidden border border-gray-100 hover:border-primary hover:shadow-xl hover:scale-[1.02] transition-all duration-300 ease-in-out">
                        <article class="h-full flex flex-col">
                            <!-- Image with proper aspect ratio -->
                            <div class="relative pt-[56.25%] overflow-hidden">
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                    class="absolute top-0 left-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            </div>

                            <!-- Content -->
                            <div class="p-3 xs:p-4 sm:p-5 flex-grow flex flex-col">
                                <div class="flex items-center text-xs xs:text-sm text-gray-500 mb-1 xs:mb-2">
                                    <i class="fas fa-calendar mr-1 xs:mr-2 text-xs"></i>
                                    <span>{{ \Carbon\Carbon::parse($post->published_at)->translatedFormat('d F Y') }}</span>
                                </div>

                                <h3
                                    class="text-base xs:text-lg sm:text-xl font-bold text-gray-800 mb-2 xs:mb-3 line-clamp-2">
                                    {{ $post->title }}
                                </h3>

                                <p
                                    class="text-gray-600 mb-2 xs:mb-3 text-xs xs:text-sm sm:text-base line-clamp-3 flex-grow">
                                    {{ strip_tags($post->summary) }}...
                                </p>

                                <div class="flex items-center justify-between mt-auto pt-2">
                                    <span
                                        class="bg-accent/10 text-accent px-2 xs:px-3 py-1 rounded-full text-xxs xs:text-xs sm:text-sm font-medium xs:font-semibold">
                                        {{ $post->category ?? 'Umum' }}
                                    </span>
                                    <span
                                        class="inline-flex items-center text-primary font-medium xs:font-semibold text-xs xs:text-sm sm:text-base group-hover:text-secondary transition-colors">
                                        Baca <span class="hidden xs:inline ml-1">Selengkapnya</span> <i
                                            class="fas fa-arrow-right ml-1 xs:ml-2 text-xs"></i>
                                    </span>
                                </div>
                            </div>
                        </article>
                    </a>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <p class="text-gray-500 text-sm sm:text-base md:text-lg">Belum ada berita tersedia.</p>
                    </div>
                @endforelse
            </div>



        </div>
    </section>
@endsection
