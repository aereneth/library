<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends MY_Model
{
    public $_table = 'categories';
    public $has_many = array(
        'books' => array('model' => 'book_model')
    );
}
