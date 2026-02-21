# Sistem Pendataan Kios & Kontrakan

> 🇮🇩 Bahasa Indonesia | 🇬🇧 [English](#english-version)

Aplikasi web berbasis Laravel untuk mengelola data sewa kios dan kontrakan, pembayaran, pengeluaran, dan laporan keuangan.

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=flat&logo=mysql&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green?style=flat)

---

## Fitur

- **Manajemen Unit** — Kelola data kios dan kontrakan beserta harga sewa
- **Manajemen Penyewa** — Data penyewa aktif dan riwayat sewa
- **Kontrak Sewa** — Buat sewa baru dengan pembayaran DP atau langsung lunas, perpanjang sewa, refund booking
- **Pembayaran** — Riwayat seluruh transaksi pembayaran per bulan
- **Pengeluaran** — Catat pengeluaran operasional per kategori
- **Laporan Keuangan** — Rekap pemasukan & pengeluaran bulanan dengan export PDF
- **Responsif** — Tampilan mobile-friendly

## Tech Stack

- **Backend** — Laravel 11, PHP 8.2+
- **Frontend** — Blade, CSS custom, vanilla JavaScript
- **Database** — MySQL 8.0
- **PDF** — barryvdh/laravel-dompdf
- **Server lokal** — Laragon

## Cara Install

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL
- Node.js (opsional, untuk asset)

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/ihsanfadlurrahman/Sistem-Pendataan-Kios-Kontrakan.git
cd Sistem-Pendataan-Kios-Kontrakan
```

**2. Install dependencies**
```bash
composer install
```

**3. Buat file `.env`**
```bash
cp .env.example .env
```

**4. Generate app key**
```bash
php artisan key:generate
```

**5. Konfigurasi database di `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_kamu
DB_USERNAME=root
DB_PASSWORD=
```

**6. Jalankan migration**
```bash
php artisan migrate
```

**7. Jalankan aplikasi**
```bash
php artisan serve
```

Buka browser dan akses `http://localhost:8000`

## Struktur Database

| Tabel | Keterangan |
|---|---|
| `users` | Data akun login |
| `units` | Data kios dan kontrakan |
| `penyewas` | Data penyewa |
| `sewas` | Kontrak sewa |
| `pembayarans` | Riwayat pembayaran |
| `pengeluarans` | Data pengeluaran operasional |

## Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## English Version

A Laravel-based web application to manage kiosk and boarding house rental data, payments, expenses, and financial reports.

## Features

- **Unit Management** — Manage kiosk and boarding house data with rental prices
- **Tenant Management** — Active tenants and rental history
- **Rental Contracts** — Create new rentals with DP or full payment, extend contracts, refund bookings
- **Payments** — Complete payment transaction history filtered by month
- **Expenses** — Record operational expenses by category
- **Financial Reports** — Monthly income & expense summary with PDF export
- **Responsive** — Mobile-friendly interface

## Tech Stack

- **Backend** — Laravel 11, PHP 8.2+
- **Frontend** — Blade, custom CSS, vanilla JavaScript
- **Database** — MySQL 8.0
- **PDF** — barryvdh/laravel-dompdf
- **Local server** — Laragon

## Installation

### Requirements
- PHP >= 8.2
- Composer
- MySQL
- Node.js (optional, for assets)

### Steps

**1. Clone the repository**
```bash
git clone https://github.com/ihsanfadlurrahman/Sistem-Pendataan-Kios-Kontrakan.git
cd Sistem-Pendataan-Kios-Kontrakan
```

**2. Install dependencies**
```bash
composer install
```

**3. Create `.env` file**
```bash
cp .env.example .env
```

**4. Generate app key**
```bash
php artisan key:generate
```

**5. Configure database in `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=root
DB_PASSWORD=
```

**6. Run migrations**
```bash
php artisan migrate
```

**7. Start the application**
```bash
php artisan serve
```

Open your browser and go to `http://localhost:8000`

## Database Structure

| Table | Description |
|---|---|
| `users` | Login account data |
| `units` | Kiosk and boarding house data |
| `penyewas` | Tenant data |
| `sewas` | Rental contracts |
| `pembayarans` | Payment history |
| `pengeluarans` | Operational expense data |

## License

This project is licensed under the [MIT License](LICENSE).
