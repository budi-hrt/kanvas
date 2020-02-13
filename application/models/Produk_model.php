<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk_model extends CI_model
{
    public function get_all()
    {
        $this->db->where('is_active', 1);
        $query =  $this->db->get('produk');
        return $query;
    }

    public function get_transaksi()
    {
        $this->db->select('t.id as id_tr,t.kode_produk,t.harga_produk,p.nama_produk,p.harga');
        $this->db->from('transaksi t');
        $this->db->join('produk p', 'p.kode=t.kode_produk', 'left');
        $this->db->order_by('t.id', 'asc');
        $query = $this->db->get();
        return $query;
    }
}
