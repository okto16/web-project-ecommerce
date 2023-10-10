<?php
class Member extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Member_Model');
        $this->load->model('Jumlah_Model');
        $this->load->model('Order_Model');
    }
    public function index()
    {
        $data['title'] = 'Bagas Tani';
        $queryAllMember = $this->Member_Model->getDataMember();
        $data = array('queryAllMember' => $queryAllMember);
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/Member', $data);
        $this->load->view('Layout Admin 2');
    }
    public function halaman_edit($idKonsumen)
    {
        $data['title'] = 'Bagas Tani';
        $queryMemberDetail = $this->Member_Model->getDataMemberDetail($idKonsumen);
        $data = array('queryMemberDetail' => $queryMemberDetail);
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/EditMember', $data);
        $this->load->view('Layout Admin 2');
    }
    public function fungsiedit($idKonsumen)
    {
        $Nik = $this->input->post('Nik');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $namaKonsumen = $this->input->post('namaKonsumen');
        $alamat = $this->input->post('alamat');
        $email = $this->input->post('email');
        $tlpn = $this->input->post('tlpn');
        // Validasi data yang harus diisi
        if (empty($Nik) || empty($username) || empty($password) || empty($namaKonsumen) || empty($alamat) || empty($email) || empty($tlpn)) {
            $this->session->set_flashdata('error', 'SEMUA DATA HARUS DI ISI');
            redirect('Member/halaman_edit/' . $idKonsumen);
        }

        $arrupdate = array(
            'Nik' => $Nik,
            'username' => $username,
            'password' => $password,
            'namaKonsumen' => $namaKonsumen,
            'alamat' => $alamat,
            'email' => $email,
            'tlpn' => $tlpn,
        );
        $this->Member_Model->updateDataMember($idKonsumen, $arrupdate);
        $this->session->set_flashdata('success', 'Data Member berhasil diperbarui.');
        redirect('Member');
    }
    public function fungsidelete($idKonsumen)
    {
        $this->Member_Model->deleteDataMember($idKonsumen);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('Member');
    }
    public function perform_search()
    {
        $keyword = $this->input->post('keyword');
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['results'] = $this->Member_Model->search($keyword);
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/CariMember', $data);
        $this->load->view('Layout Admin 2');
    }
}
