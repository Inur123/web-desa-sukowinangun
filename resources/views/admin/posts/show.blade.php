@extends('admin.layouts.app')
@section('title', 'Lihat Berita')
@section('content')

    <div class="bg-white rounded-xl shadow-xl w-full max-w-7xl mx-auto">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800">Detail Berita</h2>
                <a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </a>
            </div>
        </div>
        <div class="p-6 space-y-6">
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $post->title }}</h3>

                @if ($post->published_at)
                    <p class="text-sm text-gray-500">Diterbitkan pada:
                        {{ \Carbon\Carbon::parse($post->published_at)->format('d M Y, H:i') }}</p>
                @endif

                @if ($post->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                            class="w-full h-auto rounded-lg shadow-sm">
                    </div>
                @endif

                @if ($post->content)
                    <div class="mt-4 prose max-w-none">
                        {!! $post->content !!}
                    </div>
                @endif
            </div>

            <div class="mt-6">
                <h4 class="text-md font-semibold text-gray-800">Kategori:</h4>
                <p class="text-sm text-gray-600">{{ $post->category }}</p>
            </div>

            <div class="mt-6">
                <h4 class="text-md font-semibold text-gray-800">Tags:</h4>
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($post->tags as $tag)
                        <li class="text-sm text-gray-600">{{ $tag->name }}</li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-6">
                <h4 class="text-md font-semibold text-gray-800">Ringkasan:</h4>
                <p class="text-sm text-gray-600">{{ $post->summary ?? '-' }}</p>
            </div>

            <div class="mt-6">
                <h4 class="text-md font-semibold text-gray-800">Status:</h4>
                <span
                    class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                {{ $post->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                    {{ $post->status === 'active' ? 'Published' : 'Draft' }}
                </span>
            </div>

            <div class="mt-6">
                <h4 class="text-md font-semibold text-gray-800">Views:</h4>
                <p class="text-sm text-gray-600">{{ $post->views ?? 0 }}</p>
            </div>
        </div>
    </div>
@endsection
