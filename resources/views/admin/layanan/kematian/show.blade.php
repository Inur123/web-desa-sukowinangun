@extends('admin.layouts.app')
@section('title', 'Detail Surat Kematian - ' . $kematian->nama)

@section('content')
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">Detail Pengajuan Surat Kematian</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('kematian.index') }}"
                        class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Status Badge -->
        <div class="px-6 py-3 bg-gray-50 border-b border-gray-200">
            @switch($kematian->status)
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
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Data Almarhum/Almarhumah</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $kematian->nama }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Tempat/Tanggal Lahir</label>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $kematian->tempat_lahir }}, {{ \Carbon\Carbon::parse($kematian->ttl)->format('d F Y') }}
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">NIK</label>
                        <div class="mt-1 flex items-center">
                            <p id="nik-text" class="text-sm text-gray-900">
                                {{ substr($kematian->nik, 0, 5) }}<span class="blur-sm">{{ substr($kematian->nik, 5) }}</span>
                            </p>
                            <button onclick="toggleBlur()" class="ml-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg id="eye-open" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                                <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                                    <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Alamat</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $kematian->alamat }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Status Perkawinan</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $kematian->status_perkawinan }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">No. HP</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $kematian->no_hp }}</p>
                    </div>
                </div>

                <!-- Data Kematian -->
                <div class="space-y-4">
                    <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Data Kematian</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-500">Tanggal Meninggal</label>
                        <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($kematian->tanggal_meninggal)->format('d F Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- File Uploads -->
            <div class="mt-8">
                <h3 class="text-lg font-medium text-gray-900 border-b pb-2">Berkas Lampiran</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                    <!-- KTP -->
                    <div class="border rounded-lg p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">KTP</label>
                        @if ($kematian->ktp)
                            @php
                                $ktpExtension = pathinfo($kematian->getRawOriginal('ktp'), PATHINFO_EXTENSION);
                            @endphp
                            <div class="border rounded-lg p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('kematian.showFile', ['id' => $kematian->id, 'type' => 'ktp']) }}"
                                        target="_blank" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                                        <i class="fas fa-file-pdf mr-2"></i> Lihat KTP
                                    </a>
                                    @if (in_array(strtolower($ktpExtension), ['jpg', 'jpeg', 'png']))
                                        <div class="w-32 h-20 bg-gray-100 rounded overflow-hidden ml-4">
                                            <img src="{{ route('kematian.showFile', ['id' => $kematian->id, 'type' => 'ktp']) }}"
                                                alt="Preview KTP" class="w-full h-full object-contain">
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500 ml-4">Preview tidak tersedia</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Kartu Keluarga (KK) -->
                    <div class="border rounded-lg p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kartu Keluarga</label>
                        @if ($kematian->kk)
                            @php
                                $kkExtension = pathinfo($kematian->getRawOriginal('kk'), PATHINFO_EXTENSION);
                            @endphp
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('kematian.showFile', ['id' => $kematian->id, 'type' => 'kk']) }}"
                                        target="_blank" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                                        <i class="fas fa-file-pdf mr-2"></i> Lihat Kartu Keluarga
                                    </a>
                                    @if (in_array(strtolower($kkExtension), ['jpg', 'jpeg', 'png']))
                                        <div class="w-32 h-20 bg-gray-100 rounded overflow-hidden ml-4">
                                            <img src="{{ route('kematian.showFile', ['id' => $kematian->id, 'type' => 'kk']) }}"
                                                alt="Preview Kartu Keluarga" class="w-full h-full object-contain">
                                        </div>
                                    @else
                                        <span class="text-sm text-gray-500 ml-4">Preview tidak tersedia</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Surat Pengantar RT -->
                    <div class="border rounded-lg p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Surat Pengantar RT</label>
                        @if ($kematian->pengantar_rt)
                            @php
                                $pengantarExtension = pathinfo($kematian->getRawOriginal('pengantar_rt'), PATHINFO_EXTENSION);
                            @endphp
                            <div class="border rounded-lg p-4">
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('kematian.showFile', ['id' => $kematian->id, 'type' => 'pengantar']) }}"
                                        target="_blank" class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                                        <i class="fas fa-file-pdf mr-2"></i> Lihat Surat Pengantar
                                    </a>
                                    @if (in_array(strtolower($pengantarExtension), ['jpg', 'jpeg', 'png']))
                                        <div class="w-32 h-20 bg-gray-100 rounded overflow-hidden ml-4">
                                            <img src="{{ route('kematian.showFile', ['id' => $kematian->id, 'type' => 'pengantar']) }}"
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

            @if ($kematian->status == 'baru')
                <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end space-x-3">
                    <form action="{{ route('kematian.approve', $kematian->id) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-check mr-1"></i> Setujui
                        </button>
                    </form>

                    <form action="{{ route('kematian.reject', $kematian->id) }}" method="POST" class="inline">
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
    <script>
        function toggleBlur() {
            const nikSpan = document.querySelector('#nik-text span');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (nikSpan.classList.contains('blur-sm')) {
                nikSpan.classList.remove('blur-sm');
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                nikSpan.classList.add('blur-sm');
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>
@endsection
