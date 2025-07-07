@extends('user.layouts.app')
@section('title', 'Berita - Sukowinangun')
@section('content')

    <!-- Page Header -->
    <section class="pt-16 bg-gradient-to-r from-primary to-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Berita</h1>
                <p class="text-xl text-gray-100 max-w-3xl mx-auto">
                    Informasi terkini seputar kegiatan dan perkembangan di Desa Maju Sejahtera
                </p>
            </div>
        </div>
    </section>

    <!-- Featured News -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Berita Utama</h2>
            </div>

            @if ($mostViewedPost)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
                    <div>
                        <img src="{{ asset('storage/' . $mostViewedPost->image) }}" alt="{{ $mostViewedPost->title }}"
                            class="w-full h-full object-cover rounded-lg shadow-lg">
                    </div>
                    <div>
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2"></i>
                            <span>{{ \Carbon\Carbon::parse($mostViewedPost->published_at)->translatedFormat('d F Y') }}</span>
                            <span class="mx-2">•</span>
                            <i class="fas fa-user mr-2"></i>
                            <span>{{ $mostViewedPost->author ?? 'Admin Desa' }}</span>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">
                            {{ $mostViewedPost->title }}
                        </h2>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {{ $mostViewedPost->summary }}...
                        </p>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            {!! Str::limit(strip_tags($mostViewedPost->content), 200) !!}
                        </p>
                        <div class="flex items-center">
                            <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-semibold mr-3">
                                {{ $mostViewedPost->category ?? 'Umum' }}
                            </span>
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('berita.show', $mostViewedPost->slug) }}"
                                class="inline-block text-primary font-semibold hover:text-secondary transition-colors">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-gray-600">Tidak ada berita utama saat ini.</p>
            @endif
        </div>
    </section>

    <!-- Latest News -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Berita Terbaru</h2>
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
                                    {{ $post->summary }}...
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="bg-accent/10 text-accent px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $post->category ?? 'Umum' }}
                                    </span>
                                    <span
                                        class="inline-block text-primary font-semibold group-hover:text-secondary transition-colors">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                                    </span>
                                </div>
                            </div>
                        </article>
                    </a>
                @empty
                    <p class="text-gray-600 col-span-3">Belum ada berita tersedia.</p>
                @endforelse
            </div>

        </div>
    </section>
@endsection
