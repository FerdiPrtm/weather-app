# Weather Dashboard

Aplikasi web dashboard cuaca real-time yang menampilkan informasi cuaca saat ini dari kota mana saja di dunia. Dibangun dengan Laravel 12 dan Tailwind CSS 4, menggunakan desain glassmorphism modern dengan dukungan dark mode.

## Fitur

- **Pencarian Cuaca** - Cari cuaca saat ini untuk kota mana saja di seluruh dunia
- **Tampilan Cuaca** - Suhu, kecepatan angin, arah angin, dan koordinat lokasi
- **Kondisi Cuaca** - Cerah, Berawan, Hujan, dan Bersalju dengan ikon SVG
- **Dark Mode** - Toggle manual dengan persistensi localStorage
- **Riwayat Pencarian** - Menyimpan 5 kota terakhir yang dicari
- **Default Kota** - Menampilkan cuaca Pekanbaru saat pertama kali dibuka
- **Desain Responsif** - Mobile-first dengan glassmorphism UI
- **Bahasa Indonesia** - Seluruh antarmuka dalam Bahasa Indonesia

## Tech Stack

| Komponen | Teknologi | Versi |
|---|---|---|
| Backend | Laravel | 12.x |
| PHP | PHP | >= 8.2 |
| Frontend CSS | Tailwind CSS | 4.x |
| Build Tool | Vite | 7.x |
| Database | MySQL | (via Laragon) |

## Prerequisites

Pastikan komputer kamu sudah terinstal:

- **PHP** >= 8.2
- **Composer** (https://getcomposer.org)
- **Node.js** >= 18.x dan npm
- **MySQL** atau gunakan **Laragon** (https://laragon.org) yang sudah include PHP, MySQL, dan Node.js

## Installation

### 1. Clone Repository

```bash
git clone https://github.com/FerdiPrtm/weather-app.git
cd weather-app
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
```

Buka file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=weather-app
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Jalankan Migrasi Database

Buat database terlebih dahulu di MySQL (atau Laragon), lalu jalankan:

```bash
php artisan migrate
```

### 6. Build Frontend Assets

```bash
npm run build
```

## Menjalankan Aplikasi

### Cara Cepat (Recommended)

Jalankan semua layanan sekaligus (server, queue, logs, dan vite dev):

```bash
composer dev
```

### Manual

Buka 2 terminal terpisah:

**Terminal 1** - Laravel Server:
```bash
php artisan serve
```

**Terminal 2** - Vite Dev Server:
```bash
npm run dev
```

Buka browser dan akses: **http://localhost:8000**

## API yang Digunakan

Aplikasi ini menggunakan **Open-Meteo API** yang bersifat gratis dan tidak memerlukan API key.

| Endpoint | Fungsi |
|---|---|
| Geocoding API | Mengubah nama kota menjadi koordinat latitude/longitude |
| Forecast API | Mengambil data cuaca saat ini berdasarkan koordinat |

## License

MIT License
