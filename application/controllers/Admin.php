<?php
class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_Model');
        $this->load->model('Jumlah_Model');
        $this->load->model('Order_Model');
    }
    public function index()
    {
        $data['title'] = 'Bagas Tani';
        $queryAllAdmin = $this->Admin_Model->getDataAdmin();
        $data = array('queryAllAdmin' => $queryAllAdmin);
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin',$data);
        $this->load->view('admin/admin', $data);
        $this->load->view('Layout Admin 2');

    }
    public function halaman_tambah()
    {
        $data['title'] = 'Bagas Tani';
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin',$data);
        $this->load->view('admin/TambahAdmin', $data);
        $this->load->view('Layout Admin 2');
    }
    public function halaman_edit($idAdmin)
    {
        $data['title'] = 'Bagas Tani';
        $queryAdminDetail = $this->Admin_Model->getDataAdminDetail($idAdmin);
        $data = array('queryAdminDetail' => $queryAdminDetail);
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin',$data);
        $this->load->view('admin/EditAdmin', $data);
        $this->load->view('Layout Admin 2');
    }
    public function fungsitambah()
    {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if (empty($username) || empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'SEMUA DATA HARUS DI ISI');
            redirect('Admin/halaman_tambah');
        }
      
        $arrinsert = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->Admin_Model->insertDataAdmin($arrinsert);
        $this->session->set_flashdata('success', 'Admin berhasil ditambahkan.');
        redirect('Admin');
    }
    public function fungsiedit($idAdmin)
    {
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        if (empty($username) || empty($email) || empty($password)) {
            $this->session->set_flashdata('error', 'SEMUA DATA HARUS DI ISI');
            redirect('Admin/halaman_edit/' . $idAdmin);
        }
       
        $arrupdate = array(
            'username' => $username,
            'email' => $email,
            'password' => $password,
        );
        $this->Admin_Model->updateDataAdmin($idAdmin, $arrupdate);
        $this->session->set_flashdata('success', 'Admin berhasil diperbarui.');
        redirect('Admin');
    }
    public function fungsidelete($idAdmin)
    {
        $this->Admin_Model->deleteDataAdmin($idAdmin);
        $this->session->set_flashdata('success', 'Admin berhasil dihapus.');
        redirect('Admin');
    }
    public function perform_search() {
        $keyword = $this->input->post('keyword');
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['results'] = $this->Admin_Model->search($keyword);
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin',$data);
        $this->load->view('admin/CariAdmin', $data);
        $this->load->view('Layout Admin 2');
    }
}