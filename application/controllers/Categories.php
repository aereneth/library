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
        $config = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|regex_match[/[a-zA-Z ]+/]',
            ),
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('', '<br>');

        if($this->form_validation->run()) {
            http_response_code(200);
            echo $this->categories->insert(array(
                'name' => $this->input->post('name'),
            ));
        } else {
            http_response_code(400);
            echo validation_errors();            
        }
    }

    public function get_all()
    {
        echo json_encode($this->categories->order_by('name')->get_all());
    }
}