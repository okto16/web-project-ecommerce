<?php
class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_Model');
        $this->load->model('Jumlah_Model');
        $this->load->model('Order_Model');
        $this->load->model('Kategori_Model');
    }
    public function index()
    {
        $data['title'] = 'Kelola Produk';
        $queryAllProduk = $this->Produk_Model->getDataProduk();
        $data = array('queryAllProduk' => $queryAllProduk);
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/Produk', $data);
        $this->load->view('Layout Admin 2');
    }
    public function halaman_tambah()
    {
        $data['title'] = 'Tambah Produk';
        $queryAllKategori = $this->Kategori_Model->getDataKategori();
        $data = array('queryAllKategori' => $queryAllKategori);
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/TambahProduk', $data);
        $this->load->view('Layout Admin 2');
    }
    public function halaman_edit($idProduk)
    {
        $data['title'] = 'Edit Produk';
        $queryAllKategori = $this->Kategori_Model->getDataKategori();
        $data = array('queryAllKategori' => $queryAllKategori);
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $queryProdukDetail = $this->Produk_Model->getDataProdukDetail($idProduk);
        $data['queryProdukDetail'] = $queryProdukDetail;
        
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin',$data);
        $this->load->view('admin/EditProduk', $data);
        $this->load->view('Layout Admin 2');
    }
    
    public function fungsitambah()
    {
        $idKat = $this->input->post('idKat');
        $namProduk = $this->input->post('namProduk');
        $foto = $this->input->post('foto');
        $harga = $this->input->post('harga');
        $stok = $this->input->post('stok');
        $berat = $this->input->post('berat');
        $deskripsiProduk = $this->input->post('deskripsiProduk');

        // Validasi data yang harus diisi
        if (empty($namProduk) || empty($idKat) || empty($foto) || empty($harga) || empty($berat) || empty($deskripsiProduk) || empty($stok)) {
            $this->session->set_flashdata('error', 'SEMUA DATA HARUS DI ISI');
            redirect('Produk/halaman_tambah');
        }

        $arrinsert = array(
            'idKat' => $idKat,
            'namProduk' => $namProduk,
            'foto' => $foto,
            'harga' => $harga,
            'Stok' => $stok,
            'berat' => $berat,
            'deskripsiProduk' => $deskripsiProduk
        );
        $this->Produk_Model->insertDataProduk($arrinsert);
        $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
        redirect('Produk');
    }

    public function fungsiedit($idProduk)
    {
            $idKat = $this->input->post('idKat');
            $namProduk = $this->input->post('namProduk');
            $foto = $this->input->post('foto');
            $harga = $this->input->post('harga');
            $stok = $this->input->post('stok');
            $berat = $this->input->post('berat');
            $deskripsiProduk = $this->input->post('deskripsiProduk');
            if (empty($namProduk) || empty($idKat) || empty($foto) || empty($harga) || empty($berat) || empty($deskripsiProduk) || empty($stok)) {
                $this->session->set_flashdata('error', 'SEMUA DATA HARUS DI ISI');
                redirect('Produk/halaman_edit/' . $idProduk);
            }
            $arrupdate = array(
                'idKat' => $idKat,
                'namProduk' => $namProduk,
                'foto' => $foto,
                'harga' => $harga,
                'stok' => $stok,
                'berat' => $berat,
                'deskripsiProduk' => $deskripsiProduk
            );
    
            $this->Produk_Model->updateDataProduk($idProduk, $arrupdate);
    
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
            redirect('Produk/');
    }


    public function fungsidelete($idProduk)
    {
        $this->Produk_Model->deleteDataProduk($idProduk);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('Produk/');
    }
    public function perform_search()
    {
        $keyword = $this->input->post('keyword');
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['results'] = $this->Produk_Model->search($keyword);
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/CariProduk', $data);
        $this->load->view('Layout Admin 2');
    }
}
