<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


        $this->load->model('produk_model', 'produk');
    }
    public function index()
    {
        $this->load->model('m_security');
        $this->m_security->getsecurity();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['produk'] = $this->produk->get_all()->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('produk', $data);
    }
    public function update_harga()
    {
        $this->load->model('m_security');
        $this->m_security->getsecurity();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['produk'] = $this->produk->get_transaksi()->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('update_harga', $data);
    }

    public function ubah_harga()
    {
        $id = $_POST['id_tr'];
        $harga = $_POST['harga'];

        $data = array();
        $index = 0; // Set index array awal dengan 0
        foreach ($id as $k) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'id' => $k,
                'harga_produk' => $harga[$index]  // Ambil dan set data telepon sesuai index array dari $index
            ));

            $index++;
        }
        $this->db->update_batch('transaksi', $data, 'id');
    }
}
