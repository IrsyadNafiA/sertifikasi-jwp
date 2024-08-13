<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');

        if ($this->session->userdata('user_data') == '') {
            redirect(base_url('auth/login'));
        }

        date_default_timezone_set("Asia/Jakarta");
    }

    public function index()
    {
        // DATA WAJIB
        $data['title'] = 'Dashboard';
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }

    public function EditProfil()
    {
        // DATA WAJIB
        $data['title'] = 'Edit Profil';
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);

        if (!isset($_POST['submit'])) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/editProfil', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'no_hp' => $this->input->post('no_hp'),
                'kelas' => $this->input->post('kelas'),
            ];

            $this->db->update('users', $data, ['username' => $session['user_data']['username']]);
            redirect(base_url('dashboard/editprofil'));
        }
    }

    public function DataUser()
    {
        $data['title'] = 'Data User';
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);

        // DATA TAMBAHAN
        $data['customJs'] = ['dataUserJs'];
        $data['userData'] = $this->Main_model->getAllUser();

        if (!isset($_POST['submit'])) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/dataUser', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('username'), PASSWORD_DEFAULT),
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'no_hp' => $this->input->post('no_hp'),
                'kelas' => $this->input->post('kelas'),
                'role' => $this->input->post('role'),
            ];

            $this->db->insert('users', $data);
            redirect(base_url('dashboard/datauser'));
        }
    }

    public function Kantin()
    {
        $data['title'] = 'Kantin';
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);

        $data['pemilik'] = $this->Main_model->getUserByRole(2);
        $data['kantin'] = $this->Main_model->getAllKantin();

        if (!isset($_POST['submit'])) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/kantin', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'pemilik' => $this->input->post('pemilik'),
            ];

            $this->db->insert('kantin', $data);
            redirect(base_url('dashboard/kantin'));
        }
    }

    public function DetailKantin($pemilik)
    {
        $data['title'] = 'Detail Kantin';
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);

        $data['menu'] = $this->Main_model->getMenuByKantin($pemilik);
        $data['kantin'] = $this->Main_model->getKantinByPemilik($pemilik);

        if (!isset($_POST['submit'])) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('dashboard/detailKantin', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kantin_id' => $data['kantin']['id'],
                'nama' => $this->input->post('nama'),
                'deskripsi' => $this->input->post('deskripsi'),
                'harga' => $this->input->post('harga'),
            ];

            $this->db->insert('menus', $data);
            redirect(base_url('dashboard/detailkantin/' . $pemilik));
        }
    }

    public function EditMenu($id)
    {
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);

        $data = [
            'nama' => $this->input->post('nama'),
            'deskripsi' => $this->input->post('deskripsi'),
            'harga' => $this->input->post('harga'),
        ];

        $this->db->update('menus', $data, ['id' => $id]);
        redirect(base_url('dashboard/detailkantin/' . $data['user']['username']));
    }

    public function DeleteMenu($id)
    {
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);

        $this->db->delete('menus', ['id' => $id]);
        redirect(base_url('dashboard/detailkantin/' . $data['user']['username']));
    }
}
