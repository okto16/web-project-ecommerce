<?php
class Homepage extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kuota_Model');
        $this->load->model('Barang_Model');
    }
    public function index()
    {
        $data['title'] = 'Bagas Tani';
        $queryAllBarang = $this->Barang_Model->getDataBarang();
        $data = array('queryAllBrg' => $queryAllBarang);
        $this->load->view('Header', $data);
        $this->load->view('Homepage', $data);
        $this->load->view('Footer');      
    }
    public function CekKuota()
    {
        $data['title'] = 'Bagas Tani';
        $queryAllKuota = $this->Kuota_Model->getDataKuota();
        $data = array('queryAllKuota' => $queryAllKuota);
        $this->load->view('Header');
        $this->load->view('Cekkuota', $data);
        $this->load->view('Footer');
    }
    public function perform_search() {
        $keyword = $this->input->post('keyword');
        $data['results'] = $this->Kuota_Model->search($keyword);
        $data['tbl_member'] = $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('Header');
        $this->load->view('sidebar',$data);
        $this->load->view('member/CariKuota', $data);
        $this->load->view('Header');
    }
}
