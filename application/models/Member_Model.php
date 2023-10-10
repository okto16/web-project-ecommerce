<?php defined('BASEPATH') or exit('No direct script access allowed');

class Member_Model extends CI_Model
{
    function getDataMember()
    {
        $query = $this->db->get('tbl_member');
        return $query->result();
    }
    function getDataMemberDetail($idKonsumen)
    {
        $this->db->where('idKonsumen', $idKonsumen);
        $query = $this->db->get('tbl_member');
        return $query->row();
    }
    function updateDataMember($idKonsumen, $data)
    {
        $this->db->where('idKonsumen', $idKonsumen);
        $this->db->update('tbl_member', $data);
    }
    function deleteDataMember($idKonsumen)
    {
        $this->db->where('idKonsumen', $idKonsumen);
        $this->db->delete('tbl_member');
    }
    public function search($keyword) {
        $this->db->select('*'); 
        $this->db->from('tbl_Member');
        $this->db->like('idKonsumen', $keyword);
        $this->db->or_like('username', $keyword);
        $this->db->or_like('namaKonsumen', $keyword);
        $this->db->or_like('email', $keyword);
        $this->db->or_like('alamat', $keyword);
        return $this->db->get()->result();
    }
    
}