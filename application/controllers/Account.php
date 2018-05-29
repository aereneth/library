<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller
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

        $data['user'] = $this->session->userdata('user');

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('account/index');
        $this->load->view('partials/footer');
    }
}