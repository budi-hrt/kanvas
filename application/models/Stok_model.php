<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_model extends CI_model
{
    public function get_all()
    {
        $this->db->where('is_active', 1);
        $query =  $this->db->get('produk');
        return $query;
    }


    function nomor_stok()
    {
        $bln = date('m');
        $thn = date('Y');
        $q = $this->db->query("SELECT MAX(RIGHT(nomor_transaksi,3)) AS kd_max FROM penjualan WHERE MONTH(tanggal)=$bln AND YEAR(tanggal)=$thn ");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int) $k->kd_max) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "001";
        }
        $car = "STOK";
        date_default_timezone_set('Asia/Jakarta');
        return $car . date('ym') . $kd;
    }

    public function data_sales()
    {
        $this->db->where('is_active', 1);
        $query =  $this->db->get('sales');
        return $query;
    }



    public function save_batch($data)
    {
        return $this->db->insert_batch('transaksi', $data);
    }

    public function insert_tb()
    {

        $id_sales = $this->input->post('id_sales');
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $nomor = $this->input->post('nomor');
        $data = array(
            'tanggal' => $tanggal,
            'nomor_transaksi' => $nomor,
            'id_sales' => $id_sales
        );
        $this->db->insert('penjualan', $data);
    }
}
