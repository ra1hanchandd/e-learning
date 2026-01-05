<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * PDF Library for CodeIgniter 3
 * Simple library to export data to PDF format using browser print
 * Auto-triggers print dialog for seamless PDF export
 */
class Pdf_lib {
    
    protected $CI;
    
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    
    /**
     * Generate PDF from HTML - Auto triggers print dialog
     */
    public function export($filename, $title, $headers, $data, $report_type = 'general')
    {
        $color = $this->get_report_color($report_type);
        $html = $this->generate_html($filename, $title, $headers, $data, $color);
        
        // Clear any output buffers
        while (ob_get_level()) {
            ob_end_clean();
        }
        
        header('Content-Type: text/html; charset=utf-8');
        echo $html;
        exit;
    }
    
    /**
     * Export Pendaftaran Report to PDF
     */
    public function export_pendaftaran($filename, $data)
    {
        $headers = ['No', 'Nama Peserta', 'Email', 'No. HP', 'Bootcamp', 'Batch', 'Tgl Daftar'];
        $rows = [];
        $no = 1;
        
        foreach ($data as $row) {
            $rows[] = [
                $no++,
                $row->peserta_nama ?? '-',
                $row->email ?? '-',
                $row->no_hp ?? '-',
                $row->bootcamp_nama ?? '-',
                $row->nama_batch ?? '-',
                isset($row->tanggal_daftar) ? date('d/m/Y', strtotime($row->tanggal_daftar)) : '-'
            ];
        }
        
        $this->export($filename, 'Laporan Pendaftaran Peserta', $headers, $rows, 'pendaftaran');
    }
    
    /**
     * Export Absensi Report to PDF
     */
    public function export_absensi($filename, $data)
    {
        $headers = ['No', 'Nama Peserta', 'Bootcamp', 'Batch', 'Tanggal', 'Status'];
        $rows = [];
        $no = 1;
        
        foreach ($data as $row) {
            $rows[] = [
                $no++,
                $row->peserta_nama ?? '-',
                $row->bootcamp_nama ?? '-',
                $row->nama_batch ?? '-',
                isset($row->tanggal) ? date('d/m/Y', strtotime($row->tanggal)) : '-',
                ucfirst($row->status_hadir ?? 'alpha')
            ];
        }
        
        $this->export($filename, 'Laporan Absensi Peserta', $headers, $rows, 'absensi');
    }
    
    /**
     * Export Nilai Report to PDF
     */
    public function export_nilai($filename, $data)
    {
        $headers = ['No', 'Nama Peserta', 'Bootcamp', 'Tugas', 'Nilai', 'Tgl Upload'];
        $rows = [];
        $no = 1;
        
        foreach ($data as $row) {
            $rows[] = [
                $no++,
                $row->peserta_nama ?? '-',
                $row->bootcamp_nama ?? '-',
                $row->tugas_judul ?? '-',
                $row->nilai ?? 'Belum Dinilai',
                isset($row->created_at) ? date('d/m/Y', strtotime($row->created_at)) : '-'
            ];
        }
        
        $this->export($filename, 'Laporan Nilai Tugas', $headers, $rows, 'nilai');
    }
    
    /**
     * Get color based on report type
     */
    protected function get_report_color($type)
    {
        $colors = [
            'pendaftaran' => '#6366f1',
            'absensi' => '#10b981',
            'nilai' => '#f59e0b',
            'general' => '#3b82f6'
        ];
        return $colors[$type] ?? $colors['general'];
    }
    
    /**
     * Generate clean HTML for PDF - Landscape optimized
     */
    protected function generate_html($filename, $title, $headers, $data, $color)
    {
        $date = date('d F Y');
        $time = date('H:i');
        $totalData = count($data);
        
        $html = '<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>' . htmlspecialchars($title) . ' - ' . $date . '</title>
    <style>
        @page {
            size: A4 landscape;
            margin: 15mm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #333;
            background: white;
            line-height: 1.4;
        }
        
        .report-container {
            width: 100%;
            max-width: 100%;
        }
        
        /* Header */
        .report-header {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
            border-bottom: 3px solid ' . $color . ';
        }
        
        .report-header h1 {
            font-size: 22px;
            color: ' . $color . ';
            margin-bottom: 5px;
            font-weight: bold;
        }
        
        .report-header h2 {
            font-size: 16px;
            color: #555;
            font-weight: normal;
            margin-bottom: 10px;
        }
        
        .report-meta {
            font-size: 11px;
            color: #777;
        }
        
        .report-meta span {
            margin: 0 10px;
        }
        
        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 11px;
        }
        
        thead th {
            background: ' . $color . ';
            color: white;
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            white-space: nowrap;
        }
        
        thead th:first-child {
            width: 40px;
            text-align: center;
        }
        
