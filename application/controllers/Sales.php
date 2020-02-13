<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sales extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


        $this->load->model('sales_model', 'sales');
    }
    public function index()
    {
        $this->load->model('m_security');
        $this->m_security->getsecurity();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['sales'] = $this->sales->get_all()->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('sales', $data);
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
