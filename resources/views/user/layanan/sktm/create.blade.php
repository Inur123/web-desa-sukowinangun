@extends('user.layouts.app')
@section('title', 'Layanan SKTM - Sukowinangun')

@section('content')
    <!-- Notification Popups (same as before) -->

    <section class="pt-16 bg-gradient-to-r from-primary to-secondary" data-aos="fade-down" data-aos-duration="800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="text-center text-white">
                <div class="bg-white/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-4xl"></i>
                </div>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-3 sm:mb-4">Form Pengajuan Surat Keterangan Tidak Mampu
                </h1>
                <p class="text-base sm:text-lg md:text-xl text-gray-100 max-w-3xl mx-auto px-2 sm:px-0">
                    Ajukan permohonan Surat Keterangan Tidak Mampu (SKTM) untuk keperluan administrasi dan bantuan sosial.
                </p>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                        <form action="{{ route('sktm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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
                                            <label for="ttl"
                                                class="block text-sm font-medium text-gray-700 mb-2">Tanggal
                                                Lahir</label>
                                            <input type="date" id="ttl" name="ttl" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent">
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
                                            <label for="tempat_lahir"
                                                class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir</label>
                                            <input type="text" id="tempat_lahir" name="tempat_lahir" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                                placeholder="Kota/Kabupaten kelahiran">
                                        </div>
                                        <div>
                                            <label for="nik"
                                                class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                                            <input type="text" id="nik" name="nik" maxlength="16" required
                                                inputmode="numeric" pattern="[0-9]*"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
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

                            <!-- Data Anak -->
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                    <i class="fas fa-child mr-2 text-secondary"></i>
                                    Data Anak (Jika untuk keperluan anak)
                                </h3>

                                <div class="grid grid-cols-1 gap-4 md:gap-6">
                                    <div>
                                        <label for="nama_anak" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                            Anak</label>
                                        <input type="text" id="nama_anak" name="nama_anak"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Nama lengkap anak">
                                    </div>

                                    <div>
                                        <label for="keperluan"
                                            class="block text-sm font-medium text-gray-700 mb-2">Keperluan</label>
                                        <input type="text" id="keperluan" name="keperluan" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent"
                                            placeholder="Contoh: Pendaftaran sekolah, bantuan sosial, dll">
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
                                        <div class="space-y-4">
                                            <!-- File Upload Option -->
                                            <div id="pengantar_file_container"
                                                class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-secondary transition-colors cursor-pointer">
                                                <div id="pengantar_file_placeholder">
                                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                                    <p class="text-gray-600">Upload File Surat Pengantar</p>
                                                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 2MB)</p>
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
                                                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 2MB)</p>
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
                                                    <p class="text-xs text-gray-500 mt-1">PDF, JPG, PNG (Max 2MB)</p>
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
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Ajukan Permohonan SKTM
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Same JavaScript as before for file uploads and camera
    </script>
@endsection
