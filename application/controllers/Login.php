<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Login extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->library('form_validation');
            $this->load->model('login_model');
            $this->load->model('Member_Model');
        }

        public function index()
        {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Bagas Tani Login';
                $this->load->view('templates/header', $data);
                $this->load->view('Login');
                $this->load->view('templates/footer');
            } else {
                //validasi success
                $this->akses_login();
            }
        }

        function akses_login()
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $cekmember = $this->login_model->cekuser('tbl_member', 'email', $email);

            if ($cekmember) {
                //usernya aktif
                foreach ($cekmember as $member)
                    if (password_verify($password, $member->password)) {
                        $datamember = array('email' => $member->email,
                        'idKonsumen' => $member->idKonsumen,
                        'Nik' => $member->Nik,
                        'username' => $member->username);
                        $this->session->set_userdata($datamember);
                        redirect('home');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                        redirect('login');
                    }
            }

            $cekadmin = $this->login_model->cekuser('tbl_admin', 'email', $email);

            if ($cekadmin) {
                //usernya aktif
                foreach ($cekadmin as $row)
                    if (password_verify($password, $row->password)) {
                        $dataAdmin = array('email' => $row->email);
                        $this->session->set_userdata($dataAdmin);
                        redirect('adminpage');
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                        redirect('login');
                    }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not register!</div>');
                redirect('login');
            }
        }

        public function Registrasi()
        {
            $this->form_validation->set_rules('username', 'UserName', 'required|trim');
            $this->form_validation->set_rules('Nik', 'Nik', 'required|trim');
            $this->form_validation->set_rules('namaKonsumen', 'Name', 'required|trim');
            $this->form_validation->set_rules('alamat', 'Address', 'required|trim');
            $this->form_validation->set_rules('tlpn', 'No Telepon', 'required|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tbl_member.email]', [
                'is_unique' => 'This email has already registered!'
            ]);
            $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');

            if ($this->form_validation->run() == false) {
                $data['title'] = 'Rejeki Sports Registration';
                $this->load->view('templates/header', $data);
                $this->load->view('Registrasi');
                $this->load->view('templates/footer');
            } else {
                $data = [
                    'username' => $this->input->post('username'),
                    'Nik' => $this->input->post('Nik'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'namaKonsumen' => $this->input->post('namaKonsumen'),
                    'alamat' => $this->input->post('alamat'),
                    'email' => $this->input->post('email'),
                    'tlpn' => $this->input->post('tlpn'),
                    'statusAktif' => 'Y'
                ];
                $this->db->insert('tbl_member', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your account has been created!</div>');
                redirect('login');
            }
        }
    }
