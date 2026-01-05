<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * User Controller
 * Handles all user/peserta functionality
 */
class User extends CI_Controller {

    protected $peserta_id;

    public function __construct() {
        parent::__construct();
        
        // Check if logged in and is user
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') != 'user') {
            $this->session->set_flashdata('error', 'Akses ditolak! Silakan login sebagai peserta.');
            redirect('login');
        }

        $this->peserta_id = $this->session->userdata('peserta_id');

        // Load all models
        $this->load->model('User_model');
        $this->load->model('Peserta_model');
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
        $data['title'] = 'Dashboard Peserta';
        $data['pendaftaran'] = $this->Pendaftaran_model->get_by_peserta($this->peserta_id);
        $data['tugas_list'] = $this->Tugas_model->get_by_peserta($this->peserta_id);
        $data['nilai_summary'] = $this->Pengumpulan_tugas_model->get_nilai_summary($this->peserta_id);
        
        // Count stats for dashboard
        $data['bootcamp_diikuti'] = count($data['pendaftaran']);
        $data['my_bootcamps'] = $data['pendaftaran'];
        
        // Count pending and completed tasks
        $pending = 0;
        $selesai = 0;
        foreach ($data['tugas_list'] as $tugas) {
            if ($tugas->submission_id) {
                $selesai++;
            } elseif (strtotime($tugas->deadline) >= strtotime(date('Y-m-d'))) {
                $pending++;
            }
        }
        $data['tugas_pending'] = $pending;
        $data['tugas_selesai'] = $selesai;
        
        // Average score
        $data['nilai_rata'] = isset($data['nilai_summary']->rata_rata) ? $data['nilai_summary']->rata_rata : null;

        $this->load->view('user/layout/header', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('user/layout/footer');
    }

    /**
     * Available bootcamps
     */
    public function bootcamp() {
        $data['title'] = 'Daftar Bootcamp';
        $data['batches'] = $this->Batch_model->get_active();
        
        // Check which batches already registered
        $registered = [];
        foreach ($this->Pendaftaran_model->get_by_peserta($this->peserta_id) as $p) {
            $registered[] = $p->batch_id;
        }
        $data['registered'] = $registered;

        $this->load->view('user/layout/header', $data);
        $this->load->view('user/bootcamp/index', $data);
        $this->load->view('user/layout/footer');
    }

    /**
     * Bootcamp detail
     */
    public function bootcamp_detail($batch_id) {
        $data['title'] = 'Detail Bootcamp';
        $data['batch'] = $this->Batch_model->get_by_id($batch_id);
        
        if (!$data['batch']) {
            $this->session->set_flashdata('error', 'Bootcamp tidak ditemukan!');
            redirect('user/bootcamp');
        }

        $data['is_registered'] = $this->Pendaftaran_model->is_registered($this->peserta_id, $batch_id);

        $this->load->view('user/layout/header', $data);
        $this->load->view('user/bootcamp/detail', $data);
        $this->load->view('user/layout/footer');
    }

    /**
     * Register to bootcamp batch
     */
    public function daftar($batch_id) {
        // Check if batch exists
        $batch = $this->Batch_model->get_by_id($batch_id);
        if (!$batch) {
            $this->session->set_flashdata('error', 'Batch tidak ditemukan!');
            redirect('user/bootcamp');
        }

        // Check if already registered
        if ($this->Pendaftaran_model->is_registered($this->peserta_id, $batch_id)) {
            $this->session->set_flashdata('error', 'Anda sudah terdaftar di batch ini!');
            redirect('user/bootcamp');
        }

        // Create pendaftaran
        $data = [
            'peserta_id' => $this->peserta_id,
            'batch_id' => $batch_id,
            'tanggal_daftar' => date('Y-m-d')
        ];
        $this->Pendaftaran_model->create($data);

        $this->session->set_flashdata('success', 'Pendaftaran berhasil! Anda telah terdaftar di ' . $batch->bootcamp_nama . ' - ' . $batch->nama_batch);
        redirect('user/pendaftaran');
    }

    /**
     * My registrations
     */
    public function pendaftaran() {
        $data['title'] = 'Bootcamp Saya';
        $data['pendaftaran'] = $this->Pendaftaran_model->get_by_peserta($this->peserta_id);

        $this->load->view('user/layout/header', $data);
        $this->load->view('user/pendaftaran/index', $data);
        $this->load->view('user/layout/footer');
    }

    /**
     * My tasks
     */
    public function tugas() {
        $data['title'] = 'Tugas Saya';
        $data['tugas_list'] = $this->Tugas_model->get_by_peserta($this->peserta_id);

        $this->load->view('user/layout/header', $data);
        $this->load->view('user/tugas/index', $data);
        $this->load->view('user/layout/footer');
    }

    /**
     * Task detail
     */
    public function tugas_detail($id) {
        $data['title'] = 'Detail Tugas';
        $data['tugas'] = $this->Tugas_model->get_by_id($id);
        
        if (!$data['tugas']) {
            $this->session->set_flashdata('error', 'Tugas tidak ditemukan!');
            redirect('user/tugas');
        }

        $data['submission'] = $this->Pengumpulan_tugas_model->is_submitted($id, $this->peserta_id);

        $this->load->view('user/layout/header', $data);
        $this->load->view('user/tugas/detail', $data);
        $this->load->view('user/layout/footer');
    }

