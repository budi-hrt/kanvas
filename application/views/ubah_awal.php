<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h5 class="h5 mb-2 text-gray-800">Edit Data</h5>
    <div class="row">
        <div class="col-md-5">
            <div class="form-group row">
                <label for="nomor" class="col-sm-3 col-form-label">Nomor Stok </label>
                <div class="col-sm-7 ml-n4">
                    <input type="text" class="form-control form-control-sm " id="nomor" name="nomor" value="<?= $nomor['nomor_transaksi']; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group row">
                <label for="sales" class="col-sm-2 col-form-label">Sales </label>
                <div class="col-sm-7 ml-n4">
                    <input type="text" class="form-control form-control-sm " id="sales" name="sales" autocomplete="off" value="<?= $nomor['nama_sales']; ?>">
                </div>
            </div>
        </div>

    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Stok Awal</h6>
            <div class="d-flex justify-content-end mt-n4 mb-n2">
                <a href="javascript:;" class="btn btn-sm btn-success" id="simpan"><i class="fas fa-pencil-alt"></i> Simpan</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Produk</th>
                            <th>Dos</th>
                            <th>Bks</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="detil_awal">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- modal-loading -->
<div class="modal bd-example-modal-sm " id="modal-loading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-loading-2" role="document">
        <div class="modal-content text-center shadow">
            <!-- <div class="modal-body text-center"> -->
            <label id="label-info">Please wait...</label>
            <!-- </div> -->

        </div>
    </div>
</div>



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
    history.pushState(null, null, location.href);
    window.onpopstate = function() {
        history.go(1);
        return window.confirm('Ada Perubahan yang belum disimpan!')

    };
</script>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });

        tampil_stok();
        show_hide();
    });

    function tampil_stok() {
        const nomor = $('#nomor').val();
        $.ajax({
            type: 'get',
            url: base_url + 'stok/tampil_stok',
            data: {
                nomor: nomor
            },
            success: function(html) {
                $('#detil_awal').html(html);

            }
        });
    }


    $('#detil_awal').on('click', '.item-edit', function() {
        const id = $(this).attr('data-id');
        const banding = $(this).attr('data-banding');
        const dos = $(this).attr('data-dos');
        const bks = $(this).attr('data-bks');
        $('input[name="id_detil"]').val(id);
        $('input[name="banding"]').val(banding);
        $('input[name="dos"]').val(dos);
        $('input[name="bks"]').val(bks);
        $('#modal-stok').modal('show');
    });


    $('#update').on('click', function() {
        const id = $('input[name="id_detil"]').val();
        const banding = $('input[name="banding"]').val();
        const dos = $('input[name="dos"]').val();
        const bks = $('input[name="bks"]').val();
        $.ajax({
            type: 'post',
            url: base_url + 'stok/update_awal',
            data: {
                id: id,
                banding: banding,
                dos: dos,
                bks: bks
            },
            success: function() {
                $('#modal-stok').modal('hide');
                tampil_stok();
            }
        });
    });

    $('#simpan').on('click', function() {
        $('#modal-loading').modal('show');
        setTimeout(function() {
            $('#modal-loading').modal('hide');
            window.location.href = base_url + 'stok/list_awl';
        }, 500);
    });
</script>
<?php $this->load->view('template/foothtml'); ?>