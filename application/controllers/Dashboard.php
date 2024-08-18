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

        $data['pesanan'] = ($data['user']['role'] == '2') ? $this->Main_model->getPesananByKantin($data['user']['username']) : $this->Main_model->getPesananByUser($session['user_data']['username'], 3, 0);
        $data['kantin'] = $this->Main_model->getAllKantin();

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

        // DATA TAMBAHAN
        $data['customJs'] = ['editProfilJs'];

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

    public function editPicture()
    {
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);
        // $data['customJs'] = 'sweetAlertJs';

        $username = $this->input->post('username');

        $upload_image = $_FILES['profile_picture']['name'];

        if ($upload_image) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = '2048';
            $config['upload_path'] = './assets/img/profile_picture/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('profile_picture')) {
                $old_image = $data['user']['profile_picture'];

                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/img/profile/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('profile_picture', $new_image);
            } else {
                $this->session->set_flashdata('message', ['icon' => 'error', 'title' => 'Failed', 'text' => 'Failed to change profile picture']);
            }
        }
        $this->db->set('username', $username);
        $this->db->where('username', $username);
        $this->db->update('users');
        $this->session->set_flashdata('message', ['icon' => 'success', 'title' => 'Success', 'text' => 'Successfully change profile picture']);
        redirect(base_url('dashboard/editprofil'));
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

        // print_r($data['menu']);
        // die;

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
        redirect($this->agent->referrer());
    }

    public function DeleteMenu($id)
    {
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);

        $this->db->delete('menus', ['id' => $id]);
        redirect($this->agent->referrer());
    }

    public function PesanMenu($id)
    {
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);

        $jumlah = $this->input->post('jumlah');
        $harga_awal = $this->input->post('harga');
        $harga = $harga_awal * $jumlah;

        $data = [
            'kantin_id' => $this->input->post('kantin_id'),
            'nama_menu' => $this->input->post('nama_menu'),
            'nama_pemesan' => $this->input->post('nama_pemesan'),
            'username' => $this->input->post('username'),
            'jumlah' => $this->input->post('jumlah'),
            'tanggal_pemesanan' => date('Y-m-d H:i:s'),
            'harga' => $harga,
            'status' => 'waiting',
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // die;

        $this->db->insert('pesanan', $data);
        redirect($this->agent->referrer());
    }

    public function Pesanan()
    {
        // DATA WAJIB
        $data['title'] = 'Pesanan';
        $session = $this->session->userdata();
        $data['user'] = $this->Main_model->getUserData($session['user_data']['username']);

        // DATA TAMBAHAN
        $data['customJs'] = ['pesananJs'];
        $data['pesanan'] = ($data['user']['role'] == '2') ? $this->Main_model->getPesananByKantin($data['user']['username']) : $this->Main_model->getPesananByUser($data['user']['username']);

        // echo '<pre>';
        // print_r($data['pesanan']);
        // echo '</pre>';
        // die;

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/pesanan', $data);
        $this->load->view('templates/footer');
    }

    public function ApprovalPesanan($id)
    {
        $data = [
            'status' => $this->input->post('status'),
            'informasi' => $this->input->post('informasi'),
        ];

        $this->db->update('pesanan', $data, ['id' => $id]);
        redirect($this->agent->referrer());
    }
}
