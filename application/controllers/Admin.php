<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
        ];

        $this->load->view('index', $data);
    }
}

/* End of file Admin.php */
