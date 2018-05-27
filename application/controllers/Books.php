<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        echo $this->books->insert(array(
            'isbn' => $this->input->post('isbn'),
            'title' => $this->input->post('title'),
            'other_title' => $this->input->post('other_title'),
            'category_id' => $this->input->post('category_id'),
            'author' => $this->input->post('author'),
            'other_author' => $this->input->post('other_author'),
            'publisher' => $this->input->post('publisher'),
            'publication_year' => $this->input->post('publication_year'),
            'edition' => $this->input->post('edition'),
            'description' => $this->input->post('description'),
        ));
    }

    public function update()
    {
        $this->books->update($this->input->post('id'), array(
            'isbn' => $this->input->post('isbn'),
            'title' => $this->input->post('title'),
            'other_title' => $this->input->post('other_title'),
            'category_id' => $this->input->post('category_id'),
            'author' => $this->input->post('author'),
            'other_author' => $this->input->post('other_author'),
            'publisher' => $this->input->post('publisher'),
            'publication_year' => $this->input->post('publication_year'),
            'edition' => $this->input->post('edition'),
            'description' => $this->input->post('description'),
        ));
    }

    public function get()
    {
        echo json_encode($this->books->with('category')->get($this->input->get('id')));
    }

    public function get_all()
    {
        echo json_encode($this->books->with('category')->get_all());
    }

    public function delete()
    {
        $this->books->delete($this->input->post('id'));
    }
}