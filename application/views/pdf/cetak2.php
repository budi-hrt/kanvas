


<?php
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="' . base_url('assets/') . 'css/cetak.css" rel="stylesheet">
    
</head>

<style>

</style>



<body>
<htmlpageheader name="myheader">
<div class="ribbon-right">
<img src="' . base_url('assets/img/logo/ribbon.png') . '">
</div>

<div style="text-align: left;margin-left:20px;"><img src="' . base_url('assets/img/logo/logosmall.png') . '"></div>
<div  style="text-align: left;margin-left:18px;margin-bottom:30px;">
<span style="font-weight: bold; font-size: 11pt;">PT.Sinar Delima Panen Abadi</span><br />
Jl.Zebra 1A No.93 - Kota Palu
</div>



<table width="100%" cellpadding="10" ><tr>
<td width="45%" style="border: 0 solid #888888; ">
<span style="font-size: 10pt; color: #555555; font-family: sans;">SALES :</span><br />
<span style="font-weight: bold; font-size: 11pt;">' . $nomor['nama_sales'] . '</span><br />
Area Kanvas : ' . $nomor['nama_area'] . '
</td>

<td width="25%">&nbsp;</td>
<td width="30%" style="border: 0 solid #888888;"><span style="font-size: 10pt; color: #555555; font-family: sans;">Tanggal : ' . date('d F Y', strtotime($nomor['tanggal'])) . '</span><br /><span style=" font-size: 10pt;">No : ' . $nomor['nomor_transaksi'] . '</span><br />
Minggu Ke :  I / II / III / IV / V</td>
</tr></table>




<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="8" >
<thead>
<tr>
<td  width="5%">No.</td>
<td width="45%">Nama Produk</td>
<td width="10%">Awal</td>
<td width="10%">Akhir</td>
<td width="10%">Terjual</td>
<td width="20%">Total Penjualan</td>
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
$tahun=date('Y');
$html .= '
<tr>
    <td class="list-item2 sbttl" colspan="5" align="left" ><b>Subtotal</b></td>
    <td class="list-item2 sbttl" align="right" ><b>' . number_format($subttl, 0, ',', '.') . '</b></td>
</tr>
<tr>
    <td colspan="6" class="biaya">Rincian Biaya :</td>
   
</tr>
<tr>
<td></td>
<td  colspan="3" class="rincian-biaya"><span ><b>Priode Tanggal,</b></span>  ......../..........s/d ......../........./ '.$tahun.'</td>
</tr>
<tr>
<td></td>
<td  colspan="3" class="rincian-biaya"><span ><b>No.Kendaraan :</b></span> ....................................</td>
</tr>
<tr>
<td></td>
<td  colspan="3" class="rincian-biaya"><span ><b>Nama Driver :</b></span> .......................................</td>
</tr>
<tr>
<td></td>
    <td colspan="3" class="rincian-biaya">Biaya BBM : .............................................. ltr </td>
    <td class="rincian-biaya" align="right">:</td>
    <td class="rincian-biaya-left " align="right">-</td>
</tr>
<tr>
<td></td>
    <td colspan="3" class="rincian-biaya">Uang Makan : .................hari X .................orang</td>
    <td class="rincian-biaya" align="right">:</td>
    <td class="rincian-biaya-left" align="right">-</td>
</tr>
<tr>
<td></td>
    <td colspan="3" class="rincian-biaya">Biaya Penginapan : .................hari / malam</td>
    <td class="rincian-biaya" align="right">:</td>
    <td class="rincian-biaya-left" align="right">-</td>
</tr>
<tr>
<td></td>
    <td colspan="3" class="rincian-biaya">Biaya Kos /Kontrakan : dari ........./......./............  s/d ........./....../............</td>
    <td class="rincian-biaya" align="right">:</td>
    <td class="rincian-biaya-left" align="right">-</td>
</tr>
<tr>
<td></td>
    <td colspan="3" class="rincian-biaya">Retribusi / Parkir : </td>
    <td class="rincian-biaya" align="right">:</td>
    <td class="rincian-biaya-left" align="right">-</td>
</tr>
<tr>
<td></td>
    <td colspan="3" class="rincian-biaya">Biaya Lain -lain : </td>
    <td class="rincian-biaya" align="right">:</td>
    <td class="rincian-biaya" align="right">-</td>
</tr>
<tr>
    <td colspan="4" class="total-biaya">
    <span style="font-size: 11pt;font-weight: bold; font-family: sans;color:#273c75">Total Biaya</span><br/>
    <span style="font-weight: 100; font-size: 7pt;color:#636e72;"><i>Hasil penjumlahan rincian biaya.</i></span>
    </td>
    <td class="total-biaya" align="right">:</td>
    <td class="total-biaya-left" align="right">-</td>
</tr>
<tr>
    <td colspan="4" class="transfer">
    <span style="font-size: 11pt;font-weight: bold; font-family: sans;color:#273c75">Transfer</span><br/>
    <span style="font-weight: 100; font-size: 7pt;color:#636e72;"><i>Jumlah yang di transfer.</i></span>
    </td>
    <td class="transfer" align="right">:</td>
    <td class="transfer" align="right">-</td>
</tr>
<tr>
    <td colspan="4" class="total-biaya">
    <span style="font-size: 11pt;font-weight: bold; font-family: sans;color:#2d3436">Total Setor</span><br/>
    </td>
    <td class="total-biaya" align="right">:</td>
    <td class="total-biaya" align="right">-</td>
</tr>

';


$html .= '
</tbody>
</table></br>
<h5><i>Catatan : '.$nomor['catatan'].'<i/></h5>

';

$html .= '
</body>
</html>

';



$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$mpdf->Output();
