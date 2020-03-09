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

    public function get_stokAwal()
    {
        $this->db->select('p.id as id_pj, p.tanggal,p.nomor_transaksi,p.jumlah,s.nama_sales');
        $this->db->from('penjualan p');
        $this->db->join('sales s', 's.id=p.id_sales', 'dsc');
        $this->db->order_by('p.id', 'desc');
        $this->db->where('status_penjualan', 'Pending');
        $query =  $this->db->get();
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
        $id_user = $this->input->post('id_user');
        $data = array(
            'tanggal' => $tanggal,
            'nomor_transaksi' => $nomor,
            'id_sales' => $id_sales,
            'date_created' => time(),
            'date_update' => time(),
            'id_user' => $id_user
        );
        $this->db->insert('penjualan', $data);
    }
    public function update_tb()
    {

        $jumlah = $this->input->post('subttl');
        $tanggal = date('Y-m-d', strtotime($this->input->post('tanggal')));
        $nomor = $this->input->post('nomor');
        $id_user = $this->input->post('id_user');
        $data = array(
            'tanggal' => $tanggal,
            'jumlah' => $jumlah,
            'date_update' => time(),
            'id_user' => $id_user,
            'status_penjualan' => 'Stok'
        );
        $this->db->where('nomor_transaksi', $nomor);
        $this->db->update('penjualan', $data);
    }


    public function update_awal()
    {
        $id = $this->input->post('id');
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
    }
    public function update_akhir()
    {
        $id = $this->input->post('id');
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
    }



    public function get_penjualan($nomor)
    {
        $this->db->select('p.tanggal,p.nomor_transaksi,s.nama_sales,u.nama_user,a.nama_area,p.catatan');
        $this->db->from('penjualan p');
        $this->db->join('sales s', 's.id=p.id_sales', 'left');
        $this->db->join('user u', 'u.id_user=p.id_user', 'left');
        $this->db->join('area a', 'a.kode_area=p.kode_area', 'left');
        $this->db->where('p.nomor_transaksi', $nomor);
        $query = $this->db->get();
        return $query;
    }
}
