<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Peserta Model
 * Handles student/participant data
 */
class Peserta_model extends CI_Model {

    protected $table = 'peserta';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all peserta with user data
     */
    public function get_all($limit = null, $offset = null, $search = null) {
        $this->db->select('peserta.*, users.name, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = peserta.user_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('users.name', $search);
            $this->db->or_like('users.email', $search);
            $this->db->or_like('peserta.no_hp', $search);
            $this->db->group_end();
        }
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $this->db->order_by('peserta.id', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Count all peserta
     */
    public function count_all($search = null) {
        $this->db->select('peserta.id');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = peserta.user_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('users.name', $search);
            $this->db->or_like('users.email', $search);
            $this->db->or_like('peserta.no_hp', $search);
            $this->db->group_end();
        }
        
        return $this->db->count_all_results();
    }

    /**
     * Get peserta by ID
     */
    public function get_by_id($id) {
        $this->db->select('peserta.*, users.name, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->where('peserta.id', $id);
        return $this->db->get()->row();
    }

    /**
     * Get peserta by user ID
     */
    public function get_by_user_id($user_id) {
        $this->db->select('peserta.*, users.name, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->where('peserta.user_id', $user_id);
        return $this->db->get()->row();
    }

    /**
     * Create new peserta
     */
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update peserta
     */
    public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Delete peserta
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }
}
