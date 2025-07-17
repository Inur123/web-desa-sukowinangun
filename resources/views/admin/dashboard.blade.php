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
                    <p class="text-3xl font-bold text-gray-800">{{ $totalViews }}</p>
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
                    <p class="text-3xl font-bold text-gray-800">10</p>
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
        <!-- Card Wrapper -->
      <div class="flex flex-col h-full bg-white p-6 rounded-xl shadow-sm border border-gray-200 mt-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Statistik Pengajuan Layanan</h2>
        <form method="GET" action="">
            <select name="period" onchange="this.form.submit()"
                class="px-3 py-1 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                <option value="today" {{ $selectedPeriod === 'today' ? 'selected' : '' }}>Hari Ini</option>
                <option value="7days" {{ $selectedPeriod === '7days' ? 'selected' : '' }}>7 Hari Terakhir</option>
                <option value="30days" {{ $selectedPeriod === '30days' ? 'selected' : '' }}>30 Hari Terakhir</option>
                <option value="this_month" {{ $selectedPeriod === 'this_month' ? 'selected' : '' }}>Bulan Ini</option>
                <option value="last_month" {{ $selectedPeriod === 'last_month' ? 'selected' : '' }}>Bulan Lalu</option>
                <option value="this_year" {{ $selectedPeriod === 'this_year' ? 'selected' : '' }}>Tahun Ini</option>
            </select>
        </form>
    </div>
    <div class="flex-grow">
        <canvas id="servicesChart" class="w-full h-[200px]"></canvas>
    </div>
</div>

        <div class="flex flex-col h-full bg-white p-6 rounded-xl shadow-sm border border-gray-200 mt-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">Berita Populer</h2>
            <div class="flex-grow space-y-4">
                @foreach ($latestPosts as $post)
                    <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                        <img src="{{ $post->image ? asset('storage/' . $post->image) : '/placeholder.svg?height=50&width=80' }}"
                            alt="{{ $post->title }}" class="w-12 h-8 object-cover rounded mr-3">

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
                <a href="{{ route('posts.index') }}"
                    class="text-primary hover:text-secondary font-medium text-sm transition-colors">
                    Lihat Semua Berita <i class="fas fa-arrow-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('servicesChart').getContext('2d');
        const servicesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: {!! json_encode($chartDatasets) !!}
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                // Jika periode tahun, tambahkan tahun di tooltip
                                if ({!! json_encode($selectedPeriod) !!} === 'this_year') {
                                    return context[0].label + ' ' + new Date().getFullYear();
                                }
                                return context[0].label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
@endsection
