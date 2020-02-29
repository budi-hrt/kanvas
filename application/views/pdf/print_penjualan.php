<?php

$no = 1;
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
$nmr = $nomor['nomor_transaksi'];
$tgl = date('d-m-Y', strtotime($nomor['tanggal']));
$sales = $nomor['nama_sales'];
$daerah = $nomor['nama_area'];



class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {

        // Logo
        $image_left = K_PATH_IMAGES . 'logosmall.png';
        $this->Image($image_left, 10, 10, 28, '', 'png', '', 'T', false, 300, 'L', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 12);
        // Title
        $this->Cell(0, 0, '', 0, 1, 'C', 0, '', 3);
        $this->Cell(0, 0, 'LAPORAN PENJUALAN KANVAS', 0, 1, 'C', 0, '', 0);
    }
}
$pdf = new MYPDF('P', 'mm', 'F4', true, 'UTF-8', false);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setFooterData();
$pdf->SetTopMargin(30);
$pdf->SetFooterMargin(10);
$pdf->SetDisplayMode('real', 'default');
$pdf->AddPage();




$output = '
<h6>Nomor Stok : ' . $nmr . '</h6>
<h6>tanggal Stok : ' . $tgl . '</h6>
<h6>nama Sales : ' . $sales . ' ( ' . $daerah . ' )</h6>

<table border="0.5" cellspacing="0" cellpadding="1">
<thead>
        <tr>
            <th width="30"  align="center" >No</th>
            <th width="240"  align="center" >Nama Produk</th>
            <th width="60" align="center" >Awal</th>
            <th width="60" align="center" >Akhir</th>
            <th width="60" align="center" >Terjual</th>
            <th align="center" >Total Penjualan</th>
        </tr>
</thead>';
$output .= '<tbody>';


// Looping 
foreach ($data as $r) {
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
    $output .= '<tr>';
    if ($r['awal'] == 0 && $r['akhir'] == 0) {
    } else {
        $output .= '
        <td width="30"  align="center">' . $no++ . '</td>
        <td  width="240"  align="left">' . $r['nama_produk'] . '</td>
        <td  width="60" align="center">' . $dos . ' / ' . $bks . '</td>
        <td  width="60" align="center">' . $ados . ' / ' . $abks . '</td>
        <td  width="60" align="center">' . $tdos . ' / ' . $tbks . '</td>
        <td align="right">' . number_format($total, 0, ',', '.') . '</td>
        ';
    }





    $output .= '</tr>';
    $subttl += $total;
}
// Akhir Looping

$output .= '
<tr>
    <td rowspan="7" colspan="3"><span>
            <p>Penjaualan Sales Kanvas</p>
        </span> </td>
</tr>
<tr>
    <td colspan="2" class="text-right">Total Penjualan :</td>
    <td class="text-right bg-light pb-0">
        <h5><b>' . number_format($subttl, 0, ',', '.') . '</b></h5>
    </td>
</tr>
<tr>
    <td colspan="2" class="text-right">Total Biaya :</td>
    <td class="text-right">-</td>
</tr>
<tr>
    <td colspan="2" class="text-right">Transfer :</td>
    <td class="text-right">-</td>
</tr>
<tr>
    <td colspan="2" class="text-right">Total Setor :</td>
    <td class="text-right bg-light">-</td>
</tr>



';

$pdf->writeHTML($tbl, true, false, false, false, '');






$output .= '</tbody>';
$output .= '

</table>';





$pdf->writeHTML($output, true, false, true, false, '');
ob_end_clean();
$pdf->Output('Laporan_data_absensi.pdf', 'I');
