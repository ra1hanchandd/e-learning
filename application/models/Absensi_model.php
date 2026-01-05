<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Absensi Model
 * Handles attendance records
 */
class Absensi_model extends CI_Model {

    protected $table = 'absensi';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all absensi with related data
     */
    public function get_all($limit = null, $offset = null, $search = null) {
        $this->db->select('absensi.*, pendaftaran.tanggal_daftar, 
                          users.name as peserta_nama, batch.nama_batch, bootcamp.nama as bootcamp_nama');
        $this->db->from($this->table);
        $this->db->join('pendaftaran', 'pendaftaran.id = absensi.pendaftaran_id');
        $this->db->join('peserta', 'peserta.id = pendaftaran.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->join('batch', 'batch.id = pendaftaran.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('users.name', $search);
            $this->db->or_like('bootcamp.nama', $search);
            $this->db->group_end();
        }
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $this->db->order_by('absensi.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Count all absensi
     */
    public function count_all($search = null) {
        $this->db->select('absensi.id');
        $this->db->from($this->table);
        $this->db->join('pendaftaran', 'pendaftaran.id = absensi.pendaftaran_id');
        $this->db->join('peserta', 'peserta.id = pendaftaran.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->join('batch', 'batch.id = pendaftaran.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('users.name', $search);
            $this->db->or_like('bootcamp.nama', $search);
            $this->db->group_end();
        }
        
        return $this->db->count_all_results();
    }

    /**
     * Get absensi by batch and date
     */
    public function get_by_batch_date($batch_id, $tanggal) {
        $this->db->select('absensi.*, pendaftaran.peserta_id, users.name as peserta_nama');
        $this->db->from($this->table);
        $this->db->join('pendaftaran', 'pendaftaran.id = absensi.pendaftaran_id');
        $this->db->join('peserta', 'peserta.id = pendaftaran.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->where('pendaftaran.batch_id', $batch_id);
        $this->db->where('absensi.tanggal', $tanggal);
        return $this->db->get()->result();
    }

    /**
     * Get absensi by pendaftaran ID
     */
    public function get_by_pendaftaran($pendaftaran_id) {
        $this->db->where('pendaftaran_id', $pendaftaran_id);
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get($this->table)->result();
    }

    /**
     * Get absensi by peserta ID (all batches)
     */
    public function get_by_peserta($peserta_id) {
        $this->db->select('absensi.*, batch.nama_batch, bootcamp.nama as bootcamp_nama');
        $this->db->from($this->table);
        $this->db->join('pendaftaran', 'pendaftaran.id = absensi.pendaftaran_id');
        $this->db->join('batch', 'batch.id = pendaftaran.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->where('pendaftaran.peserta_id', $peserta_id);
        $this->db->order_by('absensi.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Create or update absensi
     */
    public function save($data) {
        // Check if exists
        $this->db->where('pendaftaran_id', $data['pendaftaran_id']);
        $this->db->where('tanggal', $data['tanggal']);
        $existing = $this->db->get($this->table)->row();
        
        if ($existing) {
            return $this->db->where('id', $existing->id)->update($this->table, $data);
        } else {
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }

    /**
     * Delete absensi
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    /**
     * Get attendance summary for a pendaftaran
     */
    public function get_summary($pendaftaran_id) {
        $this->db->select('status_hadir, COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->where('pendaftaran_id', $pendaftaran_id);
        $this->db->group_by('status_hadir');
        $result = $this->db->get()->result();
        
        $summary = ['hadir' => 0, 'izin' => 0, 'alpha' => 0];
        foreach ($result as $row) {
            $summary[$row->status_hadir] = $row->total;
        }
        return $summary;
    }

    /**
     * Get absensi by ID
     */
    public function get_by_id($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    /**
     * Update absensi
     */
    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Get all absensi for a batch with full details
     */
    public function get_all_by_batch($batch_id) {
        $this->db->select('absensi.*, pendaftaran.id as pendaftaran_id, 
                          users.name as peserta_nama, users.email');
        $this->db->from($this->table);
        $this->db->join('pendaftaran', 'pendaftaran.id = absensi.pendaftaran_id');
        $this->db->join('peserta', 'peserta.id = pendaftaran.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->where('pendaftaran.batch_id', $batch_id);
        $this->db->order_by('absensi.tanggal', 'DESC');
        $this->db->order_by('users.name', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Get unique dates for a batch
     */
    public function get_dates_by_batch($batch_id) {
        $this->db->select('DISTINCT(absensi.tanggal) as tanggal');
        $this->db->from($this->table);
        $this->db->join('pendaftaran', 'pendaftaran.id = absensi.pendaftaran_id');
        $this->db->where('pendaftaran.batch_id', $batch_id);
        $this->db->order_by('absensi.tanggal', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Get summary statistics for a batch
     */
    public function get_batch_summary($batch_id) {
        $this->db->select('status_hadir, COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->join('pendaftaran', 'pendaftaran.id = absensi.pendaftaran_id');
        $this->db->where('pendaftaran.batch_id', $batch_id);
        $this->db->group_by('status_hadir');
        $result = $this->db->get()->result();
        
        $summary = ['hadir' => 0, 'izin' => 0, 'alpha' => 0, 'total' => 0];
        foreach ($result as $row) {
            $summary[$row->status_hadir] = $row->total;
            $summary['total'] += $row->total;
        }
        return $summary;
    }

    /**
     * Get attendance matrix for batch (peserta x dates)
     */
    public function get_attendance_matrix($batch_id) {
        // Get all pendaftaran for this batch
        $this->db->select('pendaftaran.id as pendaftaran_id, users.name as peserta_nama, users.email');
        $this->db->from('pendaftaran');
        $this->db->join('peserta', 'peserta.id = pendaftaran.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->where('pendaftaran.batch_id', $batch_id);
        $this->db->order_by('users.name', 'ASC');
        $students = $this->db->get()->result();

        // Get all dates with attendance records
        $dates = $this->get_dates_by_batch($batch_id);

        // Get all attendance records for this batch
        $absensi = $this->get_all_by_batch($batch_id);

        // Build matrix
        $matrix = [];
        foreach ($students as $student) {
            $matrix[$student->pendaftaran_id] = [
                'peserta_nama' => $student->peserta_nama,
                'email' => $student->email,
                'dates' => []
            ];
            foreach ($dates as $date) {
                $matrix[$student->pendaftaran_id]['dates'][$date->tanggal] = null; // Not recorded
            }
        }

        // Fill in actual attendance
        foreach ($absensi as $a) {
            if (isset($matrix[$a->pendaftaran_id])) {
                $matrix[$a->pendaftaran_id]['dates'][$a->tanggal] = [
                    'id' => $a->id,
                    'status' => $a->status_hadir
                ];
            }
        }

        return [
            'dates' => $dates,
            'students' => $matrix
        ];
    }

    /**
     * Create absensi
     */
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
}
