# 📚 Panduan Presentasi E-Learning Bootcamp

## 🎯 Gambaran Umum Sistem

Sistem E-Learning Bootcamp adalah platform pembelajaran online yang memfasilitasi pengelolaan bootcamp/kursus intensif dengan fitur:
- **Manajemen Peserta & Mentor**
- **Pendaftaran Bootcamp**
- **Absensi Online**
- **Pengumpulan & Penilaian Tugas**
- **Laporan & Export (Excel/PDF)**

---

## 🚀 Alur Presentasi yang Disarankan

### **BAGIAN 1: Pengenalan (2-3 menit)**

#### 1.1 Tampilkan Halaman Login
- **URL:** `http://localhost:8080/login`
- **Jelaskan:** Sistem memiliki 2 role: Admin dan User (Peserta)
- **UI:** Desain modern dengan split-screen, gradient color

#### 1.2 Tampilkan Halaman Register
- **URL:** `http://localhost:8080/auth/register`
- **Jelaskan:** Peserta baru dapat mendaftar akun sendiri
- **Demo:** Daftarkan user baru (contoh: nama, email, no hp, password)

---

### **BAGIAN 2: Demo Sisi Admin (10-15 menit)**

#### 2.1 Login sebagai Admin
```
Email: admin@bootcamp.com
Password: password (atau sesuai setting)
```

#### 2.2 Dashboard Admin
- **URL:** `http://localhost:8080/admin/dashboard`
- **Tunjukkan:** 
  - Statistik total (peserta, mentor, bootcamp, batch)
  - Menu navigasi sidebar
  - Quick actions

#### 2.3 Kelola Data Master

**a) Data Mentor**
- **URL:** `http://localhost:8080/admin/mentor`
- **Demo:** Tambah mentor baru dengan nama dan keahlian
- **Fitur:** CRUD lengkap (Create, Read, Update, Delete)

**b) Data Bootcamp**
- **URL:** `http://localhost:8080/admin/bootcamp`
- **Demo:** Buat bootcamp baru (nama, deskripsi, harga, pilih mentor)
- **Relasi:** Setiap bootcamp memiliki 1 mentor

**c) Data Batch**
- **URL:** `http://localhost:8080/admin/batch`
- **Demo:** Buat batch untuk bootcamp (nama batch, tanggal mulai/selesai)
- **Relasi:** Setiap batch terkait dengan 1 bootcamp

#### 2.4 Kelola Peserta
- **URL:** `http://localhost:8080/admin/peserta`
- **Jelaskan:** Data peserta yang sudah mendaftar akun

#### 2.5 Kelola Pendaftaran
- **URL:** `http://localhost:8080/admin/pendaftaran`
- **Demo:** Lihat data peserta yang mendaftar ke batch tertentu
- **Jelaskan:** Admin bisa melihat siapa saja yang ikut setiap batch

#### 2.6 Kelola Absensi ⭐
- **URL:** `http://localhost:8080/admin/absensi`
- **Fitur Unggulan:**
  - Input absensi per batch dan tanggal
  - Pilih status: Hadir, Izin, Alpha
  - Edit absensi yang sudah ada
  - Lihat riwayat absensi
  - Auto-alpha untuk yang tidak diinput

#### 2.7 Kelola Tugas
- **URL:** `http://localhost:8080/admin/tugas`
- **Demo:** 
  - Buat tugas baru untuk batch (judul, deskripsi, deadline)
  - Lihat pengumpulan tugas dari peserta

#### 2.8 Penilaian Tugas ⭐
- **URL:** `http://localhost:8080/admin/penilaian`
- **Demo:**
  - Lihat daftar tugas yang dikumpulkan
  - Download file tugas (PDF)
  - Input nilai (0-100)

#### 2.9 Laporan & Export ⭐
- **URL:** `http://localhost:8080/admin/report`
- **Demo:**
  1. **Laporan Pendaftaran** - Export ke Excel atau PDF
  2. **Laporan Absensi** - Export ke Excel atau PDF
  3. **Laporan Nilai** - Export ke Excel atau PDF
