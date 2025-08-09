@extends('admin.layouts.app')
@section('title', 'Berita')

@section('content')
 <!-- Notification Popups -->
    @if (session('success'))
        <div class="fixed top-4 right-4 z-50 notification-popup">
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center animate-fade-in-down">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
                <button onclick="closeNotification(this)" class="ml-4">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="fixed top-4 right-4 z-50 notification-popup">
            <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg animate-fade-in-down">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>Terjadi kesalahan!</span>
                    <button onclick="closeNotification(this)" class="ml-4">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <ul class="mt-2 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
        <!-- Statistic Cards -->
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-primary/10 p-2 md:p-3 rounded-lg">
                    <i class="fas fa-newspaper text-primary text-lg md:text-xl"></i>
                </div>
                <div class="ml-3 md:ml-4">
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $totalBerita }}</p>
                    <p class="text-xs md:text-sm text-gray-600">Total Berita</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-green-100 p-2 md:p-3 rounded-lg">
                    <i class="fas fa-eye text-green-600 text-lg md:text-xl"></i>
                </div>
                <div class="ml-3 md:ml-4">
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $totalViews }}</p>
                    <p class="text-xs md:text-sm text-gray-600">Total Views</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-blue-100 p-2 md:p-3 rounded-lg">
                    <i class="fas fa-calendar text-blue-600 text-lg md:text-xl"></i>
                </div>
                <div class="ml-3 md:ml-4">
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $bulanIni }}</p>
                    <p class="text-xs md:text-sm text-gray-600">Bulan Ini</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-yellow-100 p-2 md:p-3 rounded-lg">
                    <i class="fas fa-clock text-yellow-600 text-lg md:text-xl"></i>
                </div>
                <div class="ml-3 md:ml-4">
                    <p class="text-xl md:text-2xl font-bold text-gray-800">{{ $activePosts }}</p>
                    <p class="text-xs md:text-sm text-gray-600">Active</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add News Button -->
    <div class="mb-4 md:mb-6 flex justify-end">
        <a href="{{ route('posts.create') }}"
            class="inline-flex items-center px-3 py-1 md:px-4 md:py-2 bg-primary text-white rounded-lg hover:bg-primary/90 transition-colors text-sm md:text-base">
            <i class="fas fa-plus mr-1 md:mr-2 text-xs md:text-sm"></i>
            Tambah Berita
        </a>
    </div>

    <!-- Posts Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Table Header -->
        <div class="p-4 md:p-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
                <h2 class="text-base md:text-lg font-semibold text-gray-800">Daftar Berita</h2>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 md:space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Cari berita..."
                            class="w-full pl-8 pr-3 py-1 md:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                        <i class="fas fa-search absolute left-2 top-2 md:top-3 text-gray-400 text-sm"></i>
                    </div>
                    <select
                        class="px-3 py-1 md:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                        <option>Semua Status</option>
                        <option>Active</option>
                        <option>Nonactive</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto">
            <table class="w-full min-w-max">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Judul</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Kategori</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Status</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Tanggal</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Views</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50">
                            <!-- Title Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4">
                                <div class="flex items-center">
                                    <img src="{{ $post->image ? asset('storage/' . $post->image) : '/placeholder.svg?height=50&width=80' }}"
                                        alt="Thumbnail" class="w-10 h-8 md:w-12 md:h-9 object-cover rounded mr-2 md:mr-3">
                                    <div class="min-w-0">
                                        <p
                                            class="text-xs md:text-sm font-medium text-gray-800 truncate max-w-[150px] md:max-w-xs">
                                            {{ $post->title }}</p>
                                        <p class="text-xs text-gray-500 truncate max-w-[150px] md:max-w-xs">
                                            {{ Str::limit(strip_tags($post->summary), 50) }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Category Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                <span
                                    class="bg-primary text-white px-2 py-0.5 md:py-1 rounded-full text-xs font-semibold">
                                    {{ $post->category }}
                                </span>
                            </td>

                            <!-- Status Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                @if ($post->status === 'active')
                                    <span
                                        class="bg-green-500 text-white px-2 py-0.5 md:py-1 rounded-full text-xs font-semibold">Active</span>
                                @else
                                    <span
                                        class="bg-red-500 text-white px-2 py-0.5 md:py-1 rounded-full text-xs font-semibold">Nonactive</span>
                                @endif
                            </td>

                            <!-- Date Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-600">
                                {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d M Y') : '-' }}
                            </td>

                            <!-- Views Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-600">
                                {{ $post->views ?? 0 }}
                            </td>

                            <!-- Actions Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-1 md:space-x-2">
                                    <a href="{{ route('posts.edit', $post->id) }}"
                                        class="text-primary hover:text-primary/90 text-sm md:text-base" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('posts.show', $post->slug) }}"
                                        class="text-green-600 hover:text-green-800 text-sm md:text-base" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm md:text-base cursor-pointer"
                                            title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 md:py-6 text-gray-500 text-sm md:text-base">Belum ada
                                data berita.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 md:px-6 md:py-4 border-t border-gray-200">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                <div class="text-xs md:text-sm text-gray-600">
                    Menampilkan {{ $posts->firstItem() }} - {{ $posts->lastItem() }} dari {{ $posts->total() }} berita
                </div>
                <div class="flex items-center space-x-1 md:space-x-2">
                    {{-- Previous Button --}}
                    @if ($posts->onFirstPage())
                        <span class="px-2 py-1 text-xs md:text-sm text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}"
                            class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Page Numbers --}}
                    @php
                        $start = max(1, $posts->currentPage() - 1);
                        $end = min($posts->lastPage(), $posts->currentPage() + 1);

                        if ($end - $start < 2) {
                            if ($start == 1) {
                                $end = min($start + 2, $posts->lastPage());
                            } else {
                                $start = max($end - 2, 1);
                            }
                        }
                    @endphp

                    @if ($start > 1)
                        <a href="{{ $posts->url(1) }}"
                            class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">1</a>
                        @if ($start > 2)
                            <span class="px-2 py-1 text-xs md:text-sm text-gray-500">...</span>
                        @endif
                    @endif

                    @for ($i = $start; $i <= $end; $i++)
                        @if ($i == $posts->currentPage())
                            <span
                                class="px-2 py-1 text-xs md:text-sm bg-primary text-white rounded">{{ $i }}</span>
                        @else
                            <a href="{{ $posts->url($i) }}"
                                class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($end < $posts->lastPage())
                        @if ($end < $posts->lastPage() - 1)
                            <span class="px-2 py-1 text-xs md:text-sm text-gray-500">...</span>
                        @endif
                        <a href="{{ $posts->url($posts->lastPage()) }}"
                            class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">{{ $posts->lastPage() }}</a>
                    @endif

                    {{-- Next Button --}}
                    @if ($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}"
                            class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-2 py-1 text-xs md:text-sm text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
          // Fungsi untuk menutup notifikasi
        function closeNotification(button) {
            const notification = button.closest('.notification-popup');
            if (notification) {
                notification.remove();
            }
        }

        // Set timeout untuk menghilangkan notifikasi setelah 3 detik
        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('.notification-popup');

            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.style.transition = 'opacity 0.5s ease-out';
                    notification.style.opacity = '0';

                    // Hapus elemen setelah animasi selesai
                    setTimeout(() => {
                        notification.remove();
                    }, 500);
                }, 2000);
            });
        });
    </script>
@endsection
