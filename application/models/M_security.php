<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_security extends CI_model
{


    public function getsecurity()
    {
        $username = $this->session->userdata('username');
        if (empty($username)) {
            $this->session->sess_destroy();
            redirect('auth');
        }
    }
}
