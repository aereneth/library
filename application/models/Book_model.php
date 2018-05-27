<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends MY_Model
{
    public $_table = 'books';
    protected $soft_delete = TRUE;
    public $belongs_to = array(
        'category' => array('model' => 'category_model', 'primary_key' => 'category_id'),
    );
    public $has_many = array(
        'reservations' => array('model' => 'reservation_model'),
    );
    // public $after_get = array('get_category');

    public function get_category($book)
    {
        $book->category = $book->category->name;
        return $book;
    }
}
