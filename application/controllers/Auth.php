<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{


    public function index()
    {
        $this->load->view('auth/login');
    }


    function getlogin()
    {
        $u = $_POST['username'];
        $p = $_POST['pwd'];
        $this->load->model('m_login');
        $this->m_login->get_login($u, $p);
    }
    function logout()
    {
        $this->session->sess_destroy();
        redirect('auth');
    }
}
