<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Kelurahan Sukowinangun</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" href="{{ asset('images/logo-desa.png') }}" type="image/png">
    @stack('styles')
    <style>
        .rotate-180 {
            transform: rotate(180deg);
        }
        .dropdown-menu {
            transition: all 0.3s ease;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                top: 0;
                bottom: 0;
                z-index: 50;
                transition: left 0.3s ease;
            }
            .sidebar.active {
                left: 0;
            }
            .overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,0.5);
                z-index: 40;
                display: none;
            }
            .overlay.active {
                display: block;
            }
            .mobile-menu-btn {
                display: block;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Mobile Menu Button -->
    <button class="mobile-menu-btn fixed top-4 left-4 z-30 bg-white p-2 rounded-lg shadow-md md:hidden">
        <i class="fas fa-bars text-xl text-gray-700"></i>
    </button>

    <!-- Overlay for mobile sidebar -->
    <div class="overlay"></div>

    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @include('admin.layouts.header')

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.querySelector('.overlay');

        mobileMenuBtn.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Dropdown functionality
        function toggleDropdown(button) {
            const dropdown = button.parentElement.querySelector('.dropdown-menu');
            const icon = button.querySelector('.dropdown-icon');

            // Toggle dropdown visibility
            dropdown.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');

            // Close other open dropdowns
            document.querySelectorAll('.dropdown-container').forEach(item => {
                if (item !== button.parentElement) {
                    item.querySelector('.dropdown-menu').classList.add('hidden');
                    item.querySelector('.dropdown-icon').classList.remove('rotate-180');
                }
            });
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown-container')) {
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    menu.classList.add('hidden');
                });
                document.querySelectorAll('.dropdown-icon').forEach(icon => {
                    icon.classList.remove('rotate-180');
                });
            }
        });

        // Keep dropdown open if currently on a submenu page
        document.addEventListener('DOMContentLoaded', function() {
            if (window.location.pathname.includes('layanan')) {
                const dropdown = document.querySelector('.dropdown-menu');
                const icon = document.querySelector('.dropdown-icon');
                if (dropdown) dropdown.classList.remove('hidden');
                if (icon) icon.classList.add('rotate-180');
            }

            // Set current date
            const currentDate = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            document.getElementById('currentDate').textContent = currentDate.toLocaleDateString('id-ID', options);
        });

        // Auto refresh stats (simulation)
        setInterval(() => {
            const statsElements = document.querySelectorAll('.text-3xl.font-bold');
            statsElements.forEach(element => {
                if (element.textContent.includes(',')) {
                    const currentValue = parseInt(element.textContent.replace(',', ''));
                    const newValue = currentValue + Math.floor(Math.random() * 3);
                    element.textContent = newValue.toLocaleString();
                }
            });
        }, 30000);
    </script>
</body>
</html>
