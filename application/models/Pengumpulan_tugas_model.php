<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pengumpulan Tugas Model
 * Handles assignment submissions and grading
 */
class Pengumpulan_tugas_model extends CI_Model {

    protected $table = 'pengumpulan_tugas';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all submissions with related data
     */
    public function get_all($limit = null, $offset = null, $search = null) {
        $this->db->select('pengumpulan_tugas.*, tugas.judul as tugas_judul, tugas.deadline,
                          users.name as peserta_nama, batch.nama_batch, bootcamp.nama as bootcamp_nama');
        $this->db->from($this->table);
        $this->db->join('tugas', 'tugas.id = pengumpulan_tugas.tugas_id');
        $this->db->join('batch', 'batch.id = tugas.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->join('peserta', 'peserta.id = pengumpulan_tugas.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('users.name', $search);
            $this->db->or_like('tugas.judul', $search);
            $this->db->or_like('bootcamp.nama', $search);
            $this->db->group_end();
        }
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $this->db->order_by('pengumpulan_tugas.created_at', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Count all submissions
     */
    public function count_all($search = null) {
        $this->db->select('pengumpulan_tugas.id');
        $this->db->from($this->table);
        $this->db->join('tugas', 'tugas.id = pengumpulan_tugas.tugas_id');
        $this->db->join('batch', 'batch.id = tugas.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->join('peserta', 'peserta.id = pengumpulan_tugas.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('users.name', $search);
            $this->db->or_like('tugas.judul', $search);
            $this->db->or_like('bootcamp.nama', $search);
            $this->db->group_end();
        }
        
        return $this->db->count_all_results();
    }

    /**
     * Get submission by ID
     */
    public function get_by_id($id) {
        $this->db->select('pengumpulan_tugas.*, tugas.judul as tugas_judul, tugas.deadline, tugas.deskripsi as tugas_deskripsi,
                          users.name as peserta_nama, users.email, batch.nama_batch, bootcamp.nama as bootcamp_nama');
        $this->db->from($this->table);
        $this->db->join('tugas', 'tugas.id = pengumpulan_tugas.tugas_id');
        $this->db->join('batch', 'batch.id = tugas.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->join('peserta', 'peserta.id = pengumpulan_tugas.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->where('pengumpulan_tugas.id', $id);
        return $this->db->get()->row();
    }

    /**
     * Get submissions by tugas ID
     */
    public function get_by_tugas($tugas_id) {
        $this->db->select('pengumpulan_tugas.*, users.name as peserta_nama, users.email');
        $this->db->from($this->table);
        $this->db->join('peserta', 'peserta.id = pengumpulan_tugas.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->where('pengumpulan_tugas.tugas_id', $tugas_id);
        $this->db->order_by('pengumpulan_tugas.created_at', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Get submissions by peserta ID
     */
    public function get_by_peserta($peserta_id) {
        $this->db->select('pengumpulan_tugas.*, tugas.judul as tugas_judul, tugas.deadline,
                          batch.nama_batch, bootcamp.nama as bootcamp_nama');
        $this->db->from($this->table);
        $this->db->join('tugas', 'tugas.id = pengumpulan_tugas.tugas_id');
        $this->db->join('batch', 'batch.id = tugas.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->where('pengumpulan_tugas.peserta_id', $peserta_id);
        $this->db->order_by('pengumpulan_tugas.created_at', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Check if already submitted
     */
    public function is_submitted($tugas_id, $peserta_id) {
        $this->db->where('tugas_id', $tugas_id);
        $this->db->where('peserta_id', $peserta_id);
        return $this->db->get($this->table)->row();
    }

    /**
     * Create new submission
     */
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update submission (for resubmit or grading)
     */
    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Delete submission
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    /**
     * Get ungraded submissions count
     */
    public function count_ungraded() {
        $this->db->where('nilai IS NULL');
        return $this->db->count_all_results($this->table);
    }

    /**
     * Get nilai summary by peserta
     */
    public function get_nilai_summary($peserta_id) {
        $this->db->select('AVG(nilai) as rata_rata, COUNT(*) as total_tugas, 
                          SUM(CASE WHEN nilai IS NOT NULL THEN 1 ELSE 0 END) as dinilai');
        $this->db->from($this->table);
        $this->db->where('peserta_id', $peserta_id);
        return $this->db->get()->row();
    }
}
