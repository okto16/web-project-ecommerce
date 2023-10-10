<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Order_Model extends CI_Model
{
    function insertInvoice($data)
    {
        $data['status'] = 'pending';
        $this->db->insert('invoice', $data);
        return $this->db->insert_id();
    }

    function getPendingInvoices()
    {
        $this->db->where('status', 'pending');
        $this->db->order_by('tgl_pesan', 'desc');
        return $this->db->get('invoice')->result();
    }

    function approveInvoice($idInvoice)
    {
        $this->db->where('idInvoice', $idInvoice);
        $this->db->update('invoice', array('status' => 'success'));
    }
    function payInvoice($idInvoice, $data)
    {
        $this->db->where('idInvoice', $idInvoice);
        $this->db->update('invoice', $data);
    }
    function ditolakInvoice($idInvoice)
    {
        $this->db->where('idInvoice', $idInvoice);
        $this->db->update('invoice', array('status' => 'gagal'));
    }
    function getapproveInvoice()
    {
        $this->db->where('status', 'success');
        $this->db->order_by('tgl_pesan', 'desc');
        return $this->db->get('invoice')->result();
    }
    function getapproveInvoiceDetail()
    {
        $this->db->where('status', 'success');
        $this->db->order_by('tgl_pesan', 'desc');
        $query = $this->db->get('invoice');
        return $query->row();
    }
    function getInvoiceDetail($idInvoice)
    {
        $this->db->where('idInvoice', $idInvoice);
        $query = $this->db->get('invoice');
        return $query->row();
    }
    public function insert_invoice($data)
    {

        $this->db->insert('invoice', $data);
        return $this->db->insert_id(); // Mengembalikan ID invoice yang baru di-generate
    }
    public function insert_order($data)
    {
        $this->db->insert('tbl_detail_order', $data);
    }
    public function updateTotalHarga($idInvoice, $newTotalHarga)
    {
        $this->db->where('idInvoice', $idInvoice);
        $this->db->update('invoice', array('total_harga' => $newTotalHarga));
    }
    public function updateTotalHargaDetail($idInvoice, $newTotalHarga)
    {
        $this->db->where('idInvoice', $idInvoice);
        $this->db->update('tbl_detail_order', array('total_harga' => $newTotalHarga));
    }
    public function getTransaksiByMember($idKonsumen)
    {
        $this->db->where('idKonsumen', $idKonsumen);
        $this->db->order_by('tgl_pesan', 'desc');
        return $this->db->get('invoice')->result();
    }
    function getPesananByDateRange($tanggal_awal, $tanggal_akhir)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('tgl_pesan >=', $tanggal_awal);
        $this->db->where('tgl_pesan <=', $tanggal_akhir);
        return $this->db->get()->result();
    }
    public function getDetailOrder($idInvoice, $idProduk) {
        $this->db->select('*');
        $this->db->from('tbl_detail_order');
        $this->db->where('idInvoice', $idInvoice);
        $this->db->where('idProduk', $idProduk);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null; 
        }
    }

    public function updateDetailOrder($idInvoice, $idProduk, $newJumlahProduk) {
        $this->db->where('idInvoice', $idInvoice);
        $this->db->where('idProduk', $idProduk);
        $this->db->update('tbl_detail_order', array('jumlah' => $newJumlahProduk));
        
       
        return $this->db->affected_rows() > 0;
    }
    public function getInvoiceById($idInvoice) {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('idInvoice', $idInvoice);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // Ambil data pesanan
            $invoice = $query->row();

            // Ambil item pesanan terkait
            $this->db->select('*');
            $this->db->from('tbl_detail_order');
            $this->db->where('idInvoice', $idInvoice);
            $itemQuery = $this->db->get();

            if ($itemQuery->num_rows() > 0) {
                $invoice->items = $itemQuery->result();
            } else {
                $invoice->items = array();
            }

            return $invoice;
        } else {
            return null; // Pesanan tidak ditemukan
        }
    }
    public function search($keyword)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('status', 'pending');
        $this->db->group_start();
        $this->db->like('idInvoice', $keyword);
        $this->db->or_like('namKonsumen', $keyword);
        $this->db->or_like('alamat', $keyword);
        $this->db->or_like('tgl_pesan', $keyword);
        $this->db->group_end();
        return $this->db->get()->result();
    }
}
