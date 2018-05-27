<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{

    public function index()
    {
        $this->load->library('migration');

        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }

    public function latest()
    {
        $this->load->library('migration');

        if ($this->migration->latest() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }

    public function version($ver)
    {
        $this->load->library('migration');

        if ($this->migration->version($ver) === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }
}