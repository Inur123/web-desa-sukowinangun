# Website Desa Sukowinangun

Website resmi Desa Sukowinangun yang dibangun dengan framework Laravel untuk menyediakan layanan digital kepada masyarakat desa.

<img src="images/web.jpeg" alt="Tampilan Website Desa Sukowinangun" style="max-width:100%; height:auto; border-radius: 10px;" />

## Fitur Utama

Website ini menyediakan berbagai layanan administrasi desa dan informasi untuk masyarakat, meliputi:

### Layanan Administrasi
- **Surat Keterangan Tidak Mampu (SKTM)** - Pelayanan pembuatan surat keterangan tidak mampu
- **Surat Keterangan Usaha (SKU)** - Pelayanan surat keterangan usaha untuk warga
- **Surat Domisili** - Pelayanan surat keterangan domisili
- **Surat Keterangan Belum Menikah** - Layanan surat keterangan status belum menikah
- **Surat Pengantar SKCK** - Pelayanan surat pengantar untuk SKCK
- **Surat Keterangan Penghasilan** - Layanan surat keterangan penghasilan
- **Surat Keterangan Kelahiran** - Pelayanan surat keterangan kelahiran
- **Surat Keterangan Kematian** - Pelayanan surat keterangan kematian
- **Surat Keterangan Kehilangan** - Layanan surat keterangan kehilangan
- **Surat Keterangan Harga Tanah** - Informasi dan surat keterangan harga tanah
- **Surat Keterangan Lainnya** - Pelayanan surat keterangan lainnya atau menyesuaikan kebutuhan warga

### Fitur Lainnya
- **Arsip Surat** - Sistem penyimpanan dan pengelolaan arsip surat
- **Manajemen Berita** - Sistem posting berita dan informasi desa
- **Popup Banner** - Sistem notifikasi dan pengumuman

## Teknologi yang Digunakan

- **Framework**: Laravel 12.0
- **Database**: MySQL
- **Frontend**: Vite 6.2.4 + JavaScript
- **Styling**: TailwindCSS 4.0.0
- **Animation**: AOS (Animate On Scroll) 2.3.4
- **HTTP Client**: Axios 1.8.2
- **Image Processing**: Intervention Image 2.7
- **Server**: Apache/Nginx dengan PHP 8.2+
- **Node.js**: >= 18.0.0

## Persyaratan Sistem

- **PHP**: 8.2 atau lebih tinggi
- **Node.js**: 18.0.0 atau lebih tinggi
- **MySQL**: 5.7 atau lebih tinggi
- **Composer**: 2.0 atau lebih tinggi

## Instalasi

1. Clone repository ini
```bash
git clone [repository-url]
cd web-desa-sukowinangun-kominfo
```

2. Install dependencies PHP
```bash
composer install
```

3. Install dependencies Node.js
```bash
npm install
```

4. Setup environment
```bash
cp .env.example .env
php artisan key:generate
```

5. Konfigurasi database di file `.env`
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=db-desa-sukowinangun
DB_USERNAME=root
DB_PASSWORD=root
```

6. Jalankan migrasi database
```bash
php artisan migrate
```

7. Build assets untuk production
```bash
npm run build
```

8. Atau untuk development
```bash
npm run dev
```

9. Jalankan aplikasi
```bash
php artisan serve
```

## Scripts Development

Proyek ini menggunakan beberapa script untuk development:

```bash
# Menjalankan development server (Laravel + Queue + Logs + Vite)
composer run dev

# Menjalankan Vite development server saja
npm run dev

# Build assets untuk production
npm run build

# Menjalankan tests
composer run test

# Menjalankan Laravel server saja
php artisan serve
```

## Dependencies

### Production Dependencies
- **Laravel Framework**: 12.0 - PHP framework
- **Intervention Image**: 2.7 - Image manipulation library
- **Laravel Tinker**: 2.10.1 - Interactive shell
- **AOS**: 2.3.4 - Library animasi scroll

### Development Dependencies
- **@tailwindcss/vite**: 4.0.0 - TailwindCSS integration untuk Vite
- **axios**: 1.8.2 - HTTP client
- **concurrently**: 9.0.1 - Menjalankan multiple commands
- **laravel-vite-plugin**: 1.2.0 - Laravel integration untuk Vite
- **tailwindcss**: 4.0.0 - Utility-first CSS framework
- **vite**: 6.2.4 - Build tool dan development server
- **FakerPHP**: 1.23 - Data generator untuk testing
- **Laravel Pail**: 1.2.2 - Log viewer
- **Laravel Pint**: 1.13 - Code style fixer
- **PHPUnit**: 11.5.3 - Testing framework

## Development Server

Proyek ini memiliki custom script `composer run dev` yang menjalankan:
- **Laravel Server** - `php artisan serve`
- **Queue Worker** - `php artisan queue:listen --tries=1`
- **Log Viewer** - `php artisan pail --timeout=0`
- **Vite Dev Server** - `npm run dev`

Semua service akan berjalan secara bersamaan dengan warna berbeda untuk memudahkan monitoring.

## Penggunaan

Setelah instalasi selesai, akses aplikasi melalui browser di `http://localhost:8000`. Website menyediakan interface untuk:

- Masyarakat dapat mengajukan berbagai jenis surat online
- Admin desa dapat mengelola permohonan surat
- Publikasi berita dan informasi desa
- Manajemen arsip dokumen desa

## Testing

Untuk menjalankan tests:

```bash
# Menjalankan semua tests
composer run test

# Atau langsung dengan PHPUnit
php artisan test
```

## Kontribusi

Untuk berkontribusi pada pengembangan website ini:

1. Fork repository
2. Buat branch fitur baru (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -am 'Menambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## Lisensi

Proyek ini menggunakan lisensi MIT. Lihat file [LICENSE](https://opensource.org/licenses/MIT) untuk detail lengkap.

---

**Catatan**: Pastikan semua persyaratan sistem terpenuhi sebelum melakukan instalasi. Untuk konfigurasi server production, disarankan menggunakan web server seperti Apache atau Nginx.
