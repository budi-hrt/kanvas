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
    public function get_ttlPenjualan($area, $tgl_awal, $tgl_akhir)
    {
        $this->db->select('p.tanggal,s.nama_sales,p.id_sales,p.nomor_transaksi');
        $this->db->join('sales s', 's.id=p.id_sales');
        $this->db->where('p.tanggal>=', $tgl_awal);
        $this->db->where('p.tanggal<=', $tgl_akhir);
        $this->db->where('p.kode_area', $area);
        $this->db->group_by('p.id_sales');
        $query = $this->db->get('penjualan p');
        return $query;
    }

    public function get_stok($nomor, $area, $tgl_akhir, $tgl_awal)
    {
        $this->db->select('t.awal,t.akhir,t.tanggal_stok,p.nama_produk,t.harga_produk,p.banding');
        $this->db->from('transaksi t');
        $this->db->join('produk p', 'p.kode=t.kode_produk', 'left');
        $this->db->where('t.tanggal_stok >=', $tgl_awal);
        $this->db->where('t.tanggal_stok <=', $tgl_akhir);
        $this->db->where('t.kode_area', $area);
        $this->db->where('t.nomor_stok', $nomor);
        $query = $this->db->get();
        return $query;
    }



    public function get_sumStok($area, $tgl_akhir, $tgl_awal)
    {
        $this->db->select('SUM(t.awal) as stkawal,SUM(t.akhir) as stkakhir,t.harga_produk,p.banding,p.nama_produk,t.kode_produk');
        $this->db->from('transaksi t');
        $this->db->join('produk p', 'p.kode=t.kode_produk', 'left');
        $this->db->where('t.tanggal_stok >=', $tgl_awal);
        $this->db->where('t.tanggal_stok <=', $tgl_akhir);
        $this->db->where('t.kode_area', $area);
        $this->db->group_by('t.kode_produk');
        $query = $this->db->get();
        return $query;
    }




    // Awal laporan Team

    public function get_team()
    {
        $this->db->where('is_active', 1);
        $query = $this->db->get('pusat_area');
        return $query;
    }

    public function get_ttlPenjualanTeam($team, $tgl_awal, $tgl_akhir)
    {
        $this->db->select('p.tanggal,s.nama_sales,p.id_sales,p.nomor_transaksi,a.nama_area,p.kode_area');
        $this->db->join('sales s', 's.id=p.id_sales', 'left');
        $this->db->join('area a', 'a.kode_area=p.kode_area', 'left');
        $this->db->where('p.tanggal>=', $tgl_awal);
        $this->db->where('p.tanggal<=', $tgl_akhir);
        $this->db->where('p.kode_pstarea', $team);
        $this->db->group_by('p.kode_area');
        $this->db->group_by('p.id_sales');
        $query = $this->db->get('penjualan p');
        return $query;
    }

    public function get_sumStokTeam($team, $tgl_akhir, $tgl_awal)
    {
        $this->db->select('SUM(t.awal) as stkawal,SUM(t.akhir) as stkakhir,t.harga_produk,p.banding,p.nama_produk,t.kode_produk');
        $this->db->from('transaksi t');
        $this->db->join('produk p', 'p.kode=t.kode_produk', 'left');
        $this->db->where('t.tanggal_stok >=', $tgl_awal);
        $this->db->where('t.tanggal_stok <=', $tgl_akhir);
        $this->db->where('t.kode_pstarea', $team);
        $this->db->group_by('t.kode_produk');
        $query = $this->db->get();
        return $query;
    }


    public function get_sumStokSales($area, $tgl_akhir, $tgl_awal, $sales)
    {
        $this->db->select('SUM(t.awal) as stkawal,SUM(t.akhir) as stkakhir,t.harga_produk,p.banding,p.nama_produk,t.kode_produk');
        $this->db->from('transaksi t');
        $this->db->join('produk p', 'p.kode=t.kode_produk', 'left');
        $this->db->where('t.tanggal_stok >=', $tgl_awal);
        $this->db->where('t.tanggal_stok <=', $tgl_akhir);
        $this->db->where('t.kode_area', $area);
        $this->db->where('t.id_sales', $sales);
        $this->db->group_by('t.kode_produk');
        $query = $this->db->get();
        return $query;
    }


    // Akhir Laporan team





    // Laporan Sales
    public function get_sales()
    {
        $this->db->where('is_active', 1);
        $query = $this->db->get('sales');
        return $query;
    }

    public function get_ttlPenjualanSales($sales, $tgl_awal, $tgl_akhir)
    {
        $this->db->select('p.tanggal,s.nama_sales,p.id_sales,p.nomor_transaksi,a.nama_area,p.kode_area');
        $this->db->join('sales s', 's.id=p.id_sales', 'left');
        $this->db->join('area a', 'a.kode_area=p.kode_area', 'left');
        $this->db->where('p.tanggal>=', $tgl_awal);
        $this->db->where('p.tanggal<=', $tgl_akhir);
        $this->db->where('p.id_sales', $sales);
        $this->db->where('p.status_penjualan <>', 'Pending');
        $this->db->group_by('p.nomor_transaksi');
        // $this->db->group_by('p.kode_area');
        $query = $this->db->get('penjualan p');
        return $query;
    }

    public function get_sumttlStokSales($sales, $tgl_akhir, $tgl_awal)
    {
        $this->db->select('SUM(t.awal) as stkawal,SUM(t.akhir) as stkakhir,t.harga_produk,p.banding,p.nama_produk,t.kode_produk');
        $this->db->from('transaksi t');
        $this->db->join('produk p', 'p.kode=t.kode_produk', 'left');
        $this->db->where('t.tanggal_stok >=', $tgl_awal);
        $this->db->where('t.tanggal_stok <=', $tgl_akhir);
        $this->db->where('t.id_sales', $sales);
        $this->db->group_by('t.kode_produk');
        $query = $this->db->get();
        return $query;
    }

    public function get_daerah($sales, $tgl_awal, $tgl_akhir)
    {
        $this->db->select('p.tanggal,s.nama_sales,a.nama_area');
        $this->db->join('sales s', 's.id=p.id_sales', 'left');
        $this->db->join('area a', 'a.kode_area=p.kode_area', 'left');
        $this->db->where('p.tanggal>=', $tgl_awal);
        $this->db->where('p.tanggal<=', $tgl_akhir);
        $this->db->where('p.id_sales', $sales);
        $this->db->where('p.status_penjualan <>', 'Pending');
        $this->db->group_by('p.kode_area');
        $query = $this->db->get('penjualan p');
        return $query;
    }
    // Akhir Laporan Sales
}
