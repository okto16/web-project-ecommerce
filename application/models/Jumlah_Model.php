<?php defined('BASEPATH') or exit('No direct script access allowed');

class Jumlah_Model extends CI_Model
{
    function total_barang()
    {
        return $this->db->get('tbl_produk')->num_rows();
    }
    function total_member()
    {
        return $this->db->get('tbl_member')->num_rows();
    }
    function total_pesanan()
    {
        $this->db->where('status', 'pending');
        return $this->db->get('invoice')->num_rows();
    }
}