- **Tunjukkan:** Klik tombol PDF dan tunjukkan print dialog

---

### **BAGIAN 3: Demo Sisi User/Peserta (5-7 menit)**

#### 3.1 Register Akun Baru
- **URL:** `http://localhost:8080/auth/register`
- **Demo:** Buat akun baru (jika belum)

#### 3.2 Login sebagai User
```
Email: john@email.com (atau akun yang baru dibuat)
Password: password
```

#### 3.3 Dashboard Peserta
- **URL:** `http://localhost:8080/user/dashboard`
- **Tunjukkan:**
  - Statistik personal (bootcamp diikuti, tugas, nilai rata-rata)
  - Daftar bootcamp yang diikuti
  - Tugas yang harus dikerjakan

#### 3.4 Daftar ke Bootcamp
- **URL:** `http://localhost:8080/user/bootcamp`
- **Demo:** Pilih bootcamp dan batch yang tersedia

#### 3.5 Lihat Bootcamp Saya
- **URL:** `http://localhost:8080/user/pendaftaran`
- **Tunjukkan:** Status pendaftaran bootcamp

#### 3.6 Lihat Absensi
- **URL:** `http://localhost:8080/user/absensi`
- **Tunjukkan:** Riwayat kehadiran peserta

#### 3.7 Kumpulkan Tugas ⭐
- **URL:** `http://localhost:8080/user/tugas`
- **Demo:**
  - Lihat daftar tugas
  - Upload file PDF sebagai jawaban tugas
  - Lihat status sudah/belum dikumpulkan

#### 3.8 Lihat Nilai
- **URL:** `http://localhost:8080/user/nilai`
- **Tunjukkan:** Nilai tugas yang sudah dinilai admin

---

### **BAGIAN 4: Highlight Teknologi (2-3 menit)**

#### 4.1 Teknologi yang Digunakan
| Komponen | Teknologi |
|----------|-----------|
| Backend | CodeIgniter 3 (PHP) |
| Database | MySQL |
| Frontend | Bootstrap 5, Bootstrap Icons |
| Styling | CSS Custom Properties, Gradient |
| Font | Google Fonts (Inter) |

#### 4.2 Struktur MVC
```
application/
├── controllers/    → Logic aplikasi (Admin.php, Auth.php, User.php)
├── models/         → Akses database (9 model)
├── views/          → Tampilan HTML (admin/, auth/, user/)
├── libraries/      → Library custom (Excel_lib, Pdf_lib)
└── helpers/        → Helper functions
```

#### 4.3 Fitur Keamanan
- Password di-hash dengan `password_hash()` (bcrypt)
- Session-based authentication
- Role-based access control (Admin vs User)
- Form validation
- SQL Injection prevention (Query Builder)

---

## 📋 Checklist Sebelum Presentasi

### Persiapan Database
```sql
-- Pastikan sudah import database
source database/elearning_bootcamp.sql;
```

### Persiapan Data Demo
- [ ] Minimal 2-3 mentor
- [ ] Minimal 2-3 bootcamp
- [ ] Minimal 2-3 batch (dengan tanggal yang berbeda)
- [ ] Minimal 2-3 peserta terdaftar
- [ ] Minimal 1-2 tugas dengan deadline yang masuk akal
- [ ] Minimal 1-2 data absensi
- [ ] Minimal 1-2 pengumpulan tugas (dengan file PDF)

### Akun Demo
| Role | Email | Password |
|------|-------|----------|
| Admin | admin@bootcamp.com | password |
| User | john@email.com | password |

### Jalankan Server
```bash
cd e:\jasa-website\e-learning
php -S localhost:8080
```

---

## 💡 Tips Presentasi

### Do's ✅
1. **Siapkan data dummy** sebelum presentasi agar tidak kosong
2. **Buka semua halaman** di tab berbeda untuk akses cepat
3. **Jelaskan relasi antar tabel** (Mentor→Bootcamp→Batch→Peserta)
4. **Tunjukkan fitur export PDF** - ini fitur yang menarik
5. **Demo upload tugas** dengan file PDF kecil yang sudah disiapkan

