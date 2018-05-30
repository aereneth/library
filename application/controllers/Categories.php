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
                'rules' => 'required|regex_match[/[a-zA-Z ]+/]|is_unique[categories.name]',
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

    public function delete()
    {
        $categories = array();

        foreach($this->input->post('category') as $index => $category) {
            if($this->books->get_many_by(array('category_id' => $index))) {
                http_response_code(400);
                echo 'Category is still used';
                return;
            }
            array_push($categories, $index);
        }

        http_response_code(200);
        $this->categories->delete_many($categories);
    }

    public function get_all()
    {
        echo json_encode($this->categories->order_by('name')->get_all());
    }
}