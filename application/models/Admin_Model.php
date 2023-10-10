<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Model extends CI_Model
{
    function getDataAdmin()
    {
        $query = $this->db->get('tbl_admin');
        return $query->result();
    }

    function insertDataAdmin($data)
    {
        $this->db->insert('tbl_admin', $data);
    }

    function getDataAdminDetail($idAdmin)
    {
        $this->db->where('idAdmin', $idAdmin);
        $query = $this->db->get('tbl_admin');
        return $query->row();
    }
    function updateDataAdmin($idAdmin, $data)
    {
        $this->db->where('idAdmin', $idAdmin);
        $this->db->update('tbl_admin', $data);
    }
    function deleteDataAdmin($idAdmin)
    {
        $this->db->where('idAdmin', $idAdmin);
        $this->db->delete('tbl_admin');
    }
    public function search($keyword) {
        $this->db->select('*'); 
        $this->db->from('tbl_admin');
        $this->db->like('username', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get()->result();
    }
}
