<?php defined('BASEPATH') or exit('No direct script access allowed');
class search_pesanan extends CI_Model
{
    public function search($keyword) {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('idKonsumen', 'idKonsumen');
        $this->db->group_start();
        $this->db->like('idInvoice', $keyword);
        $this->db->or_like('namKonsumen', $keyword);
        $this->db->or_like('alamat', $keyword);
        $this->db->or_like('tgl_pesan', $keyword);
        $this->db->group_end();
        return $this->db->get()->result();
    }
}