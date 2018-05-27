<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        echo $this->categories->insert(array(
            'name' => $this->input->post('name'),
        ));
    }

    public function get_all()
    {
        echo $this->categories->get_all();
    }
}