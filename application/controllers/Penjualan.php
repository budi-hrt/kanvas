<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


        $this->load->model('penjualan_model', 'penjualan');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['penjualan'] = $this->penjualan->get_penjualan()->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('daftar_penjualan', $data);
    }


    public function get($nomor)
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['penjualan'] = $this->penjualan->get_edit($nomor)->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('edit-penjualan', $data);
    }


    public function tampil()
    {
        $nomor = $this->input->get('nomor');
        $this->db->select('t.id as id_detil,t.awal,t.akhir,t.kode_produk,p.nama_produk,p.banding,p.harga');
        $this->db->from('transaksi t');
        $this->db->join('produk p', 'p.kode=t.kode_produk', 'left');
        $this->db->where('t.nomor_stok', $nomor);
        $data = $this->db->get();

        if ($data->num_rows() > 1) {
            // foreach ($data->result_array() as $r) {

            // }
            $dt['data'] = $data->result_array();
            $this->load->view('edit_list', $dt);
        } else {
            echo '
                <tr>
                <input type="hidden" name="item" >
                <td colspan="7" rowspan="3" class="text-center"> Belum Ada Stok</td>
                
                </tr>


                ';
        }
    }
    public function update_awal()
    {
        $result = $this->penjualan->update_awal();
        $msg['success'] = false;
        $msg['type'] = 'awal';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
    public function update_akhir()
    {
        $result = $this->penjualan->update_akhir();
        $msg['success'] = false;
        $msg['type'] = 'akhir';
        if ($result) {
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }
}
