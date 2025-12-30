# Sistem Donasi

Aplikasi manajemen donasi berbasis web yang dibangun menggunakan **Laravel** dan **Vite**.

## Persyaratan Sistem

Pastikan komputer Anda sudah terinstall:
- **PHP** (versi 8.2 atau lebih baru)
- **Composer**
- **Node.js** & **NPM**

## Cara Install (Setup Awal)

Ikuti langkah-langkah ini untuk menjalankan proyek di komputer Anda:

1.  **Clone Repository**
    ```bash
    git clone https://github.com/taslim2306032/sistem-donasi.git
    cd sistem-donasi
    ```

2.  **Install Dependencies**
    Install library PHP dan JavaScript yang dibutuhkan:
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment (.env)**
    Duplikat file contoh konfigurasi:
    ```bash
    cp .env.example .env
    ```

4.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5.  **Setup Database**
    Jalankan migrasi database dan isi dengan data awal (seeding):
    ```bash
    php artisan migrate:fresh --seed
    ```

## Cara Menjalankan Aplikasi

Untuk membuka aplikasi, Anda perlu menjalankan dua server sekaligus di terminal yang berbeda.

1.  **Terminal 1 (Backend Laravel)**
    ```bash
    php artisan serve
    ```

2.  **Terminal 2 (Frontend Vite)**
    ```bash
    npm run dev
    ```

3.  **Buka Browser**
    Akses aplikasi di: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Akun Default (Login)

Gunakan akun berikut untuk masuk ke aplikasi:

**Administrator:**
- **Email:** `admin@gmail.com`
- **Password:** `password`

**User (Donatur):**
- **Email:** `user@gmail.com`
- **Password:** `password`
