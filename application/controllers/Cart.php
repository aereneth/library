<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if($this->session->userdata('user') == NULL) {
            redirect('login');
        }

        if($this->session->userdata('user')->privilege != 3) {
            redirect();
        }

        $data['user'] = $this->session->userdata('user');
        $data['cart'] = $this->session->userdata('cart');

        $this->load->view('partials/header');
        $this->load->view('partials/sidebar', $data);
        $this->load->view('cart/index', $data);
        $this->load->view('partials/footer');
    }

    public function add()
    {
        $cart = $this->session->userdata('cart');

        if(count($cart) >= 7) {
            http_response_code(400);
            echo json_encode(array(
                'error' => 'You have reached the maximum allowed number of borrowed books',
            ));
            return;
        }

        $copy = $this->copies->with('book')->get_by(array(
            'book_id' => $this->input->post('book_id'),
            'status' => TRUE,
        ));

        if($copy == NULL) {
            http_response_code(400);
            echo json_encode(array(
                'error' => 'No copy available'
            ));
            return;
        }

        $cart[$copy->id] = $copy;
        $this->session->set_userdata('cart', $cart);

        http_response_code(200);
        echo json_encode($cart);
    }

    public function remove()
    {
        $cart = $this->session->userdata('cart');

        unset($cart[$this->input->post('copy_id')]);
        $this->session->set_userdata('cart', $cart);

        http_response_code(200);
        echo json_encode($cart);
    }

    public function empty()
    {
        $cart = $this->session->userdata('cart');

        if(count($cart) == 0) {
            http_response_code(400);
            echo json_encode(array(
                'error' => 'Cart is already empty',
            ));
            return;
        }

        $this->session->set_userdata('cart', array());

        http_response_code(200);
        echo json_encode($cart);
    }

    public function checkout()
    {
        $cart = $this->session->userdata('cart');

        if(count($cart) == 0) {
            http_response_code(400);
            echo json_encode(array(
                'error' => 'Cart is empty',
            ));
            return;
        }

        $query = array();

        foreach($cart as $item) {
            array_push($query, array(
                'user_id' => $this->session->userdata('user')->id,
                'copy_id' => $item->id,
                'book_id' => $item->book->id,
                'reservation_date' => (new DateTime('NOW', new DateTimeZone('Asia/Manila')))->format('c'),
            ));
        }

        $this->reservations->insert_many($query);

        $this->session->set_userdata('cart', array());

        http_response_code(200);
        echo json_encode($cart);
    }
}