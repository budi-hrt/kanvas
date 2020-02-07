<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h5 class="h5 mb-2 text-gray-800">Ubah Data Penjualan</h5>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-5 col-form-label">Nomor Stok</label>
                <div class="col-sm-7">
                    <input type="hidden" id="id_pj" name="id_pj" value="<?= $penjualan['id_pj']; ?>">
                    <input type="text" class="form-control form-control-sm" id="nomor" name="nomor" value="<?= $penjualan['nomor_transaksi']; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Tanggal </label>
                <div class="col-sm-7">
                    <input type="text" class="form-control form-control-sm datepicker" id="tanggal" name="tanggal" data-date-format="dd-mm-yyyy" value="<?= date('d-m-Y', strtotime($penjualan['tanggal'])); ?>" autocomplete="off" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-sm mb-3">
                <input type="hidden" name="id_sales" id="id_sales" class="id_sales" value="<?= $penjualan['id_sales']; ?>">
                <input type="text" class="form-control " name="nama_sales" id="nama_sales" readonly value="<?= $penjualan['nama_sales']; ?>">
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Penjualan</h6>
            <div class="d-flex justify-content-end mt-n4">
                <a href="javascript:;" id="simpan" style="display: none">Simpan</a><a href="javascript:;" id="buat">Buat</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>Produk</th>
                            <th>Awal</th>
                            <th>Akhir</th>
                            <th>Terjual</th>
                            <th>Total Penjualan</th>
                        </tr>
                    </thead>
                    <tbody id="detil_penjualan">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->








<div class="modal fade" id="modal-stok" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Masukan Stok Awal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="row justify-content-center">
                    <div class="col-md-8 ">

                        <input type="hidden" name="id_detil">
                        <input type="hidden" name="banding">
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Dos</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control " id="dos" name="dos">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Bks</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control " id="bks" name="bks">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn  btn-primary btn-block" id="update">Simpan</button>
            </div>

        </div>
    </div>
</div>




<?php $this->load->view('template/footer'); ?>

<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });

        tampil_stok();

    });


    function tampil_stok() {
        const nomor = $('#nomor').val();
        $.ajax({
            type: 'get',
            url: base_url + 'penjualan/tampil',
            data: {
                nomor: nomor
            },
            success: function(html) {
                $('#detil_penjualan').html(html);

            }
        });
    }
</script>


<?php $this->load->view('template/foothtml'); ?>