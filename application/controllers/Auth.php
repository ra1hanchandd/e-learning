<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth Controller
 * Handles login, logout, and registration
 */
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Peserta_model');
    }

    /**
     * Default - redirect to login
     */
    public function index() {
        // If already logged in, redirect to dashboard
        if ($this->session->userdata('logged_in')) {
            $role = $this->session->userdata('role');
            redirect($role == 'admin' ? 'admin/dashboard' : 'user/dashboard');
        }
        redirect('login');
    }

    /**
     * Login page and process
     */
    public function login() {
        // If already logged in, redirect
        if ($this->session->userdata('logged_in')) {
            $role = $this->session->userdata('role');
            redirect($role == 'admin' ? 'admin/dashboard' : 'user/dashboard');
        }

        // Process login form
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run()) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');

                // Get user by email
                $user = $this->User_model->get_by_email($email);

                if ($user && $this->User_model->verify_password($password, $user->password)) {
                    // Set session data
                    $session_data = [
                        'user_id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role,
                        'logged_in' => TRUE
                    ];

                    // If user role, get peserta_id
                    if ($user->role == 'user') {
                        $peserta = $this->Peserta_model->get_by_user_id($user->id);
                        if ($peserta) {
                            $session_data['peserta_id'] = $peserta->id;
                        }
                    }

                    $this->session->set_userdata($session_data);
                    $this->session->set_flashdata('success', 'Login berhasil! Selamat datang, ' . $user->name);

                    // Redirect based on role
                    redirect($user->role == 'admin' ? 'admin/dashboard' : 'user/dashboard');
                } else {
                    $this->session->set_flashdata('error', 'Email atau password salah!');
                }
            }
        }

        $data['title'] = 'Login - E-Learning Bootcamp';
        $this->load->view('auth/login', $data);
    }

    /**
     * Register page and process (for new users/peserta)
     */
    public function register() {
        // If already logged in, redirect
        if ($this->session->userdata('logged_in')) {
            redirect('user/dashboard');
        }

        // Process registration form
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'Nama', 'required|min_length[3]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');
            $this->form_validation->set_rules('no_hp', 'No. HP', 'required');

            if ($this->form_validation->run()) {
                // Create user
                $user_data = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'role' => 'user'
                ];
                $user_id = $this->User_model->create($user_data);

                // Create peserta profile
                $peserta_data = [
                    'user_id' => $user_id,
                    'no_hp' => $this->input->post('no_hp')
                ];
                $this->Peserta_model->create($peserta_data);

                $this->session->set_flashdata('success', 'Registrasi berhasil! Silakan login.');
                redirect('login');
            }
        }

        $data['title'] = 'Register - E-Learning Bootcamp';
        $this->load->view('auth/register', $data);
    }

    /**
     * Logout
     */
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
