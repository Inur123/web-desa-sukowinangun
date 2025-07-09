@extends('user.layouts.app')
@section('title', 'Profile - Sukowinangun')

@section('content')
    <!-- Page Header -->
    <section class="pt-16 bg-gradient-to-r from-primary to-secondary" data-aos="fade-down" data-aos-duration="800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Profil Kelurahan</h1>
                <p class="text-xl text-gray-100 max-w-3xl mx-auto">
                    Mengenal lebih dekat sejarah, visi misi, dan struktur organisasi kelurahan Sukowinangun
                </p>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="zoom-in-right" data-aos-delay="100">
                    <img src="{{ asset('images/kelurahan.jpeg') }}" alt="Kantor kelurahan" class="rounded-lg shadow-lg">
                </div>
                <div data-aos="fade-left" data-aos-delay="200">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Tentang kelurahan Sukowinangun</h2>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        kelurahan Sukowinangun adalah sebuah kelurahan yang terletak di kawasan strategis dengan akses yang
                        mudah ke berbagai fasilitas umum. kelurahan ini dikenal dengan keramahan penduduknya dan semangat
                        gotong royong yang tinggi.
                    </p>
                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Dengan luas wilayah 1,247 hektar dan jumlah penduduk 2,547 jiwa, kelurahan ini terus berkembang
                        menjadi kelurahan yang modern namun tetap mempertahankan nilai-nilai tradisional dan kearifan lokal.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-primary text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Lokasi</h4>
                                <p class="text-gray-600 text-sm">Kecamatan Magetan, Kabupaten Magetan, Provinsi Jawa Timur
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-calendar text-primary text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Didirikan</h4>
                                <p class="text-gray-600 text-sm">15 Agustus 1945</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-expand-arrows-alt text-primary text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Luas Wilayah</h4>
                                <p class="text-gray-600 text-sm">1,247 Hektar</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-users text-primary text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Jumlah Penduduk</h4>
                                <p class="text-gray-600 text-sm">2,547 Jiwa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision Mission -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up" data-aos-delay="100">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Visi & Misi</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Komitmen kami untuk membangun kelurahan yang maju, sejahtera, dan berkelanjutan
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <div class="bg-white p-8 rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-eye text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Visi</h3>
                    <p class="text-gray-600 leading-relaxed text-lg">
                        "Mewujudkan kelurahan Sukowinangun sebagai kelurahan yang mandiri, modern, dan berkelanjutan dengan
                        tetap menjaga nilai-nilai gotong royong dan kearifan lokal untuk kesejahteraan seluruh warga."
                    </p>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg"data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-bullseye text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Misi</h3>
                    <ul class="space-y-3 text-gray-600">
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mt-1 mr-3"></i>
                            <span>Meningkatkan kualitas pelayanan publik yang efektif dan efisien</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mt-1 mr-3"></i>
                            <span>Mengembangkan potensi ekonomi kelurahan berbasis kearifan lokal</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mt-1 mr-3"></i>
                            <span>Membangun infrastruktur yang mendukung kemajuan kelurahan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mt-1 mr-3"></i>
                            <span>Melestarikan budaya dan tradisi kelurahan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mt-1 mr-3"></i>
                            <span>Meningkatkan partisipasi masyarakat dalam pembangunan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Organization Structure -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Struktur Organisasi</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Pemerintahan kelurahan yang solid dan berpengalaman untuk melayani masyarakat
                </p>
            </div>

            <!-- Kepala kelurahan -->
            <div class="text-center mb-12"data-aos="zoom-in" data-aos-delay="100">
                <div class="bg-white p-8 rounded-xl shadow-lg inline-block">
                    <img src="{{ asset('images/lurah.jpeg') }}" alt="Kepala kelurahan"
                        class="w-50 h-full rounded-md mx-auto mb-4 ">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Agus Dwi Aryanto, S.Sos</h3>
                    <p class="text-primary font-semibold mb-2">Kepala kelurahan</p>
                    <p class="text-gray-600 text-sm">Periode 2023-Sekarang</p>
                </div>
            </div>

            <!-- Perangkat kelurahan -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-lg text-center" data-aos="zoom-in" data-aos-delay=100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Sekretaris kelurahan"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Ibu Siti Aminah, S.AP</h4>
                    <p class="text-secondary font-semibold mb-1">Sekretaris kelurahan</p>
                    <p class="text-gray-600 text-sm">Administrasi & Keuangan</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg text-center" data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Kaur Keuangan"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Bapak Ahmad Wijaya</h4>
                    <p class="text-secondary font-semibold mb-1">Kaur Keuangan</p>
                    <p class="text-gray-600 text-sm">Pengelolaan Keuangan kelurahan</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Kaur Umum"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Ibu Ratna Sari</h4>
                    <p class="text-secondary font-semibold mb-1">Kaur Umum</p>
                    <p class="text-gray-600 text-sm">Administrasi Umum</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Kasi Pemerintahan"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Bapak Bambang Sutrisno</h4>
                    <p class="text-secondary font-semibold mb-1">Kasi Pemerintahan</p>
                    <p class="text-gray-600 text-sm">Tata Pemerintahan</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Kasi Kesejahteraan"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Ibu Dewi Lestari</h4>
                    <p class="text-secondary font-semibold mb-1">Kasi Kesejahteraan</p>
                    <p class="text-gray-600 text-sm">Kesejahteraan Masyarakat</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Kasi Pelayanan"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Bapak Eko Prasetyo</h4>
                    <p class="text-secondary font-semibold mb-1">Kasi Pelayanan</p>
                    <p class="text-gray-600 text-sm">Pelayanan Masyarakat</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Geography -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16"data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Geografis kelurahan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kondisi geografis dan demografis kelurahan Sukowinangun
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="bg-white p-8 rounded-xl shadow-lg"data-aos="fade-right" data-aos-delay="200">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Batas Wilayah</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="font-semibold text-gray-700">Utara</span>
                            <span class="text-gray-600">kelurahan Sejahtera Utara</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="font-semibold text-gray-700">Selatan</span>
                            <span class="text-gray-600">kelurahan Sejahtera Selatan</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="font-semibold text-gray-700">Timur</span>
                            <span class="text-gray-600">Kecamatan Maju</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="font-semibold text-gray-700">Barat</span>
                            <span class="text-gray-600">Sungai Jernih</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-xl shadow-lg"data-aos="fade-left" data-aos-delay="400">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Data Demografis</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="font-semibold text-gray-700">Laki-laki</span>
                            <span class="text-gray-600">1,289 jiwa</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="font-semibold text-gray-700">Perempuan</span>
                            <span class="text-gray-600">1,258 jiwa</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-200">
                            <span class="font-semibold text-gray-700">Kepala Keluarga</span>
                            <span class="text-gray-600">847 KK</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="font-semibold text-gray-700">Kepadatan</span>
                            <span class="text-gray-600">2.04 jiwa/Ha</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Maps Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12"data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Lokasi Kantor</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Lokasi kantor kelurahan sukowinangun pada peta interaktif Google Maps.
                </p>
            </div>

            <div class="rounded-xl overflow-hidden shadow-lg"data-aos="zoom-in" data-aos-delay="200">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15817.524687629319!2d111.32475269786742!3d-7.642094877980936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799234fbd3c4f5%3A0x77c7c6105bafc5af!2sKantor%20Kelurahan%20Sukowinangun!5e0!3m2!1sid!2sid!4v1752052198496!5m2!1sid!2sid"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="w-full h-[450px]">
                </iframe>
            </div>
        </div>
    </section>

@endsection
