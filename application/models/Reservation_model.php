<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation_model extends MY_Model
{
    public $_table = 'reservations';
    protected $soft_delete = TRUE;
    public $belongs_to = array(
        'book' => array('model' => 'book_model', 'primary_key' => 'book_id'),
        'copy' => array('model' => 'copy_model', 'primary_key' => 'copy_id'),
        'user' => array('model' => 'user_model', 'primary_key' => 'user_id'),
    );
}
