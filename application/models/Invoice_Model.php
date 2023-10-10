<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {

    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $namaKonsumen = $this->input->post('namaKonsumen');
        $alamat = $this->input->post('alamat');

        $invoice = array (

            'namaKonsumen' => $namaKonsumen,
            'alamat' => $alamat,
            'tgl_pesan' => date('Y-m-d H:i:s'),
            'batas_bayar' => date('Y-m-d H:i:s', mktime(date('H'),date('i'),date('s'),date('m'),date('d') + 1,date('Y'))),
        );
        $this->db->insert('tbl_Invoice', $invoice);
        $idInvoice = $this->db->insert_id();
        foreach ($this->cart->contents() as $items){
            $data = array(
                'idInvoice' => $idInvoice,
                'idProduk' => $items['id'],
                'namProduk' => $items['name'],
                'jumlah' => $items['qty'],
                'harga' => $items['price'],

            );
            $this->db->insert('tbl_order', $data);

        }
        return TRUE;
    }
    public function tampil_data()
    {
        $result = $this->db->get('tbl_Invoice');
        if($result->num_rows() > 0){
            return $result->result();
        }else {
            return false;
        }
    }
}