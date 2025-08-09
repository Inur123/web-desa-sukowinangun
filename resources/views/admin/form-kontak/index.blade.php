@extends('admin.layouts.app')
@section('title', 'Pesan Kontak')

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

    <!-- Contact Messages Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Table Header -->
        <div class="p-4 md:p-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
                <h2 class="text-base md:text-lg font-semibold text-gray-800">Daftar Pesan Kontak</h2>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 md:space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Cari pesan..."
                            class="w-full pl-8 pr-3 py-1 md:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                        <i class="fas fa-search absolute left-2 top-2 md:top-3 text-gray-400 text-sm"></i>
                    </div>
                    <select
                        class="px-3 py-1 md:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                        <option>Semua Jenis</option>
                        <option>Pelayanan Administrasi</option>
                        <option>Pengaduan Masyarakat</option>
                        <option>Permintaan Informasi</option>
                        <option>Lainnya</option>
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
                            No</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Nama</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Kontak</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Jenis Kebutuhan</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Pesan</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Tanggal</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($data as $index => $contact)
                        <tr class="hover:bg-gray-50">
                            <!-- No Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                <div class="text-xs md:text-sm font-medium text-gray-800">
                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                </div>
                            </td>
                            <!-- Name Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                <div class="text-xs md:text-sm font-medium text-gray-800">
                                    {{ $contact->nama_lengkap }}
                                </div>
                            </td>

                            <!-- Contact Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                <div class="text-xs md:text-sm text-gray-600">
                                    <div>{{ $contact->no_telepon }}</div>
                                    <div class="text-primary">{{ $contact->email }}</div>
                                </div>
                            </td>

                            <!-- Type Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                @php
                                    $colorClasses = match ($contact->jenis_kebutuhan) {
                                        'Pelayanan Administrasi' => 'bg-blue-100 text-blue-800',
                                        'Pengaduan Masyarakat' => 'bg-red-100 text-red-800',
                                        'Permintaan Informasi' => 'bg-green-100 text-green-800',
                                        'Lainnya' => 'bg-yellow-100 text-yellow-800',
                                    };
                                @endphp
                                <span class="{{ $colorClasses }} px-2 py-0.5 md:py-1 rounded-full text-xs font-semibold">
                                    {{ $contact->jenis_kebutuhan }}
                                </span>
                            </td>

                            <!-- Message Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4">
                                <p class="text-xs md:text-sm text-gray-800 line-clamp-2">
                                    {{ $contact->pesan }}
                                </p>
                            </td>

                            <!-- Date Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-600">
                                {{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y H:i') }}
                            </td>

                            <!-- Actions Column -->
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-1 md:space-x-2">
                                    <!-- Detail Button -->
                                    <a href="{{ route('form-kontak.show', $contact->id) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm md:text-base cursor-pointer"
                                        title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ route('form-kontak.destroy', $contact->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pesan ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 text-sm md:text-base cursor-pointer"
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
                                pesan kontak.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($data->hasPages())
            <div class="px-4 py-3 md:px-6 md:py-4 border-t border-gray-200">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                    <div class="text-xs md:text-sm text-gray-600">
                        Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }} dari {{ $data->total() }} pesan
                    </div>
                    <div class="flex items-center space-x-1 md:space-x-2">
                        {{-- Previous Button --}}
                        @if ($data->onFirstPage())
                            <span class="px-2 py-1 text-xs md:text-sm text-gray-400 cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $data->previousPageUrl() }}"
                                class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @php
                            $start = max(1, $data->currentPage() - 1);
                            $end = min($data->lastPage(), $data->currentPage() + 1);

                            if ($end - $start < 2) {
                                if ($start == 1) {
                                    $end = min($start + 2, $data->lastPage());
                                } else {
                                    $start = max($end - 2, 1);
                                }
                            }
                        @endphp

                        @if ($start > 1)
                            <a href="{{ $data->url(1) }}"
                                class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">1</a>
                            @if ($start > 2)
                                <span class="px-2 py-1 text-xs md:text-sm text-gray-500">...</span>
                            @endif
                        @endif

                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $data->currentPage())
                                <span
                                    class="px-2 py-1 text-xs md:text-sm bg-primary text-white rounded">{{ $i }}</span>
                            @else
                                <a href="{{ $data->url($i) }}"
                                    class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">{{ $i }}</a>
                            @endif
                        @endfor

                        @if ($end < $data->lastPage())
                            @if ($end < $data->lastPage() - 1)
                                <span class="px-2 py-1 text-xs md:text-sm text-gray-500">...</span>
                            @endif
                            <a href="{{ $data->url($data->lastPage()) }}"
                                class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">{{ $data->lastPage() }}</a>
                        @endif

                        {{-- Next Button --}}
                        @if ($data->hasMorePages())
                            <a href="{{ $data->nextPageUrl() }}"
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
        @endif
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
