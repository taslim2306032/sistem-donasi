# Sistem Donasi Digital (DonasiKu)
**Disusun Oleh :**
- Taslim Nuralim : 2306032
- M Anwar Sanusi : 2306016
  
**Nama Proyek:** Sistem Donasi Berbasis Web  
**Framework:** Laravel 11  
**Frontend:** Blade Templates + Tailwind CSS  

Dokumentasi ini disusun untuk kebutuhan presentasi teknis, mencakup penjelasan arsitektur sistem, alur kerja, teknologi yang digunakan, serta panduan instalasi.

---

## 1. Deskripsi Sistem
Aplikasi ini adalah platform *crowdfunding* sederhana yang memungkinkan:
1.  **User (Donatur)** untuk melihat kampanye donasi, melakukan donasi, mengunggah bukti transfer, dan melihat riwayat donasi mereka.
2.  **Admin** untuk mengelola kampanye donasi, memverifikasi bukti pembayaran user, mengelola akun user, dan melihat statistik donasi.

Tujuan utama sistem ini adalah transparansi dan kemudahan dalam penggalangan dana digital.

---

## 2. Teknologi yang Digunakan (Tech Stack)

Sistem ini dibangun di atas pondasi teknologi modern:

-   **Backend**: [Laravel 11](https://laravel.com)
    -   Framework PHP yang kuat, aman, dan skalabel.
    -   Menggunakan fitur *MVC (Model-View-Controller)* untuk memisahkan logika bisnis, antarmuka, dan data.
    -   *Eloquent ORM* untuk interaksi database yang efisien.
-   **Frontend**: [Blade Templates](https://laravel.com/docs/blade) & [Tailwind CSS](https://tailwindcss.com)
    -   Desain antarmuka (UI/UX) yang responsif dan modern.
    -   Blade memungkinkan rendering data dinamis dari backend.
-   **Database**: MySQL
    -   Penyimpanan data relasional untuk User, Donasi, dan Riwayat Transaksi.
-   **Authentication**: Laravel Breeze
    -   Sistem login, register, dan manajemen sesi yang aman.

---

## 3. Fitur Utama

### A. Administrator (Admin)
Admin memiliki hak akses penuh terhadap sistem:
1.  **Dashboard Statistik**: Melihat total donasi terkumpul, jumlah user, dan grafik transaksi terbaru.
2.  **Manajemen Kampanye (CRUD)**:
    -   Membuat kampanye donasi baru (Judul, Deskripsi, Target, Gambar).
    -   Mengedit atau menghapus kampanye yang sudah ada.
3.  **Verifikasi Pembayaran (PENTING)**:
    -   Administrator bertugas memeriksa bukti transfer yang diunggah user.
    -   Aksi: **Approve** (Dana masuk, status *Verified*) atau **Reject** (Status *Rejected*).
4.  **Manajemen User**: Melihat daftar user terdaftar.
5.  **Manajemen Rekening**: Menambah/menghapus rekening bank tujuan transfer.

### B. User (Donatur)
User adalah pengguna umum yang ingin berdonasi:
1.  **Registrasi & Login**: Membuat akun personal.
2.  **Jelajah Donasi**: Melihat daftar donasi aktif.
3.  **Melakukan Donasi**:
    -   Memilih kampanye -> Input Nominal -> Upload Bukti Transfer.
    -   Status awal donasi adalah **"Pending"** (Menunggu verifikasi admin).
4.  **Riwayat Donasi**: Memantau status donasi mereka (apakah sudah diterima/ditolak).

---

## 4. Alur Kerja Sistem (System Flow)

Berikut adalah alur data dari user melakukan donasi hingga validasi:

1.  **User Berdonasi**: User memilih kampanye, mengisi form, dan upload bukti bayar.
    -   *Database*: Entry baru di tabel `donation_histories` dengan status `pending`.
2.  **Proses Verifikasi**: Admin menerima notifikasi/melihat di menu "Pending Payments".
3.  **Keputusan Admin**:
    -   **Jika Diterima**: Admin klik "Approve". Status berubah jadi `verified`. Total uang di kampanye donasi (`donasi_terkumpul`) bertambah otomatis.
    -   **Jika Ditolak**: Admin klik "Reject". Status berubah jadi `rejected`. Uang tidak bertambah.
4.  **Selesai**: User melihat status terbaru di dashboard mereka.


---

## 5. Akun Demo

Gunakan akun ini untuk pengujian/presentasi:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Administrator** | `admin@gmail.com` | `password` |
| **User (Donatur)** | `user@gmail.com` | `12345678` |

---
## Link vercel
*https://sistem-donasi.vercel.app/*
