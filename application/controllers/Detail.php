<?php

class Detail extends CI_Controller
{
    public function __construct()
        {
            parent::__construct();
            $this->load->model('Detail_Model');
        }
    public function index($idInvoice)
    {
        $data['tbl_detail'] = $this->Detail_Model->getDetailPembelian($idInvoice);
        $this->load->view('admin/detail_pembelian', $data);
    }
}
