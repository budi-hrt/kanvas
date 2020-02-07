<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_model
{
    public function get_penjualan()
    {
        $this->db->select('p.id as id_pj, p.tanggal,p.nomor_transaksi,p.jumlah,s.nama_sales');
        $this->db->from('penjualan p');
        $this->db->join('sales s', 's.id=p.id_sales', 'dsc');
        $this->db->order_by('p.id', 'asc');
        $this->db->where('status_penjualan <>', 'Pending');
        $query =  $this->db->get();
        return $query;
    }
    public function get_edit($nomor)
    {
        $this->db->select('p.id as id_pj, p.tanggal,p.nomor_transaksi,p.jumlah,s.nama_sales,p.id_sales');
        $this->db->from('penjualan p');
        $this->db->join('sales s', 's.id=p.id_sales', 'dsc');
        $this->db->where('nomor_transaksi', $nomor);
        $query =  $this->db->get();
        return $query;
    }
}
