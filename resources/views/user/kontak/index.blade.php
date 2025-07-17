@extends('user.layouts.app')

@section('title', 'Kontak - Sukowinangun')

@section('content')

    <section class="pt-16 bg-gradient-to-r from-primary to-secondary" data-aos="fade-down" data-aos-duration="800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4" data-aos="fade-up" data-aos-delay="100">Hubungi Kami</h1>
                <p class="text-xl text-gray-100 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    Kami siap melayani dan membantu kebutuhan administrasi serta pertanyaan Anda
                </p>
            </div>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-map-marker-alt text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Alamat</h3>
                    <p class="text-gray-600">
                        Jl. Raya Kelurahan No. 123<br>
                        Kelurahan Sukowinangun<br>
                        Kecamatan Sejahtera, 12345
                    </p>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-phone text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Telepon</h3>
                    <p class="text-gray-600">
                        (021) 1234-5678<br>
                        (021) 8765-4321<br>
                        <span class="text-sm text-gray-500">Senin - Jumat: 08:00-16:00</span>
                    </p>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-envelope text-accent text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Email</h3>
                    <p class="text-gray-600">
                        info@sukowinangun.id<br>
                        admin@sukowinangun.id<br>
                        <span class="text-sm text-gray-500">Respon dalam 24 jam</span>
                    </p>
                </div>

                <div class="text-center" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-clock text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Jam Pelayanan</h3>
                    <p class="text-gray-600">
                        Senin - Jumat: 08:00 - 16:00<br>
                        Sabtu: 08:00 - 12:00<br>
                        <span class="text-red-500 text-sm">Minggu: Tutup</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-8 sm:py-12 md:py-16 lg:py-20 bg-gray-50" data-aos="fade-up" data-aos-duration="800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="text-center mb-8 sm:mb-10 md:mb-12">
                <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-2">Kelurahan Sukowinangun</h1>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold text-primary mb-4">Hubungi Kami</h2>
                <p class="text-gray-600 max-w-2xl mx-auto text-sm sm:text-base md:text-lg">
                    Kami siap melayani dan membantu kebutuhan administrasi serta pertanyaan Anda.
                </p>
            </div>

            <!-- Grid Layout -->
            <div class="grid grid-cols-1 gap-6 sm:gap-8 lg:grid-cols-2">
                <!-- Form Section -->
                <div class="bg-white p-5 sm:p-6 md:p-8 rounded-xl shadow-md hover:shadow-lg transition-all">
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 mb-4 sm:mb-6">Formulir Kontak</h3>
                    <form class="space-y-4 sm:space-y-5 md:space-y-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5">
                            <div>
                                <label for="nama" class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Nama
                                    Lengkap</label>
                                <input type="text" id="nama" name="nama" required
                                    class="w-full px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <div>
                                <label for="telepon" class="block text-sm sm:text-base font-medium text-gray-700 mb-1">No.
                                    Telepon</label>
                                <input type="tel" id="telepon" name="telepon"
                                    class="w-full px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Alamat
                                Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="kebutuhan" class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Jenis
                                Kebutuhan</label>
                            <select id="kebutuhan" name="kebutuhan" required
                                class="w-full px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Pilih kebutuhan Anda</option>
                                <option value="administrasi">Pelayanan Administrasi</option>
                                <option value="pengaduan">Pengaduan Masyarakat</option>
                                <option value="informasi">Permintaan Informasi</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label for="pesan" class="block text-sm sm:text-base font-medium text-gray-700 mb-1">Pesan
                                Anda</label>
                            <textarea id="pesan" name="pesan" rows="4"
                                class="w-full px-4 py-2 text-sm sm:text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary hover:bg-primary-dark text-white py-3 px-6 rounded-lg font-semibold text-sm sm:text-base transition-colors shadow-md hover:shadow-lg">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Contact Info Section -->
                <div class="bg-white p-5 sm:p-6 md:p-8 rounded-xl shadow-md hover:shadow-lg transition-all">
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 mb-4 sm:mb-6">Informasi Kontak</h3>

                    <!-- Map Section -->
                    <div class="mb-6 sm:mb-8 rounded-lg overflow-hidden shadow-sm">
                        <iframe class="w-full h-48 sm:h-56 md:h-64 border-0"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15817.524687629319!2d111.32475269786742!3d-7.642094877980936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799234fbd3c4f5%3A0x77c7c6105bafc5af!2sKantor%20Kelurahan%20Sukowinangun!5e0!3m2!1sid!2sid!4v1752052198496!5m2!1sid!2sid"
                            allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <!-- Contact Details -->
                    <div class="space-y-4 sm:space-y-5">
                        <div class="flex items-start gap-3 sm:gap-4">
                            <div class="bg-primary/10 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-primary"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Alamat Kantor</h4>
                                <p class="text-gray-600 text-sm sm:text-base">
                                    Jl. Raya Sukowinangun No. 123<br>
                                    Kec. Magetan, Kabupaten Magetan<br>
                                    Jawa Timur 63314
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 sm:gap-4">
                            <div class="bg-primary/10 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-primary"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Telepon</h4>
                                <p class="text-gray-600 text-sm sm:text-base">
                                    (0351) 1234567<br>
                                    +62 812-3456-7890 (WhatsApp)
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 sm:gap-4">
                            <div class="bg-primary/10 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-primary"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Email</h4>
                                <p class="text-gray-600 text-sm sm:text-base">
                                    kelurahan.sukowinangun@magetan.go.id<br>
                                    info.sukowinangun@gmail.com
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 sm:gap-4">
                            <div class="bg-primary/10 p-2 rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-primary"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 text-sm sm:text-base">Jam Pelayanan</h4>
                                <p class="text-gray-600 text-sm sm:text-base">
                                    Senin - Kamis: 07.30 - 14.30 WIB<br>
                                    Jumat: 07.00 - 11.00 WIB<br>
                                    Sabtu - Minggu: Tutup
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Jam Pelayanan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Jadwal lengkap pelayanan administrasi dan layanan publik Kelurahan
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-xl text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-week text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Hari Kerja</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Senin - Jumat</span>
                            <span class="font-semibold text-gray-800">08:00 - 16:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sabtu</span>
                            <span class="font-semibold text-gray-800">08:00 - 12:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Minggu</span>
                            <span class="font-semibold text-red-500">Tutup</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl text-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-phone-alt text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Layanan Telepon</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Senin - Jumat</span>
                            <span class="font-semibold text-gray-800">08:00 - 17:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Sabtu</span>
                            <span class="font-semibold text-gray-800">08:00 - 14:00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Darurat</span>
                            <span class="font-semibold text-green-600">24 Jam</span>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-xl text-center" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-envelope text-accent text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Respon Email</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Hari Kerja</span>
                            <span class="font-semibold text-gray-800">
                                < 24 Jam</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Akhir Pekan</span>
                            <span class="font-semibold text-gray-800">
                                < 48 Jam</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Darurat</span>
                            <span class="font-semibold text-green-600">
                                < 6 Jam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-primary" data-aos="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center text-white">
                <h2 class="text-4xl font-bold mb-4">Butuh Bantuan?</h2>
                <p class="text-xl text-gray-100 mb-8">
                    HaloSuko siap membantu Anda dengan layanan terbaik
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('kontak.index') }}"
                        class="bg-white text-primary px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors"
                        data-aos="fade-up" data-aos-delay="100">
                        Hubungi Kami
                    </a>
                    <a href="tel:02112345678"
                        class="border-2 border-white text-white hover:bg-white hover:text-primary px-8 py-3 rounded-lg font-semibold transition-colors"
                        data-aos="fade-up" data-aos-delay="200">
                        <i class="fas fa-phone mr-2"></i>
                        (021) 1234-5678
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection
