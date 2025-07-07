@extends('admin.layouts.app')

@section('title', 'Tambah Berita Baru')

@section('content')
<div class="bg-white rounded-xl shadow-xl w-full max-w-7xl mx-auto">
    <div class="p-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-bold text-gray-800">Tambah Berita Baru</h2>
            <a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('posts.store') }}" class="p-6 space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                {{-- Judul --}}
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Berita</label>
                    <input type="text" id="title" name="title" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                           placeholder="Masukkan judul berita..."
                           value="{{ old('title') }}">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konten --}}
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Berita</label>
                    <textarea id="content" name="content" rows="12" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                              placeholder="Tulis konten berita di sini...">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Ringkasan --}}
               <div>
    <label for="summary" class="block text-sm font-medium text-gray-700 mb-2">Ringkasan</label>
    <textarea id="summary" name="summary" rows="3" maxlength="150"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
              placeholder="Ringkasan singkat berita...">{{ old('summary') }}</textarea>
    <p id="letter-count" class="text-sm text-gray-500 mt-1">0 / 100 huruf</p>
    @error('summary')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

            </div>

            <div class="space-y-6">
                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select id="status" name="status"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonactive" {{ old('status') == 'nonactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select id="category" name="category"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        <option value="">Pilih Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Publikasi --}}
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Publikasi</label>
                    <input type="date" id="published_at" name="published_at"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                           value="{{ old('published_at') }}">
                    @error('published_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar --}}
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary transition-colors cursor-pointer"
                         onclick="document.getElementById('image').click()">
                        <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                        <p class="text-gray-600 mb-2">Klik untuk upload gambar</p>
                        <p class="text-xs text-gray-500">PNG, JPG hingga 2MB</p>
                        <input type="file" id="image" name="image" accept="image/*" class="hidden">
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    {{-- Preview --}}
                    <div id="image-preview-wrapper" class="mt-4 hidden">
                        <p class="text-sm text-gray-600 mb-1">Preview Gambar:</p>
                        <img id="image-preview" class="w-full rounded-lg shadow" />
                    </div>
                </div>

                {{-- Tags --}}
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <input type="text" id="tags" name="tags"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                           placeholder="Tag1, Tag2, Tag3"
                           value="{{ old('tags') }}">
                    <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma</p>
                    @error('tags')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
            <a href="{{ route('posts.index') }}" class="px-6 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-primary hover:bg-secondary text-white rounded-lg transition-colors">
                Simpan
            </button>
        </div>
    </form>
</div>
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const previewWrapper = document.getElementById('image-preview-wrapper');
        const preview = document.getElementById('image-preview');
        const file = event.target.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewWrapper.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        } else {
            previewWrapper.classList.add('hidden');
            preview.src = '';
        }
    });
</script>
<script>
    const textarea = document.getElementById('summary');
    const counter = document.getElementById('letter-count');

    textarea.addEventListener('input', () => {
        const letters = textarea.value.replace(/[^a-zA-Z]/g, '');
        const count = letters.length;

        counter.textContent = `${count} / 100 huruf`;

        if (count > 100) {
            counter.classList.add('text-red-600');
        } else {
            counter.classList.remove('text-red-600');
        }
    });
</script>
@endsection




