<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acquisition extends CI_Controller
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
        $data['categories'] = $this->categories->order_by('name')->get_all();
        $data['books'] = $this->books->with('category')->get_all();

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('acquisition/index', $data);
        $this->load->view('partials/footer');
    }
}