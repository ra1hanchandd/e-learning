<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Tugas Model
 * Handles assignment data
 */
class Tugas_model extends CI_Model {

    protected $table = 'tugas';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all tugas with batch data
     */
    public function get_all($limit = null, $offset = null, $search = null) {
        $this->db->select('tugas.*, batch.nama_batch, bootcamp.nama as bootcamp_nama');
        $this->db->from($this->table);
        $this->db->join('batch', 'batch.id = tugas.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('tugas.judul', $search);
            $this->db->or_like('bootcamp.nama', $search);
            $this->db->or_like('batch.nama_batch', $search);
            $this->db->group_end();
        }
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $this->db->order_by('tugas.deadline', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Count all tugas
     */
    public function count_all($search = null) {
        $this->db->select('tugas.id');
        $this->db->from($this->table);
        $this->db->join('batch', 'batch.id = tugas.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('tugas.judul', $search);
            $this->db->or_like('bootcamp.nama', $search);
            $this->db->or_like('batch.nama_batch', $search);
            $this->db->group_end();
        }
        
        return $this->db->count_all_results();
    }

    /**
     * Get tugas by ID
     */
    public function get_by_id($id) {
        $this->db->select('tugas.*, batch.nama_batch, bootcamp.nama as bootcamp_nama');
        $this->db->from($this->table);
        $this->db->join('batch', 'batch.id = tugas.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->where('tugas.id', $id);
        return $this->db->get()->row();
    }

    /**
     * Get tugas by batch ID
     */
    public function get_by_batch($batch_id) {
        $this->db->where('batch_id', $batch_id);
        $this->db->order_by('deadline', 'ASC');
        return $this->db->get($this->table)->result();
    }

    /**
     * Get tugas for peserta (from enrolled batches)
     */
    public function get_by_peserta($peserta_id) {
        $this->db->select('tugas.*, batch.nama_batch, bootcamp.nama as bootcamp_nama,
                          pengumpulan_tugas.id as submission_id, pengumpulan_tugas.file_path, 
                          pengumpulan_tugas.nilai');
        $this->db->from($this->table);
        $this->db->join('batch', 'batch.id = tugas.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->join('pendaftaran', 'pendaftaran.batch_id = batch.id');
        $this->db->join('pengumpulan_tugas', 'pengumpulan_tugas.tugas_id = tugas.id AND pengumpulan_tugas.peserta_id = ' . (int)$peserta_id, 'left');
        $this->db->where('pendaftaran.peserta_id', $peserta_id);
        $this->db->order_by('tugas.deadline', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Create new tugas
     */
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update tugas
     */
    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Delete tugas
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
}
