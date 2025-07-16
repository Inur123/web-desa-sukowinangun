@extends('user.layouts.app')
@section('title', '404 - Sukowinangun')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 text-center" data-aos="zoom-in">
            <div>
                <h1 class="text-7xl font-bold text-primary mb-4">404</h1>
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Halaman Tidak Ditemukan
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Maaf, halaman yang Anda cari tidak dapat ditemukan. Mungkin sudah dihapus atau dipindahkan.
                </p>
            </div>
            <div class="mt-8">
                <a href="{{ url('/') }}"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-primary hover:bg-secondary focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">

                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </section>
@endsection
