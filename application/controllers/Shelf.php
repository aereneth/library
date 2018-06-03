<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelf extends CI_Controller
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
        $data['books'] = $this->books->with('copies')->get_all();

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('shelf/index', $data);
        $this->load->view('partials/footer');
    }
}