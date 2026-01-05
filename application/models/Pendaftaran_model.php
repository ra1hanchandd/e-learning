<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Pendaftaran Model
 * Handles bootcamp registration/enrollment
 */
class Pendaftaran_model extends CI_Model {

    protected $table = 'pendaftaran';

    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all pendaftaran with related data
     */
    public function get_all($limit = null, $offset = null, $search = null) {
        $this->db->select('pendaftaran.*, peserta.no_hp, users.name as peserta_nama, users.email,
                          batch.nama_batch, bootcamp.nama as bootcamp_nama');
        $this->db->from($this->table);
        $this->db->join('peserta', 'peserta.id = pendaftaran.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->join('batch', 'batch.id = pendaftaran.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('users.name', $search);
            $this->db->or_like('bootcamp.nama', $search);
            $this->db->or_like('batch.nama_batch', $search);
            $this->db->group_end();
        }
        
        if ($limit) {
            $this->db->limit($limit, $offset);
        }
        
        $this->db->order_by('pendaftaran.tanggal_daftar', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Count all pendaftaran
     */
    public function count_all($search = null) {
        $this->db->select('pendaftaran.id');
        $this->db->from($this->table);
        $this->db->join('peserta', 'peserta.id = pendaftaran.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->join('batch', 'batch.id = pendaftaran.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        
        if ($search) {
            $this->db->group_start();
            $this->db->like('users.name', $search);
            $this->db->or_like('bootcamp.nama', $search);
            $this->db->or_like('batch.nama_batch', $search);
            $this->db->group_end();
        }
        
        return $this->db->count_all_results();
    }

    /**
     * Get pendaftaran by ID
     */
    public function get_by_id($id) {
        $this->db->select('pendaftaran.*, peserta.no_hp, users.name as peserta_nama, users.email,
                          batch.nama_batch, batch.tanggal_mulai, batch.tanggal_selesai,
                          bootcamp.nama as bootcamp_nama, bootcamp.harga');
        $this->db->from($this->table);
        $this->db->join('peserta', 'peserta.id = pendaftaran.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->join('batch', 'batch.id = pendaftaran.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->where('pendaftaran.id', $id);
        return $this->db->get()->row();
    }

    /**
     * Get pendaftaran by peserta ID
     */
    public function get_by_peserta($peserta_id) {
        $this->db->select('pendaftaran.*, batch.nama_batch, batch.tanggal_mulai, batch.tanggal_selesai,
                          bootcamp.nama as bootcamp_nama, bootcamp.harga, mentor.nama as mentor_nama');
        $this->db->from($this->table);
        $this->db->join('batch', 'batch.id = pendaftaran.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->join('mentor', 'mentor.id = bootcamp.mentor_id');
        $this->db->where('pendaftaran.peserta_id', $peserta_id);
        $this->db->order_by('pendaftaran.tanggal_daftar', 'DESC');
        return $this->db->get()->result();
    }

    /**
     * Get pendaftaran by batch ID
     */
    public function get_by_batch($batch_id) {
        $this->db->select('pendaftaran.*, users.name as peserta_nama, users.email, peserta.no_hp');
        $this->db->from($this->table);
        $this->db->join('peserta', 'peserta.id = pendaftaran.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->where('pendaftaran.batch_id', $batch_id);
        $this->db->order_by('users.name', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Check if already registered
     */
    public function is_registered($peserta_id, $batch_id) {
        $this->db->where('peserta_id', $peserta_id);
        $this->db->where('batch_id', $batch_id);
        return $this->db->count_all_results($this->table) > 0;
    }

    /**
     * Create new pendaftaran
     */
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    /**
     * Delete pendaftaran
     */
    public function delete($id) {
        return $this->db->where('id', $id)->delete($this->table);
    }

    /**
     * Count peserta per batch
     */
    public function count_by_batch($batch_id) {
        $this->db->where('batch_id', $batch_id);
        return $this->db->count_all_results($this->table);
    }
}
