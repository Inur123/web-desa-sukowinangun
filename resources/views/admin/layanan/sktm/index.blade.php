@extends('admin.layouts.app')
@section('title', 'SKTM')

@section('content')
    <!-- Statistic Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
        <!-- Total Pengajuan Card -->
        <div class="bg-white p-4 rounded-lg shadow border border-gray-200">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-lg mr-3">
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Total Pengajuan</p>
                    <p class="text-xl font-bold text-gray-800">1,245</p>
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
                    <p class="text-xl font-bold text-gray-800">856</p>
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
                    <p class="text-xl font-bold text-gray-800">128</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Table Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-lg font-semibold text-gray-800 mb-2 sm:mb-0">Daftar Pengajuan SKTM</h2>
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
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.
                            Pengajuan</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama
                            Pemohon</th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <!-- Sample Data Row 1 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">SKTM-2023-001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Budi Santoso</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15 Jan 2023</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Disetujui</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                            <a href="#" class="text-yellow-600 hover:text-yellow-900 mr-3"><i
                                    class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <!-- Sample Data Row 2 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">SKTM-2023-002</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ani Wijaya</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">18 Jan 2023</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Proses</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                            <a href="#" class="text-yellow-600 hover:text-yellow-900 mr-3"><i
                                    class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>

                    <!-- Sample Data Row 3 -->
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">SKTM-2023-003</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Citra Dewi</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">20 Jan 2023</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span
                                class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Ditolak</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="#" class="text-blue-600 hover:text-blue-900 mr-3"><i class="fas fa-eye"></i></a>
                            <a href="#" class="text-yellow-600 hover:text-yellow-900 mr-3"><i
                                    class="fas fa-edit"></i></a>
                            <a href="#" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600">
                    Menampilkan 1-5 dari 24 Sktm
                </div>
                <div class="flex items-center space-x-2">
                    <button class="px-2 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="px-2 py-1 text-sm bg-primary text-white rounded">1</button>
                    <button class="px-2 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">2</button>
                    <button class="px-2 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">3</button>
                    <button class="px-2 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">3</button>
                    <button class="px-2 py-1 text-sm text-gray-500 hover:text-gray-700 transition-colors">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
