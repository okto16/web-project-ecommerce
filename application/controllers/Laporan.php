<?php defined('BASEPATH') or exit('No direct script access allowed');

use setasign\Fpdi\Tcpdf\Fpdi;

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Order_Model');
        $this->load->model('Laporan_Model');
        $this->load->model('Jumlah_Model');
    }

    public function index()
    {
        $data['title'] = 'Laporan';
        $data['invoice'] = $this->Order_Model->getapproveInvoice();
        $pending['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $pending['invoice'] = $this->Order_Model->getPendingInvoices();
        $name['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', array_merge($name, $pending));
        $this->load->view('admin/Laporan', $data);
        $this->load->view('Layout Admin 2');
    }
    public function detail($idInvoice)
    {
        $data['orderDetail'] = $this->Detail_Model->getOrderDetail($idInvoice);
        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin', $data);
        $this->load->view('admin/DetailPesanan', $data);
        $this->load->view('Layout Admin 2');
    }

    public function laporan_harian()
    {
        $data['title'] = 'Laporan Harian';
        $data['invoice'] = $this->Order_Model->getapproveInvoice();
        $tanggal_awal = $this->input->post('tanggal_awal');
        $tanggal_akhir = $this->input->post('tanggal_akhir');
        $data['laporan'] = $this->Laporan_Model->getLaporanByDateRange($tanggal_awal, $tanggal_akhir);
        $pending['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $pending['invoice'] = $this->Order_Model->getPendingInvoices();
        $name['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();


        $this->load->view('Layout Admin', $data);
        $this->load->view('sidebaradmin', array_merge($name, $pending));
        $this->load->view('admin/LaporanHarian', $data);
        $this->load->view('Layout Admin 2');
    }

    public function cetak()
    {
        $data['invoice'] = $this->Order_Model->getapproveInvoice();
        $this->load->view('admin/Print', $data);
    }
    public function perform_search()
    {
        $keyword = $this->input->post('keyword');
        $pending['total_pesanan'] = $this->Jumlah_Model->total_pesanan();
        $pending['invoice'] = $this->Order_Model->getPendingInvoices();
        $data['results'] = $this->Laporan_Model->search($keyword);
        $name['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Layout Admin');
        $this->load->view('sidebaradmin',array_merge($data, $name, $pending));
        $this->load->view('admin/CariLaporan', $data);
        $this->load->view('Layout Admin 2');
    }
}
