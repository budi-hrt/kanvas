<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Produk</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success"><a href="javascript:;" id="update_harga"><i class="fas fa-pencil-alt"></i> Update Harga </a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>Id</th>
                            <th>Nama</th>
                            <th>Harga Transaksi</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($produk as $p) : ?>
                            <tr>
                                <input type="hidden" class="id_tr" value="<?= $p['id_tr']; ?>">
                                <input type="hidden" class="harga" value="<?= $p['harga']; ?>">
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $p['id_tr']; ?></td>
                                <td><?= $p['nama_produk']; ?></td>
                                <td><?= $p['harga_produk']; ?></td>
                                <td><?= $p['harga']; ?></td>
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
    $('#update_harga').on('click', function() {
        const id_tr = [];
        $('.id_tr').each(function() {
            id_tr.push($(this).val());
        });
        const harga = [];
        $('.harga').each(function() {
            harga.push($(this).val());
        });

        $.ajax({
            type: 'post',
            url: base_url + 'produk/ubah_harga',
            data: {
                id_tr: id_tr,
                harga: harga
            },
            success: function() {
                alert('success');
            }

        });
    });
</script>
<?php $this->load->view('template/foothtml'); ?>