<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{




    public function index()
    {
        $this->load->model('m_security');
        $this->m_security->getsecurity();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('home');
    }

    public function penjualan()
    {
        $this->load->model('m_security');
        $this->m_security->getsecurity();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $this->load->view('sales/header', $data);
        $this->load->view('sales/sidebar');
        $this->load->view('sales/topbar', $data);
        $this->load->view('sales/penjualan');
    }
}
