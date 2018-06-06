<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller
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
        
        if($this->session->userdata('user')->privilege > 1) {
            redirect();
        }

        $data['user'] = $this->session->userdata('user');
        $data['accounts'] = $this->users->order_by('id')->get_all();

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('account/index', $data);
        $this->load->view('partials/footer');
    }

    public function create()
    {
        if($this->session->userdata('user') == NULL) {
            redirect('/login');
        }
        
        if($this->session->userdata('user')->privilege > 1) {
            redirect();
        }

        $config = array(
            array(
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'required|regex_match[/^[a-zA-Z ]+$/]',
            ),
            array(
                'field' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'required|regex_match[/^[a-zA-Z ]+$/]',
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
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[32]',
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
            ),
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('','<br>');

        if($this->input->server('REQUEST_METHOD') == 'POST') {
            if($this->form_validation->run()) {
                $this->users->insert(array(
                    'first_name' => ucwords($this->input->post('first_name')),
                    'last_name' => ucwords($this->input->post('last_name')),
                    'email_address' => $this->input->post('email'),
                    'contact_number' => $this->input->post('contact_number'),
                    'address' => $this->input->post('address'),
                    'privilege' => $this->input->post('privilege'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                ));

                $this->session->set_flashdata(array('message' => 'Account successfully created'));
                redirect('account');
            } else {
                $data['errors'] = validation_errors();
            }
        }

        $data['user'] = $this->session->userdata('user');

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('account/create', $data);
        $this->load->view('partials/footer');
    }

    public function update($user_id)
    {
        if($this->session->userdata('user') == NULL) {
            redirect('/login');
        }
        
        if($this->session->userdata('user')->privilege > 1) {
            redirect();
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
                'rules' => 'required|valid_email',
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
                $this->users->update($user_id, array(
                    'first_name' => ucwords($this->input->post('first_name')),
                    'last_name' => ucwords($this->input->post('last_name')),
                    'email_address' => $this->input->post('email'),
                    'contact_number' => $this->input->post('contact_number'),
                    'address' => $this->input->post('address'),
                    'privilege' => $this->input->post('privilege'),
                ));

                $this->session->set_flashdata(array('message' => 'Account successfully updated'));
                redirect('account');
            } else {
                $data['errors'] = validation_errors();
            }
        }

        $data['user'] = $this->session->userdata('user');
        $data['account'] = $this->users->get($user_id);

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('account/update', $data);
        $this->load->view('partials/footer');
    }

    public function delete($user_id)
    {
        if($this->session->userdata('user')->privilege > 1) {
            redirect();
        }

        $this->users->delete($user_id);
        redirect('account');
    }
}