@extends('user.layouts.app')

@section('title', 'Layanan Lainnya - Sukowinangun')

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
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4">Form Pengajuan Layanan Lainnya</h1>
                <p class="text-base sm:text-lg md:text-xl text-gray-100 max-w-3xl mx-auto px-2 sm:px-0">
                    Ajukan permohonan layanan administrasi lainnya sesuai kebutuhan Anda.
                </p>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                        <form action="{{ route('lainnya.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                            <input type="text" id="nama" name="nama" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="Nama sesuai KTP">
                                        </div>
                                        <div>
                                            <label for="ttl" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir</label>
                                            <input type="date" id="ttl" name="ttl" required placeholder="YYYY-MM-DD"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                        </div>
                                        <div>
                                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                            <input type="text" id="tempat_lahir" name="tempat_lahir" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="Kota/Kabupaten kelahiran">
                                        </div>
                                    </div>
                                    <!-- Column 2 -->
                                    <div class="space-y-4">
                                        <div>
                                            <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                                            <input type="text" id="nik" name="nik" maxlength="16" required
                                                inputmode="numeric" pattern="[0-9]*"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="16 digit NIK">
                                            <div id="nikError" class="text-red-500 text-sm mt-1 hidden">NIK harus 16 digit</div>
                                        </div>
                                        <div>
                                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">Nomor HP</label>
                                            <input type="text" id="no_hp" name="no_hp" required inputmode="numeric"
                                                pattern="[0-9]*" maxlength="15"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="Contoh: 081234567890">
                                        </div>
                                        <div>
                                            <label for="status_perkawinan" class="block text-sm font-medium text-gray-700 mb-2">Status Perkawinan</label>
                                            <select id="status_perkawinan" name="status_perkawinan" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                                <option value="">Pilih Status</option>
                                                <option value="Belum Kawin">Belum Kawin</option>
                                                <option value="Kawin">Kawin</option>
                                                <option value="Cerai Hidup">Cerai Hidup</option>
                                                <option value="Cerai Mati">Cerai Mati</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Full width fields -->
                                    <div class="md:col-span-2">
                                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                        <textarea id="alamat" name="alamat" rows="3" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Jalan, nomor rumah, RT/RW"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Keperluan -->
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-info-circle mr-2 text-secondary"></i>
                                    Keperluan
                                </h3>
                                <div class="grid grid-cols-1 gap-4 md:gap-6">
                                    <div>
                                        <label for="keperluan" class="block text-sm font-medium text-gray-700 mb-2">Keperluan</label>
                                        <input type="text" id="keperluan" name="keperluan" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Jelaskan keperluan layanan yang dibutuhkan">
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Dokumen -->
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-upload mr-2 text-secondary"></i>
                                    Upload Dokumen
                                </h3>

                                <div id="file-container">
                                    <!-- File upload template akan ditambahkan di sini -->
                                </div>

                                <button type="button" id="add-file-btn"
                                    class="mt-4 bg-secondary hover:bg-primary text-white py-2 px-4 rounded-lg flex items-center">
                                    <i class="fas fa-plus mr-2"></i>
                                    Tambah File
                                </button>
                            </div>

                            <!-- Submit Button -->
                            <div class="border-t pt-6">
                                <button type="submit"
                                    class="w-full bg-secondary hover:bg-primary text-white py-3 px-6 rounded-lg font-semibold text-lg transition-colors flex items-center justify-center">
                                    Ajukan Permohonan Layanan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    let fileIndex = 0;

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

    // Tambah file upload pertama saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        addFileUpload();
    });

    // Fungsi untuk menambah file upload
    document.getElementById('add-file-btn').addEventListener('click', function() {
        addFileUpload();
    });

    function addFileUpload() {
        const container = document.getElementById('file-container');
        const fileDiv = document.createElement('div');
        fileDiv.className = 'file-upload-item border border-gray-200 rounded-lg p-4 mb-4';
        fileDiv.setAttribute('data-index', fileIndex);

        fileDiv.innerHTML = `
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-medium text-gray-700">Dokumen ${fileIndex + 1}</h4>
                ${fileIndex > 0 ? `<button type="button" onclick="removeFileUpload(${fileIndex})" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>` : ''}
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama/Keterangan File</label>
                    <input type="text" name="file_names[${fileIndex}]" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                        placeholder="Contoh: KTP, KK, Surat Pengantar, dll">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload File</label>
                    <div class="space-y-4">
                        <!-- File Upload Option -->
                        <div id="file_container_${fileIndex}"
                            class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-secondary transition-colors cursor-pointer">
                            <div id="file_placeholder_${fileIndex}">
                                <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                <p class="text-gray-600">Klik untuk upload file</p>
                                <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 5MB)</p>
                            </div>
                            <div id="file_preview_${fileIndex}" class="hidden">
                                <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                    <div class="flex items-center truncate">
                                        <i class="fas fa-file text-blue-500 text-xl mr-2"></i>
                                        <span id="file_name_${fileIndex}" class="truncate"></span>
                                    </div>
                                    <button type="button" onclick="resetFileInput(${fileIndex})"
                                        class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="file" id="files_${fileIndex}" name="files[${fileIndex}]"
                                accept=".pdf,.jpg,.jpeg,.png" class="hidden"
                                onchange="previewFile(${fileIndex})">
                        </div>
                        <!-- Or Divider -->
                        <div class="flex items-center">
                            <div class="flex-grow border-t border-gray-300"></div>
                            <span class="mx-2 text-gray-500">atau</span>
                            <div class="flex-grow border-t border-gray-300"></div>
                        </div>
                        <!-- Camera Option -->
                        <div>
                            <button type="button" onclick="openCamera(${fileIndex})"
                                class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 py-2 px-4 rounded-lg flex items-center justify-center">
                                <i class="fas fa-camera mr-2"></i>
                                Ambil Foto
                            </button>
                            <input type="hidden" id="camera_data_${fileIndex}" name="camera_data[${fileIndex}]">
                            <div id="camera_preview_${fileIndex}" class="mt-2 hidden">
                                <img id="camera_img_${fileIndex}" class="max-w-full h-auto rounded-lg border border-gray-200 max-h-40">
                                <button type="button" onclick="resetCameraInput(${fileIndex})"
                                    class="mt-2 text-red-500 hover:text-red-700 text-sm">
                                    <i class="fas fa-times mr-1"></i> Hapus Foto
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        container.appendChild(fileDiv);

        // Setup event listener untuk file container yang baru dibuat
        setupFileUploadEvents(fileIndex);

        fileIndex++;
    }

    // Function untuk setup event listeners
    function setupFileUploadEvents(index) {
        const fileContainer = document.getElementById(`file_container_${index}`);
        const fileInput = document.getElementById(`files_${index}`);

        if (fileContainer && fileInput) {
            fileContainer.addEventListener('click', function(e) {
                if (e.target.closest('button') ||
                    e.target.closest('i') ||
                    e.target.closest('svg') ||
                    e.target.tagName === 'BUTTON' ||
                    e.target.tagName === 'I') {
                    return;
                }
                console.log(`Clicking file input for index ${index}`);
                fileInput.click();
            });

            // Tambahkan hover effect
            fileContainer.addEventListener('mouseenter', function() {
                if (!document.getElementById(`file_preview_${index}`).classList.contains('hidden')) {
                    return;
                }
                this.classList.add('border-secondary');
            });

            fileContainer.addEventListener('mouseleave', function() {
                if (!document.getElementById(`file_preview_${index}`).classList.contains('hidden')) {
                    return;
                }
                this.classList.remove('border-secondary');
            });
        }
    }

    // Update function previewFile
    function previewFile(index) {
        const input = document.getElementById(`files_${index}`);
        const file = input.files[0];

        console.log(`Preview file for index ${index}:`, file);

        if (file) {
            // Validasi ukuran file (5MB = 2 * 1024 * 1024 bytes)
            if (file.size > 2 * 1024 * 1024) {
                alert('Ukuran file terlalu besar. Maksimal 5MB.');
                resetFileInput(index);
                return;
            }

            // Validasi tipe file
            const allowedTypes = ['application/pdf', 'image/jpeg', 'image/jpg', 'image/png'];
            if (!allowedTypes.includes(file.type)) {
                alert('Tipe file tidak didukung. Gunakan PDF, JPG, atau PNG.');
                resetFileInput(index);
                return;
            }

            // Tampilkan preview
            document.getElementById(`file_placeholder_${index}`).classList.add('hidden');
            document.getElementById(`file_preview_${index}`).classList.remove('hidden');
            document.getElementById(`file_name_${index}`).textContent = file.name;

            // Update icon berdasarkan tipe file
            const iconElement = document.querySelector(`#file_preview_${index} i`);
            if (file.type === 'application/pdf') {
                iconElement.className = 'fas fa-file-pdf text-red-500 text-xl mr-2';
            } else {
                iconElement.className = 'fas fa-file-image text-blue-500 text-xl mr-2';
            }

            // Reset camera input
            resetCameraInput(index);

            console.log(`File preview updated for index ${index}`);
        }
    }

    // Update function resetFileInput
    function resetFileInput(index) {
        const input = document.getElementById(`files_${index}`);
        const placeholder = document.getElementById(`file_placeholder_${index}`);
        const preview = document.getElementById(`file_preview_${index}`);

        if (input) {
            input.value = '';
        }

        if (preview && placeholder) {
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }

        console.log(`File input reset for index ${index}`);
    }

    function removeFileUpload(index) {
        const fileDiv = document.querySelector(`[data-index="${index}"]`);
        if (fileDiv) {
            fileDiv.remove();
        }
    }

    function resetCameraInput(index) {
        document.getElementById(`camera_data_${index}`).value = '';
        document.getElementById(`camera_preview_${index}`).classList.add('hidden');
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

    function openCamera(index) {
        // Check if iOS device
        const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) ||
            (navigator.platform === 'MacIntel' && navigator.maxTouchPoints > 1);

        if (isIOS) {
            // iOS specific implementation
            handleIOSCamera(index);
            return;
        }

        // Standard implementation for other devices
        handleStandardCamera(index);
    }

    function handleIOSCamera(index) {
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
                if (file.size > 5 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 5MB.');
                    document.body.removeChild(fileInput);
                    return;
                }

                // Check file type
                if (!file.type.match('image.*')) {
                    alert('Hanya file gambar yang diperbolehkan.');
                    document.body.removeChild(fileInput);
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(event) {
                    // Compress image for iOS
                    compressImageForIOS(event.target.result, function(compressedImage) {
                        document.getElementById(`camera_data_${index}`).value = compressedImage;
                        document.getElementById(`camera_img_${index}`).src = compressedImage;
                        document.getElementById(`camera_preview_${index}`).classList.remove('hidden');

                        // Reset file input
                        resetFileInput(index);
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

    function handleStandardCamera(index) {
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
        header.textContent = 'Ambil Foto Dokumen';
        modal.appendChild(header);

        // Create video container
        const videoContainer = document.createElement('div');
        videoContainer.style.width = '100%';
        videoContainer.style.maxWidth = '500px';
        videoContainer.style.position = 'relative';

        // Create video element
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
        captureBtn.className = 'bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-lg flex items-center justify-center';
        captureBtn.innerHTML = '<i class="fas fa-camera mr-2"></i> Ambil Foto';
        captureBtn.onclick = function() {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Convert to data URL
            const imageData = canvas.toDataURL('image/jpeg', 0.7);

            // Set the value and show preview
            document.getElementById(`camera_data_${index}`).value = imageData;
            document.getElementById(`camera_img_${index}`).src = imageData;
            document.getElementById(`camera_preview_${index}`).classList.remove('hidden');

            // Reset file input
            resetFileInput(index);

            // Stop camera and remove modal
            stream.getTracks().forEach(track => track.stop());
            document.body.removeChild(modal);
        };

        // Create cancel button
        const cancelBtn = document.createElement('button');
        cancelBtn.className = 'bg-gray-500 hover:bg-gray-600 text-white py-2 px-6 rounded-lg flex items-center justify-center';
        cancelBtn.innerHTML = '<i class="fas fa-times mr-2"></i> Batal';
        cancelBtn.onclick = function() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            document.body.removeChild(modal);
        };

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
                width: { ideal: 1280 },
                height: { ideal: 720 }
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
    }
</script>
@endsection
