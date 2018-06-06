<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller
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
        $data['books'] = $this->books->get_all();

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('inventory/index', $data);
        $this->load->view('partials/footer');
    }

    public function view($book_id)
    {
        if($this->session->userdata('user') == NULL) {
            redirect('/login');
        }

        $data['user'] = $this->session->userdata('user');
        $data['copies'] = $this->copies->with('book')->get_many_by(array(
            'book_id' => $book_id,
        ));

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('inventory/view', $data);
        $this->load->view('partials/footer');
    }
}