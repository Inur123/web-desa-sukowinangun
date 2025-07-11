@extends('admin.layouts.app')
@section('title', 'Arsip Surat')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
        <!-- Statistic Cards -->
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-primary/10 p-2 md:p-3 rounded-lg">
                    <i class="fas fa-envelope text-primary text-lg md:text-xl"></i>
                </div>
                <div class="ml-3 md:ml-4">
                    <p class="text-xl md:text-2xl font-bold text-gray-800">125</p>
                    <p class="text-xs md:text-sm text-gray-600">Total Surat</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-green-100 p-2 md:p-3 rounded-lg">
                    <i class="fas fa-inbox text-green-600 text-lg md:text-xl"></i>
                </div>
                <div class="ml-3 md:ml-4">
                    <p class="text-xl md:text-2xl font-bold text-gray-800">78</p>
                    <p class="text-xs md:text-sm text-gray-600">Surat Masuk</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-blue-100 p-2 md:p-3 rounded-lg">
                    <i class="fas fa-paper-plane text-blue-600 text-lg md:text-xl"></i>
                </div>
                <div class="ml-3 md:ml-4">
                    <p class="text-xl md:text-2xl font-bold text-gray-800">47</p>
                    <p class="text-xs md:text-sm text-gray-600">Surat Keluar</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-gray-200">
            <div class="flex items-center">
                <div class="bg-yellow-100 p-2 md:p-3 rounded-lg">
                    <i class="fas fa-calendar text-yellow-600 text-lg md:text-xl"></i>
                </div>
                <div class="ml-3 md:ml-4">
                    <p class="text-xl md:text-2xl font-bold text-gray-800">12</p>
                    <p class="text-xs md:text-sm text-gray-600">Bulan Ini</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Letter Buttons -->
    <div class="mb-4 md:mb-6 flex justify-between">
        <div class="flex space-x-2">
            <button class="px-3 py-1 md:px-4 md:py-2 border border-gray-300 rounded-lg text-sm md:text-base font-medium">
                <i class="fas fa-filter mr-1 md:mr-2 text-xs md:text-sm"></i>
                Filter
            </button>
            <button class="px-3 py-1 md:px-4 md:py-2 border border-gray-300 rounded-lg text-sm md:text-base font-medium">
                <i class="fas fa-download mr-1 md:mr-2 text-xs md:text-sm"></i>
                Export
            </button>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('arsip-surat.create') }}"
                class="inline-flex items-center px-3 py-1 md:px-4 md:py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm md:text-base">
                <i class="fas fa-plus mr-1 md:mr-2 text-xs md:text-sm"></i>
                Tambah Surat
            </a>
        </div>

    </div>

    <!-- Letters Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Table Header -->
        <div class="p-4 md:p-6 border-b border-gray-200">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-3 md:space-y-0">
                <h2 class="text-base md:text-lg font-semibold text-gray-800">Daftar Surat</h2>
                <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 md:space-x-4">
                    <div class="relative">
                        <input type="text" placeholder="Cari surat..."
                            class="w-full pl-8 pr-3 py-1 md:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                        <i class="fas fa-search absolute left-2 top-2 md:top-3 text-gray-400 text-sm"></i>
                    </div>
                    <select
                        class="px-3 py-1 md:py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                        <option>Semua Jenis</option>
                        <option>Surat Masuk</option>
                        <option>Surat Keluar</option>
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
                            No. Surat</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Jenis</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Tanggal</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Pengirim/Penerima</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Deskripsi</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            File</th>
                        <th
                            class="px-3 py-2 md:px-6 md:py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider whitespace-nowrap">
                            Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($arsipList as $index => $arsip)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                <p class="text-xs md:text-sm font-medium text-gray-800">{{ $index + 1 }}</p>
                            </td>
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                <p class="text-xs md:text-sm font-medium text-gray-800">{{ $arsip->nomor_surat ?? '-' }}</p>
                            </td>
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                @if ($arsip->jenis === 'masuk')
                                    <span
                                        class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-semibold">Surat
                                        Masuk</span>
                                @elseif ($arsip->jenis === 'keluar')
                                    <span
                                        class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-semibold">Surat
                                        Keluar</span>
                                @else
                                    <span class="text-gray-500 text-xs">-</span>
                                @endif
                            </td>
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-600">
                                {{ $arsip->tanggal ? \Carbon\Carbon::parse($arsip->tanggal)->format('d M Y') : '-' }}
                            </td>
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-600">
                                {{ $arsip->pengirim_penerima ?? '-' }}
                            </td>
                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-600">
                                {{ $arsip->deskripsi ?? '-' }}
                            </td>
                           <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap text-xs md:text-sm">
    @if ($arsip->file_surat)
        <a href="{{ route('arsip-surat.show', $arsip->id) }}"
           target="_blank"
           class="text-blue-600 hover:text-blue-800">
            Lihat File
        </a>
    @else
        <span class="text-gray-500">-</span>
    @endif
</td>


                            <td class="px-3 py-3 md:px-6 md:py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('arsip-surat.show', $arsip->id) }}"
                                        class="text-blue-600 hover:text-blue-800" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('arsip-surat.edit', $arsip->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href=""
                                        class="text-green-600 hover:text-green-800" title="Download">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <form action="{{ route('arsip-surat.destroy', $arsip->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-gray-500 text-sm">
                                Belum ada data surat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <!-- Pagination -->
        <div class="px-4 py-3 md:px-6 md:py-4 border-t border-gray-200">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                <div class="text-xs md:text-sm text-gray-600">
                    Menampilkan 1 - 3 dari 125 surat
                </div>
                <div class="flex items-center space-x-1 md:space-x-2">
                    <span class="px-2 py-1 text-xs md:text-sm text-gray-400 cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="px-2 py-1 text-xs md:text-sm bg-primary text-white rounded">1</span>
                    <a href="#"
                        class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">2</a>
                    <a href="#"
                        class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">3</a>
                    <span class="px-2 py-1 text-xs md:text-sm text-gray-500">...</span>
                    <a href="#"
                        class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">13</a>
                    <a href="#"
                        class="px-2 py-1 text-xs md:text-sm text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
