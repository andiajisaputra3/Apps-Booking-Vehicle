# APLIKASI PEMESANAN KENDARAAN

## Deskripsi Aplikasi
Aplikasi berbasis web untuk mengelola pemesanan kendaraan dengan sistem persetujuan berjenjang.

## 🚀 Teknologi yang Digunakan
- **Laravel** - Framework backend utama.
- **Spatie** - Manajemen role dan permission.
- **Flowbite** - Komponen UI berbasis Tailwind.
- **Toastr** - Notifikasi.
- **SweetAlert2** - Konfirmasi dan alert interaktif.
- **Vite** - Build tool frontend.

## 📌 Fitur Utama
- **Master Data** → Mengelola data kendaraan dan driver.
- **Booking** → Admin dapat membuat pemesanan kendaraan.
- **Riwayat Pemesanan** → Menampilkan histori pemesanan.
- **Report** → Laporan pemakaian kendaraan.
- **Driver & Vehicle** → Manajemen data driver dan kendaraan.
- **Approval** → Persetujuan pemesanan oleh Manager & Supervisor.

## Role & Akses
Superadmin → Memiliki akses penuh ke seluruh fitur.
Admin → Bertugas membuat pemesanan kendaraan.
Manager → Bertugas melakukan Approval Level 1.
Supervisor → Bertugas melakukan Approval Level 2.

## Akun
Email	                Password
superadmin@gmail.com	password
admin@gmail.com	        password
manager@gmail.com	    password
supervisor@gmail.com	password

## 🛠 Instalasi dan Konfigurasi
### 1️⃣ **Clone Repository**
```bash
git clone https://github.com/username/repo.git
cd repo

composer install
npm install && npm run dev

cp .env.example .env
php artisan key:generate

php artisan migrate --seed

php artisan serve
