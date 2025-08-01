@extends('user.layouts.app')
@section('title', 'Layanan Surat Kehilangan - Sukowinangun')

@section('content')
    <!-- Notification Popups -->
     @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK',
                    position: 'center'
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let errorMessages = '';
                @foreach ($errors->all() as $error)
                    errorMessages += '{{ $error }}<br>';
                @endforeach

                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan!',
                    html: errorMessages,
                    confirmButtonColor: '#d33',
                    confirmButtonText: 'OK',
                    position: 'center'
                });
            });
        </script>
    @endif

    <section class="pt-16 bg-gradient-to-r from-primary to-secondary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="text-center text-white">
                <div class="bg-white/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-4xl"></i>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4">Form Pengajuan Surat Kehilangan</h1>
                <p class="text-base sm:text-lg md:text-xl text-gray-100 max-w-3xl mx-auto px-2 sm:px-0">
                    Ajukan permohonan Surat Kehilangan untuk dokumen yang hilang.
                </p>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                        <form action="{{ route('kehilangan.store') }}" method="POST" enctype="multipart/form-data"
                            class="space-y-6">
                            @csrf
                            <!-- Data Pribadi -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-user mr-2 text-secondary"></i>
                                    Data Pribadi
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <!-- Column 1 -->
                                    <div class="space-y-4">
                                        <div>
                                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                                Lengkap</label>
                                            <input type="text" id="nama" name="nama"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="Nama sesuai KTP" value="{{ old('nama') }}">
                                        </div>

                                        <div>
                                            <label for="ttl"
                                                class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                            <input type="date" id="ttl" name="ttl" placeholder="YYYY-MM-DD"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                value="{{ old('ttl') }}">
                                        </div>

                                        <div>
                                            <label for="tempat_lahir"
                                                class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                            <input type="text" id="tempat_lahir" name="tempat_lahir"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="Kota/Kabupaten kelahiran" value="{{ old('tempat_lahir') }}">
                                        </div>
                                    </div>

                                    <!-- Column 2 -->
                                    <div class="space-y-4">
                                        <div>
                                            <label for="nik"
                                                class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                                            <input type="text" id="nik" name="nik" maxlength="16"
                                                inputmode="numeric" pattern="[0-9]*"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="16 digit NIK" value="{{ old('nik') }}">
                                            <div id="nikError" class="text-red-500 text-sm mt-1 hidden">NIK harus 16 digit
                                            </div>
                                        </div>
                                        <div>
                                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                                HP</label>
                                            <input type="text" id="no_hp" name="no_hp" inputmode="numeric"
                                                pattern="[0-9]*" maxlength="15"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="Contoh: 081234567890" value="{{ old('no_hp') }}">
                                        </div>

                                        <div>
                                            <label for="status_perkawinan"
                                                class="block text-sm font-medium text-gray-700 mb-2">Status
                                                Perkawinan</label>
                                            <select id="status_perkawinan" name="status_perkawinan"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                                <option value="">Pilih Status</option>
                                                <option value="Belum Kawin"
                                                    {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum
                                                    Kawin</option>
                                                <option value="Kawin"
                                                    {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin
                                                </option>
                                                <option value="Cerai Hidup"
                                                    {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai
                                                    Hidup</option>
                                                <option value="Cerai Mati"
                                                    {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai
                                                    Mati</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Full width fields -->
                                    <div class="md:col-span-2">
                                        <label for="alamat"
                                            class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                        <textarea id="alamat" name="alamat" rows="3"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Jalan, nomor rumah, RT/RW">{{ old('alamat') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi Kehilangan -->
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-info-circle mr-2 text-secondary"></i>
                                    Informasi Kehilangan
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <!-- Kolom Pertama -->
                                    <div>
                                        <label for="surat_yang_hilang"
                                            class="block text-sm font-medium text-gray-700 mb-2">
                                            Dokumen yang Hilang
                                        </label>
                                        <input type="text" id="surat_yang_hilang" name="surat_yang_hilang"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Contoh: KTP, KK, SIM, dll"
                                            value="{{ old('surat_yang_hilang') }}">
                                    </div>

                                    <!-- Kolom Kedua -->
                                    <div>
                                        <label for="keperluan" class="block text-sm font-medium text-gray-700 mb-2">
                                            Keperluan
                                        </label>
                                        <input type="text" id="keperluan" name="keperluan"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Contoh: Penggantian dokumen, laporan ke polisi, dll"
                                            value="{{ old('keperluan') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-upload mr-2 text-secondary"></i>
                                    Upload Dokumen
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <!-- Surat Pengantar RT/RW -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Surat Pengantar
                                            RT/RW</label>
                                        <div class="space-y-4">
                                            <!-- File Upload Option -->
                                            <div id="pengantar_file_container"
                                                class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-secondary transition-colors cursor-pointer">
                                                <div id="pengantar_file_placeholder">
                                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                                    <p class="text-gray-600">Upload File Surat Pengantar</p>
                                                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 5MB)</p>
                                                </div>
                                                <div id="pengantar_file_preview" class="hidden">
                                                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                                        <div class="flex items-center truncate">
                                                            <i class="fas fa-file-pdf text-red-500 text-xl mr-2"></i>
                                                            <span id="pengantar_file_name" class="truncate"></span>
                                                        </div>
                                                        <button type="button" onclick="resetFileInput('pengantar_file')"
                                                            class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="file" id="pengantar_rt_file" name="pengantar_rt_file"
                                                    accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                                                    onchange="previewFile('pengantar_rt_file', 'pengantar_file')">
                                            </div>

                                            <!-- Or Divider -->
                                            <div class="flex items-center">
                                                <div class="flex-grow border-t border-gray-300"></div>
                                                <span class="mx-2 text-gray-500">atau</span>
                                                <div class="flex-grow border-t border-gray-300"></div>
                                            </div>

                                            <!-- Camera Option -->
                                            <div>
                                                <button type="button"
                                                    onclick="openCamera('pengantar_rt_camera', 'Surat Pengantar RT')"
                                                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-camera mr-2"></i>
                                                    Ambil Foto Surat Pengantar
                                                </button>
                                                <input type="hidden" id="pengantar_rt_camera"
                                                    name="pengantar_rt_camera">
                                                <div id="pengantar_rt_camera_preview" class="mt-2 hidden">
                                                    <img id="pengantar_rt_camera_img"
                                                        class="max-w-full h-auto rounded-lg border border-gray-200 max-h-40">
                                                    <button type="button"
                                                        onclick="resetCameraInput('pengantar_rt_camera')"
                                                        class="mt-2 text-red-500 hover:text-red-700 text-sm">
                                                        <i class="fas fa-times mr-1"></i> Hapus Foto
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Fotokopi KTP -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto KTP</label>
                                        <div class="space-y-4">
                                            <!-- File Upload Option -->
                                            <div id="ktp_file_container"
                                                class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-secondary transition-colors cursor-pointer">
                                                <div id="ktp_file_placeholder">
                                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                                    <p class="text-gray-600">Upload File KTP</p>
                                                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 5MB)</p>
                                                </div>
                                                <div id="ktp_file_preview" class="hidden">
                                                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                                        <div class="flex items-center truncate">
                                                            <i class="fas fa-file-image text-blue-500 text-xl mr-2"></i>
                                                            <span id="ktp_file_name" class="truncate"></span>
                                                        </div>
                                                        <button type="button" onclick="resetFileInput('ktp_file')"
                                                            class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="file" id="ktp_file" name="ktp_file"
                                                    accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                                                    onchange="previewFile('ktp_file', 'ktp_file')">
                                            </div>

                                            <!-- Or Divider -->
                                            <div class="flex items-center">
                                                <div class="flex-grow border-t border-gray-300"></div>
                                                <span class="mx-2 text-gray-500">atau</span>
                                                <div class="flex-grow border-t border-gray-300"></div>
                                            </div>

                                            <!-- Camera Option -->
                                            <div>
                                                <button type="button" onclick="openCamera('ktp_camera', 'KTP')"
                                                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-camera mr-2"></i>
                                                    Ambil Foto KTP
                                                </button>
                                                <input type="hidden" id="ktp_camera" name="ktp_camera">
                                                <div id="ktp_camera_preview" class="mt-2 hidden">
                                                    <img id="ktp_camera_img"
                                                        class="max-w-full h-auto rounded-lg border border-gray-200 max-h-40">
                                                    <button type="button" onclick="resetCameraInput('ktp_camera')"
                                                        class="mt-2 text-red-500 hover:text-red-700 text-sm">
                                                        <i class="fas fa-times mr-1"></i> Hapus Foto
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Fotokopi KK -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Foto KK</label>
                                        <div class="space-y-4">
                                            <!-- File Upload Option -->
                                            <div id="kk_file_container"
                                                class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-secondary transition-colors cursor-pointer">
                                                <div id="kk_file_placeholder">
                                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                                    <p class="text-gray-600">Upload File KK</p>
                                                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 5MB)</p>
                                                </div>
                                                <div id="kk_file_preview" class="hidden">
                                                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                                        <div class="flex items-center truncate">
                                                            <i class="fas fa-file-image text-blue-500 text-xl mr-2"></i>
                                                            <span id="kk_file_name" class="truncate"></span>
                                                        </div>
                                                        <button type="button" onclick="resetFileInput('kk_file')"
                                                            class="text-red-500 hover:text-red-700">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <input type="file" id="kk_file" name="kk_file"
                                                    accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                                                    onchange="previewFile('kk_file', 'kk_file')">
                                            </div>

                                            <!-- Or Divider -->
                                            <div class="flex items-center">
                                                <div class="flex-grow border-t border-gray-300"></div>
                                                <span class="mx-2 text-gray-500">atau</span>
                                                <div class="flex-grow border-t border-gray-300"></div>
                                            </div>

                                            <!-- Camera Option -->
                                            <div>
                                                <button type="button" onclick="openCamera('kk_camera', 'KK')"
                                                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-camera mr-2"></i>
                                                    Ambil Foto KK
                                                </button>
                                                <input type="hidden" id="kk_camera" name="kk_camera">
                                                <div id="kk_camera_preview" class="mt-2 hidden">
                                                    <img id="kk_camera_img"
                                                        class="max-w-full h-auto rounded-lg border border-gray-200 max-h-40">
                                                    <button type="button" onclick="resetCameraInput('kk_camera')"
                                                        class="mt-2 text-red-500 hover:text-red-700 text-sm">
                                                        <i class="fas fa-times mr-1"></i> Hapus Foto
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="border-t pt-6">
                                <button type="submit"
                                    class="w-full bg-secondary hover:bg-primary text-white py-3 px-6 rounded-lg font-semibold text-lg transition-colors flex items-center justify-center">

                                    Ajukan Permohonan Surat Kehilangan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

 <script>
        // Validasi NIK harus 16 digit
        document.getElementById('nik').addEventListener('input', function() {
            const nikInput = this;
            const nikError = document.getElementById('nikError');

            if (nikInput.value.length !== 16 && nikInput.value.length > 0) {
                nikError.classList.remove('hidden');
                nikInput.classList.add('border-red-500');
            } else {
                nikError.classList.add('hidden');
                nikInput.classList.remove('border-red-500');
            }
        });

        // Camera functionality with iOS support
        function openCamera(inputId, label) {
            // Check if iOS device
            const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) ||
                (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);

            if (isIOS) {
                // iOS specific implementation
                handleIOSCamera(inputId, label);
                return;
            }

            // Standard implementation for other devices
            handleStandardCamera(inputId, label);
        }

        // Handle camera for iOS devices
        function handleIOSCamera(inputId, label) {
            // Create a file input element
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*';
            fileInput.capture = 'environment'; // Use rear camera
            fileInput.style.display = 'none';

            fileInput.onchange = function(e) {
                if (e.target.files && e.target.files.length > 0) {
                    const file = e.target.files[0];

                    // Check file size (max 5MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Ukuran file terlalu besar. Maksimal 5MB.');
                        return;
                    }

                    // Check file type
                    if (!file.type.match('image.*')) {
                        alert('Hanya file gambar yang diperbolehkan.');
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function(event) {
                        // Compress image for iOS
                        compressImageForIOS(event.target.result, function(compressedImage) {
                            document.getElementById(inputId).value = compressedImage;
                            document.getElementById(`${inputId}_img`).src = compressedImage;
                            document.getElementById(`${inputId}_preview`).classList.remove('hidden');

                            // Disable the other input method
                            if (inputId === 'pengantar_rt_camera') {
                                resetFileInput('pengantar_file');
                            } else if (inputId === 'ktp_camera') {
                                resetFileInput('ktp_file');
                            } else if (inputId === 'kk_camera') {
                                resetFileInput('kk_file');
                            }
                        });
                    };

                    reader.readAsDataURL(file);
                }

                // Remove input after use
                setTimeout(() => {
                    document.body.removeChild(fileInput);
                }, 100);
            };

            document.body.appendChild(fileInput);
            fileInput.click();
        }

        // Image compression for iOS
        function compressImageForIOS(imageData, callback) {
            const img = new Image();
            img.src = imageData;

            img.onload = function() {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');

                // Set maximum dimensions
                const MAX_WIDTH = 800;
                const MAX_HEIGHT = 800;

                let width = img.width;
                let height = img.height;

                // Calculate new dimensions maintaining aspect ratio
                if (width > height) {
                    if (width > MAX_WIDTH) {
                        height *= MAX_WIDTH / width;
                        width = MAX_WIDTH;
                    }
                } else {
                    if (height > MAX_HEIGHT) {
                        width *= MAX_HEIGHT / height;
                        height = MAX_HEIGHT;
                    }
                }

                canvas.width = width;
                canvas.height = height;

                // Draw and compress image
                ctx.drawImage(img, 0, 0, width, height);

                // Convert to JPEG with 70% quality
                callback(canvas.toDataURL('image/jpeg', 0.7));
            };
        }

        // Standard camera implementation for non-iOS devices
        function handleStandardCamera(inputId, label) {
            // Check if browser supports mediaDevices
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert('Browser Anda tidak mendukung akses kamera');
                return;
            }

            // Create modal container
            const modal = document.createElement('div');
            modal.style.position = 'fixed';
            modal.style.top = '0';
            modal.style.left = '0';
            modal.style.width = '100%';
            modal.style.height = '100%';
            modal.style.backgroundColor = 'rgba(0,0,0,0.9)';
            modal.style.zIndex = '9999';
            modal.style.display = 'flex';
            modal.style.flexDirection = 'column';
            modal.style.alignItems = 'center';
            modal.style.justifyContent = 'center';
            modal.style.padding = '20px';

            // Create header
            const header = document.createElement('div');
            header.className = 'text-white text-xl font-bold mb-4';
            header.textContent = `Ambil Foto ${label}`;
            modal.appendChild(header);

            // Create video container with responsive sizing
            const videoContainer = document.createElement('div');
            videoContainer.style.width = '100%';
            videoContainer.style.maxWidth = '500px';
            videoContainer.style.position = 'relative';

            // Create video element for preview
            const video = document.createElement('video');
            video.setAttribute('autoplay', '');
            video.style.width = '100%';
            video.style.borderRadius = '0.5rem';
            video.style.display = 'block';
            video.style.maxHeight = '70vh';
            videoContainer.appendChild(video);

            // Create canvas for capturing
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            // Create button container
            const buttonContainer = document.createElement('div');
            buttonContainer.className = 'flex flex-col md:flex-row gap-4 mt-4';

            // Create capture button
            const captureBtn = document.createElement('button');
            captureBtn.textContent = 'Ambil Foto';
            captureBtn.className =
                'bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg flex items-center justify-center';
            captureBtn.innerHTML = '<i class="fas fa-camera mr-2"></i> Ambil Foto';
            captureBtn.onclick = function() {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Convert to data URL with quality compression
                const imageData = canvas.toDataURL('image/jpeg', 0.7);

                // Set the value and show preview
                document.getElementById(inputId).value = imageData;
                document.getElementById(`${inputId}_img`).src = imageData;
                document.getElementById(`${inputId}_preview`).classList.remove('hidden');

                // Stop camera and remove modal
                stream.getTracks().forEach(track => track.stop());
                document.body.removeChild(modal);

                // Disable the other input method
                if (inputId === 'pengantar_rt_camera') {
                    resetFileInput('pengantar_file');
                } else if (inputId === 'ktp_camera') {
                    resetFileInput('ktp_file');
                } else if (inputId === 'kk_camera') {
                    resetFileInput('kk_file');
                }
            };

            // Create cancel button
            const cancelBtn = document.createElement('button');
            cancelBtn.textContent = 'Batal';
            cancelBtn.className =
                'bg-gray-500 hover:bg-gray-600 text-white py-2 px-6 rounded-lg flex items-center justify-center';
            cancelBtn.innerHTML = '<i class="fas fa-times mr-2"></i> Batal';
            cancelBtn.onclick = function() {
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
                document.body.removeChild(modal);
            };

            // Add elements to modal
            buttonContainer.appendChild(captureBtn);
            buttonContainer.appendChild(cancelBtn);
            modal.appendChild(videoContainer);
            modal.appendChild(buttonContainer);
            document.body.appendChild(modal);

            // Start camera
            let stream;
            navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment',
                        width: {
                            ideal: 1280
                        },
                        height: {
                            ideal: 720
                        }
                    },
                    audio: false
                })
                .then(function(s) {
                    stream = s;
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function(err) {
                    console.error("Error accessing camera: ", err);
                    document.body.removeChild(modal);
                    alert('Gagal mengakses kamera: ' + err.message);
                });

            // Handle window resize
            const resizeHandler = function() {
                if (video.videoWidth > 0) {
                    const aspectRatio = video.videoWidth / video.videoHeight;
                    const maxWidth = Math.min(500, window.innerWidth - 40);
                    const height = maxWidth / aspectRatio;
                    video.style.width = `${maxWidth}px`;
                    video.style.height = `${height}px`;
                }
            };

            window.addEventListener('resize', resizeHandler);
            video.addEventListener('loadedmetadata', resizeHandler);
            modal._resizeHandler = resizeHandler;

            // Cleanup on modal removal
            modal._cleanup = function() {
                window.removeEventListener('resize', this._resizeHandler);
                if (stream) {
                    stream.getTracks().forEach(track => track.stop());
                }
            };

            // Override removeChild to ensure cleanup
            const originalRemoveChild = document.body.removeChild.bind(document.body);
            document.body.removeChild = function(node) {
                if (node._cleanup) node._cleanup();
                return originalRemoveChild(node);
            };
        }

        // File preview functionality
        function previewFile(inputId, previewId) {
            const input = document.getElementById(inputId);
            const file = input.files[0];

            if (file) {
                // Check file size (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    resetFileInput(previewId);
                    return;
                }

                // Check file type
                if (!file.type.match('image.*') && !file.type.match('application/pdf')) {
                    alert('Hanya file gambar (JPG, PNG) atau PDF yang diperbolehkan.');
                    resetFileInput(previewId);
                    return;
                }

                // Tampilkan preview
                document.getElementById(`${previewId}_placeholder`).classList.add('hidden');
                document.getElementById(`${previewId}_preview`).classList.remove('hidden');
                document.getElementById(`${previewId}_name`).textContent = file.name;

                // Nonaktifkan input kamera yang lain
                if (previewId === 'pengantar_file') {
                    resetCameraInput('pengantar_rt_camera');
                } else if (previewId === 'ktp_file') {
                    resetCameraInput('ktp_camera');
                } else if (previewId === 'kk_file') {
                    resetCameraInput('kk_camera');
                }
            }
        }

        // Reset input file
        function resetFileInput(type) {
            const inputId = type === 'pengantar_file' ? 'pengantar_rt_file' : (type === 'ktp_file' ? 'ktp_file' :
            'kk_file');
            const input = document.getElementById(inputId);

            // Reset file input
            input.value = '';

            // Sembunyikan preview dan tampilkan placeholder
            const placeholder = document.getElementById(`${type}_placeholder`);
            const preview = document.getElementById(`${type}_preview`);

            if (placeholder && preview) {
                preview.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }

            // Optional: cegah popup upload otomatis
            input.dispatchEvent(new Event('change')); // agar tidak memicu ulang preview
        }

        // Reset input kamera
        function resetCameraInput(inputId) {
            document.getElementById(inputId).value = '';
            document.getElementById(`${inputId}_preview`).classList.add('hidden');
        }

        // Untuk pengantar
        document.getElementById('pengantar_file_container').addEventListener('click', function(e) {
            if (
                e.target.closest('button') ||
                e.target.closest('i') ||
                e.target.closest('svg')
            ) {
                return;
            }
            document.getElementById('pengantar_rt_file').click();
        });

        // Untuk KTP
        document.getElementById('ktp_file_container').addEventListener('click', function(e) {
            if (
                e.target.closest('button') ||
                e.target.closest('i') ||
                e.target.closest('svg')
            ) {
                return;
            }
            document.getElementById('ktp_file').click();
        });

        // Untuk KK
        document.getElementById('kk_file_container').addEventListener('click', function(e) {
            if (
                e.target.closest('button') ||
                e.target.closest('i') ||
                e.target.closest('svg')
            ) {
                return;
            }
            document.getElementById('kk_file').click();
        });
    </script>
@endsection
