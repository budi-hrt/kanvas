<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h5 mb-2 text-gray-800 ml-2"><img src="<?= base_url('assets/img/icon/cart.png'); ?>" style="width: 32px;"> Daftar Penjualan</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Nomor Stok</th>
                            <th class="text-center">Sales</th>
                            <th class="text-center">Total </th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($penjualan as $p) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="text-center"><?= date('d-m-Y', strtotime($p['tanggal'])); ?></td>
                                <td class="text-center"><?= $p['nomor_transaksi']; ?></td>
                                <td><?= $p['nama_sales']; ?></td>
                                <td class="text-right"><?= number_format($p['jumlah'], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('stok_akhir/penjualan/'); ?><?= $p['nomor_transaksi']; ?>" class="mr-2 item-print" target="blank"><i class="fas fa-print text-info"></i></a>
                                    <!-- <a href="javascript:;" class="item-edit" data-id="<?= $p['id_pj']; ?>" data-nomor="<?= $p['nomor_transaksi']; ?>"><i class="fas fa-pencil-alt text-success"></i></a> -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php $this->load->view('template/footer'); ?>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });


    $('#dataTable').on('click', '.item-edit', function() {
        const id = $(this).attr('data-id');
        const nomor = $(this).attr('data-nomor');
        window.location.href = base_url + "penjualan/get/" + nomor;
    });
</script>
<?php $this->load->view('template/foothtml'); ?>