<?php
    class Cekkuota extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Kuota_Model');
            $this->load->library('session');
        }
        public function index()
        {
            $data['title'] = 'Bagas Tani';
            $Nik = $this->session->userdata('Nik');
            $queryAllKuota = $this->Kuota_Model->getDataKuotaByUserId($Nik);
            $data = array('queryAllKuota' => $queryAllKuota);
            $data['tbl_member'] = $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('Header');
            $this->load->view('sidebar', $data);
            $this->load->view('member/Cekkuota', $data);
            $this->load->view('Footer');
        }
        public function perform_search() {
            $keyword = $this->input->post('keyword');
            $data['results'] = $this->Kuota_Model->search($keyword);
            $this->load->view('Header');
            $this->load->view('CariKuota', $data);
            $this->load->view('Header');
        }
    }