### Don'ts ❌
1. Jangan terlalu lama di satu halaman
2. Jangan tunjukkan error/bug jika ada
3. Jangan menjelaskan kode terlalu detail (kecuali diminta)
4. Jangan skip fitur utama (Absensi, Tugas, Penilaian, Export)

---

## 🔗 URL Penting

### Admin Panel
| Halaman | URL |
|---------|-----|
| Dashboard | /admin/dashboard |
| Mentor | /admin/mentor |
| Bootcamp | /admin/bootcamp |
| Batch | /admin/batch |
| Peserta | /admin/peserta |
| Pendaftaran | /admin/pendaftaran |
| Absensi | /admin/absensi |
| Tugas | /admin/tugas |
| Penilaian | /admin/penilaian |
| Laporan | /admin/report |

### User Panel
| Halaman | URL |
|---------|-----|
| Dashboard | /user/dashboard |
| Daftar Bootcamp | /user/bootcamp |
| Bootcamp Saya | /user/pendaftaran |
| Tugas | /user/tugas |
| Absensi | /user/absensi |
| Nilai | /user/nilai |
| Profil | /user/profil |

### Auth
| Halaman | URL |
|---------|-----|
| Login | /login |
| Register | /auth/register |
| Logout | /auth/logout |

---

## 📊 ERD (Entity Relationship Diagram)

```
┌──────────────┐     ┌──────────────┐
│    USERS     │     │   MENTOR     │
├──────────────┤     ├──────────────┤
│ id           │     │ id           │
│ name         │     │ nama         │
│ email        │     │ keahlian     │
│ password     │     └───────┬──────┘
│ role         │             │
└──────┬───────┘             │
       │                     │
       │1                    │1
       │                     │
┌──────▼───────┐     ┌───────▼──────┐
│   PESERTA    │     │   BOOTCAMP   │
├──────────────┤     ├──────────────┤
│ id           │     │ id           │
│ user_id (FK) │     │ nama         │
│ no_hp        │     │ deskripsi    │
└──────┬───────┘     │ harga        │
       │             │ mentor_id(FK)│
       │             └───────┬──────┘
       │                     │
       │N                    │1
       │                     │
┌──────▼───────┐     ┌───────▼──────┐
│ PENDAFTARAN  │◄────┤    BATCH     │
├──────────────┤     ├──────────────┤
│ id           │     │ id           │
│ peserta_id   │     │ bootcamp_id  │
│ batch_id     │     │ nama_batch   │
│ tanggal_daftar     │ tanggal_mulai│
└──────┬───────┘     │ tanggal_selesai
       │             └───────┬──────┘
       │                     │
       │                     │
┌──────▼───────┐     ┌───────▼──────┐
│   ABSENSI    │     │    TUGAS     │
├──────────────┤     ├──────────────┤
│ id           │     │ id           │
│ pendaftaran_id     │ batch_id     │
│ tanggal      │     │ judul        │
│ status_hadir │     │ deskripsi    │
└──────────────┘     │ deadline     │
                     └───────┬──────┘
                             │
                             │
                     ┌───────▼──────┐
                     │PENGUMPULAN_  │
                     │    TUGAS     │
                     ├──────────────┤
                     │ id           │
                     │ tugas_id     │
                     │ peserta_id   │
                     │ file_path    │
                     │ nilai        │
                     └──────────────┘
```

---

## 🎓 Penutup Presentasi

### Kesimpulan
Sistem E-Learning Bootcamp ini menyediakan solusi lengkap untuk:
1. ✅ Manajemen bootcamp dan batch
2. ✅ Registrasi dan pendaftaran peserta
3. ✅ Pencatatan absensi online
4. ✅ Pengumpulan dan penilaian tugas
5. ✅ Laporan dengan export Excel & PDF

### Pengembangan Selanjutnya (Opsional)
- Integrasi pembayaran online
- Notifikasi email
- Forum diskusi
- Sertifikat otomatis
- Mobile app

---

**Selamat Presentasi! 🎉**
