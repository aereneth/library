<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends CI_Controller
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

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('reservation/index', $data);
        $this->load->view('partials/footer');
    }

    public function history()
    {
        if($this->session->userdata('user') == NULL) {
            redirect('/login');
        }
        
        if($this->session->userdata('user')->privilege < 3) {
            redirect();
        }

        $data['user'] = $this->session->userdata('user');
        $data['reservations'] = $this->reservations->with('copy')->with('book')->get_many_by(array(
            'user_id' => $this->session->userdata('user')->id,
            'status != 0',
        ));

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('reservation/history', $data);
        $this->load->view('partials/footer');
    }

    public function get_all()
    {
        http_response_code(200);
        echo json_encode($this->reservations->with('book')->with('copy')->with('user')->get_all());
    }

    public function accept()
    {
        $reservation = $this->reservations->with('copy')->get($this->input->post('reservation_id'));

        if(!$reservation->copy->status) {
            $this->reservations->update($this->input->post('reservation_id'), array(
                'status' => 5,
            ));

            http_response_code(400);
            echo json_encode(array(
                'error' => 'Book already borrowed',
            ));
            return;
        }

        $this->copies->update($reservation->copy->id, array(
            'status' => FALSE,
        ));

        $this->reservations->update($this->input->post('reservation_id'), array(
            'status' => 1,
            'borrow_date' => (new DateTime('NOW', new DateTimeZone('Asia/Manila')))->format('c'),
            'due_date' => (new DateTime('NOW', new DateTimeZone('Asia/Manila')))->add(new DateInterval('P5D'))->format('c'),
        ));

        http_response_code(200);
        echo json_encode($this->reservations->with('copy')->get($this->input->post('reservation_id')));
    }

    public function deny()
    {
        $this->reservations->update($this->input->post('reservation_id'), array(
            'status' => 4,
        ));
    }

    public function return()
    {
        $reservation = $this->reservations->with('copy')->get($this->input->post('reservation_id'));

        $this->copies->update($reservation->copy->id, array(
            'status' => TRUE,
        ));

        $borrow_date = (new DateTime($reservation->borrow_date));
        $return_date = (new DateTime('NOW', new DateTimeZone('Asia/Manila')));
        $overdue_days = $borrow_date->diff($return_date)->days;
        $overdue_fine = 0;
        $message = 'Book returned';

        if($overdue_days > 0) {
            $overdue_fine = 20 * $overdue_days;
            $message = "Book returned with an overdue fine of P {$overdue_fine}";
        }

        $this->reservations->update($this->input->post('reservation_id'), array(
            'status' => 2,
            'return_date' => $return_date->format('c'),
            'overdue_fine' => $overdue_fine,
        ));

        http_response_code(200);
        echo json_encode(array(
            'message' => $message,
        ));
        return;
    }
}