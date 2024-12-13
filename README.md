# Poliklinik 

Proyek ini adalah sistem manajemen poliklinik yang dirancang untuk mengelola data pasien, dokter, dan administrasi lainnya. Sistem ini dibuat menggunakan Laravel untuk backend dan Blade untuk frontend.

---

## Fitur Utama
- **Manajemen Data Pasien**: CRUD untuk data pasien.
- **Manajemen Data Dokter**: CRUD untuk data dokter dan jadwal praktek.
- **Autentikasi**: Sistem login dengan peran (admin, dokter, pasien).
- **Dashboard Dinamis**: Statistik dan informasi terkait poliklinik.

---

## Persyaratan Sistem
Sebelum menjalankan proyek ini, pastikan komputer Anda memiliki:
- PHP versi 8.0 atau lebih tinggi
- Composer
- MySQL atau MariaDB
- Node.js dan npm
- Git

---

## Cara Mengkloning dan Menjalankan Proyek

Ikuti langkah-langkah berikut untuk mengkloning dan menjalankan proyek ini di komputer Anda:

### 1. Kloning Repository
Buka terminal dan jalankan perintah berikut:
```bash
git clone https://github.com/rahmanditya/Poliklinik
```

Ganti `username` dengan nama pengguna GitHub Anda.

### 2. Masuk ke Direktori Proyek
```bash
cd Poliklinik
```

### 3. Instal Dependensi
Jalankan perintah berikut untuk menginstal dependensi PHP menggunakan Composer:
```bash
composer install
```

### 4. Atur File Konfigurasi `.env`
Salin file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

Kemudian edit file `.env` untuk mengatur konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=poliklinik
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate App Key
Jalankan perintah berikut untuk membuat *application key*:
```bash
php artisan key:generate
```

### 6. Buat Tabel Session (WAJIB)
Perintah session:table menghasilkan skema yang diperlukan untuk mengelola sesi 
jika Anda menggunakan database sebagai pengendali sesi. 
Ini ideal untuk aplikasi yang memerlukan penyimpanan sesi persisten atau ingin berbagi sesi di beberapa server.
```bash
php artisan session:table
```

### 7. Migrasi dan Seed Database
Migrasikan tabel dan isi data awal:
```bash
php artisan migrate:fresh
```
Seed tabel poli jika ingin praktis:
```bash
php artisan db:seed PoliSeeder
```

### 8. Jalankan Server Backend secara Lokal
Jalankan server Laravel menggunakan perintah:
```bash
php artisan serve
```

Akses aplikasi di browser melalui alamat: [http://localhost:8000] / (http://127.0.0.1:8000)

---

## Skrip Tambahan (WAJIB)

### Menginstal Dependensi Frontend
Proyek ini menggunakan file frontend (CSS/JavaScript), jadi wajib install dependensi dengan npm:
```bash
npm install
```

Untuk meng-*build* file frontend:
```bash
npm run dev
```

### BUILD BACKEND DAN FRONTEND DENGAN CARA MEMBUKA 2 TERMINAL, JALANKAN KEDUA BASH BERIKUT SECARA BERSAMAAN

```bash
npm run dev
php artisan serve
```

---

## Kontribusi
Kami menerima kontribusi untuk pengembangan proyek ini. Silakan buat *pull request* atau ajukan *issue* jika Anda menemukan bug atau memiliki ide untuk fitur baru.

---


Terima kasih telah menggunakan sistem manajemen poliklinik ini!
