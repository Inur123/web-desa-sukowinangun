@extends('user.layouts.app')
@section('title', 'Kontak - Sukowinangun')

@section('content')
    <section class="pt-16 bg-gradient-to-r from-primary to-secondary"data-aos="fade-down" data-aos-duration="800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Hubungi Kami</h1>
                <p class="text-xl text-gray-100 max-w-3xl mx-auto">
                    Kami siap melayani dan membantu kebutuhan administrasi serta pertanyaan Anda
                </p>
            </div>
        </div>
    </section>
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                <div class="text-center">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Alamat</h3>
                    <p class="text-gray-600">
                        Jl. Raya Desa No. 123<br>
                        Desa Maju Sejahtera<br>
                        Kecamatan Sejahtera, 12345
                    </p>
                </div>

                <div class="text-center">
                    <div class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Telepon</h3>
                    <p class="text-gray-600">
                        (021) 1234-5678<br>
                        (021) 8765-4321<br>
                        <span class="text-sm text-gray-500">Senin - Jumat: 08:00-16:00</span>
                    </p>
                </div>

                <div class="text-center">
                    <div class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-accent text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Email</h3>
                    <p class="text-gray-600">
                        info@desamajusejahtera.id<br>
                        admin@desamajusejahtera.id<br>
                        <span class="text-sm text-gray-500">Respon dalam 24 jam</span>
                    </p>
                </div>

                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-green-600 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Jam Pelayanan</h3>
                    <p class="text-gray-600">
                        Senin - Jumat: 08:00 - 16:00<br>
                        Sabtu: 08:00 - 12:00<br>
                        <span class="text-red-500">Minggu: Tutup</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h2>
                    <form class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Depan</label>
                                <input type="text" id="firstName" name="firstName" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                            <div>
                                <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Nama
                                    Belakang</label>
                                <input type="text" id="lastName" name="lastName" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                            </div>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                            <input type="tel" id="phone" name="phone"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                            <select id="subject" name="subject" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent">
                                <option value="">Pilih Subjek</option>
                                <option value="layanan">Pertanyaan Layanan</option>
                                <option value="administrasi">Administrasi</option>
                                <option value="pengaduan">Pengaduan</option>
                                <option value="saran">Saran & Kritik</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                            <textarea id="message" name="message" rows="5" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-primary hover:bg-secondary text-white py-3 px-6 rounded-lg font-semibold transition-colors">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Map -->
                <div class="bg-white p-8 rounded-xl shadow-lg">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Lokasi Kami</h2>
                    <div class="mb-6 rounded-lg overflow-hidden h-64">
    <iframe
        class="w-full h-full border-0"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15817.524687629319!2d111.32475269786742!3d-7.642094877980936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799234fbd3c4f5%3A0x77c7c6105bafc5af!2sKantor%20Kelurahan%20Sukowinangun!5e0!3m2!1sid!2sid!4v1752052198496!5m2!1sid!2sid"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>


                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-directions text-primary text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Petunjuk Arah</h4>
                                <p class="text-gray-600 text-sm">
                                    Dari pusat kota, ambil jalan raya menuju arah timur sekitar 15 km.
                                    Kantor desa berada di sebelah kiri jalan, berseberangan dengan pasar tradisional.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-car text-primary text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Transportasi</h4>
                                <p class="text-gray-600 text-sm">
                                    Tersedia angkutan umum rute kota-desa setiap 30 menit.
                                    Area parkir tersedia di depan kantor desa.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <i class="fas fa-landmark text-primary text-xl mt-1 mr-4"></i>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Patokan</h4>
                                <p class="text-gray-600 text-sm">
                                    Dekat dengan Masjid Al-Ikhlas, SD Negeri 1 Maju Sejahtera,
                                    dan Puskesmas Desa.
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
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Jam Pelayanan</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Jadwal lengkap pelayanan administrasi dan layanan publik desa
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-xl text-center">
                    <div class="bg-primary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-calendar-week text-primary text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Hari Kerja</h3>
                    <div class="space-y-2">
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

                <div class="bg-gray-50 p-6 rounded-xl text-center">
                    <div class="bg-secondary/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone-alt text-secondary text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Layanan Telepon</h3>
                    <div class="space-y-2">
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

                <div class="bg-gray-50 p-6 rounded-xl text-center">
                    <div class="bg-accent/10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-accent text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Respon Email</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Hari Kerja</span>
                            <span class="font-semibold text-gray-800">{'< 24 Jam'}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Akhir Pekan</span>
                            <span class="font-semibold text-gray-800">{'< 48 Jam'}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Darurat</span>
                            <span class="font-semibold text-green-600">{'< 6 Jam'}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