        tbody td {
            padding: 8px;
            border-bottom: 1px solid #e5e5e5;
            vertical-align: top;
        }
        
        tbody td:first-child {
            text-align: center;
            font-weight: bold;
            color: #666;
        }
        
        tbody tr:nth-child(even) {
            background: #fafafa;
        }
        
        tbody tr:hover {
            background: #f5f5f5;
        }
        
        /* Status Badges */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .badge-success {
            background: #dcfce7;
            color: #166534;
        }
        
        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }
        
        .badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .badge-secondary {
            background: #f1f5f9;
            color: #475569;
        }
        
        /* Footer */
        .report-footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #e5e5e5;
            font-size: 10px;
            color: #999;
        }
        
        /* Summary Box */
        .summary-box {
            display: inline-block;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: 4px solid ' . $color . ';
            padding: 10px 20px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .summary-box strong {
            color: ' . $color . ';
            font-size: 18px;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #999;
        }
        
        /* Print Styles */
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            .no-print {
                display: none !important;
            }
            
            thead th {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            .badge {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            
            tbody tr:nth-child(even) {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
        
        /* Screen Only - Loading indicator */
        @media screen {
            .loading-overlay {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(255,255,255,0.95);
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
                z-index: 9999;
            }
            
            .loading-overlay.hidden {
                display: none;
            }
            
            .spinner {
                width: 40px;
                height: 40px;
                border: 4px solid #e5e5e5;
                border-top: 4px solid ' . $color . ';
                border-radius: 50%;
                animation: spin 1s linear infinite;
                margin-bottom: 15px;
            }
            
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
        <div>Menyiapkan dokumen PDF...</div>
    </div>

    <div class="report-container">
        <div class="report-header">
            <h1>EduCamp Bootcamp</h1>
            <h2>' . htmlspecialchars($title) . '</h2>
            <div class="report-meta">
                <span>Tanggal: ' . $date . '</span>
                <span>|</span>
                <span>Waktu: ' . $time . ' WIB</span>
                <span>|</span>
                <span>Total: ' . $totalData . ' Data</span>
            </div>
        </div>
        
        <div class="summary-box">
            Total Data: <strong>' . $totalData . '</strong>
        </div>';
        
        if (empty($data)) {
            $html .= '
        <div class="empty-state">
            <p>Tidak ada data yang tersedia untuk laporan ini.</p>
        </div>';
        } else {
            $html .= '
        <table>
            <thead>
                <tr>';
            
            foreach ($headers as $header) {
                $html .= '<th>' . htmlspecialchars($header) . '</th>';
            }
            
            $html .= '
                </tr>
            </thead>
            <tbody>';
            
            foreach ($data as $row) {
                $html .= '<tr>';
                foreach ($row as $index => $cell) {
                    $cellContent = htmlspecialchars($cell);
                    
                    // Status badges
                    $cellLower = strtolower($cell);
                    if ($cellLower == 'hadir') {
                        $cellContent = '<span class="badge badge-success">Hadir</span>';
                    } elseif ($cellLower == 'izin') {
                        $cellContent = '<span class="badge badge-warning">Izin</span>';
                    } elseif ($cellLower == 'alpha') {
                        $cellContent = '<span class="badge badge-danger">Alpha</span>';
                    } elseif ($cell === 'Belum Dinilai') {
                        $cellContent = '<span class="badge badge-secondary">Belum Dinilai</span>';
                    } elseif (is_numeric($cell) && $index == 4) {
                        // Nilai column (index 4 for nilai reports)
                        $val = floatval($cell);
                        if ($val >= 80) {
                            $cellContent = '<span class="badge badge-success">' . $cell . '</span>';
                        } elseif ($val >= 60) {
                            $cellContent = '<span class="badge badge-warning">' . $cell . '</span>';
                        } else {
                            $cellContent = '<span class="badge badge-danger">' . $cell . '</span>';
                        }
                    }
                    
                    $html .= '<td>' . $cellContent . '</td>';
                }
                $html .= '</tr>';
            }
            
            $html .= '
            </tbody>
        </table>';
        }
        
        $html .= '
        <div class="report-footer">
            <p>Dokumen ini digenerate otomatis oleh sistem EduCamp Bootcamp pada ' . $date . ' pukul ' . $time . ' WIB</p>
            <p>&copy; ' . date('Y') . ' EduCamp - Platform E-Learning Bootcamp</p>
        </div>
    </div>
    
    <script>
        // Auto print when page fully loads
        window.onload = function() {
            // Hide loading overlay
            document.getElementById("loadingOverlay").classList.add("hidden");
            
            // Small delay then trigger print
            setTimeout(function() {
                window.print();
            }, 300);
        };
    </script>
</body>
</html>';
        
        return $html;
    }
}
