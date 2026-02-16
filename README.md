<h1 align="center">🏢 Property Management System</h1>
<h3 align="center">Sistem Pendataan Kios & Kontrakan</h3>

🚀 Web-Based Rental & Financial Management System

⚙️ Built with Laravel 10

📊 Status: Still Developed

<p align="center"> <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="250"> </p>

📌 Overview
Property Management System adalah aplikasi web berbasis Laravel yang dirancang untuk membantu pengelolaan:
- 🏬 Kios
- 🏠 Kontrakan
- 👤 Penyewa
- 📄 Sewa
- 💰 Pembayaran
- 📉 Pengeluaran
- 📊 Laporan Keuangan

Sistem ini dibuat untuk kebutuhan manajemen properti skala kecil–menengah dan dirancang dengan validasi logika bisnis yang realistis.

🔐 Authentication
- Secure login system
- Middleware-based route protection

🏠 Unit Management
- CRUD Unit
- Status otomatis (Kosong / Disewa)
- Validasi 1 unit hanya boleh memiliki 1 sewa aktif
- Tampilan berbasis card
- Icon berdasarkan tipe (Kontrakan / Kios)
- Warna unit berdasarkan kepemilikan (Pink / Biru)

👤 Penyewa Management
- CRUD Penyewa
- 1 Penyewa dapat menyewa lebih dari 1 unit
- Tampilan unit aktif langsung di card penyewa

📄 Sewa Management
- Status otomatis "Aktif" saat create
- Tombol "Selesai" tanpa perlu edit
- Otomatis mengosongkan unit saat sewa selesai
- Validasi bisnis untuk mencegah konflik unit

💰 Pembayaran
- CRUD Pembayaran
- Anti double pembayaran dalam bulan yang sama
- Hanya dapat membayar sewa aktif
- Status otomatis "Lunas"
- Relasi langsung ke penyewa & unit

📉 Pengeluaran
- CRUD Pengeluaran
- Kategori (Listrik, Air, Perbaikan, dll)
- Tracking pengeluaran bulanan
- Timestamps untuk audit trail

📊 Laporan Keuangan

- Filter berdasarkan bulan & tahun  
- Perhitungan:
    - Total pemasukan
    - Total pengeluaran
    - Laba / rugi
- Detail transaksi
- Export laporan ke PDF

<!-- 🧠 Business Logic Implemented

1 Unit = Maksimal 1 Sewa Aktif

1 Penyewa = Bisa memiliki banyak sewa

Unit otomatis kosong saat sewa selesai

Pembayaran tidak boleh duplikat dalam bulan yang sama

Laba bersih dihitung otomatis dari pemasukan - pengeluaran

🛠 Tech Stack

Laravel 10

Blade Template Engine

Eloquent ORM

MySQL

DOMPDF (PDF Export)

RESTful Resource Controller

📂 Main Modules

- Unit
- Penyewa
- Sewa
- Pembayaran
- Pengeluaran
- Laporan

Relasi Database

Penyewa → hasMany → Sewa

Unit → hasMany → Sewa

Sewa → hasMany → Pembayaran

Pembayaran → belongsTo → Sewa

📈 Development Status

🚧 UI Improvements Ongoing
🚧 Feature Enhancement in Progress

Planned Improvements

Dashboard charts

Soft delete implementation

Role & permission system

Excel export

Hosting & deployment

SaaS-style UI enhancement

🎯 Project Purpose

Project ini dibuat untuk:

Membantu manajemen properti keluarga

Mengimplementasikan Laravel dalam skenario real-world

Melatih arsitektur sistem & validasi bisnis

Portfolio backend development -->

<!-- ⚙️ Installation
git clone https://github.com/your-username/your-repo.git
cd your-repo

composer install
cp .env.example .env
php artisan key:generate -->
<!-- 
# Setup database

php artisan migrate

php artisan serve -->

This project is open-sourced for educational and portfolio purposes.
