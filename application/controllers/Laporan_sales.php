<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_sales extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('laporan_model', 'laporan');
    }
    public function index()
    {
        $this->load->model('m_security');
        $this->m_security->getsecurity();
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['sales'] = $this->laporan->get_sales()->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('lap-sales', $data);
    }

    public function rincian_sales()
    {
        $sales = $this->input->get('sales');
        $tgl_awal = date('Y-m-d', strtotime($this->input->get('tgl_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->input->get('tgl_akhir')));
        $data = $this->laporan->get_ttlPenjualanSales($sales, $tgl_awal, $tgl_akhir);
        $total = 0;
        $terjual = 0;
        $total = 0;
        $subttl = 0;
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
        $dusttl = 0;
        $bksttl = 0;
        if ($data->num_rows() > 0) {
            foreach ($data->result_array() as $p) {
                echo '<tr>
                <td colspan="2" class="bg-swan-white "><b> Area Kanvas : ' . $p['nama_area'] . '</b> </td>
            //  <td colspan="3" class="bg-swan-white text-right pr-3 text-primary"><b>' . date('d F Y', strtotime($p['tanggal'])) . '</b></td>
             </tr>';
                $area = $p['kode_area'];
                $nomor = $p['nomor_transaksi'];
                $omset = $this->laporan->get_stok($nomor, $area, $tgl_akhir, $tgl_awal)->result_array();

                $no = 1;

                foreach ($omset as $r) {
                    $terjual = $r['awal'] - $r['akhir'];
                    $total = $terjual * $r['harga_produk'];
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





                    echo '  <tr>';
                    if ($r['awal'] == 0 && $r['akhir'] == 0) {
                        echo '
                    <td  style="display: none"">' . $no++ . '</td>
                    <td  style="display: none">' . $r['nama_produk'] . '</td>
                  
                    <td  style="display: none"">' . $tdos . ' / ' . $tbks . '</td>
                    <td  style="display: none">' . number_format($total, 0, ',', '.') . '</td>';
                    } else {
                        echo '
                        <td class="text-center">' . $no++ . '</td>
                        <td>' . $r['nama_produk'] . '</td>
                      
                        <td class="text-center" width="50px">' . $tdos . '</td>
                        <td class="text-center" width="50px">' . $tbks . '</td>
                        <td class="text-right">' . number_format($total, 0, ',', '.') . '</td>
                        ';
                        $subttl += $total;
                        $dusttl += $tdos;
                        $bksttl += $tbks;
                    }

                    echo '</tr>';
                }
                echo '
                <tr>
                <td colspan="2" class="text-right pr-5 bg-abu"><b> SUBTOTAL : ....</b></td>
                <td class="text-center bg-abu " width="50px"><b>' . $dusttl . '</b></td>
                <td class="text-center bg-abu " width="50px"><b> ' . $bksttl . '</b></td>
                <td class="bg-yelow pl-1 text-right"><b> ' . number_format($subttl, 0, ',', '.') . '</b></td>
                </tr>';
                $subttl = 0;
            }
        } else {
            echo '<h3> Laporan Tidak ditemukan</h3>';
        }
    }


    public function lap_ttlSales()
    {

        $sales = $this->input->get('sales');
        $tgl_awal = date('Y-m-d', strtotime($this->input->get('tgl_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->input->get('tgl_akhir')));
        $data = $this->laporan->get_ttlPenjualanSales($sales, $tgl_awal, $tgl_akhir);
        $total = 0;
        $terjual = 0;
        $total = 0;
        $subttl = 0;
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
        $dusttl = 0;
        $bksttl = 0;
        if ($data->num_rows() > 0) {
            $omset = $this->laporan->get_sumttlStokSales($sales, $tgl_akhir, $tgl_awal)->result_array();
            $no = 1;
            foreach ($omset as $r) {
                $terjual = $r['stkawal'] - $r['stkakhir'];
                $total = $terjual * $r['harga_produk'];
                $banding = $r['banding'];
                if ($r['stkawal'] >= $banding) {
                    $dos = floor($r['stkawal'] / $banding);
                    $res = $banding * $dos;
                    $bks = $r['stkawal'] - $res;
                } else {
                    $dos = 0;
                    $bks = $r['stkawal'];
                }

                if ($r['stkakhir'] >= $banding) {
                    $ados = floor($r['stkakhir'] / $banding);
                    $ares = $banding * $ados;
                    $abks = $r['stkakhir'] - $ares;
                } else {
                    $ados = 0;
                    $abks = $r['stkakhir'];
                }
                if ($terjual >= $banding) {
                    $tdos = floor($terjual / $banding);
                    $tres = $banding * $tdos;
                    $tbks = $terjual - $tres;
                } else {
                    $tdos = 0;
                    $tbks = $terjual;
                }

                echo '  <tr>';
                if ($r['stkawal'] == 0 && $r['stkakhir'] == 0) {
                    echo '
                <td  style="display: none"">' . $no++ . '</td>
                <td  style="display: none">' . $r['nama_produk'] . '</td>
              
                <td  style="display: none"">' . $tdos . ' / ' . $tbks . '</td>
                <td  style="display: none">' . number_format($total, 0, ',', '.') . '</td>';
                } else {
                    echo '
                    <td class="text-center">' . $no++ . '</td>
                    <td>' . $r['nama_produk'] . '</td>
                  
                    <td class="text-center" width="50px">' . $tdos . '</td>
                    <td class="text-center" width="50px"> ' . $tbks . '</td>
                    <td class="text-right">' . number_format($total, 0, ',', '.') . '</td>
                    ';
                    $subttl += $total;
                    $dusttl += $tdos;
                    $bksttl += $tbks;
                }

                echo '</tr>';
            }
            echo '
            <tr>
            <td colspan="2" class="bg-abu text-right"><b> Subtotal .....</b></td>
            <td class="text-center bg-abu " width="50px"><b>' . $dusttl . '</b></td>
            <td class="text-center bg-abu " width="50px"><b> ' . $bksttl . '</b></td>
            <td class="bg-yelow pr-1 text-right"><b> ' . number_format($subttl, 0, ',', '.') . '</b></td>
            </tr>';
            $subttl = 0;



            $n = 1;
            echo '<tr>
            <td colspan="5"> 
            <b>Area Kanvas :</b><br>
            ';
            $daerah =  $this->laporan->get_daerah($sales, $tgl_awal, $tgl_akhir)->result_array();
            foreach ($daerah as $p) {
                echo '
               
                <span class="ml-3"><b>' . $n++ . '.</b>
                <b>' . $p['nama_area'] . '</b> <i class="far fa-star text-warning"></i> <i class="far fa-star text-warning"></i> <i class="far fa-star text-warning"></i><br></span>

               ';
            }
            echo ' </tr>
            </td>';
        } else {
            echo '<h3> Laporan Tidak ditemukan</h3>';
        }
    }
}
