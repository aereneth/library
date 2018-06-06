<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller
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

        $config = array(
            array(
                'field' => 'overdue_rate',
                'label' => 'Overdue Rate',
                'rules' => 'required|numeric',
            ),
            array(
                'field' => 'borrow',
                'label' => 'Borrow Duration',
                'rules' => 'required|numeric',
            ),
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('', '<br>');

        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->form_validation->run()) {
            $this->settings->update_by(
                array('name' => 'overdue_rate'), 
                array('value' => $this->input->post('overdue_rate'))
            );
            $this->settings->update_by(
                array('name' => 'borrow_duration'), 
                array('value' => $this->input->post('borrow'))
            );

            $this->session->set_flashdata('message', 'Settings successfully updated');
        } else {
            $this->session->set_flashdata('errors', validation_errors());
        }

        $data['user'] = $this->session->userdata('user');
        $data['overdue_rate'] = $this->settings->get_by(array('name' => 'overdue_rate'));
        $data['borrow_duration'] = $this->settings->get_by(array('name' => 'borrow_duration'));

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('settings/index', $data);
        $this->load->view('partials/footer');
    }
}