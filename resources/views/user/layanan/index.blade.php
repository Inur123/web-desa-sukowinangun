@extends('user.layouts.app')
@section('title', 'Layanan - Sukowinangun')

@section('content')


    <!-- Page Header -->
    <section class="pt-16 bg-gradient-to-r from-primary to-secondary"data-aos="fade-down" data-aos-duration="800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Kelurahan</h1>
                <p class="text-xl text-gray-100 max-w-3xl mx-auto">
                    Berbagai layanan administrasi dan fasilitas publik untuk kemudahan warga Kelurahan
                </p>
            </div>
        </div>
    </section>
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Surat Keterangan -->
                <a href="form-sktm.html"
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-file-alt text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Tidak Mampu</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan tidak mampu untuk berbagai keperluan bantuan sosial
                        dan pendidikan.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-primary font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Administrasi KTP -->
                <a href="{{ route('sku.create') }}"
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-id-card text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Usaha</h3>
                    <p class="text-gray-600">
                        Pengajuan surat keterangan usaha untuk keperluan administrasi bisnis dan perizinan usaha.
                    </p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-secondary font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Izin Usaha -->
                <a href="form-domisili.html"
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-home text-accent text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Lainnya</h3>
                    <p class="text-gray-600">Pengurusan surat keterangan untuk berbagai keperluan administrasi.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-accent font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>
            </div>
        </div>
    </section>
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Cara Menggunakan Layanan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Proses mudah dan cepat untuk mengakses layanan kelurahan secara online
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Langkah 1 -->
                <div class="text-center">
                    <div class="bg-primary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">1</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Persiapkan Dokumen</h3>
                    <p class="text-gray-600">Siapkan dokumen yang diperlukan sesuai jenis layanan yang diminta</p>
                </div>

                <!-- Langkah 2 -->
                <div class="text-center">
                    <div class="bg-secondary w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">2</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Isi Formulir Online</h3>
                    <p class="text-gray-600">Lengkapi formulir permohonan melalui website kami secara online</p>
                </div>

                <!-- Langkah 3 -->
                <div class="text-center">
                    <div class="bg-accent w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">3</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Ambil ke Kantor</h3>
                    <p class="text-gray-600">Datang ke kantor kelurahan setelah mendapat notifikasi dokumen siap</p>
                </div>

                <!-- Langkah 4 -->
                <div class="text-center">
                    <div class="bg-green-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">4</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Selesai</h3>
                    <p class="text-gray-600">Dokumen resmi dapat diambil sesuai waktu yang ditentukan</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Persyaratan Umum</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Dokumen yang perlu disiapkan untuk menggunakan layanan kelurahan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Dokumen Identitas</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>KTP Asli & Fotocopy</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Kartu Keluarga</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Akta Kelahiran</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Dokumen Pendukung</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Surat Pengantar RT/RW</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Pas Foto 3x4 (2 lembar)</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Materai 10.000 (jika diperlukan)</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Dokumen Khusus</h3>
                    <ul class="space-y-2">
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Sesuai jenis layanan</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Surat keterangan lainnya</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <i class="fas fa-check text-green-500 mr-2"></i>
                            <span>Dokumen pendukung khusus</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white">
                <h2 class="text-3xl font-bold mb-4">Butuh Bantuan?</h2>
                <p class="text-xl text-gray-100 mb-8">
                    Tim kami siap membantu Anda dengan layanan terbaik
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="kontak.html"
                        class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                        Hubungi Kami
                    </a>
                    <a href="tel:02112345678"
                        class="border-2 border-white text-white hover:bg-white hover:text-primary px-8 py-3 rounded-lg font-semibold transition-colors">
                        <i class="fas fa-phone mr-2"></i>
                        (021) 1234-5678
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
