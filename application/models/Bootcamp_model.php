<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Bootcamp Model
 * Handles bootcamp/course data
 */
class Bootcamp_model extends CI_Model {

    protected $table = 'bootcamp';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all bootcamps with mentor data
     */
    public function get_all($limit = null, $offset = null, $search = null) {
        $this->db->select('bootcamp.*, mentor.nama as mentor_nama');
        $this->db->from($this->table);
        $this->db->join('mentor', 'mentor.id = bootcamp.mentor_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('bootcamp.nama', $search);
            $this->db->or_like('bootcamp.deskripsi', $search);
            $this->db->or_like('mentor.nama', $search);
            $this->db->group_end();
        }
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $this->db->order_by('bootcamp.id', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Count all bootcamps
     */
    public function count_all($search = null) {
        $this->db->select('bootcamp.id');
        $this->db->from($this->table);
        $this->db->join('mentor', 'mentor.id = bootcamp.mentor_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('bootcamp.nama', $search);
            $this->db->or_like('bootcamp.deskripsi', $search);
            $this->db->or_like('mentor.nama', $search);
            $this->db->group_end();
        }
        
        return $this->db->count_all_results();
    }

    /**
     * Get bootcamp by ID
     */
    public function get_by_id($id) {
        $this->db->select('bootcamp.*, mentor.nama as mentor_nama');
        $this->db->from($this->table);
        $this->db->join('mentor', 'mentor.id = bootcamp.mentor_id');
        $this->db->where('bootcamp.id', $id);
        return $this->db->get()->row();
    }

    /**
     * Create new bootcamp
     */
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update bootcamp
     */
    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Delete bootcamp
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    /**
     * Get all for dropdown
     */
    public function get_dropdown() {
        $bootcamps = $this->db->get($this->table)->result();
        $dropdown = [];
        foreach ($bootcamps as $bootcamp) {
            $dropdown[$bootcamp->id] = $bootcamp->nama;
        }
        return $dropdown;
    }
}
