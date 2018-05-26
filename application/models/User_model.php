<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model
{
    public $_table = 'users';
    public $has_many = array(
        'reservations' => array('model' => 'reservation_model'),
    );
}
