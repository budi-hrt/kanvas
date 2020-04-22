


<?php
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="' . base_url('assets/') . 'css/penjualanKvs.css" rel="stylesheet">

    
</head>

<style>

</style>
<body>
<htmlpageheader name="myheader">
<div class="logo" style="text-align: left;margin-left:20px;"><img src="' . base_url('assets/img/logo/logosmall.png') . '"></div>
<div class="judul"> <u>LAPORAN PENJUALAN KANVAS</u></div>
<div style=" font-size: 9pt;text-align: center;">No : ' . $nomor['nomor_transaksi'] . '</div> 

<div style=" font-size: 9pt;text-align: right;">Tanggal : ' . date('d F Y', strtotime($nomor['tanggal'])) . '</div>
<table width="100%" cellpadding="10"><tr>
<td width="45%" style="border: 0 solid #888888; ">
<span style="font-size: 9pt; color: #555555; font-family: sans;">COMPANY :</span><br />
<span style="font-weight: bold; font-size: 11pt;">PT.Sinar Delima Panen Abadi</span><br />
<span style="font-size:9pt;">Jl.Zebra 1A No.93 - Kota Palu</span>
</td>

<td width="15%">&nbsp;</td>
<td width="45%" style="border: 0 solid #888888;"><span style="font-size: 9pt; color: #555555; font-family: sans;">SALES :</span><br /><span style="font-weight: bold; font-size: 11pt;">' . $nomor['nama_sales'] . '</span><br /> Area Kanvas : ' . $nomor['nama_area'] . '</td>
</tr></table>
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse;" cellpadding="8" >
<thead>
<tr>
<td rowspan="2"   width="5%" style="  padding-top: 12px;">No.</td>
<td rowspan="2"  width="35%" style="  padding-top: 12px;">Nama Produk</td>
<td colspan="2" width="13%">Awal</td>
<td colspan="2" width="13%">Akhir</td>
<td colspan="2" width="15%">Terjual</td>
<td rowspan="2"   width="20%" style="  padding-top: 12px;">Total Penjualan</td>
</tr>
<tr>
<td>Dos</td>
<td>Bks</td>
<td>Dos</td>
<td>Bks</td>
<td>Dos</td>
<td>Bks</td>
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

    $html .= '<tr class="cld">';
    if ($r['awal'] == 0 && $r['akhir'] == 0) {
        $html .= '
            ';
    } else {
        $html .= '
            <td class="list-item" align="center">' . $no++ . '</td>
            <td class="list-item">' . $r['nama_produk'] . '</td>
            <td class="list-item" align="center">' . $dos . '</td>
            <td class="list-item" align="center">' . $bks . '</td>
            <td class="list-item" align="center">' . $ados .  '</td>
            <td class="list-item" align="center">' .  $abks . '</td>
            <td class="list-item terjual" align="center">' . $tdos . '</td>
            <td class="list-item terjual" align="center">' . $tbks . '</td>
            <td class="list-item" align="right">' . number_format($total, 0, ',', '.') . '</td>
            ';
    }
    $html .= '</tr>';
    $subttl += $total;
}
$html .= '
<tr>
<td colspan="8" class="totals " ><b>Subtotal </b> :</td>
<td class="totals" ><b>' . number_format($subttl, 0, ',', '.') . '</b></td>
</tr>
<tr>
<td class="no-border" colspan="5" style="  padding-left: 10px;">Catatan :</td>
<td class="totals" colspan="3">Total Biaya :</td>
<td class="totals blank">-</td>
</tr>
<tr>
<td class="no-border catatan" style="  padding-left: 10px;font-style: italic;" colspan="5">' . $nomor['catatan'] . '</td>
<td class="totals" colspan="3">Transfer :</td>
<td class="totals blank">-</td>
</tr>
<tr>
<td class="no-border bawah" colspan="5"></td>
<td class="totals" colspan="3">Total Setor :</td>
<td class="totals blank">-</td>
</tr>

';


$html .= '
</tbody>
</table>
<br/>
';

