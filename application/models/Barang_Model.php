<?php defined('BASEPATH') or exit('No direct script access allowed');

class Barang_Model extends CI_Model
{
    function getDataBarang()
    {
        $query = $this->db->get('tbl_Produk');
        return $query->result();
    }
    public function getallBarang()
    {
        return $this->db->get('tbl_produk')->result();
    }

    function getDataBarangDetail($idKat)
    {
        $this->db->where('idKat', $idKat);
        $query = $this->db->get('tbl_Produk');
        return $query->row();
    }
}
