@extends('admin.layouts.app')
@section('title', 'Detail SKU - ' . $sku->nama)

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Detail Pengajuan SKU</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('sku.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Kembali
                    </a>
                    <a href="{{ route('sku.edit', $sku->id) }}"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                        Edit
                    </a>
                </div>
            </div>
        </div>

        <!-- Status Badge -->
        <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
            @switch($sku->status)
                @case('diterima')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i> Disetujui
                    </span>
                @break

                @case('ditolak')
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                        <i class="fas fa-times-circle mr-1"></i> Ditolak
                    </span>
                @break

                @default
                    <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i> Baru
                    </span>
            @endswitch
        </div>

        <!-- Main Content -->
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Pemohon -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Data Pemohon</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $sku->nama }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Tempat/Tanggal Lahir</label>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $sku->tempat_lahir }}, {{ \Carbon\Carbon::parse($sku->ttl)->format('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">NIK</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $sku->nik }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Alamat</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $sku->alamat }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Status Perkawinan</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $sku->status_perkawinan }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">No. HP</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $sku->no_hp }}</p>
                    </div>
                </div>

                <!-- Data Usaha -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Data Usaha</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nama Usaha</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $sku->nama_usaha }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Alamat Usaha</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $sku->alamat_usaha }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Keperluan</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $sku->keperluan }}</p>
                    </div>
                </div>
            </div>

            <!-- File Uploads -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Berkas Lampiran</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

                    {{-- KTP --}}
                    <div class="border rounded-lg p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">KTP</label>
                        @if ($sku->ktp)
                            @php
                                $ktpExtension = pathinfo($sku->getRawOriginal('ktp'), PATHINFO_EXTENSION);
                            @endphp
                            <div class="border rounded-lg p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('sku.showFile', ['id' => $sku->id, 'type' => 'ktp']) }}"
                                        target="_blank" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                                        <i class="fas fa-file-pdf mr-2"></i> Lihat KTP
                                    </a>
                                    @if (in_array(strtolower($ktpExtension), ['jpg', 'jpeg', 'png']))
                                        <div class="w-32 h-20 bg-gray-100 rounded overflow-hidden ml-4">
                                            <img src="{{ route('sku.showFile', ['id' => $sku->id, 'type' => 'ktp']) }}"
                                                alt="Preview KTP" class="w-full h-full object-contain">
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500 ml-4">Preview tidak tersedia</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Surat Pengantar RT --}}
                    <div class="border rounded-lg p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Surat Pengantar RT</label>
                        @if ($sku->pengantar_rt)
                            @php
                                $pengantarExtension = pathinfo(
                                    $sku->getRawOriginal('pengantar_rt'),
                                    PATHINFO_EXTENSION,
                                );
                            @endphp
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('sku.showFile', ['id' => $sku->id, 'type' => 'pengantar']) }}"
                                        target="_blank" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                                        <i class="fas fa-file-pdf mr-2"></i> Lihat Surat Pengantar
                                    </a>
                                    @if (in_array(strtolower($pengantarExtension), ['jpg', 'jpeg', 'png']))
                                        <div class="w-32 h-20 bg-gray-100 rounded overflow-hidden ml-4">
                                            <img src="{{ route('sku.showFile', ['id' => $sku->id, 'type' => 'pengantar']) }}"
                                                alt="Preview Pengantar RT" class="w-full h-full object-contain">
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500 ml-4">Preview tidak tersedia</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            @if ($sku->status == 'baru')
                <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end space-x-3">
                    <form action="{{ route('sku.approve', $sku->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-check mr-1"></i> Setujui
                        </button>
                    </form>

                    <form action="{{ route('sku.reject', $sku->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-times mr-1"></i> Tolak
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal for File Preview -->
    <div id="previewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4" id="modalTitle">
                                Preview Dokumen
                            </h3>
                            <div class="mt-2">
                                <iframe id="previewFrame" class="w-full h-96 border-0" src=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closePreview()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewFile(url) {
                document.getElementById('previewFrame').src = url;
                document.getElementById('previewModal').classList.remove('hidden');
            }

            function closePreview() {
                document.getElementById('previewFrame').src = '';
                document.getElementById('previewModal').classList.add('hidden');
            }
        </script>
    @endpush
@endsection
