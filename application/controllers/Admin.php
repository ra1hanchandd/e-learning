<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Controller
 * Handles all admin functionality
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Check if logged in and is admin
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'admin') {
            $this->session->set_flashdata('error', 'Akses ditolak! Silakan login sebagai admin.');
            redirect('login');
        }

        // Load all models
        $this->load->model('User_model');
        $this->load->model('Peserta_model');
        $this->load->model('Mentor_model');
        $this->load->model('Bootcamp_model');
        $this->load->model('Batch_model');
        $this->load->model('Pendaftaran_model');
        $this->load->model('Absensi_model');
        $this->load->model('Tugas_model');
        $this->load->model('Pengumpulan_tugas_model');
    }

    /**
     * Dashboard
     */
    public function dashboard() {
        $data['title'] = 'Dashboard Admin';
        $data['total_peserta'] = $this->Peserta_model->count_all();
        $data['total_mentor'] = $this->Mentor_model->count_all();
        $data['total_bootcamp'] = $this->Bootcamp_model->count_all();
        $data['total_batch'] = $this->Batch_model->count_all();
        $data['total_pendaftaran'] = $this->Pendaftaran_model->count_all();
        $data['tugas_belum_dinilai'] = $this->Pengumpulan_tugas_model->count_ungraded();
        
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('admin/layout/footer');
    }

    // ==========================================
    // MENTOR CRUD
    // ==========================================
    
    public function mentor() {
        $search = $this->input->get('search');
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $data['title'] = 'Data Mentor';
        $data['mentors'] = $this->Mentor_model->get_all($limit, $offset, $search);
        $data['total'] = $this->Mentor_model->count_all($search);
        $data['search'] = $search;
        $data['page'] = $page;
        $data['total_pages'] = ceil($data['total'] / $limit);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/mentor/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function mentor_create() {
        $data['title'] = 'Tambah Mentor';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/mentor/create', $data);
        $this->load->view('admin/layout/footer');
    }

    public function mentor_store() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('keahlian', 'Keahlian', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'keahlian' => $this->input->post('keahlian')
            ];
            $this->Mentor_model->create($data);
            $this->session->set_flashdata('success', 'Mentor berhasil ditambahkan!');
            redirect('admin/mentor');
        } else {
            $this->mentor_create();
        }
    }

    public function mentor_edit($id) {
        $data['title'] = 'Edit Mentor';
        $data['mentor'] = $this->Mentor_model->get_by_id($id);
        
        if (!$data['mentor']) {
            $this->session->set_flashdata('error', 'Mentor tidak ditemukan!');
            redirect('admin/mentor');
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/mentor/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function mentor_update($id) {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('keahlian', 'Keahlian', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'keahlian' => $this->input->post('keahlian')
            ];
            $this->Mentor_model->update($id, $data);
            $this->session->set_flashdata('success', 'Mentor berhasil diupdate!');
            redirect('admin/mentor');
        } else {
            $this->mentor_edit($id);
        }
    }

    public function mentor_delete($id) {
        $this->Mentor_model->delete($id);
        $this->session->set_flashdata('success', 'Mentor berhasil dihapus!');
        redirect('admin/mentor');
    }

    // ==========================================
    // BOOTCAMP CRUD
    // ==========================================

    public function bootcamp() {
        $search = $this->input->get('search');
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $data['title'] = 'Data Bootcamp';
        $data['bootcamps'] = $this->Bootcamp_model->get_all($limit, $offset, $search);
        $data['total'] = $this->Bootcamp_model->count_all($search);
        $data['search'] = $search;
        $data['page'] = $page;
        $data['total_pages'] = ceil($data['total'] / $limit);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/bootcamp/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function bootcamp_create() {
        $data['title'] = 'Tambah Bootcamp';
        $data['mentors'] = $this->Mentor_model->get_dropdown();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/bootcamp/create', $data);
        $this->load->view('admin/layout/footer');
    }

    public function bootcamp_store() {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('mentor_id', 'Mentor', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'harga' => $this->input->post('harga'),
                'mentor_id' => $this->input->post('mentor_id')
            ];
            $this->Bootcamp_model->create($data);
            $this->session->set_flashdata('success', 'Bootcamp berhasil ditambahkan!');
            redirect('admin/bootcamp');
        } else {
            $this->bootcamp_create();
        }
    }

    public function bootcamp_edit($id) {
        $data['title'] = 'Edit Bootcamp';
        $data['bootcamp'] = $this->Bootcamp_model->get_by_id($id);
        $data['mentors'] = $this->Mentor_model->get_dropdown();
        
        if (!$data['bootcamp']) {
            $this->session->set_flashdata('error', 'Bootcamp tidak ditemukan!');
            redirect('admin/bootcamp');
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/bootcamp/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function bootcamp_update($id) {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('harga', 'Harga', 'required|numeric');
        $this->form_validation->set_rules('mentor_id', 'Mentor', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'harga' => $this->input->post('harga'),
                'mentor_id' => $this->input->post('mentor_id')
            ];
            $this->Bootcamp_model->update($id, $data);
            $this->session->set_flashdata('success', 'Bootcamp berhasil diupdate!');
            redirect('admin/bootcamp');
        } else {
            $this->bootcamp_edit($id);
        }
    }

    public function bootcamp_delete($id) {
        $this->Bootcamp_model->delete($id);
        $this->session->set_flashdata('success', 'Bootcamp berhasil dihapus!');
        redirect('admin/bootcamp');
    }

    // ==========================================
    // BATCH CRUD
    // ==========================================

    public function batch() {
        $search = $this->input->get('search');
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $data['title'] = 'Data Batch';
        $data['batches'] = $this->Batch_model->get_all($limit, $offset, $search);
        $data['total'] = $this->Batch_model->count_all($search);
        $data['search'] = $search;
        $data['page'] = $page;
        $data['total_pages'] = ceil($data['total'] / $limit);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/batch/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function batch_create() {
        $data['title'] = 'Tambah Batch';
        $data['bootcamps'] = $this->Bootcamp_model->get_dropdown();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/batch/create', $data);
        $this->load->view('admin/layout/footer');
    }

    public function batch_store() {
        $this->form_validation->set_rules('bootcamp_id', 'Bootcamp', 'required');
        $this->form_validation->set_rules('nama_batch', 'Nama Batch', 'required');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'bootcamp_id' => $this->input->post('bootcamp_id'),
                'nama_batch' => $this->input->post('nama_batch'),
                'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                'tanggal_selesai' => $this->input->post('tanggal_selesai')
            ];
            $this->Batch_model->create($data);
            $this->session->set_flashdata('success', 'Batch berhasil ditambahkan!');
            redirect('admin/batch');
        } else {
            $this->batch_create();
        }
    }

    public function batch_edit($id) {
        $data['title'] = 'Edit Batch';
        $data['batch'] = $this->Batch_model->get_by_id($id);
        $data['bootcamps'] = $this->Bootcamp_model->get_dropdown();
        
        if (!$data['batch']) {
            $this->session->set_flashdata('error', 'Batch tidak ditemukan!');
            redirect('admin/batch');
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/batch/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function batch_update($id) {
        $this->form_validation->set_rules('bootcamp_id', 'Bootcamp', 'required');
        $this->form_validation->set_rules('nama_batch', 'Nama Batch', 'required');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'bootcamp_id' => $this->input->post('bootcamp_id'),
                'nama_batch' => $this->input->post('nama_batch'),
                'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                'tanggal_selesai' => $this->input->post('tanggal_selesai')
            ];
            $this->Batch_model->update($id, $data);
            $this->session->set_flashdata('success', 'Batch berhasil diupdate!');
            redirect('admin/batch');
        } else {
            $this->batch_edit($id);
        }
    }

    public function batch_delete($id) {
        $this->Batch_model->delete($id);
        $this->session->set_flashdata('success', 'Batch berhasil dihapus!');
        redirect('admin/batch');
    }

    // ==========================================
    // PESERTA (View Only)
    // ==========================================

    public function peserta() {
        $search = $this->input->get('search');
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $data['title'] = 'Data Peserta';
        $data['peserta_list'] = $this->Peserta_model->get_all($limit, $offset, $search);
        $data['total'] = $this->Peserta_model->count_all($search);
        $data['search'] = $search;
        $data['page'] = $page;
        $data['total_pages'] = ceil($data['total'] / $limit);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/peserta/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function peserta_detail($id) {
        $data['title'] = 'Detail Peserta';
        $data['peserta'] = $this->Peserta_model->get_by_id($id);
        
        if (!$data['peserta']) {
            $this->session->set_flashdata('error', 'Peserta tidak ditemukan!');
            redirect('admin/peserta');
        }

        $data['pendaftaran'] = $this->Pendaftaran_model->get_by_peserta($id);
        $data['nilai_summary'] = $this->Pengumpulan_tugas_model->get_nilai_summary($id);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/peserta/detail', $data);
        $this->load->view('admin/layout/footer');
    }

    // ==========================================
    // PENDAFTARAN
    // ==========================================

    public function pendaftaran() {
        $search = $this->input->get('search');
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $data['title'] = 'Data Pendaftaran';
        $data['pendaftaran_list'] = $this->Pendaftaran_model->get_all($limit, $offset, $search);
        $data['total'] = $this->Pendaftaran_model->count_all($search);
        $data['search'] = $search;
        $data['page'] = $page;
        $data['total_pages'] = ceil($data['total'] / $limit);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/pendaftaran/index', $data);
        $this->load->view('admin/layout/footer');
    }

    // ==========================================
    // ABSENSI
    // ==========================================

    public function absensi() {
        $data['title'] = 'Absensi';
        $data['batches'] = $this->Batch_model->get_all();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/absensi/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function absensi_batch($batch_id) {
        $data['title'] = 'Input Absensi';
        $data['batch'] = $this->Batch_model->get_by_id($batch_id);
        
        if (!$data['batch']) {
            $this->session->set_flashdata('error', 'Batch tidak ditemukan!');
            redirect('admin/absensi');
        }

        $data['pendaftaran_list'] = $this->Pendaftaran_model->get_by_batch($batch_id);
        $data['tanggal'] = $this->input->get('tanggal') ? $this->input->get('tanggal') : date('Y-m-d');
        
        // Get existing absensi for this date
        $absensi = $this->Absensi_model->get_by_batch_date($batch_id, $data['tanggal']);
        $data['absensi_data'] = [];
        foreach ($absensi as $a) {
            $data['absensi_data'][$a->pendaftaran_id] = $a->status_hadir;
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/absensi/batch', $data);
        $this->load->view('admin/layout/footer');
    }

    public function absensi_store() {
        $batch_id = $this->input->post('batch_id');
        $tanggal = $this->input->post('tanggal');
        $absensi = $this->input->post('absensi');

        if ($absensi) {
            foreach ($absensi as $pendaftaran_id => $status) {
                $data = [
                    'pendaftaran_id' => $pendaftaran_id,
                    'tanggal' => $tanggal,
                    'status_hadir' => $status
                ];
                $this->Absensi_model->save($data);
            }
            $this->session->set_flashdata('success', 'Absensi berhasil disimpan!');
        }

        redirect('admin/absensi/batch/' . $batch_id . '?tanggal=' . $tanggal);
    }

    /**
     * View attendance history for a batch
     */
    public function absensi_history($batch_id) {
        $data['title'] = 'Riwayat Absensi';
        $data['batch'] = $this->Batch_model->get_by_id($batch_id);
        
        if (!$data['batch']) {
            $this->session->set_flashdata('error', 'Batch tidak ditemukan!');
            redirect('admin/absensi');
        }

        $data['matrix'] = $this->Absensi_model->get_attendance_matrix($batch_id);
        $data['summary'] = $this->Absensi_model->get_batch_summary($batch_id);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/absensi/history', $data);
        $this->load->view('admin/layout/footer');
    }

    /**
     * Edit single attendance record
     */
    public function absensi_edit($id) {
        $data['title'] = 'Edit Absensi';
        $data['absensi'] = $this->Absensi_model->get_by_id($id);
        
        if (!$data['absensi']) {
            $this->session->set_flashdata('error', 'Data absensi tidak ditemukan!');
            redirect('admin/absensi');
        }

        // Get related info
        $this->db->select('pendaftaran.batch_id, users.name as peserta_nama, batch.nama_batch, bootcamp.nama as bootcamp_nama');
        $this->db->from('pendaftaran');
        $this->db->join('peserta', 'peserta.id = pendaftaran.peserta_id');
        $this->db->join('users', 'users.id = peserta.user_id');
        $this->db->join('batch', 'batch.id = pendaftaran.batch_id');
        $this->db->join('bootcamp', 'bootcamp.id = batch.bootcamp_id');
        $this->db->where('pendaftaran.id', $data['absensi']->pendaftaran_id);
        $data['info'] = $this->db->get()->row();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/absensi/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    /**
     * Update attendance record
     */
    public function absensi_update($id) {
        $absensi = $this->Absensi_model->get_by_id($id);
        
        if (!$absensi) {
            $this->session->set_flashdata('error', 'Data absensi tidak ditemukan!');
            redirect('admin/absensi');
        }

        $data = [
            'status_hadir' => $this->input->post('status_hadir'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->Absensi_model->update($id, $data);
        $this->session->set_flashdata('success', 'Absensi berhasil diupdate!');

        // Get batch_id for redirect
        $this->db->select('pendaftaran.batch_id');
        $this->db->from('pendaftaran');
        $this->db->where('pendaftaran.id', $absensi->pendaftaran_id);
        $pendaftaran = $this->db->get()->row();

        redirect('admin/absensi/history/' . $pendaftaran->batch_id);
    }

    /**
     * Delete attendance record
     */
    public function absensi_delete($id) {
        $absensi = $this->Absensi_model->get_by_id($id);
        
        if (!$absensi) {
            $this->session->set_flashdata('error', 'Data absensi tidak ditemukan!');
            redirect('admin/absensi');
        }

        // Get batch_id for redirect
        $this->db->select('pendaftaran.batch_id');
        $this->db->from('pendaftaran');
        $this->db->where('pendaftaran.id', $absensi->pendaftaran_id);
        $pendaftaran = $this->db->get()->row();

        $this->Absensi_model->delete($id);
        $this->session->set_flashdata('success', 'Data absensi berhasil dihapus!');

        redirect('admin/absensi/history/' . $pendaftaran->batch_id);
    }

    /**
     * Mark all unrecorded as alpha for a batch on a specific date
     */
    public function absensi_auto_alpha($batch_id) {
        $tanggal = $this->input->get('tanggal') ? $this->input->get('tanggal') : date('Y-m-d');
        
        // Get all pendaftaran for this batch
        $pendaftaran_list = $this->Pendaftaran_model->get_by_batch($batch_id);
        
        // Get existing absensi for this date
        $existing = $this->Absensi_model->get_by_batch_date($batch_id, $tanggal);
        $recorded = [];
        foreach ($existing as $a) {
            $recorded[$a->pendaftaran_id] = true;
        }

        $count = 0;
        foreach ($pendaftaran_list as $p) {
            if (!isset($recorded[$p->id])) {
                $data = [
                    'pendaftaran_id' => $p->id,
                    'tanggal' => $tanggal,
                    'status_hadir' => 'alpha'
                ];
                $this->Absensi_model->create($data);
                $count++;
            }
        }

        if ($count > 0) {
            $this->session->set_flashdata('success', "$count peserta ditandai Alpha untuk tanggal $tanggal");
        } else {
            $this->session->set_flashdata('info', 'Semua peserta sudah memiliki status absensi untuk tanggal ini.');
        }

        redirect('admin/absensi/batch/' . $batch_id . '?tanggal=' . $tanggal);
    }

    // ==========================================
    // TUGAS
    // ==========================================

    public function tugas() {
        $search = $this->input->get('search');
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $data['title'] = 'Data Tugas';
        $data['tugas_list'] = $this->Tugas_model->get_all($limit, $offset, $search);
        $data['total'] = $this->Tugas_model->count_all($search);
        $data['search'] = $search;
        $data['page'] = $page;
        $data['total_pages'] = ceil($data['total'] / $limit);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/tugas/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function tugas_create() {
        $data['title'] = 'Tambah Tugas';
        $data['batches'] = $this->Batch_model->get_dropdown();
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/tugas/create', $data);
        $this->load->view('admin/layout/footer');
    }

    public function tugas_store() {
        $this->form_validation->set_rules('batch_id', 'Batch', 'required');
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deadline', 'Deadline', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'batch_id' => $this->input->post('batch_id'),
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'deadline' => $this->input->post('deadline')
            ];
            $this->Tugas_model->create($data);
            $this->session->set_flashdata('success', 'Tugas berhasil ditambahkan!');
            redirect('admin/tugas');
        } else {
            $this->tugas_create();
        }
    }

    public function tugas_edit($id) {
        $data['title'] = 'Edit Tugas';
        $data['tugas'] = $this->Tugas_model->get_by_id($id);
        $data['batches'] = $this->Batch_model->get_dropdown();
        
        if (!$data['tugas']) {
            $this->session->set_flashdata('error', 'Tugas tidak ditemukan!');
            redirect('admin/tugas');
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/tugas/edit', $data);
        $this->load->view('admin/layout/footer');
    }

    public function tugas_update($id) {
        $this->form_validation->set_rules('batch_id', 'Batch', 'required');
        $this->form_validation->set_rules('judul', 'Judul', 'required');
        $this->form_validation->set_rules('deadline', 'Deadline', 'required');

        if ($this->form_validation->run()) {
            $data = [
                'batch_id' => $this->input->post('batch_id'),
                'judul' => $this->input->post('judul'),
                'deskripsi' => $this->input->post('deskripsi'),
                'deadline' => $this->input->post('deadline')
            ];
            $this->Tugas_model->update($id, $data);
            $this->session->set_flashdata('success', 'Tugas berhasil diupdate!');
            redirect('admin/tugas');
        } else {
            $this->tugas_edit($id);
        }
    }

    public function tugas_delete($id) {
        $this->Tugas_model->delete($id);
        $this->session->set_flashdata('success', 'Tugas berhasil dihapus!');
        redirect('admin/tugas');
    }

    public function tugas_submissions($id) {
        $data['title'] = 'Pengumpulan Tugas';
        $data['tugas'] = $this->Tugas_model->get_by_id($id);
        
        if (!$data['tugas']) {
            $this->session->set_flashdata('error', 'Tugas tidak ditemukan!');
            redirect('admin/tugas');
        }

        $data['submissions'] = $this->Pengumpulan_tugas_model->get_by_tugas($id);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/tugas/submissions', $data);
        $this->load->view('admin/layout/footer');
    }

    // ==========================================
    // PENILAIAN
    // ==========================================

    public function penilaian() {
        $search = $this->input->get('search');
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $limit = 10;
        $offset = ($page - 1) * $limit;

        $data['title'] = 'Penilaian Tugas';
        $data['submissions'] = $this->Pengumpulan_tugas_model->get_all($limit, $offset, $search);
        $data['total'] = $this->Pengumpulan_tugas_model->count_all($search);
        $data['search'] = $search;
        $data['page'] = $page;
        $data['total_pages'] = ceil($data['total'] / $limit);

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/penilaian/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function penilaian_nilai($id) {
        $data['title'] = 'Beri Nilai';
        $data['submission'] = $this->Pengumpulan_tugas_model->get_by_id($id);
        
        if (!$data['submission']) {
            $this->session->set_flashdata('error', 'Pengumpulan tidak ditemukan!');
            redirect('admin/penilaian');
        }

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/penilaian/nilai', $data);
        $this->load->view('admin/layout/footer');
    }

    public function penilaian_store() {
        $id = $this->input->post('id');
        $nilai = $this->input->post('nilai');

        if ($nilai !== '' && $nilai >= 0 && $nilai <= 100) {
            $this->Pengumpulan_tugas_model->update($id, ['nilai' => $nilai]);
            $this->session->set_flashdata('success', 'Nilai berhasil disimpan!');
        } else {
            $this->session->set_flashdata('error', 'Nilai harus antara 0-100!');
        }

        redirect('admin/penilaian');
    }

    // ==========================================
    // REPORT
    // ==========================================

    public function report() {
        $data['title'] = 'Laporan';
        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/report/index', $data);
        $this->load->view('admin/layout/footer');
    }

    public function report_pendaftaran() {
        $data['title'] = 'Laporan Pendaftaran';
        $data['pendaftaran_list'] = $this->Pendaftaran_model->get_all();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/report/pendaftaran', $data);
        $this->load->view('admin/layout/footer');
    }

    public function report_absensi() {
        $data['title'] = 'Laporan Absensi';
        $data['absensi_list'] = $this->Absensi_model->get_all();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/report/absensi', $data);
        $this->load->view('admin/layout/footer');
    }

    public function report_nilai() {
        $data['title'] = 'Laporan Nilai';
        $data['nilai_list'] = $this->Pengumpulan_tugas_model->get_all();

        $this->load->view('admin/layout/header', $data);
        $this->load->view('admin/report/nilai', $data);
        $this->load->view('admin/layout/footer');
    }

    public function report_export($type) {
        $this->load->library('Excel_lib');
        
        switch ($type) {
            case 'pendaftaran':
                $data = $this->Pendaftaran_model->get_all();
                $this->excel_lib->export_pendaftaran('laporan_pendaftaran_' . date('Ymd'), $data);
                break;
            case 'absensi':
                $data = $this->Absensi_model->get_all();
                $headers = ['No', 'Peserta', 'Bootcamp', 'Batch', 'Tanggal', 'Status'];
                $rows = [];
                $no = 1;
                foreach ($data as $row) {
                    $rows[] = [
                        $no++,
                        $row->peserta_nama,
                        $row->bootcamp_nama,
                        $row->nama_batch,
                        date('d-m-Y', strtotime($row->tanggal)),
                        ucfirst($row->status_hadir)
                    ];
                }
                $this->excel_lib->export_report('laporan_absensi_' . date('Ymd'), 'Laporan Absensi', $headers, $rows);
                break;
            case 'nilai':
                $data = $this->Pengumpulan_tugas_model->get_all();
                $headers = ['No', 'Peserta', 'Bootcamp', 'Tugas', 'Nilai', 'Tanggal Upload'];
                $rows = [];
                $no = 1;
                foreach ($data as $row) {
                    $rows[] = [
                        $no++,
                        $row->peserta_nama,
                        $row->bootcamp_nama,
                        $row->tugas_judul,
                        $row->nilai ?? 'Belum Dinilai',
                        date('d-m-Y H:i', strtotime($row->created_at))
                    ];
                }
                $this->excel_lib->export_report('laporan_nilai_' . date('Ymd'), 'Laporan Nilai', $headers, $rows);
                break;
            default:
                $this->session->set_flashdata('error', 'Tipe export tidak valid!');
                redirect('admin/report');
        }
    }

    /**
     * Export Report to PDF
     */
    public function report_export_pdf($type) {
        $this->load->library('Pdf_lib');
        
        switch ($type) {
            case 'pendaftaran':
                $data = $this->Pendaftaran_model->get_all();
                $this->pdf_lib->export_pendaftaran('laporan_pendaftaran_' . date('Ymd'), $data);
                break;
            case 'absensi':
                $data = $this->Absensi_model->get_all();
                $this->pdf_lib->export_absensi('laporan_absensi_' . date('Ymd'), $data);
                break;
            case 'nilai':
                $data = $this->Pengumpulan_tugas_model->get_all();
                $this->pdf_lib->export_nilai('laporan_nilai_' . date('Ymd'), $data);
                break;
            default:
                $this->session->set_flashdata('error', 'Tipe export tidak valid!');
                redirect('admin/report');
        }
    }
}
