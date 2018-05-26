<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation_model extends MY_Model
{
    public $_table = 'reservations';
    public $belongs_to = array(
        'books' => array('model' => 'book_model'),
        'users' => array('model' => 'user_model'),
    );
}
