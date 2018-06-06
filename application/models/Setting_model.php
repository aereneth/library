<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends MY_Model
{
    public $_table = 'settings';
    protected $soft_delete = FALSE;
}
