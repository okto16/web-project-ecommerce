<?php
class Adminpage extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Rejeki Sports';
        $this->load->view('Layout Admin', $data);
        $this->load->view('Layout Admin 2');

        $data['tbl_admin'] = $this->db->get_where('tbl_admin', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('admin/Homepage', $data);
    }
    
    public function Profile()
	{
		$this->load->view('Layout Admin');
		$this->load->view('Admin/Profile');
		$this->load->view('Layout Admin 2');
	}

    public function logout()
    {
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your account has been Logout</div>');
        redirect('login');
    }
}
