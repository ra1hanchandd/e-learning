<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Mentor Model
 * Handles instructor data
 */
class Mentor_model extends CI_Model {

    protected $table = 'mentor';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all mentors
     */
    public function get_all($limit = null, $offset = null, $search = null) {
        if ($search) {
            $this->db->group_start();
            $this->db->like('nama', $search);
            $this->db->or_like('keahlian', $search);
            $this->db->group_end();
        }
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->table)->result();
    }

    /**
     * Count all mentors
     */
    public function count_all($search = null) {
        if ($search) {
            $this->db->group_start();
            $this->db->like('nama', $search);
            $this->db->or_like('keahlian', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results($this->table);
    }

    /**
     * Get mentor by ID
     */
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    /**
     * Create new mentor
     */
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update mentor
     */
    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Delete mentor
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    /**
     * Get all for dropdown
     */
    public function get_dropdown() {
        $mentors = $this->db->get($this->table)->result();
        $dropdown = [];
        foreach ($mentors as $mentor) {
            $dropdown[$mentor->id] = $mentor->nama;
        }
        return $dropdown;
    }
}
