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
        $config = array(
            array(
                'field' => 'isbn',
                'label' => 'ISBN',
                'rules' => 'required|exact_length[5]|numeric|is_unique[books.isbn]',
            ),
            array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required|max_length[255]|alpha_numeric_spaces',
            ),
            array(
                'field' => 'other_title',
                'label' => 'Other Title',
                'rules' => 'max_length[255]|alpha_numeric_spaces',
            ),
            array(
                'field' => 'category_id',
                'label' => 'Category',
                'rules' => 'required',
            ),
            array(
                'field' => 'author',
                'label' => 'Author',
                'rules' => 'required|max_length[255]|alpha_numeric_spaces',
            ),
            array(
                'field' => 'other_author',
                'label' => 'Other Author',
                'rules' => 'max_length[255]|alpha_numeric_spaces',
            ),
            array(
                'field' => 'publisher',
                'label' => 'Publisher',
                'rules' => 'required|max_length[255]|alpha_numeric_spaces',
            ),
            array(
                'field' => 'publication_year',
                'label' => 'Publication Year',
                'rules' => 'required|exact_length[4]|numeric',
            ),
            array(
                'field' => 'edition',
                'label' => 'Edition',
                'rules' => 'required|max_length[64]',
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required',
            ),
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('', '<br>');

        if($this->form_validation->run()) {
            http_response_code(200);
            echo $this->books->insert(array(
                'isbn' => $this->input->post('isbn'),
                'title' => $this->input->post('title'),
                'other_title' => $this->input->post('other_title') ?? NULL,
                'category_id' => $this->input->post('category_id'),
                'author' => $this->input->post('author'),
                'other_author' => $this->input->post('other_author') ?? NULL,
                'publisher' => $this->input->post('publisher'),
                'publication_year' => $this->input->post('publication_year'),
                'edition' => $this->input->post('edition'),
                'description' => $this->input->post('description'),
                'acquisition_date' => (new DateTime('NOW', new DateTimeZone('Asia/Manila')))->format('c'),
                'recent_update_date' => (new DateTime('NOW', new DateTimeZone('Asia/Manila')))->format('c'),
            ));
        } else {
            http_response_code(400);
            echo validation_errors();
        }
    }

    public function update()
    {
        $config = array(
            array(
                'field' => 'isbn',
                'label' => 'ISBN',
                'rules' => 'required|exact_length[5]|numeric|is_unique[books.isbn]',
            ),
            array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required|max_length[255]|alpha_numeric_spaces',
            ),
            array(
                'field' => 'other_title',
                'label' => 'Other Title',
                'rules' => 'max_length[255]|alpha_numeric_spaces',
            ),
            array(
                'field' => 'category_id',
                'label' => 'Category',
                'rules' => 'required',
            ),
            array(
                'field' => 'author',
                'label' => 'Author',
                'rules' => 'required|max_length[255]|alpha_numeric_spaces',
            ),
            array(
                'field' => 'other_author',
                'label' => 'Other Author',
                'rules' => 'max_length[255]|alpha_numeric_spaces',
            ),
            array(
                'field' => 'publisher',
                'label' => 'Publisher',
                'rules' => 'required|max_length[255]|alpha_numeric_spaces',
            ),
            array(
                'field' => 'publication_year',
                'label' => 'Publication Year',
                'rules' => 'required|exact_length[4]|numeric',
            ),
            array(
                'field' => 'edition',
                'label' => 'Edition',
                'rules' => 'required|max_length[64]',
            ),
            array(
                'field' => 'description',
                'label' => 'Description',
                'rules' => 'required',
            ),
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('', '<br>');

        if($this->form_validation->run()) {
            http_response_code(200);
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
                'recent_update_date' => (new DateTime('NOW', new DateTimeZone('Asia/Manila')))->format('c'),
            ));
        } else {
            http_response_code(400);
            echo validation_errors();
        }
    }

    public function get()
    {
        echo json_encode($this->books->with('category')->get($this->input->get('id')));
    }

    public function get_all()
    {
        echo json_encode($this->books->with('category')->with('copies')->get_all());
    }

    public function delete()
    {
        $this->books->delete($this->input->post('id'));
    }
}