@extends('admin.layouts.app')
@section('title', 'Detail Pesan Kontak')

@section('content')
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-4 md:p-6 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h2 class="text-base md:text-lg font-semibold text-gray-800">Detail Pesan Kontak</h2>
                <a href="{{ route('form-kontak.index') }}" class="text-sm text-primary hover:text-primary/80">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="p-4 md:p-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $contact->nama_lengkap }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $contact->no_telepon }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $contact->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Kebutuhan</label>
                    <p class="mt-1 text-sm text-gray-900">{{ $contact->jenis_kebutuhan }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pesan</label>
                    <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $contact->pesan }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tanggal Kirim</label>
                    <p class="mt-1 text-sm text-gray-900">{{ \Carbon\Carbon::parse($contact->created_at)->format('d M Y H:i') }}</p>
                </div>
            </div>

            <div class="mt-6 flex space-x-3">
                <form action="{{ route('form-kontak.destroy', $contact->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors text-sm">
                        <i class="fas fa-trash mr-1"></i> Hapus
                    </button>
                </form>
                <a href="{{ route('form-kontak.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors text-sm">
                    <i class="fas fa-times mr-1"></i> Tutup
                </a>
            </div>
        </div>
    </div>
@endsection
