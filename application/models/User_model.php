<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Model
 * Handles user authentication and CRUD operations
 */
class User_model extends CI_Model {

    protected $table = 'users';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all users
     */
    public function get_all($limit = null, $offset = null, $search = null) {
        if ($search) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->group_end();
        }
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $this->db->order_by('id', 'DESC');
        return $this->db->get($this->table)->result();
    }

    /**
     * Count all users
     */
    public function count_all($search = null) {
        if ($search) {
            $this->db->group_start();
            $this->db->like('name', $search);
            $this->db->or_like('email', $search);
            $this->db->group_end();
        }
        return $this->db->count_all_results($this->table);
    }

    /**
     * Get user by ID
     */
    public function get_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    /**
     * Get user by email (for login)
     */
    public function get_by_email($email) {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    /**
     * Create new user
     */
    public function create($data) {
        // Hash password
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update user
     */
    public function update($id, $data) {
        // Hash password if provided
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }
        
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    /**
     * Delete user
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    /**
     * Verify password
     */
    public function verify_password($password, $hash) {
        return password_verify($password, $hash);
    }

    /**
     * Check if email exists
     */
    public function email_exists($email, $exclude_id = null) {
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $this->db->where('email', $email);
        return $this->db->count_all_results($this->table) > 0;
    }
}
