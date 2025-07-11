@extends('admin.layouts.app')
@section('title', 'Edit Arsip Surat')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 md:p-6 border-b border-gray-200">
            <h2 class="text-base md:text-lg font-semibold text-gray-800">Edit Surat</h2>
            <p class="mt-1 text-sm text-gray-500">Mengubah data arsip surat yang sudah ada</p>
        </div>

        <form action="{{ route('arsip-surat.update', $arsip->id) }}" method="POST" enctype="multipart/form-data" class="p-4 md:p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6">
                <!-- Nomor Surat -->
                <div>
                    <label for="nomor_surat" class="block text-sm font-medium text-gray-700 mb-1">Nomor Surat</label>
                    <input type="text" name="nomor_surat" id="nomor_surat" value="{{ old('nomor_surat', $arsip->nomor_surat) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    @error('nomor_surat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Surat -->
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat</label>
                    <select name="jenis" id="jenis"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Pilih Jenis Surat</option>
                        <option value="masuk" {{ old('jenis', $arsip->jenis) == 'masuk' ? 'selected' : '' }}>Surat Masuk</option>
                        <option value="keluar" {{ old('jenis', $arsip->jenis) == 'keluar' ? 'selected' : '' }}>Surat Keluar</option>
                    </select>
                    @error('jenis')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal', $arsip->tanggal ? Carbon\Carbon::parse($arsip->tanggal)->format('Y-m-d') : '') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    @error('tanggal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pengirim/Penerima -->
                <div>
                    <label for="pengirim_penerima" class="block text-sm font-medium text-gray-700 mb-1">
                        <span id="label-pengirim">{{ $arsip->jenis == 'masuk' ? 'Pengirim' : 'Penerima' }}</span>
                    </label>
                    <input type="text" name="pengirim_penerima" id="pengirim_penerima" value="{{ old('pengirim_penerima', $arsip->pengirim_penerima) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                    @error('pengirim_penerima')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File Surat -->
                <div class="md:col-span-2">
                    <label for="file_surat" class="block text-sm font-medium text-gray-700 mb-1">File Surat</label>
                    <div class="flex items-center gap-4">
                        <input type="file" name="file_surat" id="file_surat"
                            accept=".pdf,.jpg,.jpeg,.png"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        @if($arsip->file_surat)
                            <a href="{{ route('arsip-surat.show', $arsip->id) }}" target="_blank"
                                class="px-3 py-2 bg-gray-100 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors text-sm">
                                Lihat File Saat Ini
                            </a>
                        @endif
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah file. Format: PDF, JPG, JPEG, PNG (maksimal 2MB)</p>
                    @error('file_surat')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">{{ old('deskripsi', $arsip->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('arsip-surat.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jenisSelect = document.getElementById('jenis');
            const labelPengirim = document.getElementById('label-pengirim');

            jenisSelect.addEventListener('change', function() {
                if (this.value === 'masuk') {
                    labelPengirim.textContent = 'Pengirim';
                } else if (this.value === 'keluar') {
                    labelPengirim.textContent = 'Penerima';
                } else {
                    labelPengirim.textContent = 'Pengirim/Penerima';
                }
            });
        });
    </script>
    @endpush
@endsection
