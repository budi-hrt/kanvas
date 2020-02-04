<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


        $this->load->model('stok_model', 'stok');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['produk'] = $this->stok->get_all()->result_array();
        $data['nomor'] = $this->stok->nomor_stok();
        $data['sales'] = $this->stok->data_sales()->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('stok', $data);
    }


    public function get_stok()
    {
        $msg['success'] = false;
        $id_sales = $this->input->get('id');
        $status = 'Pending';
        $cek = $this->db->get_where('penjualan', ['id_sales' => $id_sales, 'status_penjualan' => $status]);
        if ($cek->num_rows() < 1) {
            $msg['success'] = true;
            $msg['type'] = 'kosong';
            echo json_encode($msg);
        } else {
            $msg['success'] = true;
            $msg['type'] = 'ada';
            echo json_encode($msg);
        }
    }


    public function simpan_detil()
    {
        $nomor = $_POST['nomor'];
        $kode_produk = $_POST['kode'];
        $tanggal = date('Y-m-d', strtotime($_POST['tanggal']));
        $id_sales = $_POST['id_sales'];
        $data = array();
        $index = 0; // Set index array awal dengan 0
        foreach ($kode_produk as $k) { // Kita buat perulangan berdasarkan nis sampai data terakhir
            array_push($data, array(
                'nomor_stok' => $nomor,
                'kode_produk' => $k,  // Ambil dan set data nama sesuai index array dari $index
                'tanggal_awal' => $tanggal,  // Ambil dan set data alamat sesuai index array dari $index
                'id_sales' => $id_sales  // Ambil dan set data telepon sesuai index array dari $index
            ));

            $index++;
        }
        $this->stok->save_batch($data);
    }

    public function simpan_tb()
    {
        $this->stok->insert_tb();
    }


    public function tampil_stok()
    {
        $nomor = $this->input->get('nomor');
        $this->db->select('t.id as id_detil,t.awal,t.akhir,t.kode_produk,p.nama_produk');
        $this->db->from('transaksi t');
        $this->db->join('produk p', 'p.kode=t.kode_produk', 'left');
        $this->db->where('t.nomor_stok', $nomor);
        $data = $this->db->get();
        $no = 1;
        if ($data->num_rows() > 1) {
            foreach ($data->result_array() as $t) {

                echo '
                <tr>
                <td>' . $no++ . '</td>
                <td>' . $t['kode_produk'] . '</td>
                <td>' . $t['nama_produk'] . '</td>
                <td>' . $t['awal'] . '</td>
                <td>' . $t['awal'] . '</td>
                <td><a href="javascript:;"><i class="fas fa-edit"></i></a></td>
                </tr>


                ';
            }
        } else {
            echo '
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="javascript:;"><i class="fas fa-edit"></i></a></td>
                </tr>


                ';
        }
    }
}
