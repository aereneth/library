<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Copy_model extends MY_Model
{
    public $_table = 'copies';
    protected $soft_delete = TRUE;
    public $belongs_to = array(
        'book' => array('model' => 'book_model', 'primary_key' => 'book_id'),
    );
    public $has_many = array(
        'reservations' => array('model' => 'reservation_model', 'primary_key' => 'copy_id'),
    );
}
