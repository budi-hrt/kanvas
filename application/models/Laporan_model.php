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

    public function get_penjualan($area, $tgl_awal, $tgl_akhir)
    {
        $this->db->select('p.tanggal,s.nama_sales,p.id_sales,p.nomor_transaksi');
        $this->db->join('sales s', 's.id=p.id_sales');
        $this->db->where('p.tanggal>=', $tgl_awal);
        $this->db->where('p.tanggal<=', $tgl_akhir);
        $this->db->where('p.kode_area', $area);
        $this->db->order_by('p.jumlah', 'desc');
        $query = $this->db->get('penjualan p');
        return $query;
    }

    public function get_stok($nomor, $area, $tgl_akhir, $tgl_awal)
    {
        $this->db->select('t.awal,t.akhir,t.tanggal_stok,p.nama_produk,p.harga,p.banding');
        $this->db->from('transaksi t');
        $this->db->join('produk p', 'p.kode=t.kode_produk', 'left');
        $this->db->where('t.tanggal_stok >=', $tgl_awal);
        $this->db->where('t.tanggal_stok <=', $tgl_akhir);
        $this->db->where('t.kode_area', $area);
        $this->db->where('t.nomor_stok', $nomor);
        $query = $this->db->get();
        return $query;
    }
}
