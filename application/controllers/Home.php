<?php
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_Model');
    }
    public function index()
    {
        $data['title'] = 'Bagas Tani';
        $queryAllBarang = $this->Barang_Model->getDataBarang();
        $data = array('queryAllBrg' => $queryAllBarang);
            $this->load->view('header');
            $data['tbl_member'] = $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();
            $this->load->view('sidebar',$data);
            $this->load->view('member/homepage', $data);
            $this->load->view('footer',$data);
        }
    

    public function Profile()
    {
        $data['title'] = 'Bagas Tani';
        $queryAllKuota = $this->Kuota_Model->getDataKuota();
        $data = array('queryAllKuota' => $queryAllKuota);
        $this->load->view('Header', $data);
        $this->load->view('member/Cekkuota', $data);
        $this->load->view('Footer');
    }

    public function Proses_Pesanan()
    
    {
        $data['title'] = 'Bagas Tani';
        $this->cart->destroy();
        $this->load->view('header');
        $data['tbl_member'] = $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('sidebar',$data);
        $this->load->view('member/Proses_pesanan',$data);
        $this->load->view('footer',$data);
    }
    public function Shop_chart()
    {
        $data['title'] = 'Bagas Tani';
        $this->load->view('Layout Admin', $data);
        $this->load->view('Layout Admin 2');

        $data['tbl_member'] = $this->db->get_where('tbl_member', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('member/Shop_chart', $data);
    }

    public function logout()
    {
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your account has been Logout</div>');
        redirect('login');
    }
}
