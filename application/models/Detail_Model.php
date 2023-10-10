<?php defined('BASEPATH') or exit('No direct script access allowed');

class Detail_Model extends CI_Model
{
    public function insertDetailOrder($data)
    {
        $this->db->insert('tbl_detail_order', $data);
    }
    public function getOrderDetail($idInvoice) {
        $this->db->where('idInvoice', $idInvoice);
        return $this->db->get('tbl_detail_order')->result();
    }
    function getdataOrderDetail($idInvoice)
    {
        $this->db->where('idInvoice', $idInvoice);
        $query = $this->db->get('tbl_detail_order');
        return $query->row();
    }
    public function updateDataDetail($idInvoice, $jumlahReturn)
    {
        $this->db->where('idInvoice', $idInvoice);
        $this->db->update('tbl_detail_order', $jumlahReturn);
    }
    
}