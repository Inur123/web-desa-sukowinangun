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
                            placeholder="Masukkan judul berita..." value="{{ old('title') }}">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="ai_prompt" class="block text-sm font-medium text-gray-700 mb-2">Prompt AI</label>
                        <div class="flex space-x-2">
                            <input type="text" id="ai_prompt" name="ai_prompt"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                                placeholder="Masukkan perintah untuk AI..." />
                            <button type="button" id="generateBtn"
                                class="px-4 py-2 bg-primary hover:bg-primary/90 transition-colors text-white rounded-lg cursor-pointer">Generate</button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Masukkan perintah, lalu klik Generate untuk mengisi konten
                            otomatis.</p>
                    </div>

                    {{-- Textarea Content --}}
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Konten Berita</label>
                        <textarea id="content" name="content" rows="12" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent editor"
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
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent cursor-pointer">
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
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent cursor-pointer">
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
                        <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                            Publikasi</label>
                        <input type="date" id="published_at" name="published_at"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent "
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
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Tambahan</label>
                        <div id="additional-images-wrapper" class="space-y-4 ">
                            {{-- Input pertama akan ditambahkan secara otomatis --}}
                        </div>
                        <button type="button" onclick="addAdditionalImage()"
                            class="mt-3 w-full flex items-center justify-center px-4 py-2 border-2 border-dashed border-gray-300 rounded-lg hover:border-primary hover:bg-gray-50 transition-colors cursor-pointer">
                            <i class="fas fa-plus-circle mr-2 text-primary "></i>
                            <span class="text-primary font-medium">Tambah Gambar Lainnya</span>
                        </button>
                        <p class="text-xs text-gray-500 mt-2">Format: PNG, JPG (maksimal 2MB per gambar)</p>
                    </div>

                    {{-- Tags --}}
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                        <input type="text" id="tags" name="tags"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"
                            placeholder="Tag1, Tag2, Tag3" value="{{ old('tags') }}">
                        <p class="text-xs text-gray-500 mt-1">Pisahkan dengan koma</p>
                        @error('tags')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('posts.index') }}"
                    class="px-6 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2 bg-primary hover:bg-secondary text-white rounded-lg transition-colors cursor-pointer">
                    Simpan
                </button>
            </div>
        </form>
    </div>
    <script src="https://cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
    <script>
        // Inisialisasi CKEditor untuk konten
        CKEDITOR.replace('content', {
            toolbar: [{
                    name: 'document',
                    items: ['Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates']
                },
                {
                    name: 'clipboard',
                    items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
                },
                {
                    name: 'editing',
                    items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                },
                {
                    name: 'forms',
                    items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button',
                        'ImageButton', 'HiddenField'
                    ]
                },
                '/',
                {
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                        'CopyFormatting', 'RemoveFormat'
                    ]
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
                        'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                        '-', 'BidiLtr', 'BidiRtl', 'Language'
                    ]
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink', 'Anchor']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak',
                        'Iframe'
                    ]
                },
                '/',
                {
                    name: 'styles',
                    items: ['Styles', 'Format', 'Font', 'FontSize']
                },
                {
                    name: 'colors',
                    items: ['TextColor', 'BGColor']
                },
                {
                    name: 'tools',
                    items: ['Maximize', 'ShowBlocks']
                },
                {
                    name: 'about',
                    items: ['About']
                }
            ],
            height: 400
        });

        // Inisialisasi CKEditor untuk ringkasan (lebih sederhana)
        CKEDITOR.replace('summary', {
            toolbar: [{
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
                },
                {
                    name: 'paragraph',
                    items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight']
                },
                {
                    name: 'links',
                    items: ['Link', 'Unlink']
                },
                {
                    name: 'insert',
                    items: ['Image', 'Table']
                },
                {
                    name: 'tools',
                    items: ['Maximize']
                }
            ],
            height: 150,
            wordcount: {
                showCharCount: true,
                maxCharCount: 150
            }
        });

        // Script untuk preview gambar tetap sama
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

        // Script untuk menghitung karakter (diperbarui untuk CKEditor)
        CKEDITOR.instances.summary.on('change', function() {
            const data = this.getData();
            const text = data.replace(/<[^>]*>/g, ''); // Hilangkan tag HTML
            const count = text.length;

            document.getElementById('letter-count').textContent = `${count} / 100 huruf`;

            if (count > 100) {
                document.getElementById('letter-count').classList.add('text-red-600');
            } else {
                document.getElementById('letter-count').classList.remove('text-red-600');
            }
        });
    </script>
    <script>
        let imageInputIndex = 0;

        function addAdditionalImage() {
            const wrapper = document.getElementById('additional-images-wrapper');

            const div = document.createElement('div');
            div.classList.add('relative', 'group');

            const inputDiv = document.createElement('div');
            inputDiv.classList.add('flex', 'items-center', 'space-x-3');

            const input = document.createElement('input');
            input.type = 'file';
            input.name = `additional_images[]`;
            input.accept = 'image/*';
            input.classList.add(
                'w-full', 'px-4', 'py-2.5', 'border', 'rounded-lg',
                'border-gray-300', 'focus:ring-2', 'focus:ring-primary',
                'focus:border-transparent', 'file:mr-4', 'file:py-2',
                'file:px-4', 'file:rounded-md', 'file:border-0',
                'file:text-sm', 'file:font-medium', 'file:bg-gray-100',
                'file:text-gray-700', 'hover:file:bg-gray-200'
            );

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.innerHTML = '<i class="fas fa-times text-red-500 hover:text-red-700"></i>';
            removeBtn.classList.add('flex-shrink-0');
            removeBtn.title = 'Hapus gambar ini';
            removeBtn.onclick = function() {
                wrapper.removeChild(div);
            };

            inputDiv.appendChild(input);
            inputDiv.appendChild(removeBtn);
            div.appendChild(inputDiv);

            // Tambahkan preview container
            const previewDiv = document.createElement('div');
            previewDiv.classList.add('mt-2', 'hidden', 'image-preview-container');

            const previewLabel = document.createElement('p');
            previewLabel.classList.add('text-sm', 'text-gray-600', 'mb-1');
            previewLabel.textContent = 'Preview:';

            const previewImg = document.createElement('img');
            previewImg.classList.add('w-full', 'h-32', 'object-cover', 'rounded-lg', 'border', 'border-gray-200');

            previewDiv.appendChild(previewLabel);
            previewDiv.appendChild(previewImg);
            div.appendChild(previewDiv);

            // Event listener untuk preview gambar
            input.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewDiv.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewDiv.classList.add('hidden');
                }
            });

            wrapper.appendChild(div);
            imageInputIndex++;
        }

        // Tambahkan input pertama secara otomatis saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            addAdditionalImage();
        });
    </script>
    <script>
        document.getElementById('generateBtn').addEventListener('click', function() {
            const prompt = document.getElementById('ai_prompt').value;
            const generateBtn = this; // Simpan referensi tombol

            if (!prompt) {
                alert('Masukkan prompt terlebih dahulu!');
                return;
            }

            // Tambahkan animasi loading
            generateBtn.innerHTML = `
        <span class="inline-flex items-center">
            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Processing...
        </span>
    `;
            generateBtn.disabled = true;
            generateBtn.classList.remove('bg-green-500', 'hover:bg-green-600');
            generateBtn.classList.add('bg-green-400');

            fetch("{{ route('generate.content') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        prompt: prompt
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.output) {
                        CKEDITOR.instances['content'].setData(data.output);
                    } else {
                        alert("Gagal mendapatkan respon dari AI");
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Terjadi kesalahan");
                })
                .finally(() => {
                    // Kembalikan tombol ke keadaan semula
                    generateBtn.innerHTML = 'Generate';
                    generateBtn.disabled = false;
                    generateBtn.classList.remove('bg-green-400');
                    generateBtn.classList.add('bg-green-500', 'hover:bg-green-600');
                });
        });
    </script>

@endsection
