<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Excel Library for CodeIgniter 3
 * Simple library to export data to Excel format using PHP
 */
class Excel_lib {
    
    protected $CI;
    
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    
    /**
     * Export data to Excel file
     * 
     * @param string $filename Filename without extension
     * @param array $headers Column headers
     * @param array $data Data rows
     * @param string $title Sheet title
     * @return void
     */
    public function export($filename, $headers, $data, $title = 'Sheet1')
    {
        // Set headers for download
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        
        // Start output
        echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
        echo '<head>';
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        echo '<!--[if gte mso 9]>';
        echo '<xml>';
        echo '<x:ExcelWorkbook>';
        echo '<x:ExcelWorksheets>';
        echo '<x:ExcelWorksheet>';
        echo '<x:Name>' . $title . '</x:Name>';
        echo '<x:WorksheetOptions>';
        echo '<x:Print>';
        echo '<x:ValidPrinterInfo/>';
        echo '</x:Print>';
        echo '</x:WorksheetOptions>';
        echo '</x:ExcelWorksheet>';
        echo '</x:ExcelWorksheets>';
        echo '</x:ExcelWorkbook>';
        echo '</xml>';
        echo '<![endif]-->';
        echo '<style>';
        echo 'table { border-collapse: collapse; }';
        echo 'th, td { border: 1px solid #000; padding: 5px; }';
        echo 'th { background-color: #4472C4; color: #fff; font-weight: bold; }';
        echo '.header-title { font-size: 16px; font-weight: bold; margin-bottom: 10px; }';
        echo '</style>';
        echo '</head>';
        echo '<body>';
        
        echo '<table>';
        
        // Header row
        echo '<tr>';
        foreach ($headers as $header) {
            echo '<th>' . htmlspecialchars($header) . '</th>';
        }
        echo '</tr>';
        
        // Data rows
        foreach ($data as $row) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . htmlspecialchars($cell) . '</td>';
            }
            echo '</tr>';
        }
        
        echo '</table>';
        echo '</body>';
        echo '</html>';
        
        exit;
    }
    
    /**
     * Export data to Excel with custom styling
     * 
     * @param string $filename Filename without extension
     * @param string $report_title Report title
     * @param array $headers Column headers
     * @param array $data Data rows
     * @param array $summary Optional summary row
     * @return void
     */
    public function export_report($filename, $report_title, $headers, $data, $summary = array())
    {
        // Set headers for download
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
        header('Cache-Control: max-age=0');
        
        // Start output
        echo '<html xmlns:x="urn:schemas-microsoft-com:office:excel">';
        echo '<head>';
        echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
        echo '<!--[if gte mso 9]>';
        echo '<xml>';
        echo '<x:ExcelWorkbook>';
        echo '<x:ExcelWorksheets>';
        echo '<x:ExcelWorksheet>';
        echo '<x:Name>Report</x:Name>';
        echo '<x:WorksheetOptions>';
        echo '<x:Print>';
        echo '<x:ValidPrinterInfo/>';
        echo '</x:Print>';
        echo '</x:WorksheetOptions>';
        echo '</x:ExcelWorksheet>';
        echo '</x:ExcelWorksheets>';
        echo '</x:ExcelWorkbook>';
        echo '</xml>';
        echo '<![endif]-->';
        echo '<style>';
        echo 'table { border-collapse: collapse; }';
        echo 'th, td { border: 1px solid #000; padding: 8px; }';
        echo 'th { background-color: #4472C4; color: #fff; font-weight: bold; text-align: center; }';
        echo '.title { font-size: 18px; font-weight: bold; }';
        echo '.subtitle { font-size: 12px; color: #666; }';
        echo '.summary { background-color: #E2EFDA; font-weight: bold; }';
        echo '.number { text-align: right; }';
        echo '.center { text-align: center; }';
        echo '</style>';
        echo '</head>';
        echo '<body>';
        
        // Report title
        echo '<table>';
        echo '<tr><td colspan="' . count($headers) . '" class="title">' . htmlspecialchars($report_title) . '</td></tr>';
        echo '<tr><td colspan="' . count($headers) . '" class="subtitle">Tanggal Export: ' . date('d-m-Y H:i:s') . '</td></tr>';
        echo '<tr><td colspan="' . count($headers) . '">&nbsp;</td></tr>';
        
        // Header row
        echo '<tr>';
        foreach ($headers as $header) {
            echo '<th>' . htmlspecialchars($header) . '</th>';
        }
        echo '</tr>';
        
        // Data rows
        foreach ($data as $row) {
            echo '<tr>';
            foreach ($row as $cell) {
                echo '<td>' . htmlspecialchars($cell) . '</td>';
            }
            echo '</tr>';
        }
        
        // Summary row if provided
        if (!empty($summary)) {
            echo '<tr>';
            foreach ($summary as $cell) {
                echo '<td class="summary">' . htmlspecialchars($cell) . '</td>';
            }
            echo '</tr>';
        }
        
        echo '</table>';
        echo '</body>';
        echo '</html>';
        
        exit;
    }
    
    /**
     * Export attendance report
     * 
     * @param string $filename Filename
     * @param string $batch_name Batch name
     * @param string $date Date
     * @param array $data Attendance data
     * @return void
     */
    public function export_absensi($filename, $batch_name, $date, $data)
    {
        $headers = array('No', 'Nama Peserta', 'Email', 'Status', 'Keterangan');
        
        $rows = array();
        $no = 1;
        foreach ($data as $row) {
            $rows[] = array(
                $no++,
                $row->nama ?? '',
                $row->email ?? '',
                ucfirst($row->status ?? ''),
                $row->keterangan ?? ''
            );
        }
        
        $title = 'Laporan Absensi - ' . $batch_name . ' (' . $date . ')';
        $this->export_report($filename, $title, $headers, $rows);
    }
    
    /**
     * Export grade report
     * 
     * @param string $filename Filename
     * @param string $batch_name Batch name
     * @param array $data Grade data
     * @return void
     */
    public function export_nilai($filename, $batch_name, $data)
    {
        $headers = array('No', 'Nama Peserta', 'Tugas', 'Nilai', 'Feedback');
        
        $rows = array();
        $no = 1;
        foreach ($data as $row) {
            $rows[] = array(
                $no++,
                $row->peserta_nama ?? '',
                $row->tugas_judul ?? '',
                $row->nilai ?? '-',
                $row->feedback ?? ''
            );
        }
        
        $title = 'Laporan Nilai - ' . $batch_name;
        $this->export_report($filename, $title, $headers, $rows);
    }
    
    /**
     * Export registration report
     * 
     * @param string $filename Filename
     * @param array $data Registration data
     * @return void
     */
    public function export_pendaftaran($filename, $data)
    {
        $headers = array('No', 'Nama Peserta', 'Email', 'Bootcamp', 'Batch', 'Tanggal Daftar');
        
        $rows = array();
        $no = 1;
        foreach ($data as $row) {
            $rows[] = array(
                $no++,
                $row->peserta_nama ?? '',
                $row->email ?? '',
                $row->bootcamp_nama ?? '',
                $row->batch_nama ?? '',
                isset($row->created_at) ? date('d-m-Y', strtotime($row->created_at)) : ''
            );
        }
        
        $title = 'Laporan Pendaftaran Bootcamp';
        $this->export_report($filename, $title, $headers, $rows);
    }
}
