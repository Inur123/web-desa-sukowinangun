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
                <!-- SKTM -->
                <a href=""
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-file-alt text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Tidak Mampu (SKTM)</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan tidak mampu untuk berbagai keperluan bantuan sosial
                        dan pendidikan.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-primary font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Surat Keterangan Belum Menikah -->
                <a href=""
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-user text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Belum Menikah</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan status belum menikah untuk berbagai keperluan administrasi.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-secondary font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Surat Pengantar SKCK -->
                <a href=""
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-file-signature text-accent text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Pengantar SKCK</h3>
                    <p class="text-gray-600">Pengajuan surat pengantar untuk membuat Surat Keterangan Catatan Kepolisian.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-accent font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Surat Keterangan Domisili -->
                <a href=""
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-home text-blue-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Domisili</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan domisili untuk keperluan administrasi.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-blue-500 font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Surat Keterangan Harga Tanah -->
                <a href=""
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-landmark text-green-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Harga Tanah</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan nilai tanah untuk keperluan administrasi properti.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-green-500 font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Surat Keterangan Usaha -->
                <a href="{{ route('sku.create') }}"
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-yellow-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-business-time text-yellow-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Usaha</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan usaha untuk keperluan administrasi bisnis dan perizinan.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-yellow-500 font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Surat Keterangan Kehilangan -->
                <a href=""
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-search text-red-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Kehilangan</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan kehilangan untuk keperluan administrasi pengaduan.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-red-500 font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Surat Keterangan Kelahiran -->
                <a href=""
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-pink-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-baby text-pink-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Kelahiran</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan kelahiran untuk keperluan administrasi kependudukan.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-pink-500 font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Surat Keterangan Kematian -->
                <a href=""
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-gray-200 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-praying-hands text-gray-700 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Kematian</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan kematian untuk keperluan administrasi kependudukan.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-gray-700 font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Surat Keterangan Penghasilan -->
                <a href=""
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-money-bill-wave text-purple-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Penghasilan</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan penghasilan untuk berbagai keperluan administrasi.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-purple-500 font-semibold">Ajukan Sekarang →</span>
                    </div>
                </a>

                <!-- Surat Keterangan Lainnya -->
                <a href=""
                    class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border border-gray-100">
                    <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-file text-indigo-500 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Surat Keterangan Lainnya</h3>
                    <p class="text-gray-600">Pengajuan surat keterangan untuk keperluan lain yang tidak termasuk dalam kategori.</p>
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <span class="text-indigo-500 font-semibold">Ajukan Sekarang →</span>
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
                            <span>Pas Foto 3x4 (2 lembar)(jika diperlukan)</span>
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
