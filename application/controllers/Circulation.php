<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Circulation extends CI_Controller
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
        
        if($this->session->userdata('user')->privilege > 2) {
            redirect();
        }

        $data['user'] = $this->session->userdata('user');

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('circulation/index', $data);
        $this->load->view('partials/footer');
    }
}