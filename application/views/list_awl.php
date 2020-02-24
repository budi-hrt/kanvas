<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Stok Awal</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header ">
            <h6 class="m-0 font-weight-bold text-primary"><a href="<?= base_url('stok'); ?>" class="btn btn-sm btn-primary"> Tambah </a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>Nomor Stok</th>
                            <th>Tanggal</th>
                            <th>Nama Sales</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($awl as $p) : ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $p['nomor_transaksi']; ?></td>
                                <td><?= date('d F Y', strtotime($p['tanggal'])); ?></td>
                                <td><?= $p['nama_sales']; ?></td>
                                <td><a href="javascript:;" class="item-edit" data-nomor="<?= $p['nomor_transaksi']; ?>"><i class="fas fa-edit"></i></a></td>
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

    $('.item-edit').on('click', function() {
        const nomor = $(this).attr('data-nomor');
        window.location.href = base_url + 'stok/ubah/' + nomor;
    });
</script>
<?php $this->load->view('template/foothtml'); ?>