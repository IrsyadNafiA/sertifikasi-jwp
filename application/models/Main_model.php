<?php
class Main_model extends CI_model
{
    public function getUserData($username)
    {
        return $this->db->get_where('users', ['username' => $username])->row_array();
    }

    public function getAllUser()
    {
        return $this->db->get('users')->result_array();
    }

    public function getUserByRole($role)
    {
        return $this->db->get_where('users', ['role' => $role])->result_array();
    }

    public function getAllKantin()
    {
        return $this->db->get('kantin')->result_array();
    }

    public function getMenuByKantin($kantin)
    {
        $this->db->select('menus.*');
        $this->db->from('menus');
        $this->db->join('kantin', 'kantin.id = menus.kantin_id');
        $this->db->where('kantin.pemilik', $kantin);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getKantinByPemilik($pemilik)
    {
        return $this->db->get_where('kantin', ['pemilik' => $pemilik])->row_array();
    }

    public function getPesananByKantin($kantin, $limit = null, $offset = null)
    {
        $this->db->select('pesanan.*');
        // $this->db->select('kantin.*');
        // $this->db->from('kantin.nama as nama_kantin');
        $this->db->from('pesanan');
        $this->db->join('kantin', 'kantin.id = pesanan.kantin_id');
        $this->db->where('kantin.pemilik', $kantin);
        $this->db->order_by('pesanan.id', 'DESC');

        if (!is_null($limit) && $limit > 0) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPesananByUser($user, $limit = null, $offset = null)
    {
        $this->db->select('pesanan.*');
        $this->db->from('pesanan');
        $this->db->join('kantin', 'kantin.id = pesanan.kantin_id');
        $this->db->where('pesanan.username', $user);
        $this->db->order_by('pesanan.id', 'DESC');

        if (!is_null($limit) && $limit > 0) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result_array();
    }
}
