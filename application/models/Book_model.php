<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends MY_Model
{
    public $_table = 'books';
    public $belongs_to = array(
        'categories' => array('model' => 'category_model'),
    );
    public $has_many = array(
        'reservations' => array('model' => 'reservation_model'),
    );
}
