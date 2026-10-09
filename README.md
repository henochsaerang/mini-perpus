<div align="center">

  # 📚 Mini-Perpus
  **Sistem Manajemen & Inventaris Perpustakaan Berbasis Web**

  [![Laravel](https://img.shields.io/badge/Laravel-v12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![PHP](https://img.shields.io/badge/PHP-v8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
  [![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-v3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
  [![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

</div>

---

## 👨‍🎓 Identitas Mahasiswa

- **Nama:** Henoch Abraham Saerang
- **NIM:** 23210035
- **Mata Kuliah:** Pemrograman Framework
- **Program Studi:** S1 Teknik Informatika
- **Instansi:** Universitas Negeri Manado

---

## 🚀 Tentang Proyek

**Mini-Perpus** adalah aplikasi web inventaris perpustakaan yang dibangun menggunakan framework **Laravel** dengan pola arsitektur **MVC (Model-View-Controller)**. Proyek ini dikembangkan untuk memenuhi penilaian Ujian Tengah Semester (UTS) Pemrograman Framework.

Sistem ini mendukung pengolahan data koleksi buku dan kategorisasinya dengan menerapkan relasi database *One-to-Many* serta prinsip validasi data *server-side*.

---

## ✨ Fitur Utama

- **Manajemen Kategori Buku (CRUD):**
  - Menambah, melihat, memperbarui, dan menghapus kategori.
  - Proteksi penghapusan kategori yang masih memiliki relasi ke data buku.
  - Penghitungan jumlah buku terintegrasi per kategori.

- **Manajemen Katalog Buku (CRUD):**
  - Menambah buku baru dengan pemilihan kategori dinamis melalui **Custom Searchable Dropdown**.
  - Menampilkan daftar buku lengkap dengan nama kategori dalam bentuk teks.
  - Fitur edit dan hapus data buku.
  - Indikator status stok buku (Tersedia, Terbatas, Habis).

- **Antarmuka Modern & Responsif:**
  - Desain *Enterprise Dashboard* menggunakan **Tailwind CSS**.
  - Elemen interaktif dipandu **FontAwesome Icons** & JavaScript Native.
  - *Feedback alert* interaktif untuk penanganan notifikasi sukses/gagal.

---

## 🛠️ Stack Teknologi

- **Backend:** PHP 8.2, Laravel 12
- **Database:** MySQL / SQLite (Eloquent ORM)
- **Frontend:** Blade Templating Engine, Tailwind CSS (CDN)
- **Interaktivitas:** Vanilla JavaScript, FontAwesome 6

---

## ⚙️ Panduan Instalasi Lokal

Jika Anda ingin menjalankan proyek ini di lingkungan lokal, ikuti langkah-langkah berikut:

1. **Clone Repositori:**
   git clone [https://github.com/henochsaerang/mini-perpus.git](https://github.com/henochsaerang/mini-perpus.git)
   cd mini-perpus

2. **Install Depedensi Composer:**
   composer install

3. **Konfigurasi Environment:**
   Salin file `.env.example` menjadi `.env`:
   cp .env.example .env

   Generate application key:
   php artisan key:generate

4. **Konfigurasi Database & Migrasi:**
   Sesuaikan pengaturan database pada file `.env`, lalu jalankan migrasi:
   php artisan migrate

5. **Jalankan Server Lokal:**
   php artisan serve

   Aplikasi dapat diakses melalui browser di `[http://127.0.0.1:8000](http://127.0.0.1:8000)`.

---

<div align="center">
  <p>Dikembangkan untuk Evaluasi UTS Pemrograman Framework — UNIMA</p>
</div>