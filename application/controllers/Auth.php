<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Main_model');
    }

    public function index()
    {
        $this->load->view('auth/index');
    }

    public function Login()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        $data['customJs'] = 'sweetAlertJs';

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login', $data);
        } else {
            $username = $this->input->post('username', true);
            $password = $this->input->post('password', true);

            $user = $this->Main_model->getUserData($username);
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $this->session->set_userdata([
                        'username' => $user['username'],
                        'nama_lengkap' => $user['nama_lengkap'],
                        'no_hp' => $user['no_hp'],
                        'kelas' => $user['kelas'],
                        'role' => $user['role'],
                        'user_data' => ['username' => $user['username']],
                    ]);
                    redirect(base_url('dashboard'));
                } else {
                    $this->session->set_flashdata('error', 'Wrong Password');
                    redirect(base_url('auth/login'));
                }
            } else {
                $this->session->set_flashdata('error', 'Username Not Found');
                redirect(base_url('auth/login'));
            }
        }
    }

    public function Register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('confirm_password', 'Password', 'required|trim');
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No. HP', 'required|trim');
        $this->form_validation->set_rules('kelas', 'kelas', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/register');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');

            $username_check = $this->Main_model->getUserData($username);

            if ($username_check) {
                $this->session->set_flashdata('error', 'Username sudah terdaftar');
                redirect(base_url('auth/register'));
            } else {
                if ($password == $confirm_password) {
                    $data = [
                        'username' => $this->input->post('username'),
                        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                        'nama_lengkap' => $this->input->post('nama_lengkap'),
                        'no_hp' => $this->input->post('no_hp'),
                        'kelas' => $this->input->post('kelas'),
                        'role' => 3,
                        'profile_picture' => 'default.png',
                    ];
                    $this->db->insert('users', $data);

                    $this->session->set_flashdata('message', ['icon' => 'success', 'title' => 'Berhasil', 'text' => 'Akun berhasil dibuat!']);
                    redirect(base_url('auth/login'));
                } else {
                    $this->session->set_flashdata('error', 'Password tidak cocok');
                    redirect(base_url('auth/register'));
                }
            }
        }
    }

    public function Logout()
    {
        $this->session->unset_userdata(['username', 'nama_lengkap', 'no_hp', 'kelas', 'role', 'user_data']);
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }

    public function ChangePassword()
    {
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('confirm_password', 'Password', 'required|trim');

        if ($this->form_validation->run() == true) {
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            $username = $this->input->post('username');
            if ($password != $confirm_password) {
                $this->session->set_flashdata('error', 'Password tidak cocok');
                redirect(base_url('dashboard/changepassword'));
            } else {
                $data = [
                    'password' => password_hash($password, PASSWORD_DEFAULT)
                ];
                $this->db->where('username', $username);
                $this->db->update('users', $data);
                redirect(base_url('auth/logout'));
            }
        }
    }
}
