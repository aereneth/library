<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Copies extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        echo json_encode($this->copies->insert(array(
            'book_id' => $this->input->post('book_id'),
        )));
    }

    public function get_all()
    {
        http_response_code(200);
        echo json_encode($this->copies->with('book')->with('reservations')->get_all())
    }
}