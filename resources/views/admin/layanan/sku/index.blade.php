@extends('admin.layouts.app')
@section('title', 'SKU')

@section('content')
    <!-- Statistic Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">


        <!-- Total Pengajuan Card -->
        <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-lg mr-3">
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Pengajuan</p>
                    <p class="text-xl font-bold text-gray-800">{{ $total }}</p>
                </div>
            </div>
        </div>

        <!-- Disetujui Card -->
        <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
            <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-lg mr-3">
                    <i class="fas fa-check-circle text-green-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Disetujui</p>
                    <p class="text-xl font-bold text-gray-800">{{ $disetujui }}</p>
                </div>
            </div>
        </div>

        <!-- Ditolak Card -->
        <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
            <div class="flex items-center">
                <div class="bg-red-100 p-3 rounded-lg mr-3">
                    <i class="fas fa-times-circle text-red-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Ditolak</p>
                    <p class="text-xl font-bold text-gray-800">{{ $ditolak }}</p>
                </div>
            </div>
        </div>
        <!-- Baru Card -->
        <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
            <div class="flex items-center">
                <div class="bg-yellow-100 p-3 rounded-lg mr-3">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Menunggu Persetujuan</p>
                    <p class="text-xl font-bold text-gray-800">{{ $baru }}</p>
                </div>
            </div>
        </div>

    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-lg font-semibold text-gray-800 mb-2 sm:mb-0">Daftar Pengajuan Surat Keterangan Usaha</h2>
                <div class="flex items-center space-x-2">
                    <div class="relative">
                        <input type="text" placeholder="Cari pengajuan..."
                            class="pl-8 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Lahir</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Usaha</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keperluan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse ($skus as $sku)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $sku->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ \Carbon\Carbon::parse($sku->ttl)->format('d M Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $sku->alamat }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $sku->nama_usaha }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $sku->keperluan }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @switch($sku->status)
                        @case('diterima')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                            @break
                        @case('ditolak')
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                            @break
                        @default
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Baru</span>
                    @endswitch
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                    {{ \Carbon\Carbon::parse($sku->created_at)->format('H:i | d M Y ') }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a href="{{ route('sku.show', $sku->id) }}" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('sku.edit', $sku->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('sku.destroy', $sku->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Yakin ingin menghapus?')" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada data pengajuan.</td>
            </tr>
        @endforelse
    </tbody>
</table>


            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $skus->firstItem() }}-{{ $skus->lastItem() }} dari {{ $skus->total() }} SKU
                    </div>
                    <div class="flex items-center space-x-2">
                        {{-- Custom pagination layout using Laravel --}}
                        @if ($skus->onFirstPage())
                            <span class="px-2 py-1 text-sm text-gray-400 cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $skus->previousPageUrl() }}"
                                class="px-2 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        @for ($i = 1; $i <= $skus->lastPage(); $i++)
                            @if ($i == $skus->currentPage())
                                <span class="px-2 py-1 text-sm bg-primary text-white rounded">{{ $i }}</span>
                            @else
                                <a href="{{ $skus->url($i) }}"
                                    class="px-2 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">{{ $i }}</a>
                            @endif
                        @endfor

                        @if ($skus->hasMorePages())
                            <a href="{{ $skus->nextPageUrl() }}"
                                class="px-2 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="px-2 py-1 text-sm text-gray-400 cursor-not-allowed">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    @endsection
