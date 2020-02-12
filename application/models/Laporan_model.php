<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_model
{

    public function get_area()
    {
        $this->db->where('is_active', 1);
        $query = $this->db->get('area');
        return $query;
    }

    public function get_laporan($area, $tgl_awal, $tgl_akhir)
    {
        $this->db->select('p.tanggal,s.nama_sales,p.id_sales');
        $this->db->join('sales s', 's.id=p.id_sales');
        $this->db->where('p.tanggal>=', $tgl_awal);
        $this->db->where('p.tanggal<=', $tgl_akhir);
        $this->db->where('p.kode_area', $area);
        $query = $this->db->get('penjualan');
    }
}
