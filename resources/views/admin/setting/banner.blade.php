@extends('admin.layouts.app')
@section('title', 'Pengaturan Popup Banner')

@section('content')
    <!-- Notification Popups -->
    @if (session('success'))
        <div class="fixed top-4 right-4 z-50 notification-popup">
            <div class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center animate-fade-in-down">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
                <button onclick="closeNotification(this)" class="ml-4">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="fixed top-4 right-4 z-50 notification-popup">
            <div class="bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg animate-fade-in-down">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span>Terjadi kesalahan!</span>
                    <button onclick="closeNotification(this)" class="ml-4">
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
    <div class="grid grid-cols-1 gap-4 md:gap-6 mb-6 md:mb-8">
        <!-- Header -->
        <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-gray-200">
            <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Pengaturan Sistem</h1>
            <p class="text-sm text-gray-600 mt-1">Kelola pengaturan popup banner</p>
        </div>

        <!-- Settings Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 md:p-6 border-b border-gray-200">
                <h2 class="text-base md:text-lg font-semibold text-gray-800">Pengaturan Popup Banner</h2>
            </div>

            <form method="POST" action="{{ route('admin.setting.banner.update') }}" class="p-4 md:p-6" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Banner Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                        Judul Banner
                    </label>
                    <input type="text" id="title" name="title"
                        value="{{ old('title', $banner->title) }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm"
                        placeholder="Masukkan judul banner">
                    <p class="mt-1 text-xs text-gray-500">
                        Judul yang akan ditampilkan pada popup banner
                    </p>
                </div>

                <!-- Banner Image -->
                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">
                        Gambar Banner
                    </label>
                    <div class="flex items-center space-x-4">
                        @if($banner->image)
                            <div class="w-32 h-32 rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ asset('storage/' . $banner->image) }}" alt="Current Banner" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" id="image" name="image" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm">
                            <p class="mt-1 text-xs text-gray-500">
                                Unggah gambar baru untuk mengganti banner (Rekomendasi: 800x600 px)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Active Status Toggle -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status Banner</label>
                    <div class="flex items-center">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-primary rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                            <span class="ml-3 text-sm font-medium text-gray-700">
                                {{ old('is_active', $banner->is_active) ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </label>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Aktifkan untuk menampilkan popup banner kepada pengunjung
                    </p>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors text-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi untuk menutup notifikasi
        function closeNotification(button) {
            const notification = button.closest('.notification-popup');
            if (notification) {
                notification.remove();
            }
        }

        // Set timeout untuk menghilangkan notifikasi setelah 3 detik
        document.addEventListener('DOMContentLoaded', function() {
            const notifications = document.querySelectorAll('.notification-popup');

            notifications.forEach(notification => {
                setTimeout(() => {
                    notification.style.transition = 'opacity 0.5s ease-out';
                    notification.style.opacity = '0';

                    // Hapus elemen setelah animasi selesai
                    setTimeout(() => {
                        notification.remove();
                    }, 500);
                }, 2000);
            });

            // Update teks toggle saat status berubah
            const toggleSwitch = document.querySelector('input[name="is_active"]');
            if (toggleSwitch) {
                toggleSwitch.addEventListener('change', function() {
                    const statusText = this.nextElementSibling.nextElementSibling;
                    statusText.textContent = this.checked ? 'Aktif' : 'Nonaktif';
                });
            }
        });
    </script>
@endsection
