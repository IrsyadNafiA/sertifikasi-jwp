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
}
