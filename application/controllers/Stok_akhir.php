<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok_akhir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();


        $this->load->model('stok_model', 'stok');
    }
    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['sales'] = $this->stok->data_sales()->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('stok_akhir', $data);
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
            $data = $cek->row_array();
            $msg['success'] = true;
            $msg['type'] = 'ada';
            $msg['nomor'] = $data['nomor_transaksi'];
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

    public function simpan_session_sales()
    {
        $array = array('id_sls', 'nm_sales', 'nmr');
        $this->session->unset_userdata($array);
        $id = $this->input->post('id_sales');
        $nama = $this->input->post('nama_sales');
        $nomor = $this->input->post('nomor');
        $sls = [
            'id_sls' => $id,
            'nm_sales' => $nama,
            'nmr' => $nomor
        ];
        $this->session->set_userdata($sls);
    }

    public function hapus_session_sales()
    {
        $array = array('id_sls', 'nm_sales', 'nmr');
        $this->session->unset_userdata($array);
    }

    public function simpan_tb()
    {
        $this->stok->insert_tb();
    }


    public function tampil_stok()
    {
        $nomor = $this->input->get('nomor');
        $this->db->select('t.id as id_detil,t.awal,t.akhir,t.kode_produk,p.nama_produk,p.banding,p.harga');
        $this->db->from('transaksi t');
        $this->db->join('produk p', 'p.kode=t.kode_produk', 'left');
        $this->db->where('t.nomor_stok', $nomor);
        $data = $this->db->get();
        $no = 1;
        $total = 0;
        $terjual = 0;
        $total = 0;
        $banding = 0;
        $dos = 0;
        $bks = 0;
        $res = 0;
        $ados = 0;
        $abks = 0;
        $ares = 0;
        $tdos = 0;
        $tbks = 0;
        $tres = 0;
        if ($data->num_rows() > 1) {
            foreach ($data->result_array() as $r) {
                $terjual = $r['awal'] - $r['akhir'];
                $total = $terjual * $r['harga'];
                $banding = $r['banding'];
                if ($r['awal'] >= $banding) {
                    $dos = floor($r['awal'] / $banding);
                    $res = $banding * $dos;
                    $bks = $r['awal'] - $res;
                } else {
                    $dos = 0;
                    $bks = $r['awal'];
                }

                if ($r['akhir'] >= $banding) {
                    $ados = floor($r['akhir'] / $banding);
                    $ares = $banding * $ados;
                    $abks = $r['akhir'] - $ares;
                } else {
                    $ados = 0;
                    $abks = $r['akhir'];
                }
                if ($terjual >= $banding) {
                    $tdos = floor($terjual / $banding);
                    $tres = $banding * $tdos;
                    $tbks = $terjual - $tres;
                } else {
                    $tdos = 0;
                    $tbks = $terjual;
                }
                echo '
                <tr>
                <td>' . $no++ . '</td>
                <td>' . $r['kode_produk'] . '</td>
                <td>' . $r['nama_produk'] . '</td>
                <td>' . $dos . '</td>
                <td>' . $bks . '</td>
                <td>' . $ados . '</td>
                <td>' . $abks . '</td>
                </tr>
                
                
                ';
            }
            echo '<input type="hidden" name="item" value="1">';
        } else {
            echo '
                <tr>
                <input type="hidden" name="item" >
                <td colspan="6" rowspan="3" class="text-center"> Belum Ada Stok</td>
                
                </tr>


                ';
        }
    }


    public function update_awal()
    {
        $this->stok->update_awal();
    }
}
