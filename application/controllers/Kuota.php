<?php
class Kuota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kuota_Model');
        $this->load->model('Jumlah_Model');
        $this->load->model('Order_Model');
        $this->load->model('Produk_Model');
    }
    public function index()
    {
        $data['title'] = 'Bagas Tani';
        $queryAllKuota = $this->Kuota_Model->getDataKuota();
        $data = array('queryAllKuota' => $queryAllKuota);
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/Kuota', $data);
        $this->load->view('Layout Admin 2');
    }
    public function halaman_tambah()
    {
        $data['title'] = 'Bagas Tani';
        $queryAllProduk = $this->Produk_Model->getDataProduk();
        $data = array('queryAllProduk' => $queryAllProduk);
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/TambahKuota', $data);
        $this->load->view('Layout Admin 2');
    }
    public function halaman_edit($id)
    {
        $data['title'] = 'Bagas Tani';
        $queryAllProduk = $this->Produk_Model->getDataProduk();
        $data = array('queryAllProduk' => $queryAllProduk);
        $queryKuotaDetail = $this->Kuota_Model->getDataKuotaDetail($id);
        $data = array('queryKuotaDetail' => $queryKuotaDetail);
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/EditKuota', $data);
        $this->load->view('Layout Admin 2');
    }
    public function fungsitambah()
    {
        $Nik = $this->input->post('Nik');
        $username = $this->input->post('username');
        $idProduk = $this->input->post('idProduk');
        $namProduk = $this->input->post('namProduk');
        $jumlahKuota = $this->input->post('jumlahKuota');
        $tahun = $this->input->post('tahun');
        // Validasi data yang harus diisi
        if (empty($Nik) || empty($username) || empty($idProduk) || empty($namProduk) || empty($jumlahKuota) || empty($tahun)) {
            $this->session->set_flashdata('error', 'SEMUA DATA HARUS DI ISI');
            redirect('Kuota/halaman_tambah');
        }

        $arrinsert = array(
            'Nik' => $Nik,
            'username' => $username,
            'idProduk' => $idProduk,
            'namProduk' => $namProduk,
            'jumlahKuota' => $jumlahKuota,
            'tahun' => $tahun
        );
        $this->Kuota_Model->insertDataKuota($arrinsert);
        $this->session->set_flashdata('success', 'Kuota Subsidi berhasil ditambahkan.');
        redirect('Kuota');
    }
    public function fungsiedit($id)
    {
        $Nik = $this->input->post('Nik');
        $username = $this->input->post('username');
        $idProduk = $this->input->post('idProduk');
        $namProduk = $this->input->post('namProduk');
        $jumlahKuota = $this->input->post('jumlahKuota');
        $tahun = $this->input->post('tahun');
        if (empty($Nik) || empty($username) || empty($idProduk) || empty($namProduk) || empty($jumlahKuota) || empty($tahun)) {
            $this->session->set_flashdata('error', 'SEMUA DATA HARUS DI ISI');
            redirect('Kuota/halaman_edit/'. $id);
        }
        $arrupdate = array(
            'Nik' => $Nik,
            'username' => $username,
            'idProduk' => $idProduk,
            'namProduk' => $namProduk,
            'jumlahKuota' => $jumlahKuota,
            'tahun' => $tahun
        );
        $this->Kuota_Model->updateDataKuota($id, $arrupdate);
        $this->session->set_flashdata('success', 'Kuota berhasil diperbarui.');
        redirect('Kuota');
    }
    public function fungsidelete($id)
    {
        $this->Kuota_Model->deleteDataKuota($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('Kuota');
    }
    public function perform_search()
    {
        $keyword = $this->input->post('keyword');
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['results'] = $this->Kuota_Model->search($keyword);
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/CariKuota', $data);
        $this->load->view('Layout Admin 2');
    }
}
