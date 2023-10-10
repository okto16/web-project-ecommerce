<?php
class Adminpage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jumlah_Model');
        $this->load->model('Order_Model');
    }
    public function index()
    {
        $data['title'] = 'Bagas Tani';
        $data['total_barang'] = $this->Jumlah_Model->total_barang();
        $data['total_member'] = $this->Jumlah_Model->total_member();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/Homepage', $data);
        $this->load->view('Layout Admin 2');
    }

    public function logout()
    {
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your account has been Logout</div>');
        redirect('login');
    }
}
