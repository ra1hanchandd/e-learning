<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Batch Model
 * Handles bootcamp batch/schedule data
 */
class Batch_model extends CI_Model {

    protected $table = 'batch';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all batches with bootcamp data
     */
    public function get_all($limit = null, $offset = null, $search = null) {
        $this->db->select('batch.*, bootcamp.nama as bootcamp_nama, mentor.nama as mentor_nama');
        $this->db->from($this->table);
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->join('mentor', 'mentor.id = bootcamp.mentor_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('batch.nama_batch', $search);
            $this->db->or_like('bootcamp.nama', $search);
            $this->db->group_end();
        }
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $this->db->order_by('batch.tanggal_mulai', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Count all batches
     */
    public function count_all($search = null) {
        $this->db->select('batch.id');
        $this->db->from($this->table);
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('batch.nama_batch', $search);
            $this->db->or_like('bootcamp.nama', $search);
            $this->db->group_end();
        }
        
        return $this->db->count_all_results();
    }

    /**
     * Get batch by ID
     */
    public function get_by_id($id) {
        $this->db->select('batch.*, bootcamp.nama as bootcamp_nama, bootcamp.harga, mentor.nama as mentor_nama');
        $this->db->from($this->table);
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->join('mentor', 'mentor.id = bootcamp.mentor_id');
        $this->db->where('batch.id', $id);
        return $this->db->get()->row();
    }

    /**
     * Get batches by bootcamp ID
     */
    public function get_by_bootcamp($bootcamp_id) {
        $this->db->where('bootcamp_id', $bootcamp_id);
        $this->db->order_by('tanggal_mulai', 'ASC');
        return $this->db->get($this->table)->result();
    }

    /**
     * Get active batches (not yet ended)
     */
    public function get_active() {
        $this->db->select('batch.*, bootcamp.nama as bootcamp_nama, bootcamp.harga');
        $this->db->from($this->table);
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->where('batch.tanggal_selesai >=', date('Y-m-d'));
        $this->db->order_by('batch.tanggal_mulai', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Create new batch
     */
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update batch
     */
    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Delete batch
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    /**
     * Get all for dropdown
     */
    public function get_dropdown() {
        $this->db->select('batch.*, bootcamp.nama as bootcamp_nama');
        $this->db->from($this->table);
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->order_by('batch.tanggal_mulai', 'DESC');
        $batches = $this->db->get()->result();
        
        $dropdown = [];
        foreach ($batches as $batch) {
            $dropdown[$batch->id] = $batch->bootcamp_nama . ' - ' . $batch->nama_batch;
        }
        return $dropdown;
    }
}
