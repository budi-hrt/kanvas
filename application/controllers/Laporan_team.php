<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_team extends CI_Controller
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
        $data['team'] = $this->laporan->get_team()->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar', $data);
        $this->load->view('lap-ttlteam', $data);
    }

    public function rincian_team()
    {
        $team = $this->input->get('team');
        $tgl_awal = date('Y-m-d', strtotime($this->input->get('tgl_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->input->get('tgl_akhir')));
        $data = $this->laporan->get_ttlPenjualanTeam($team, $tgl_awal, $tgl_akhir);
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
        if ($data->num_rows() > 0) {
            foreach ($data->result_array() as $p) {
                echo '<tr>
                <td colspan="2" class="bg-swan-white "><b> Area Kanvas : ' . $p['nama_area'] . '</b> </td>
            //  <td colspan="2" class="bg-swan-white text-right pr-3 text-primary"><b>' . $p['nama_sales'] . '</b></td>
             </tr>';
                $area = $p['kode_area'];
                $sales = $p['id_sales'];
                $omset = $this->laporan->get_sumStokSales($area, $tgl_akhir, $tgl_awal, $sales)->result_array();

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
                      
                        <td class="text-center">' . $tdos . ' / ' . $tbks . '</td>
                        <td class="text-right">' . number_format($total, 0, ',', '.') . '</td>
                        ';
                        $subttl += $total;
                    }

                    echo '</tr>';
                }
                echo '
                <tr>
                <td colspan="3" class="text-right pr-5"><b> SUBTOTAL : ....</b></td>
                <td class="bg-yelow pl-1"><b> ' . number_format($subttl, 0, ',', '.') . '</b></td>
                </tr>';
                $subttl = 0;
            }
        } else {
            echo '<h3> Laporan Tidak ditemukan</h3>';
        }
    }


    public function lap_ttlTeam()
    {

        $team = $this->input->get('team');
        $tgl_awal = date('Y-m-d', strtotime($this->input->get('tgl_awal')));
        $tgl_akhir = date('Y-m-d', strtotime($this->input->get('tgl_akhir')));
        $data = $this->laporan->get_ttlPenjualanTeam($team, $tgl_awal, $tgl_akhir);
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
            $omset = $this->laporan->get_sumStokTeam($team, $tgl_akhir, $tgl_awal)->result_array();
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
            <td colspan="2" class="bg-light text-right"><b> Subtotal .....</b></td>
            <td class="text-center bg-light text-primary" width="50px"><b>' . $dusttl . '</b></td>
            <td class="text-center bg-light text-primary" width="50px"><b> ' . $bksttl . '</b></td>
            <td class="bg-yelow pr-1 text-right"><b> ' . number_format($subttl, 0, ',', '.') . '</b></td>
            </tr>';
            $subttl = 0;



            $n = 1;
            echo '<tr>
            <td colspan="5"> 
            <b>Kontribusi Oleh :</b><br>
            ';
            foreach ($data->result_array() as $p) {
                echo '
               
                <span class="ml-3"><b>' . $n++ . '.</b>
                <b>' . $p['nama_sales'] . '</b> <i class="far fa-star text-warning"></i> <i class="far fa-star text-warning"></i> <i class="far fa-star text-warning"></i><br></span>

               ';
            }
            echo ' </tr>
            </td>';
        } else {
            echo '<h3> Laporan Tidak ditemukan</h3>';
        }
    }
}
