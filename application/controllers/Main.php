<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->session->userdata('user') == NULL) {
            redirect('/login');
        }

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar');
        $this->load->view('index');
        $this->load->view('partials/footer');
    }

    public function login()
    {
        if($this->session->userdata('user') != NULL) {
            redirect('/');
        }

        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $user = $this->users->get_by(array(
                'email_address' => $this->input->post('email'),
            ));

            if(password_verify($this->input->post('password'), $user->password)) {
                $this->session->set_userdata('user', $user);
                redirect('/');
            }
        }

        $this->load->view('partials/header');
        $this->load->view('login');
        $this->load->view('partials/footer');
    }

    public function logout()
    {
        if($this->session->userdata('user') == NULL) {
            redirect('/login');
        }

        $this->session->unset_userdata('user');
        redirect('/login');
    }
}