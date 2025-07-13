@extends('user.layouts.app')
@section('title', 'Layanan SKU - Sukowinangun')

@section('content')
    <!-- Notification Popups -->
    @if (session('success'))
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center animate-fade-in-down">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
                <button onclick="this.parentElement.remove()" class="ml-4">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="fixed top-4 right-4 z-50">
            <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg animate-fade-in-down">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>Terjadi kesalahan!</span>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <ul class="mt-2 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <section class="pt-16 bg-gradient-to-r from-primary to-secondary"data-aos="fade-down" data-aos-duration="800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="text-center text-white">
                 <div class="bg-white/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-store text-4xl"></i>
            </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4">Form Pengajuan Surat Keterangan Usaha</h1>
                <p class="text-base sm:text-lg md:text-xl text-gray-100 max-w-3xl mx-auto px-2 sm:px-0">
                 Ajukan permohonan Surat Keterangan Usaha (SKU) untuk keperluan administrasi bisnis dan perizinan usaha Anda.
                </p>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                        <form action="{{ route('sku.store') }}" method="POST" enctype="multipart/form-data"
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
                                            <input type="text" id="nama" name="nama" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="Nama sesuai KTP">
                                        </div>

                                        <div>
                                            <label for="tempat_lahir"
                                                class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                            <input type="text" id="tempat_lahir" name="tempat_lahir" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="Kota/Kabupaten kelahiran">
                                        </div>

                                        <div>
                                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">Nomor
                                                HP</label>
                                            <input type="text" id="no_hp" name="no_hp" required inputmode="numeric"
                                                pattern="[0-9]*" maxlength="15"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="Contoh: 081234567890">

                                        </div>

                                    </div>

                                    <!-- Column 2 -->
                                    <div class="space-y-4">
                                        <div>
                                            <label for="ttl"
                                                class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                                Lahir</label>
                                            <input type="date" id="ttl" name="ttl" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
                                        </div>

                                        <div>
                                            <label for="nik"
                                                class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                                            <input type="text" id="nik" name="nik" maxlength="16" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="16 digit NIK">
                                            <div id="nikError" class="text-red-500 text-sm mt-1 hidden">NIK harus 16 digit
                                            </div>
                                        </div>

                                        <div>
                                            <label for="status_perkawinan"
                                                class="block text-sm font-medium text-gray-700 mb-2">Status
                                                Perkawinan</label>
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

                                    <!-- Full width field -->
                                    <div class="md:col-span-2">
                                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat
                                            Lengkap</label>
                                        <textarea id="alamat" name="alamat" rows="3" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Jalan, nomor rumah, RT/RW"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Data Usaha -->
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-store mr-2 text-secondary"></i>
                                    Data Usaha
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                                    <!-- Column 1 -->
                                    <div>
                                        <label for="nama_usaha" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                            Usaha</label>
                                        <input type="text" id="nama_usaha" name="nama_usaha" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Nama usaha Anda">
                                    </div>

                                    <!-- Column 2 -->
                                    <div>
                                        <label for="keperluan"
                                            class="block text-sm font-medium text-gray-700 mb-2">Keperluan</label>
                                        <input type="text" id="keperluan" name="keperluan" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Contoh: Pengajuan izin usaha, perpanjangan izin, dll">
                                    </div>

                                    <!-- Full width field -->
                                    <div class="md:col-span-2">
                                        <label for="alamat_usaha"
                                            class="block text-sm font-medium text-gray-700 mb-2">Alamat Usaha</label>
                                        <textarea id="alamat_usaha" name="alamat_usaha" rows="3" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Alamat lengkap tempat usaha"></textarea>
                                    </div>
                                </div>
                            </div>

                            <!-- Upload Dokumen -->
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
                                        <div id="pengantar_rt_container"
                                            class="border-2 border-dashed border-gray-300 rounded-lg p-3 md:p-4 text-center hover:border-secondary transition-colors cursor-pointer relative min-h-[120px] flex items-center justify-center">
                                            <div id="pengantar_rt_preview"
                                                class="hidden absolute inset-0 bg-white rounded-lg p-3 flex items-center">
                                                <div class="w-full">
                                                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                                        <div class="flex items-center min-w-0">
                                                            <i
                                                                class="fas fa-file-pdf text-red-500 text-lg md:text-xl mr-2 flex-shrink-0"></i>
                                                            <div class="min-w-0">
                                                                <p id="pengantar_rt_filename"
                                                                    class="text-xs md:text-sm font-medium truncate"></p>
                                                                <p id="pengantar_rt_size" class="text-xs text-gray-500">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <button type="button" onclick="removeFile('pengantar_rt')"
                                                            class="text-red-500 hover:text-red-700 ml-2 flex-shrink-0">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="pengantar_rt_placeholder" class="px-2">
                                                <i
                                                    class="fas fa-cloud-upload-alt text-2xl md:text-3xl text-gray-400 mb-1 md:mb-2"></i>
                                                <p class="text-gray-600 text-sm md:text-base">Klik untuk upload Surat
                                                    Pengantar</p>
                                                <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 2MB)</p>
                                            </div>
                                            <input type="file" id="pengantar_rt" name="pengantar_rt"
                                                accept=".pdf,.jpg,.jpeg,.png" class="hidden" required
                                                onchange="previewFile('pengantar_rt')">
                                        </div>
                                    </div>

                                    <!-- Fotokopi KTP -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Fotokopi KTP</label>
                                        <div id="ktp_container"
                                            class="border-2 border-dashed border-gray-300 rounded-lg p-3 md:p-4 text-center hover:border-secondary transition-colors cursor-pointer relative min-h-[120px] flex items-center justify-center">
                                            <div id="ktp_preview"
                                                class="hidden absolute inset-0 bg-white rounded-lg p-3 flex items-center">
                                                <div class="w-full">
                                                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                                        <div class="flex items-center min-w-0">
                                                            <i
                                                                class="fas fa-file-image text-blue-500 text-lg md:text-xl mr-2 flex-shrink-0"></i>
                                                            <div class="min-w-0">
                                                                <p id="ktp_filename"
                                                                    class="text-xs md:text-sm font-medium truncate"></p>
                                                                <p id="ktp_size" class="text-xs text-gray-500"></p>
                                                            </div>
                                                        </div>
                                                        <button type="button" onclick="removeFile('ktp')"
                                                            class="text-red-500 hover:text-red-700 ml-2 flex-shrink-0">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="ktp_placeholder" class="px-2">
                                                <i
                                                    class="fas fa-cloud-upload-alt text-2xl md:text-3xl text-gray-400 mb-1 md:mb-2"></i>
                                                <p class="text-gray-600 text-sm md:text-base">Klik untuk upload KTP</p>
                                                <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 2MB)</p>
                                            </div>
                                            <input type="file" id="ktp" name="ktp"
                                                accept=".pdf,.jpg,.jpeg,.png" class="hidden" required
                                                onchange="previewFile('ktp')">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="border-t pt-6">
                                <button type="submit"
                                    class="w-full bg-secondary hover:bg-primary text-white py-3 px-6 rounded-lg font-semibold text-lg transition-colors flex items-center justify-center">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Ajukan Permohonan SKU
                                </button>
                            </div>
                        </form>
                    </div>
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

        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('pengantar_rt_container').addEventListener('click', function() {
                document.getElementById('pengantar_rt').click();
            });

            document.getElementById('ktp_container').addEventListener('click', function() {
                document.getElementById('ktp').click();
            });
        });

        // File preview functionality
        function previewFile(inputId) {
            const input = document.getElementById(inputId);
            const file = input.files[0];

            if (file) {
                const preview = document.getElementById(`${inputId}_preview`);
                const placeholder = document.getElementById(`${inputId}_placeholder`);
                const filename = document.getElementById(`${inputId}_filename`);
                const filesize = document.getElementById(`${inputId}_size`);

                // Format file size
                const formatFileSize = (bytes) => {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                };

                // Show appropriate icon based on file extension
                const fileExt = file.name.split('.').pop().toLowerCase();
                let iconClass = 'fa-file';

                if (fileExt === 'pdf') {
                    iconClass = 'fa-file-pdf text-red-500';
                } else if (['jpg', 'jpeg', 'png'].includes(fileExt)) {
                    iconClass = 'fa-file-image text-blue-500';
                }

                filename.textContent = file.name;
                filesize.textContent = formatFileSize(file.size);
                preview.querySelector('i').className = `fas ${iconClass} text-lg md:text-xl mr-2 flex-shrink-0`;

                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
        }

        function removeFile(inputId, event) {
            event.stopPropagation(); // Mencegah event click bubble ke container
            const input = document.getElementById(inputId);
            const preview = document.getElementById(`${inputId}_preview`);
            const placeholder = document.getElementById(`${inputId}_placeholder`);

            input.value = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');

            if (input.required) {
                input.setCustomValidity('File harus diupload');
            }
        }

        // Reset custom validation when new file is selected
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                this.setCustomValidity('');
            });
        });
        setTimeout(() => {
    const successNotif = document.querySelector('.bg-green-500');
    const errorNotif = document.querySelector('.bg-red-500');

    if (successNotif) successNotif.remove();
    if (errorNotif) errorNotif.remove();
}, 5000);
    </script>
@endsection
