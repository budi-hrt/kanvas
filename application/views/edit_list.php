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

foreach ($data as $r) : ?>
    <?php


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
    }; ?>

    <tr>

        <td class="text-center"><?= $no++; ?></td>
        <td><?= $r['nama_produk']; ?></td>
        <td class="text-center ">
            <a href="javascript:;" class="item-awal" data-id="<?= $r['id_detil']; ?>" data-banding="<?= $r['banding']; ?>" data-dos="<?= $dos; ?>" data-bks="<?= $bks; ?>"><?= $dos; ?>/ <?= $bks; ?></a>
        </td>
        <td class="text-center">
            <a href="javascript:;" class=" item-akhir" data-ida="<?= $r['id_detil']; ?>" data-bandinga="<?= $r['banding']; ?>" data-ados="<?= $ados; ?>" data-abks="<?= $abks; ?>"><?= $ados; ?>/ <?= $abks; ?></a>
        </td>
        <td class="text-center"><?= $tdos; ?>/ <?= $tbks; ?></td>
        <td class="text-right"><?= number_format($total, 0, ',', '.'); ?></td>

    </tr>

    <?php
    $subttl += $total;; ?>


<?php endforeach; ?>

<tr>
    <td rowspan="5" colspan="3" class="text-center"><span> <img src="<?= base_url('assets/img/icon/cart.png'); ?>">
            <p>Penjaualan Sales Kanvas</p>
        </span> </td>
</tr>
<tr>
    <td colspan="2" class="text-right">Total Penjualan :</td>
    <td class="text-right bg-light pb-0">
        <h5><b><?= number_format($subttl, 0, ',', '.'); ?></b></h5>
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