$html .= '
<div class="judul biaya"><u>Laporan Biaya</u></div><br/>
<table width="100%" >
<tr>
<td width="50%">
<span class="judul biaya" >Rincian Biaya </span><br><br>
<span class=" biaya" >Priode Tgl : ......./...... s/d ........./......../' . date('Y') . '</span><br><br>
</td>
<td width="50%">
<span class="judul biaya" >Rincian Pengisian BBM </span><br><br>
<span class=" biaya" >Jenis Kendaraan : Motor/ Carry/ Apv/ L300/ PS/ .........</span><br><br>
</td>
</tr>
</table>

<div class="km">
<table class="items t-km" width="59%" style="border-collapse: collapse;" >
<thead>
<tr>
<td >Tgl</td>
<td  width="20%" >Km Isi</td>
<td  width="15%">J.BBM</td>
<td  width="11%">Ltr</td>
<td  width="25%">Harga</td>
<td  width="20%" >Losmen</td>
</tr>
</thead>
<tbody>';


for ($i = 0; $i < 12; $i++) {
    $html .= '
    <tr>
    <td class="list-item" align="center">/</td>
    <td class="list-item"></td>
    <td class="list-item"></td>
    <td class="list-item"></td>
    <td class="list-item"></td>
    <td class="list-item"></td>
    </tr>';
}
$html .= '
<tr>
<td class="list-item" colspan="3" align="center"><b>
Total</b>
</td>
<td class="list-item"></td>
<td class="list-item"></td>
<td class="list-item"></td>
</tr>
</tbody>
</table>

</div>
    



<table class="t-biaya"  width="40%">
<tr>
<td width="25%" align="left">No.Kendaraan</td>
<td width="50%" align="left">: ..................................</td>
<td width="10%" align="left"> </td>
</tr>
<tr>
<td width="25%" align="left">Tujuan</td>
<td width="50%" align="left">: ' . $nomor['nama_area'] . '</td>
<td width="10%" align="left"> </td>
</tr>
<tr>
<td width="25%" align="left">Nama Driver</td>
<td width="50%" align="left">: ..................................</td>
<td width="10%" align="left"> </td>
</tr>
<tr>
<td width="25%" align="left">KM. Awal</td>
<td width="50%" align="left">: ..................................</td>
<td width="10%" align="left"> </td>
</tr>
<tr>
<td width="25%" align="left">KM. Akhir</td>
<td width="50%" align="left">: ..................................</td>
<td width="10%" align="left"> </td>
</tr>
<tr>
<td width="25%" align="left">Biaya BBM</td>
<td width="50%" align="left">: ...............................Ltr</td>
<td width="10%" align="left">Rp............................... </td>
</tr>
<tr>
<td width="25%" align="left">Uang Makan</td>
<td width="50%" align="left">: ( .......Hr x ........Org )</td>
<td width="10%" align="left">Rp............................... </td>
</tr>
<tr>
<td width="25%" align="left">Penginapan</td>
<td width="50%" align="left">: ( ...........Malam / Hari ) </td>
<td width="10%" align="left">Rp............................... </td>
</tr>
<tr>
<td width="25%" align="left">Sewa Kos</td>
<td width="50%" align="left">: dari .......... s/d ...........</td>
<td width="10%" align="left">Rp............................... </td>
</tr>
<tr>
<td width="25%" align="left">Sewa Kos</td>
<td width="50%" align="left">: dari .......... s/d ...........</td>
<td width="10%" align="left">Rp............................... </td>
</tr>
<tr>
<td width="25%" align="left">Retribusi</td>
<td width="50%" align="left">:</td>
<td width="10%" align="left">Rp............................... </td>
</tr>
<tr>
<td width="25%" align="left">Biaya Lainnya</td>
<td width="45%" align="left">: ...............................</td>
<td width="10%" align="left">Rp...............................</td>
</tr>
<tr>
<td width="25%" align="left"></td>
<td width="45%" align="left">: .................................</td>
<td width="10%" align="left">Rp............................... </td>
</tr>
<tr>
<td width="25%" align="left">By Transfer</td>
<td width="45%" align="left">:</td>
<td width="10%" align="left">Rp............................... </td>
</tr>
<tr>
<td width="25%" align="left"></td>
<td width="45%" align="left"><b>Total Biaya</b></td>
<td width="10%" align="left"><b>Rp.......................... </b></td>
</tr>

</table>
</body>
</html>

';

$mpdf = new \Mpdf\Mpdf(['format' =>  [215, 310]]);
$mpdf->WriteHTML($html);
$mpdf->Output();
