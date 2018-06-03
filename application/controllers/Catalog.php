<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalog extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        
        $this->load->view('partials/header');
        
        if($this->session->userdata('user') != NULL) {
            $data['user'] = $this->session->userdata('user');
            $this->load->view('partials/sidebar', $data);
        }

        $this->load->view('catalog/index');
        $this->load->view('partials/footer');
    }
}