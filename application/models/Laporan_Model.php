<?php defined('BASEPATH') or exit('No direct script access allowed');
class Laporan_model extends CI_Model
{
    function getLaporanByDateRange($tanggal_awal, $tanggal_akhir)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('tgl_pesan >=', $tanggal_awal);
        $this->db->where('tgl_pesan <=', $tanggal_akhir);
        $this->db->where('status', 'success');
        return $this->db->get()->result();
    }

    public function search($keyword)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('status', 'success');
        $this->db->group_start();
        $this->db->like('idInvoice', $keyword);
        $this->db->or_like('namKonsumen', $keyword);
        $this->db->or_like('alamat', $keyword);
        $this->db->or_like('tgl_pesan', $keyword);
        $this->db->group_end();
        return $this->db->get()->result();
    }
}