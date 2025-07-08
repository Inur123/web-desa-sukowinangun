@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Berita</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalPosts }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        {{ $postsThisMonth }}% bulan ini
                    </p>
                </div>
                <div class="bg-primary/10 p-3 rounded-lg">
                    <i class="fas fa-newspaper text-primary text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Pengunjung</p>
                    <p class="text-3xl font-bold text-gray-800">2,547</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        +12% minggu ini
                    </p>
                </div>
                <div class="bg-blue-100 p-3 rounded-lg">
                    <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Views Berita</p>
                    <p class="text-3xl font-bold text-gray-800">{{ $totalViews }}</p>
                    <p class="text-sm text-green-600 mt-1">
                        <i class="fas fa-arrow-up mr-1"></i>
                        {{ $viewGrowth }}% hari ini
                    </p>
                </div>
                <div class="bg-green-100 p-3 rounded-lg">
                    <i class="fas fa-eye text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Layanan Aktif</p>
                    <p class="text-3xl font-bold text-gray-800">6</p>
                    <p class="text-sm text-gray-500 mt-1">
                        <i class="fas fa-check mr-1"></i>
                        Semua berjalan
                    </p>
                </div>
                <div class="bg-accent/10 p-3 rounded-lg">
                    <i class="fas fa-cogs text-accent text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Visitor Chart -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold text-gray-800">Statistik Pengunjung</h2>
                <select
                    class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option>7 Hari Terakhir</option>
                    <option>30 Hari Terakhir</option>
                    <option>3 Bulan Terakhir</option>
                </select>
            </div>
            <!-- <canvas id="visitorChart" width="400" height="200"></canvas> -->
        </div>

        <!-- Popular Posts -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Berita Populer</h2>
            <div class="space-y-4">
                @foreach ($latestPosts as $post)
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                       <img src="{{ $post->image ? asset('storage/' . $post->image) : '/placeholder.svg?height=50&width=80' }}"
     alt="{{ $post->title }}"
     class="w-12 h-8 object-cover rounded mr-3">

                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-800">{{ $post->title }}</h3>
                            <p class="text-xs text-gray-500">
                                {{ $post->views }} views • {{ $post->created_at->diffForHumans() }}
                            </p>
                        </div>

                        <div class="text-right">
                            <span class="text-sm font-semibold text-primary">{{ $post->views }}</span>
                            <p class="text-xs text-gray-500">views</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="posts.html" class="text-primary hover:text-secondary font-medium text-sm transition-colors">
                    Lihat Semua Berita <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Actions and Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Quick Actions -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Aksi Cepat</h2>
            <div class="grid grid-cols-2 gap-4">
                <a href="posts.html"
                    class="flex flex-col items-center p-4 bg-primary/5 hover:bg-primary/10 rounded-lg transition-colors group">
                    <div class="bg-primary/10 group-hover:bg-primary/20 p-3 rounded-lg mb-3">
                        <i class="fas fa-plus text-primary text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-800">Tambah Berita</span>
                </a>

                <a href="beranda.html"
                    class="flex flex-col items-center p-4 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors group">
                    <div class="bg-blue-100 group-hover:bg-blue-200 p-3 rounded-lg mb-3">
                        <i class="fas fa-eye text-blue-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-800">Lihat Website</span>
                </a>

                <a href="posts.html"
                    class="flex flex-col items-center p-4 bg-green-50 hover:bg-green-100 rounded-lg transition-colors group">
                    <div class="bg-green-100 group-hover:bg-green-200 p-3 rounded-lg mb-3">
                        <i class="fas fa-edit text-green-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-800">Edit Berita</span>
                </a>

                <a href="#"
                    class="flex flex-col items-center p-4 bg-yellow-50 hover:bg-yellow-100 rounded-lg transition-colors group">
                    <div class="bg-yellow-100 group-hover:bg-yellow-200 p-3 rounded-lg mb-3">
                        <i class="fas fa-chart-bar text-yellow-600 text-xl"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-800">Lihat Statistik</span>
                </a>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Aktivitas Terbaru</h2>
            <div class="space-y-4">
                <div class="flex items-start">
                    <div class="bg-green-100 p-2 rounded-full mr-3 mt-1">
                        <i class="fas fa-plus text-green-600 text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Berita baru dipublikasikan</p>
                        <p class="text-xs text-gray-500">"Pembangunan Jalan Desa Tahap II" • 2 jam lalu</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-blue-100 p-2 rounded-full mr-3 mt-1">
                        <i class="fas fa-edit text-blue-600 text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Berita diperbarui</p>
                        <p class="text-xs text-gray-500">"Festival Budaya Desa 2024" • 4 jam lalu</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-yellow-100 p-2 rounded-full mr-3 mt-1">
                        <i class="fas fa-eye text-yellow-600 text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Lonjakan pengunjung</p>
                        <p class="text-xs text-gray-500">+50 pengunjung dalam 1 jam terakhir</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-purple-100 p-2 rounded-full mr-3 mt-1">
                        <i class="fas fa-comment text-purple-600 text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Pesan baru diterima</p>
                        <p class="text-xs text-gray-500">Dari formulir kontak • 6 jam lalu</p>
                    </div>
                </div>

                <div class="flex items-start">
                    <div class="bg-red-100 p-2 rounded-full mr-3 mt-1">
                        <i class="fas fa-trash text-red-600 text-xs"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Berita dihapus</p>
                        <p class="text-xs text-gray-500">"Draft artikel lama" • 1 hari lalu</p>
                    </div>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200">
                <a href="#" class="text-primary hover:text-secondary font-medium text-sm transition-colors">
                    Lihat Semua Aktivitas <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
