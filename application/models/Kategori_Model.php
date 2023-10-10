<?php defined('BASEPATH') or exit('No direct script access allowed');
class Kategori_model extends CI_Model
{
    public function getDataKategori()
    {
        return $this->db->get('tbl_kategori')->result();
    }

    public function insertKategori($data)
    {
        $this->db->insert('tbl_kategori', $data);
        return $this->db->insert_id();
    }
    function getDataKategoriDetail($idKat)
    {
        $this->db->where('idKat', $idKat);
        $query = $this->db->get('tbl_kategori');
        return $query->row();
    }
    function updateDataKategori($idKat, $data)
    {
        $this->db->where('idKat', $idKat);
        $this->db->update('tbl_kategori', $data);
    }
    function deleteDataKategori($idKat)
    {
        $this->db->where('idKat', $idKat);
        $this->db->delete('tbl_kategori');
    }
    public function search($keyword) {
        $this->db->select('*'); 
        $this->db->from('tbl_kategori');
        $this->db->like('idKat', $keyword);
        $this->db->or_like('namaKat', $keyword);
        return $this->db->get()->result();
    }

}
