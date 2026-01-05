-- =====================================================
-- E-LEARNING BOOTCAMP SYSTEM DATABASE
-- Created for CodeIgniter 3
-- Total: 9 Tables (5 Master + 4 Transaction)
-- =====================================================

-- Create Database
CREATE DATABASE IF NOT EXISTS elearning_bootcamp;
USE elearning_bootcamp;

-- =====================================================
-- MASTER DATA TABLES (5 Tables)
-- =====================================================

-- 1. USERS TABLE - Authentication & Role Management
CREATE TABLE users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. PESERTA TABLE - Student/Participant Profile
CREATE TABLE peserta (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) UNSIGNED NOT NULL,
    no_hp VARCHAR(20) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. MENTOR TABLE - Instructor Data
CREATE TABLE mentor (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    keahlian VARCHAR(200) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. BOOTCAMP TABLE - Course/Program Data
CREATE TABLE bootcamp (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(150) NOT NULL,
    deskripsi TEXT,
    harga DECIMAL(12,2) NOT NULL DEFAULT 0,
    mentor_id INT(11) UNSIGNED NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (mentor_id) REFERENCES mentor(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. BATCH TABLE - Bootcamp Schedule/Batch
CREATE TABLE batch (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    bootcamp_id INT(11) UNSIGNED NOT NULL,
    nama_batch VARCHAR(100) NOT NULL,
    tanggal_mulai DATE NOT NULL,
    tanggal_selesai DATE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (bootcamp_id) REFERENCES bootcamp(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- TRANSACTION DATA TABLES (4 Tables)
-- =====================================================

-- 6. PENDAFTARAN TABLE - Registration/Enrollment
CREATE TABLE pendaftaran (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    peserta_id INT(11) UNSIGNED NOT NULL,
    batch_id INT(11) UNSIGNED NOT NULL,
    tanggal_daftar DATE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (peserta_id) REFERENCES peserta(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (batch_id) REFERENCES batch(id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY unique_enrollment (peserta_id, batch_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. ABSENSI TABLE - Attendance Record
CREATE TABLE absensi (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pendaftaran_id INT(11) UNSIGNED NOT NULL,
    tanggal DATE NOT NULL,
    status_hadir ENUM('hadir', 'izin', 'alpha') NOT NULL DEFAULT 'alpha',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (pendaftaran_id) REFERENCES pendaftaran(id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY unique_attendance (pendaftaran_id, tanggal)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. TUGAS TABLE - Assignment Data
CREATE TABLE tugas (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    batch_id INT(11) UNSIGNED NOT NULL,
    judul VARCHAR(200) NOT NULL,
    deskripsi TEXT,
    deadline DATE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (batch_id) REFERENCES batch(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 9. PENGUMPULAN_TUGAS TABLE - Assignment Submission
CREATE TABLE pengumpulan_tugas (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tugas_id INT(11) UNSIGNED NOT NULL,
    peserta_id INT(11) UNSIGNED NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    nilai DECIMAL(5,2) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tugas_id) REFERENCES tugas(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (peserta_id) REFERENCES peserta(id) ON DELETE CASCADE ON UPDATE CASCADE,
    UNIQUE KEY unique_submission (tugas_id, peserta_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- SAMPLE DATA
-- =====================================================

-- Insert Admin User (Password: admin123)
INSERT INTO users (name, email, password, role) VALUES 
('Administrator', 'admin@bootcamp.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert Sample User (Password: user123)
INSERT INTO users (name, email, password, role) VALUES 
('John Doe', 'john@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

-- Insert Peserta for Sample User
INSERT INTO peserta (user_id, no_hp) VALUES (2, '081234567890');

-- Insert Sample Mentors
INSERT INTO mentor (nama, keahlian) VALUES 
('Budi Santoso', 'Web Development, PHP, MySQL'),
('Rina Wijaya', 'Data Science, Python, Machine Learning'),
('Ahmad Fauzi', 'Mobile Development, Flutter, React Native');

-- Insert Sample Bootcamps
INSERT INTO bootcamp (nama, deskripsi, harga, mentor_id) VALUES 
('Fullstack Web Developer', 'Belajar menjadi fullstack web developer dari dasar hingga mahir', 2500000, 1),
('Data Science Fundamentals', 'Pelajari dasar-dasar data science dan machine learning', 3000000, 2),
('Mobile App Development', 'Bangun aplikasi mobile cross-platform dengan Flutter', 2800000, 3);

-- Insert Sample Batches
INSERT INTO batch (bootcamp_id, nama_batch, tanggal_mulai, tanggal_selesai) VALUES 
(1, 'Batch 1 - Januari 2026', '2026-01-15', '2026-03-15'),
(1, 'Batch 2 - April 2026', '2026-04-01', '2026-06-01'),
(2, 'Batch 1 - Februari 2026', '2026-02-01', '2026-04-01'),
(3, 'Batch 1 - Maret 2026', '2026-03-01', '2026-05-01');

-- =====================================================
-- END OF SQL FILE
-- =====================================================
