# E-Learning Bootcamp System

## Deskripsi
Sistem E-Learning Bootcamp berbasis web menggunakan CodeIgniter 3.
Mendukung 2 role: Admin dan User (Peserta).

## Instalasi

### 1. Download CodeIgniter 3
Download CodeIgniter 3.1.13 dari https://codeigniter.com/download
Ekstrak folder `system` ke dalam direktori proyek ini.

### 2. Setup Database
1. Buat database di MySQL
2. Import file `database/elearning_bootcamp.sql`
3. Konfigurasi koneksi di `application/config/database.php`

### 3. Konfigurasi
1. Edit `application/config/config.php`
   - Set `base_url` sesuai URL proyek Anda
2. Edit `application/config/database.php`
   - Set hostname, username, password, database

### 4. Folder Permissions
Pastikan folder berikut memiliki write permission:
- `uploads/tugas/`

## Login Default

### Admin
- Email: admin@bootcamp.com
- Password: password

### User
- Email: john@email.com
- Password: password

## Struktur Folder
```
e-learning/
├── application/
│   ├── config/
│   ├── controllers/
│   ├── models/
│   ├── views/
│   ├── helpers/
│   └── libraries/
├── system/          (CodeIgniter Core - download terpisah)
├── uploads/
│   └── tugas/
├── database/
│   └── elearning_bootcamp.sql
└── index.php
```

## Fitur
1. Login & Logout (Session-based)
2. CRUD Master Data (Admin)
3. Pendaftaran Bootcamp (User)
4. Absensi (Admin)
5. Upload Tugas (User)
6. Penilaian (Admin)
7. Export Report (Excel)

## Alur Sistem
1. Admin login → Kelola data master
2. User login → Daftar ke batch bootcamp
3. Admin → Catat absensi peserta
4. Admin → Buat tugas untuk batch
5. User → Upload tugas
6. Admin → Beri nilai tugas
7. Admin → Lihat laporan

## Tech Stack
- PHP 7.x
- CodeIgniter 3.1.x
- MySQL 5.7+
- Bootstrap 5
- jQuery

## Author
E-Learning Bootcamp System - Academic Project
