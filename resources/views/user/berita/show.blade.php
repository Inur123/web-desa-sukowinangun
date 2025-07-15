@extends('user.layouts.app')
@section('title', $post->title . ' - Berita Sukowinangun')
@push('meta')
    <meta name="description" content="{{ $post->summary ?? strip_tags(Str::limit($post->content, 150)) }}">
    <meta property="og:title" content="{{ $post->title }} - Berita Sukowinangun" />
    <meta property="og:description" content="{{ $post->summary ?? strip_tags(Str::limit($post->content, 150)) }}" />
    <meta property="og:image" content="{{ asset('storage/' . $post->image) }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="article" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $post->title }} - Berita Sukowinangun" />
    <meta name="twitter:description" content="{{ $post->summary ?? strip_tags(Str::limit($post->content, 150)) }}" />
    <meta name="twitter:image" content="{{ asset('storage/' . $post->image) }}" />
@endpush
@section('content')
    <section class="pt-20 pb-4 bg-white border-b border-gray-200">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center space-x-2 text-sm text-gray-500">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">
                    <i class="fas fa-home"></i>
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('berita.index') }}" class="hover:text-primary transition-colors">Berita</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-gray-800 line-clamp-1">{{ $post->title }}</span>
            </nav>
        </div>
    </section>
    <article class="py-12 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <header class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-sm font-semibold">
                        <i class="fas fa-tag mr-1"></i>
                        {{ $post->category ?? 'Umum' }}
                    </span>
                    <div class="flex items-center text-gray-500 text-sm">
                        <i class="fas fa-calendar mr-2"></i>
                        @php
                            use Carbon\Carbon;
                            $published =
                                $post->published_at instanceof Carbon
                                    ? $post->published_at
                                    : Carbon::parse($post->published_at);
                        @endphp
                        <time datetime="{{ $published->format('Y-m-d') }}">
                            {{ $published->translatedFormat('d F Y') }}
                        </time>
                    </div>
                    <div class="flex items-center text-gray-500 text-sm">
                        <i class="fas fa-eye mr-2"></i>
                        <span>{{ $post->views }} dilihat</span>
                    </div>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 leading-tight mb-4">
                    {{ $post->title }}
                </h1>
                <div class="flex items-center justify-between py-4 border-y border-gray-200">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center mr-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $post->author ?? 'Admin Desa' }}</p>
                            <p class="text-xs text-gray-500">Pemerintah Kelurahan Sukowinangun</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-eye mr-1"></i>
                            {{ $post->views }} views
                        </span>
                        <button onclick="copyToClipboard()" class="text-gray-500 hover:text-primary transition-colors">
                            <i class="fas fa-share-alt"></i>
                        </button>
                    </div>
                </div>
            </header>
            <div class="mb-8">
                <div class="w-full h-64 md:h-auto md:max-h-[80vh] overflow-hidden rounded-xl shadow-lg">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                        class="w-full h-full object-contain md:object-cover">
                </div>
                @if ($post->image_caption)
                    <p class="text-sm text-gray-500 text-center mt-2 italic">
                        {{ $post->image_caption }}
                    </p>
                @endif
            </div>
            <div class="prose prose-lg max-w-none">
                <div class="space-y-6 text-gray-700 leading-relaxed">
                    {!! $post->content !!}
                </div>
                @if ($post->additionalImages->count() > 0)
                    <hr class="my-8 border-gray-300">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Dokumentasi Kegiatan</h2>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach ($post->additionalImages as $image)
                            <div class="relative overflow-hidden rounded-lg">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Dokumentasi Kegiatan"
                                    class="w-full h-40 object-cover hover:scale-105 transition-transform duration-300">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            @if ($post->tags->count())
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">Tags:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($post->tags as $tag)
                            <span
                                class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-gray-200 transition-colors cursor-pointer">
                                #{{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Bagikan artikel ini:</h3>
                <div class="flex flex-wrap gap-3">
                    <input type="text" id="linkToCopy" value="{{ url()->current() }}" readonly
                        class="text-gray-700 text-sm px-2 py-1 rounded border border-gray-300 hidden">
                    <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition-colors inline-flex items-center">
                        <i class="fab fa-whatsapp mr-2"></i>
                        Bagikan ke WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </article>
@endsection