    /**
     * Upload task form
     */
    public function tugas_upload($id) {
        $data['title'] = 'Upload Tugas';
        $data['tugas'] = $this->Tugas_model->get_by_id($id);
        
        if (!$data['tugas']) {
            $this->session->set_flashdata('error', 'Tugas tidak ditemukan!');
            redirect('user/tugas');
        }

        $data['submission'] = $this->Pengumpulan_tugas_model->is_submitted($id, $this->peserta_id);

        $this->load->view('user/layout/header', $data);
        $this->load->view('user/tugas/upload', $data);
        $this->load->view('user/layout/footer');
    }

    /**
     * Submit task
     */
    public function tugas_submit() {
        $tugas_id = $this->input->post('tugas_id');
        
        // Check if tugas exists
        $tugas = $this->Tugas_model->get_by_id($tugas_id);
        if (!$tugas) {
            $this->session->set_flashdata('error', 'Tugas tidak ditemukan!');
            redirect('user/tugas');
        }

        // Upload file configuration
        $config['upload_path'] = './uploads/tugas/';
        $config['allowed_types'] = '*'; // Allow all types, we validate extension manually
        $config['max_size'] = 10240; // 10MB
        $config['file_name'] = 'tugas_' . $tugas_id . '_' . $this->peserta_id . '_' . time();

        // Allowed extensions for manual validation
        $allowed_ext = ['pdf', 'doc', 'docx', 'zip', 'rar', 'jpg', 'jpeg', 'png', 'xlsx', 'xls', 'ppt', 'pptx', 'txt'];

        // Create upload directory if not exists
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        // Manual extension check before upload
        if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
            $file_ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
            if (!in_array($file_ext, $allowed_ext)) {
                $this->session->set_flashdata('error', 'Tipe file tidak diizinkan! Hanya: ' . implode(', ', $allowed_ext));
                redirect('user/tugas/detail/' . $tugas_id);
                return;
            }
        }

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file')) {
            $file_data = $this->upload->data();
            $file_path = 'uploads/tugas/' . $file_data['file_name'];

            // Check if resubmitting
            $existing = $this->Pengumpulan_tugas_model->is_submitted($tugas_id, $this->peserta_id);
            
            if ($existing) {
                // Delete old file
                if (file_exists('./' . $existing->file_path)) {
                    unlink('./' . $existing->file_path);
                }
                // Update submission
                $this->Pengumpulan_tugas_model->update($existing->id, [
                    'file_path' => $file_path,
                    'nilai' => null // Reset nilai on resubmit
                ]);
                $this->session->set_flashdata('success', 'Tugas berhasil diupload ulang!');
            } else {
                // Create new submission
                $data = [
                    'tugas_id' => $tugas_id,
                    'peserta_id' => $this->peserta_id,
                    'file_path' => $file_path
                ];
                $this->Pengumpulan_tugas_model->create($data);
                $this->session->set_flashdata('success', 'Tugas berhasil dikumpulkan!');
            }
        } else {
            $this->session->set_flashdata('error', $this->upload->display_errors('', ''));
        }

        redirect('user/tugas/detail/' . $tugas_id);
    }

    /**
     * My attendance
     */
    public function absensi() {
        $data['title'] = 'Absensi Saya';
        $data['absensi_list'] = $this->Absensi_model->get_by_peserta($this->peserta_id);

        $this->load->view('user/layout/header', $data);
        $this->load->view('user/absensi/index', $data);
        $this->load->view('user/layout/footer');
    }

    /**
     * My grades
     */
    public function nilai() {
        $data['title'] = 'Nilai Saya';
        $data['nilai_list'] = $this->Pengumpulan_tugas_model->get_by_peserta($this->peserta_id);
        $data['summary'] = $this->Pengumpulan_tugas_model->get_nilai_summary($this->peserta_id);

        $this->load->view('user/layout/header', $data);
        $this->load->view('user/nilai/index', $data);
        $this->load->view('user/layout/footer');
    }

    /**
     * Profile
     */
    public function profil() {
        $data['title'] = 'Profil Saya';
        $data['peserta'] = $this->Peserta_model->get_by_user_id($this->session->userdata('user_id'));

        $this->load->view('user/layout/header', $data);
        $this->load->view('user/profil/index', $data);
        $this->load->view('user/layout/footer');
    }

    /**
     * Update profile
     */
    public function profil_update() {
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required');

        if ($this->form_validation->run()) {
            $user_id = $this->session->userdata('user_id');
            
            // Update user
            $user_data = ['name' => $this->input->post('name')];
            if ($this->input->post('password')) {
                $user_data['password'] = $this->input->post('password');
            }
            $this->User_model->update($user_id, $user_data);

            // Update peserta
            $peserta = $this->Peserta_model->get_by_user_id($user_id);
            $this->Peserta_model->update($peserta->id, ['no_hp' => $this->input->post('no_hp')]);

            // Update session
            $this->session->set_userdata('name', $this->input->post('name'));

            $this->session->set_flashdata('success', 'Profil berhasil diupdate!');
        } else {
            $this->session->set_flashdata('error', validation_errors());
        }

        redirect('user/profil');
    }
}
