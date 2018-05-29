<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
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

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('index');
        $this->load->view('partials/footer');
    }

    public function login()
    {
        if($this->session->userdata('user') != NULL) {
            redirect('/');
        }

        if($this->input->server('REQUEST_METHOD') == 'POST') {
            $user = $this->users->get_by(array(
                'email_address' => $this->input->post('email'),
            ));

            if(password_verify($this->input->post('password'), $user->password)) {
                $this->session->set_userdata('user', $user);
                redirect('/');
            }
        }

        $this->load->view('partials/header');
        $this->load->view('login');
        $this->load->view('partials/footer');
    }

    public function logout()
    {
        if($this->session->userdata('user') == NULL) {
            redirect('/login');
        }

        $this->session->unset_userdata('user');
        redirect('/login');
    }

    public function register()
    {
        if($this->session->userdata('user') != NULL) {
            redirect('/');
        }

        $config = array(
            array(
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'required|alpha_numeric_spaces',
            ),
            array(
                'field' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'required|alpha_numeric_spaces',
            ),
            array(
                'field' => 'email',
                'label' => 'Email Address',
                'rules' => 'required|valid_email|is_unique[users.email_address]',
            ),
            array(
                'field' => 'contact_number',
                'label' => 'Contact Number',
                'rules' => 'required|exact_length[11]|numeric',
            ),
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('','<br>');

        if($this->input->server('REQUEST_METHOD') == 'POST') {
            if($this->form_validation->run()) {
                $this->users->insert(array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'email_address' => $this->input->post('email'),
                    'contact_number' => $this->input->post('contact_number'),
                    'address' => $this->input->post('address'),
                    'privilege' => 3,
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                ));

                redirect('login');
            } else {
                $data['errors'] = validation_errors();
            }
        }

        $this->load->view('partials/header');
        $this->load->view('register');
        $this->load->view('partials/footer');        
    }
}