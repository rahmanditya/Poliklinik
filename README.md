# Poliklinik Management System

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
git clone https://github.com/username/poliklinik.git
```

Ganti `username` dengan nama pengguna GitHub Anda.

### 2. Masuk ke Direktori Proyek
```bash
cd poliklinik
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
DB_DATABASE=nama_database
DB_USERNAME=user_database
DB_PASSWORD=password_database
```

### 5. Generate App Key
Jalankan perintah berikut untuk membuat *application key*:
```bash
php artisan key:generate
```

### 6. Migrasi dan Seed Database
Migrasikan tabel dan isi data awal:
```bash
php artisan migrate --seed
```

### 7. Jalankan Server Lokal
Jalankan server Laravel menggunakan perintah:
```bash
php artisan serve
```

Akses aplikasi di browser melalui alamat: [http://localhost:8000](http://localhost:8000)

---

## Skrip Tambahan

### Menginstal Dependensi Frontend
Jika proyek ini menggunakan file frontend (CSS/JavaScript), instal dependensi dengan npm:
```bash
npm install
```

Untuk meng-*build* file frontend:
```bash
npm run dev
```

---

## Kontribusi
Kami menerima kontribusi untuk pengembangan proyek ini. Silakan buat *pull request* atau ajukan *issue* jika Anda menemukan bug atau memiliki ide untuk fitur baru.

---

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

## Kontak
Jika Anda memiliki pertanyaan atau butuh bantuan, silakan hubungi:
- Email: emailanda@example.com
- GitHub: [username](https://github.com/username)

---

Terima kasih telah menggunakan sistem manajemen poliklinik ini!
