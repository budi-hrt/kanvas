<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('laporan_model', 'laporan');
    }
    public function index()
    {
        $this->load->model('m_security');
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['area'] = $this->laporan->get_area()->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('laporan', $data);
    }

    public function cari_laporan()
    {
        $area = $this->input->get('area');
        $tgl_awal = date('Y-m-d', strtotime($this->input->get('tgl_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->input->get('tgl_akhir')));
        $this->db->select('*');
        $this->db->from('transaksi');
        $this->db->where('t.tanggal_stok >=', $tgl_awal);
        $this->db->where('t.tanggal_stok <=', $tgl_akhir);
        $this->db->where('t.kode_area', $area);
        $data = $this->db->get();
        if ($data->num_rows() > 0) {
            $dt['laporan'] = $this->laporan->get_penjualan($area, $tgl_awal, $tgl_akhir);
            $this->load->view('list_laporan', $tgl_awal, $tgl_akhir, $area, $dt);
        } else {
            echo '<h3> Laporan Tidak ditemukan</h3>';
        }
    }
}
