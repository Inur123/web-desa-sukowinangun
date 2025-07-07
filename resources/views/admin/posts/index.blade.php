@extends('admin.layouts.app')
@section('title', 'Berita')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-primary/10 p-3 rounded-lg">
                    <i class="fas fa-newspaper text-primary text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-800">{{ $totalBerita }}</p>
                    <p class="text-gray-600 text-sm">Total Berita</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-lg">
                    <i class="fas fa-eye text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-800">1,247</p>
                    <p class="text-gray-600 text-sm">Total Views</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i class="fas fa-calendar text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-800">{{ $bulanIni }}</p>
                    <p class="text-gray-600 text-sm">Bulan Ini</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-yellow-100 p-3 rounded-lg">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-2xl font-bold text-gray-800">{{ $activePosts }}</p>
                    <p class="text-gray-600 text-sm">Active</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-6 justify-end flex">
        <a href="{{ route('posts.create') }}"
            class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors">
            <i class="fas fa-plus mr-2"></i>
            Tambah Berita
        </a>
    </div>
    <!-- Posts Table -->

    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Daftar Berita</h2>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Cari berita..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <select
                        class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option>Semua Status</option>
                        <option>Active</option>
                        <option>Nonactive</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : '/placeholder.svg?height=50&width=80' }}"
                                        alt="Thumbnail" class="w-12 h-8 object-cover rounded mr-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-800">{{ $post->title }}</p>
                                        <p class="text-xs text-gray-500">{{ Str::limit($post->summary, 50) }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-primary/10 text-primary px-2 py-1 rounded-full text-xs font-semibold">
                                    {{ $post->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($post->status === 'active')
                                    <span
                                        class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">Active</span>
                                @else
                                    <span
                                        class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-semibold">Nonactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $post->views ?? 0 }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                        class="text-blue-600 hover:text-blue-800" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('posts.show', $post->slug) }}"
                                        class="text-green-600 hover:text-green-800" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500">Belum ada data berita.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Menampilkan {{ $posts->firstItem() }} - {{ $posts->lastItem() }} dari {{ $posts->total() }} berita
                </div>
                <div class="flex items-center space-x-2">
                    {{-- Tombol Previous --}}
                    @if ($posts->onFirstPage())
                        <span class="px-3 py-1 text-sm text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Tombol Halaman --}}
                    @php
                        // Tentukan range halaman yang akan ditampilkan
                        $start = max(1, $posts->currentPage() - 1);
                        $end = min($posts->lastPage(), $posts->currentPage() + 1);

                        // Pastikan selalu ada 3 tombol jika memungkinkan
                        if ($end - $start < 2) {
                            if ($start == 1) {
                                $end = min($start + 2, $posts->lastPage());
                            } else {
                                $start = max($end - 2, 1);
                            }
                        }
                    @endphp

                    {{-- Tampilkan tombol halaman pertama jika tidak termasuk dalam range --}}
                    @if ($start > 1)
                        <a href="{{ $posts->url(1) }}" class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">1</a>
                        @if ($start > 2)
                            <span class="px-3 py-1 text-sm text-gray-500">...</span>
                        @endif
                    @endif

                    {{-- Tampilkan range halaman --}}
                    @for ($i = $start; $i <= $end; $i++)
                        @if ($i == $posts->currentPage())
                            <span class="px-3 py-1 text-sm bg-primary text-white rounded">{{ $i }}</span>
                        @else
                            <a href="{{ $posts->url($i) }}" class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">{{ $i }}</a>
                        @endif
                    @endfor

                    {{-- Tampilkan tombol halaman terakhir jika tidak termasuk dalam range --}}
                    @if ($end < $posts->lastPage())
                        @if ($end < $posts->lastPage() - 1)
                            <span class="px-3 py-1 text-sm text-gray-500">...</span>
                        @endif
                        <a href="{{ $posts->url($posts->lastPage()) }}" class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">{{ $posts->lastPage() }}</a>
                    @endif

                    {{-- Tombol Next --}}
                    @if ($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" class="px-3 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-3 py-1 text-sm text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
