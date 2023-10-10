<?php
class Pesananmember extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_Model');
        $this->load->model('Detail_Model');
        $this->load->model('search_pesanan');
    }

    public function index()
    {
        $data['title'] = 'Bagas Tani';
        $idKonsumen = $this->session->userdata('idKonsumen');
        $data['riwayatTransaksi'] = $this->Order_Model->getTransaksiByMember($idKonsumen);
        $data['tbl_member'] = $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('header');
        $this->load->view('sidebar', $data);
        $this->load->view('member/Pesanan', $data);
    }

    public function detail($idInvoice)
    {
        $data['orderDetail'] = $this->Detail_Model->getOrderDetail($idInvoice);
        $data['tbl_member'] = $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('header');
        $this->load->view('sidebar', $data);
        $this->load->view('member/DetailPesanan', $data);
        $this->load->view('footer');
    }
}