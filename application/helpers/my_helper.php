<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Format tanggal Indonesia
 * 
 * @param string $date Date string
 * @param bool $with_time Include time or not
 * @return string Formatted date
 */
if (!function_exists('format_tanggal')) {
    function format_tanggal($date, $with_time = false)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        
        $timestamp = strtotime($date);
        $tanggal = date('j', $timestamp);
        $bulan_nama = $bulan[(int)date('n', $timestamp)];
        $tahun = date('Y', $timestamp);
        
        $hasil = $tanggal . ' ' . $bulan_nama . ' ' . $tahun;
        
        if ($with_time) {
            $hasil .= ' ' . date('H:i', $timestamp);
        }
        
        return $hasil;
    }
}

/**
 * Format currency to Indonesian Rupiah
 * 
 * @param float $amount Amount to format
 * @return string Formatted currency
 */
if (!function_exists('format_rupiah')) {
    function format_rupiah($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}

/**
 * Generate random string
 * 
 * @param int $length Length of string
 * @return string Random string
 */
if (!function_exists('generate_random_string')) {
    function generate_random_string($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}

/**
 * Truncate text with ellipsis
 * 
 * @param string $text Text to truncate
 * @param int $limit Character limit
 * @return string Truncated text
 */
if (!function_exists('truncate_text')) {
    function truncate_text($text, $limit = 100)
    {
        if (strlen($text) <= $limit) {
            return $text;
        }
        return substr($text, 0, $limit) . '...';
    }
}

/**
 * Get status badge HTML for attendance
 * 
 * @param string $status Status value
 * @return string HTML badge
 */
if (!function_exists('absensi_badge')) {
    function absensi_badge($status)
    {
        $badges = array(
            'hadir' => '<span class="badge bg-success">Hadir</span>',
            'izin' => '<span class="badge bg-info">Izin</span>',
            'sakit' => '<span class="badge bg-warning text-dark">Sakit</span>',
            'alpha' => '<span class="badge bg-danger">Alpha</span>'
        );
        
        return isset($badges[$status]) ? $badges[$status] : '<span class="badge bg-secondary">Unknown</span>';
    }
}

/**
 * Get grade status badge
 * 
 * @param float $nilai Grade value
 * @return string HTML badge
 */
if (!function_exists('nilai_badge')) {
    function nilai_badge($nilai)
    {
        if ($nilai === null || $nilai === '') {
            return '<span class="badge bg-secondary">Belum dinilai</span>';
        }
        
        if ($nilai >= 85) {
            return '<span class="badge bg-success">' . $nilai . ' (A)</span>';
        } elseif ($nilai >= 70) {
            return '<span class="badge bg-primary">' . $nilai . ' (B)</span>';
        } elseif ($nilai >= 55) {
            return '<span class="badge bg-warning text-dark">' . $nilai . ' (C)</span>';
        } else {
            return '<span class="badge bg-danger">' . $nilai . ' (D)</span>';
        }
    }
}

/**
 * Calculate percentage
 * 
 * @param int $value Current value
 * @param int $total Total value
 * @param int $decimals Number of decimals
 * @return float Percentage
 */
if (!function_exists('calculate_percentage')) {
    function calculate_percentage($value, $total, $decimals = 0)
    {
        if ($total == 0) {
            return 0;
        }
        return round(($value / $total) * 100, $decimals);
    }
}

/**
 * Format file size
 * 
 * @param int $bytes File size in bytes
 * @return string Formatted file size
 */
if (!function_exists('format_file_size')) {
    function format_file_size($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}

/**
 * Get file extension icon class
 * 
 * @param string $filename Filename with extension
 * @return string Bootstrap icon class
 */
if (!function_exists('file_icon')) {
    function file_icon($filename)
    {
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        $icons = array(
            'pdf' => 'bi-file-pdf text-danger',
            'doc' => 'bi-file-word text-primary',
            'docx' => 'bi-file-word text-primary',
            'xls' => 'bi-file-excel text-success',
            'xlsx' => 'bi-file-excel text-success',
            'zip' => 'bi-file-zip text-warning',
            'rar' => 'bi-file-zip text-warning',
            'jpg' => 'bi-file-image text-info',
            'jpeg' => 'bi-file-image text-info',
            'png' => 'bi-file-image text-info',
            'gif' => 'bi-file-image text-info'
        );
        
        return isset($icons[$ext]) ? $icons[$ext] : 'bi-file-earmark';
    }
}

/**
 * Check if user is logged in
 * 
 * @return bool
 */
if (!function_exists('is_logged_in')) {
    function is_logged_in()
    {
        $CI =& get_instance();
        return $CI->session->userdata('user_id') ? true : false;
    }
}

/**
 * Check if user is admin
 * 
 * @return bool
 */
if (!function_exists('is_admin')) {
    function is_admin()
    {
        $CI =& get_instance();
        return $CI->session->userdata('role') === 'admin';
    }
}

/**
 * Get current user ID
 * 
 * @return int|null
 */
if (!function_exists('current_user_id')) {
    function current_user_id()
    {
        $CI =& get_instance();
        return $CI->session->userdata('user_id');
    }
}

/**
 * Convert date to time ago format
 * 
 * @param string $datetime Date time string
 * @return string Time ago format
 */
if (!function_exists('time_ago')) {
    function time_ago($datetime)
    {
        $timestamp = strtotime($datetime);
        $diff = time() - $timestamp;
        
        if ($diff < 60) {
            return 'Baru saja';
        } elseif ($diff < 3600) {
            $minutes = floor($diff / 60);
            return $minutes . ' menit yang lalu';
        } elseif ($diff < 86400) {
            $hours = floor($diff / 3600);
            return $hours . ' jam yang lalu';
        } elseif ($diff < 604800) {
            $days = floor($diff / 86400);
            return $days . ' hari yang lalu';
        } elseif ($diff < 2592000) {
            $weeks = floor($diff / 604800);
            return $weeks . ' minggu yang lalu';
        } else {
            return format_tanggal($datetime);
        }
    }
}
