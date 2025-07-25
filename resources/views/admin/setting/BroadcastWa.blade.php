@extends('admin.layouts.app')
@section('title', 'Pengaturan Notifikasi WhatsApp')

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
            <p class="text-sm text-gray-600 mt-1">Kelola pengaturan dasar sistem</p>
        </div>

        <!-- Settings Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 md:p-6 border-b border-gray-200">
                <h2 class="text-base md:text-lg font-semibold text-gray-800">Pengaturan Notifikasi</h2>
            </div>

            <form method="POST" action="{{ route('admin.setting.BroadcastWa.update') }}" class="p-4 md:p-6">
                @csrf
                @method('PUT')
                <!-- WhatsApp Admin -->
                <div class="mb-4">
                    <label for="admin_whatsapp_number" class="block text-sm font-medium text-gray-700 mb-1">
                        Nomor WhatsApp Admin
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-phone text-gray-400"></i>
                        </div>
                        <input type="text" id="admin_whatsapp_number" name="admin_whatsapp_number"
                            value="{{ old('admin_whatsapp_number', $settings['admin_whatsapp_number']) }}"
                            class="pl-10 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm"
                            placeholder="6281234567890">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Nomor yang akan menerima notifikasi pengajuan baru (<span class="font-bold">masukkan nomer hp dengan
                            contoh 6281234567890</span>)
                    </p>
                </div>

                <!-- FONNTE API Token -->
                <div class="mb-4">
                    <label for="fonnte_api_token" class="block text-sm font-medium text-gray-700 mb-1">
                        FONNTE API Token
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input type="password" id="fonnte_api_token" name="fonnte_api_token"
                            value="{{ old('fonnte_api_token', $settings['fonnte_api_token']) }}"
                            class="pl-10 pr-10 w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary focus:border-transparent text-sm"
                            placeholder="Masukkan token API">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" onclick="togglePasswordVisibility('fonnte_api_token')"
                                class="text-gray-500 hover:text-gray-700 focus:outline-none">
                                <i class="fas fa-eye" id="eye-icon-fonnte_api_token"></i>
                            </button>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Token untuk mengakses API WhatsApp FONNTE
                    </p>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-3 mt-6">
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors text-sm">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-dark transition-colors text-sm">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePasswordVisibility(fieldId) {
            const field = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(`eye-icon-${fieldId}`);

            if (field.type === 'password') {
                field.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }

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
        });
    </script>
@endsection
