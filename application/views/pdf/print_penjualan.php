


<?php
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="' . base_url('assets/') . 'css/stylepdf.css" rel="stylesheet">
    
</head>

<style>

</style>



<body>
<htmlpageheader name="myheader">
<div style="font-weight: bold; font-size: 14pt;text-align: center;"><u>LAPORAN PENJUALAN KANVAS</u></div>
<div style=" font-size: 10pt;text-align: center;">No : ' . $nomor['nomor_transaksi'] . '</div> 

<div style=" font-size: 10pt;text-align: right;">Tanggal : ' . date('d F Y', strtotime($nomor['tanggal'])) . '</div>
<table width="100%" cellpadding="10"><tr>
<td width="45%" style="border: 0 solid #888888; ">
<span style="font-size: 10pt; color: #555555; font-family: sans;">COMPANY :</span><br />
<span style="font-weight: bold; font-size: 11pt;">PT.Sinar Delima Panen Abadi</span><br />
Jl.Zebra 1A No.93 - Kota Palu
</td>

<td width="15%">&nbsp;</td>
<td width="45%" style="border: 0 solid #888888;"><span style="font-size: 10pt; color: #555555; font-family: sans;">SALES :</span><br /><span style="font-weight: bold; font-size: 11pt;">' . $nomor['nama_sales'] . '</span><br /> Area Kanvas : ' . $nomor['nama_area'] . '</td>
</tr></table>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="8" >
<thead>
<tr>
<td  width="5%">No.</td>
<td width="45%">Nama Produk</td>
<td width="10%">Awal</td>
<td width="10%">Akhir</td>
<td width="10%">Terjual</td>
<td width="20%">Subtotal</td>
</tr>
</thead>
<tbody>';
// ITEMS HERE -->
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

    $html .= '<tr>';
    if ($r['awal'] == 0 && $r['akhir'] == 0) {
        $html .= '
            ';
    } else {
        $html .= '
            <td class="list-item" align="center">' . $no++ . '</td>
            <td class="list-item">' . $r['nama_produk'] . '</td>
            <td class="list-item" align="center">' . $dos . ' / ' . $bks . '</td>
            <td class="list-item" align="center">' . $ados . ' / ' . $abks . '</td>
            <td class="list-item" align="center">' . $tdos . ' / ' . $tbks . '</td>
            <td class="list-item" align="right">' . number_format($total, 0, ',', '.') . '</td>
            ';
    }
    $html .= '</tr>';
    $subttl += $total;
}
$html .= '
<tr>
    <td class="blanktotal"  rowspan="4" colspan="3" align="left">
    <span style="font-size: 10pt; color: #555555; font-family: sans;">Rincian Biaya :</span><br />
    <span style=" font-size: 9pt;">Pengisian BBM ( ..................Ltr ) : .........................</span><br />
    <span style=" font-size: 9pt;">Uang Makan ( ......hari X .....org ) : .........................</span><br />
    <span style=" font-size: 9pt;">Penginapan  ( ........hari / malam) : .........................</span><br />
    <span style=" font-size: 9pt;">Retibusi   : ........</span><br />
    <span style=" font-size: 9pt;">Biaya Lain -lain ( ..................... )  : .........................</span><br />
  
         </td>
        <td   colspan="2" class="totals">Subtotal:</td>
<td class="totals sbttl" align="right">' . number_format($subttl, 0, ',', '.') . '</td>
</tr>
<tr>
    <td colspan="2" class="totals">Total Biaya :</td>
    <td class="totals" align="right">-</td>
</tr>
<tr>
    <td colspan="2"  class="totals">Transfer :</td>
    <td class="totals" align="right">-</td>
</tr>
<tr>
    <td  colspan="2" class="totals">Total Setor :</td>
    <td class="totals" align="right">-</td>
</tr>
';


$html .= '
</tbody>
</table>

';

$html .= '
</body>
</html>

';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();
