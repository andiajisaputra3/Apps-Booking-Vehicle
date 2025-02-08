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

## 🧑‍💼 Role & Akses
| Role        | Deskripsi Akses |
|------------|----------------|
| **Superadmin** | Memiliki akses penuh ke seluruh fitur. |
| **Admin** | Bertugas membuat pemesanan kendaraan. |
| **Manager** | Bertugas melakukan **Approval Level 1**. |
| **Supervisor** | Bertugas melakukan **Approval Level 2**. |

## 🔑 Akun Default
| Role        | Email                     | Password  |
|------------|---------------------------|-----------|
| Superadmin | `superadmin@gmail.com`     | `password`  |
| Admin      | `admin@gmail.com`          | `password`  |
| Manager    | `manager@gmail.com`        | `password`  |
| Supervisor | `supervisor@gmail.com`     | `password`  |

## 🛠 Instalasi dan Konfigurasi
### 1️⃣ **Clone Repository**
```bash
git clone https://github.com/andiajisaputra3/Apps-Booking-Vehicle.git
cd repo
```
### 2️⃣ **Install Dependency**
```bash
composer install
npm install && npm run dev
```
### 3️⃣ **Konfigurasi Environment**
```bash
cp .env.example .env
php artisan key:generate
```
### 4️⃣ **Migrasi dan Seeder**
```bash
php artisan migrate --seed
```
### 5️⃣ **Jalankan Aplikasi**
```bash
php artisan serve
```
