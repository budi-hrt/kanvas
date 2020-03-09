<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_model
{
    public function get_penjualan()
    {
        $this->db->select('p.id as id_pj, p.tanggal,p.nomor_transaksi,p.jumlah,s.nama_sales,p.catatan');
        $this->db->from('penjualan p');
        $this->db->join('sales s', 's.id=p.id_sales', 'dsc');
        $this->db->order_by('p.id', 'desc');
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



    public function update_awal()
    {
        $id = $this->input->post('id_detil');
        $banding = $this->input->post('banding');
        // $awal = $this->input->post('awal');
        $dos = $this->input->post('dos');
        $bks = $this->input->post('bks');
        $stok = $dos * $banding;
        $awal = $stok + $bks;
        $data = array(
            'awal' => $awal
        );
        $this->db->where('id', $id);
        $this->db->update('transaksi', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function update_akhir()
    {
        $id = $this->input->post('id_detil');
        $banding = $this->input->post('banding');
        // $awal = $this->input->post('awal');
        $dos = $this->input->post('dos');
        $bks = $this->input->post('bks');
        $stok = $dos * $banding;
        $akhir = $stok + $bks;
        $data = array(
            'akhir' => $akhir
        );
        $this->db->where('id', $id);
        $this->db->update('transaksi', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
