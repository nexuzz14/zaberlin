# Zaberlin TV

Zaberlin TV adalah platform streaming video edukasi dan podcast terbaik di Indonesia. Platform ini dirancang dengan gaya modern (terinspirasi dari Netflix dan UI modern) dengan tema warna *dark navy*, merah, dan biru cerah.

## 🚀 Fitur Utama

- **Hero Banner (Netflix-Style):** Menampilkan video terpopuler secara dinamis di halaman depan dengan latar belakang blur.
- **Kategori Dropdown:** Navigasi mudah ke kategori utama seperti Podcast dan Edukasi.
- **Video Carousel:** Menampilkan video dengan desain horizontal (*landscape*) yang responsif.
- **Halaman Nonton yang Bersih:** Player video *full-width* dengan fokus penuh pada konten (tanpa sidebar), dilengkapi dengan kontrol modern.
- **Penghitung Tayangan Real-time:** Setiap kunjungan ke halaman video otomatis menambah jumlah *views*.
- **Upload Video:** Dukungan untuk dua jenis video:
  - Video *embed* dari YouTube.
  - Upload file video (HTML5 player khusus).

## 🛠 Teknologi yang Digunakan

- **Backend:** Laravel 11/13, PHP 8.3
- **Database:** MySQL
- **Frontend:** Blade Templating Engine, Tailwind CSS (Vite)
- **Desain UI/UX:** Glassmorphism, Gradien Zaberlin (Merah - Biru - Navy)

## 📦 Instalasi & Pengaturan Lokal

1. **Clone repositori ini:**
   ```bash
   git clone https://github.com/nexuzz14/zaberlin.git
   cd zaberlin
   ```

2. **Instal dependensi PHP & Node.js:**
   ```bash
   composer install
   npm install
   ```

3. **Pengaturan Environment:**
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Atur koneksi database di file `.env` Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key:**
   ```bash
   php artisan key:generate
   ```

5. **Migrasi Database & Seeder:**
   Jalankan perintah ini untuk membuat tabel dan mengisi data awal (dummy):
   ```bash
   php artisan migrate --seed
   ```

6. **Tautkan Storage:**
   Karena platform mendukung upload file video dan thumbnail, jalankan:
   ```bash
   php artisan storage:link
   ```

7. **Jalankan Aplikasi:**
   Buka 2 terminal. Di terminal pertama jalankan server Laravel:
   ```bash
   php artisan serve
   ```
   Di terminal kedua jalankan Vite (untuk compile Tailwind):
   ```bash
   npm run dev
   ```
   Buka `http://localhost:8000` di browser Anda.

## 🎨 Palet Warna

- **Navy:** `#06065D` (Warna utama / latar belakang)
- **Navy Dark:** `#040440` (Dropdown & Overlay)
- **Biru (Blue Zaberlin):** `#0E49B5` (Aksen & Badge Edukasi)
- **Light Blue:** `#A2DAE0` (Aksen teks/hover)
- **Merah (Red Zaberlin):** `#ED0101` (Aksen & Badge Podcast)

---
*Dibuat untuk memberikan pengalaman belajar dan mendengarkan podcast yang menyenangkan.*
