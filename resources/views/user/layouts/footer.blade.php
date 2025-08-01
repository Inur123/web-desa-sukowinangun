<footer class="bg-gray-800 text-white py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center mb-4">
                    <img class="h-10 w-10 mr-3" src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa" />
                    <h3 class="text-xl font-bold">Kelurahan Sukowinangun</h3>
                </div>
                <p class="text-gray-300 mb-4">
                    Kelurahan yang berkembang dengan semangat gotong royong dan teknologi modern untuk pelayanan
                    terbaik.
                </p>
                <div class="flex space-x-4">
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="/" class="text-gray-300 hover:text-white transition-colors">
                        <i class="fab fa-youtube text-xl"></i>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Menu Utama</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}"
                            class="text-gray-300 hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="{{ route('profile.index') }}"
                            class="text-gray-300 hover:text-white transition-colors">Profil Kelurahan</a></li>
                    <li><a href="" class="text-gray-300 hover:text-white transition-colors">Layanan</a></li>
                    <li><a href="{{ route('berita.index') }}"
                            class="text-gray-300 hover:text-white transition-colors">Berita</a></li>
                    <li><a href="" class="text-gray-300 hover:text-white transition-colors">Kontak</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Layanan</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('sktm.create') }}"
                            class="text-gray-300 hover:text-white transition-colors">Surat Keterangan Tidak Mampu</a>
                    </li>
                    <li><a href="{{ route('sku.create') }}"
                            class="text-gray-300 hover:text-white transition-colors">Surat Izin Usaha</a></li>
                    <li><a href="{{ route('skck.create') }}"
                            class="text-gray-300 hover:text-white transition-colors">Surat Keterangan Catatan
                            Kepolisian</a></li>
                    <li><a href="{{ route('kematian.create') }}"
                            class="text-gray-300 hover:text-white transition-colors">Surat Keterangan Kematian</a></li>
                    <li><a href="{{ route('domisili.create') }}"
                            class="text-gray-300 hover:text-white transition-colors">Surat Keterangan Domisili</a></li>

                </ul>
            </div>
            <div>
                <h4 class="text-lg font-semibold mb-4">Kontak Info</h4>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-3 text-primary"></i>
                        <span class="text-gray-300 text-sm">Jl. Kunti No. 3</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone mr-3 text-primary"></i>
                        <span class="text-gray-300 text-sm">(021) 1234-5678</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-primary"></i>
                        <span class="text-gray-300 text-sm">info@sukowinangun.id</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-700 mt-8 pt-8 text-center">
            <p class="text-gray-300">
                &copy; {{ date('Y') }} Kelurahan Sukowinangun | Developed by
                <a href="https://www.instagram.com/inurzainur87/" target="_blank" class="text-gray-300">
                    Zainur
                </a>
            </p>
        </div>
    </div>
</footer>
