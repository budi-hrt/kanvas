<!-- Begin Page Content -->
<div class="container-fluid pl-5 pr-5 pb-3 pt-0">

    <!-- Page Heading -->
    <ul class="list-group ">
        <li class="list-group-item p-1 pl-4 text-primary "><b> Nomor Stok : <?= $nomor['nomor_transaksi']; ?></b></li>
        <li class="list-group-item p-1 pl-4"> Tanggal Stok : <?= date('d-m-Y', strtotime($nomor['tanggal'])); ?></li>
        <li class="list-group-item p-1 pl-4 pr-4 d-flex justify-content-between align-items-center"> Nama Sales : <?= $nomor['nama_sales']; ?> <span>Daerah : </span></li>
    </ul>

    <!-- DataTales Example -->
    <div class="card mb-4 ">

        <div class="card-body pt-1">
            <input type="hidden" name="nomor" id="nomor" value="<?= $nomor['nomor_transaksi']; ?>">
            <table class="table table-sm ">
                <thead class="thead-light">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nama Produk</th>
                        <th class="text-center">Awal</th>
                        <th class="text-center">Akhir</th>
                        <th class="text-center">Terjual</th>
                        <th class="text-center">Total Penjualan</th>
                    </tr>

                </thead>
                <tbody id="tampil">

                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-n4 ml-4">
        <small>Admin Stok : <?= $nomor['nama_user']; ?></small>
    </div>
    <div class="row d-flex justify-content-center mb-3">
        <div class="col-md-4">
            <button class="btn btn-primary" id="print"><i class="fa s fa-print"></i> Print Penjualan</button>
            <a href="<?= base_url('admin'); ?>" class="btn btn-danger"><i class="fa s fa-home"></i> Dashboard</a>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php $this->load->view('template/footer'); ?>
<script>
    $(document).ready(function() {

        tampil_penjualan();

    });

    function tampil_penjualan() {
        const nomor = $('#nomor').val();
        $.ajax({
            type: 'get',
            url: base_url + 'stok_akhir/tampil_penjualan',
            data: {
                nomor: nomor
            },
            success: function(html) {
                $('#tampil').html(html);
            }
        });
    }


    $('#print').on('click', function() {
        window.print();
    });
</script>
<?php $this->load->view('template/foothtml'); ?>