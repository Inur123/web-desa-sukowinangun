@extends('user.layouts.app')
@section('title', 'Profile - Sukowinangun')
@section('content')
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
                        Dengan luas wilayah ± 153 hektar dan jumlah penduduk 2,547 jiwa, kelurahan ini terus berkembang
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
                                <p class="text-gray-600 text-sm">Tahun 1984</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-expand-arrows-alt text-primary text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Luas Wilayah</h4>
                                <p class="text-gray-600 text-sm">± 153 Hektar</p>
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
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Sejarah Kelurahan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Mengenal asal-usul dan perkembangan Kelurahan Sukowinangun dari masa ke masa
                </p>
            </div>

            <div class="bg-white p-6 md:p-8 lg:p-10 rounded-xl shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="prose max-w-none text-gray-600">
                    <h3 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Asal Usul Kelurahan Sukowinangun</h3>
                    <p class="mb-6 leading-relaxed">
                        Kantor Kelurahan letaknya sangat strategis berada di timur persimpangan jalan antara Jalan Yos
                        Sudarso/Mayjend Sungkono dan Jalan MT Haryono/Jalan Kunti. <br>Kelurahan Sukowinangun berasal dari 2
                        (dua) Desa dan 1 (satu) wilayah yaitu:
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-bold text-gray-800 mb-2">Desa Bangun</h4>
                            <p class="text-sm text-gray-600">Terdiri dari 2 dukuhan: Dukuh Bangun dan Malangi. Dipimpin oleh
                                Kepala Desa bernama Karyodimejo.</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-bold text-gray-800 mb-2">Desa Clelek</h4>
                            <p class="text-sm text-gray-600">Terdiri dari 2 dukuhan: Dukuh Bantengan dan Sobontoro (Betoro).
                                Dipimpin oleh Kepala Desa bernama Hirodikromo.</p>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h4 class="font-bold text-gray-800 mb-2">Banjarmlati</h4>
                            <p class="text-sm text-gray-600">Sebelumnya merupakan bagian dari Kelurahan Kebonagung.</p>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Legenda Wilayah</h3>
                    <div class="space-y-8">
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Dukuh Mlangi</h4>
                            <p class="leading-relaxed">
                                Sekitar tahun 1860 ada seorang pendatang bernama Malangi (Kyai Malangi) yang datang untuk
                                menyiarkan agama Islam. Kedatangannya disambut gembira oleh penduduk setempat. Warga
                                membantu mendirikan langgar sebagai tempat mengaji. Kyai Malangi dimakamkan di dukuh Mlangi
                                dan namanya diabadikan sebagai nama dukuhan.
                            </p>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Dukuh Clelek</h4>
                            <p class="leading-relaxed">
                                Konon ada seorang yang datang dengan rasa ketakutan karena menjadi buronan pemerintah
                                kerajaan. Orang tersebut mondar-mandir (clela-clele/berpura-pura gila) untuk mengelabuhi
                                tentara kerajaan. Wilayah ini kemudian disebut Clelek. Pada tahun 1964 nama diubah menjadi
                                Bangunsari yang berarti suka membangun.
                            </p>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Dukuh Bantengan</h4>
                            <p class="leading-relaxed">
                                Sekitar tahun 1855 ada sapi hutan (banteng) yang mengamuk dan memporak-porandakan wilayah
                                ini. Seorang dengan aji pangluluh mampu menjinakkan banteng ini dan menyatakan bahwa jika
                                wilayah ini ramai kelak, namanya harus Bantengan.
                            </p>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Dukuh Sobontoro</h4>
                            <p class="leading-relaxed">
                                Pada tahun 1855 datang Kyai Sobontoro untuk menyebarkan agama Islam. Kedatangannya disambut
                                gembira warga dan wilayah ini menjadi pusat penyebaran agama Islam, sehingga dinamakan
                                Sobontoro.
                            </p>
                        </div>
                        <div>
                            <h4 class="text-xl font-semibold text-gray-800 mb-2">Dukuh Banjarmlati</h4>
                            <p class="leading-relaxed">
                                Sekitar tahun 1860-an wilayah ini didatangi kerabat keraton Surakarta yang ahli di bidang
                                pertanian. Beliau selalu membawa keris yang memiliki daya magis kuat. Setelah meninggal
                                dimakamkan di Banjarmlati dan dijuluki Kyai Selurung, yang sekarang menjadi punden warga
                                setempat.
                            </p>
                        </div>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-800 mt-8 mb-4">Pembentukan Kelurahan Sukowinangun</h3>
                    <p class="mb-4 leading-relaxed">
                        Pada tahun 1901 atas kesepakatan bersama dari 2 desa tersebut ditambah wilayah Mbanjarmlati
                        bergabung menjadi 1 menjadi Desa Sukowinangun yang saat itu dipimpin oleh Kepala Desa bernama Bpk
                        Munodho.
                    </p>
                    <p class="leading-relaxed">
                        Selanjutnya pada Tahun 1984, Desa Sukowinangun berubah status menjadi Kelurahan Sukowinangun
                        berdasarkan keputusan pemerintah.
                    </p>
                </div>
            </div>
        </div>
    </section>
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
                        "Mewujudkan Pekayanan Terbaik Kepada Masyarakat Kelurahan Sukowinangun dan Peningkatan Manajemen
                        Pelayanan Prima dan Pembangunan Partisipatif."
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
                            <span>Meningkatkan Kapabilitas dan Kompetensi Aparatur</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mt-1 mr-3"></i>
                            <span>Memberikan Pelayanan Prima Kepada Masyarakat</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mt-1 mr-3"></i>
                            <span>Penguatan Kelembagaan Organisasi Kemasyarakatan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-primary mt-1 mr-3"></i>
                            <span>Meningkatkan Peran Serta Masyarakat Dalam Pembangunan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
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
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Bambang Hernawan HP SE</h4>
                    <p class="text-secondary font-semibold mb-1">Sekretaris kelurahan</p>

                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg text-center" data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Kasi Pemberdayaan Masyarakat"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Yulia Rohma Budiani SE</h4>
                    <p class="text-secondary font-semibold mb-1">Kasi pemberdayaan Masyarakat</p>
                    <p class="text-gray-600 text-sm"></p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Kasi Pemerintahan Keamanan dan Ketertiban"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Bayu Dwi Irawan S.Sos</h4>
                    <p class="text-secondary font-semibold mb-1">Kasi Pemerintahan Keamanan dan Ketertiban</p>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Pengadministrasi Perkantoran"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Muhammad Lathifatul Aziz</h4>
                    <p class="text-secondary font-semibold mb-1">Pengadministrasi Perkantoran</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Pengadministrasi Perkantoran"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Beby Anobaya Putri Modra</h4>
                    <p class="text-secondary font-semibold mb-1">Pengadministrasi Perkantoran</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Pengadministrasi Perkantoran"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Nur Amin</h4>
                    <p class="text-secondary font-semibold mb-1">Pengadministrasi Perkantoran</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Pengadministrasi Perkantoran"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Jumiran</h4>
                    <p class="text-secondary font-semibold mb-1">Pengadministrasi Perkantoran</p>
                </div>
                <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Tenaga Keamanan"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Bambang Tri Kurniawa</h4>
                    <p class="text-secondary font-semibold mb-1">Tenaga Keamanan</p>
                </div>
                 <div class="bg-white p-6 rounded-xl shadow-lg text-center"data-aos="zoom-in" data-aos-delay="100">
                    <img src="/placeholder.svg?height=120&width=120" alt="Tenaga Kebersihan"
                        class="w-24 h-24 rounded-full mx-auto mb-4 object-cover">
                    <h4 class="text-lg font-bold text-gray-800 mb-2">Suwarno</h4>
                    <p class="text-secondary font-semibold mb-1">Tenaga Kebersihan</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-8 sm:py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8 md:mb-12">
                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-800 mb-2">Kelurahan Sukowinangun</h1>
                <h2 class="text-xl sm:text-2xl lg:text-3xl font-semibold text-gray-700 mb-3">Geografis Kelurahan</h2>
                <p class="text-base sm:text-lg text-gray-600 max-w-3xl mx-auto">Kondisi geografis dan demografis Kelurahan
                    Sukowinangun</p>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-10 lg:gap-12">
                <div class="bg-white p-6 md:p-8 lg:p-10 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6 pb-2 border-b-2 border-gray-200">Batas
                        Wilayah</h3>
                    <div class="space-y-4 md:space-y-5">
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <span class="col-span-1 font-semibold text-gray-700 text-sm md:text-base">Utara</span>
                            <span class="col-span-2 text-gray-600 text-sm md:text-base">Desa Milangasri</span>
                        </div>
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <span class="col-span-1 font-semibold text-gray-700 text-sm md:text-base">Selatan</span>
                            <span class="col-span-2 text-gray-600 text-sm md:text-base">Kelurahan Kebonagung</span>
                        </div>
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <span class="col-span-1 font-semibold text-gray-700 text-sm md:text-base">Timur</span>
                            <span class="col-span-2 text-gray-600 text-sm md:text-base">Desa Baron dan Purwosari</span>
                        </div>
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <span class="col-span-1 font-semibold text-gray-700 text-sm md:text-base">Barat</span>
                            <span class="col-span-2 text-gray-600 text-sm md:text-base">Kelurahan Kepolorejo</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-6 md:p-8 lg:p-10 rounded-xl shadow-md hover:shadow-lg transition-all duration-300">
                    <h3 class="text-xl sm:text-2xl font-bold text-gray-800 mb-6 pb-2 border-b-2 border-gray-200">Data
                        Demografis</h3>
                    <div class="space-y-4 md:space-y-5">
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <span class="col-span-1 font-semibold text-gray-700 text-sm md:text-base">Laki-laki</span>
                            <span class="col-span-2 text-gray-600 text-sm md:text-base">1,289 jiwa</span>
                        </div>
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <span class="col-span-1 font-semibold text-gray-700 text-sm md:text-base">Perempuan</span>
                            <span class="col-span-2 text-gray-600 text-sm md:text-base">1,258 jiwa</span>
                        </div>
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <span class="col-span-1 font-semibold text-gray-700 text-sm md:text-base">Kepala
                                Keluarga</span>
                            <span class="col-span-2 text-gray-600 text-sm md:text-base">847 KK</span>
                        </div>
                        <div class="grid grid-cols-3 gap-4 items-center">
                            <span class="col-span-1 font-semibold text-gray-700 text-sm md:text-base">Kepadatan</span>
                            <span class="col-span-2 text-gray-600 text-sm md:text-base">2.04 jiwa/Ha</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12"data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Lokasi Kantor</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Lokasi kantor kelurahan sukowinangun pada peta interaktif Google Maps.
                </p>
            </div>

            <div class="rounded-xl overflow-hidden shadow-lg"data-aos="zoom-in" data-aos-delay="200"
                alt="Google Maps kelurahan">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15817.524687629319!2d111.32475269786742!3d-7.642094877980936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799234fbd3c4f5%3A0x77c7c6105bafc5af!2sKantor%20Kelurahan%20Sukowinangun!5e0!3m2!1sid!2sid!4v1752052198496!5m2!1sid!2sid"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" class="w-full h-[450px]">
                </iframe>
            </div>
        </div>
    </section>
@endsection
