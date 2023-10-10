<?php
class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_Model');
        $this->load->model('Jumlah_Model');
        $this->load->model('Order_Model');
    }
    public function index()
    {
        $data['title'] = 'Bagas Tani';
        $queryAllKategori = $this->Kategori_Model->getDataKategori();
        $data = array('queryAllKategori' => $queryAllKategori);
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/Kategori', $data);
        $this->load->view('Layout Admin 2');
    }
    public function halaman_tambah()
    {
        $data['title'] = 'Bagas Tani';
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/TambahKategori', $data);
        $this->load->view('Layout Admin 2');
    }
    public function halaman_edit($idKat)
    {
        $data['title'] = 'Bagas Tani';
        $queryKategoriDetail = $this->Kategori_Model->getDataKategoriDetail($idKat);
        $data = array('queryKategoriDetail' => $queryKategoriDetail);
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/EditKategori', $data);
        $this->load->view('Layout Admin 2');
    }
    public function fungsitambah()
    {
        $namaKat = $this->input->post('namaKat');

        // Validasi data yang harus diisi
        if (empty($namaKat)) {
            $this->session->set_flashdata('error', 'Nama Kategori harus diisi.');
            redirect('Kategori/halaman_tambah');
        }

        $arrinsert = array(
            'namaKat' => $namaKat,
        );
        $this->Kategori_Model->insertKategori($arrinsert);
        $this->session->set_flashdata('success', 'Kategori berhasil ditambahkan.');
        redirect('Kategori');
    }

    public function fungsiedit($idKat)
    {
        $namaKat = $this->input->post('namaKat');

        // Validasi data yang harus diisi
        if (empty($namaKat)) {
            $this->session->set_flashdata('error', 'Nama Kategori harus diisi!!');
            redirect('Kategori/halaman_edit/' . $idKat);
        }

        $arrupdate = array(
           
            'namaKat' => $namaKat,
        );
        $this->Kategori_Model->updateDataKategori($idKat, $arrupdate);
        $this->session->set_flashdata('success', 'Kategori berhasil diperbarui.');
        redirect('Kategori/');
    }


    public function fungsidelete($idKat)
    {
        $this->Kategori_Model->deleteDataKategori($idKat);
        $this->session->set_flashdata('success', 'Kategori berhasil dihapus.');
        redirect('Kategori');
    }

    public function search()
    {
        $keyword = $this->input->get('keyword');

        $data['results'] = $this->Order_Model->search_orders($keyword);

        $this->load->view('search_results', $data);
    }
    public function perform_search()
    {
        $keyword = $this->input->post('keyword');
        $data['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $data['results'] = $this->Kategori_Model->search($keyword);
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/CariKategori', $data);
        $this->load->view('Layout Admin 2');
    }
}
