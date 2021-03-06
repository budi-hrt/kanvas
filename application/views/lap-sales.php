<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row pl-5 mb-n3">
        <div class="col-md-3">
            <div class="form-group row">
                <label for="tgl_awal" class="col-sm-4 col-form-label">Dari</label>
                <div class="col-sm-7 ml-n5">
                    <input type="text" class="form-control form-control-sm datepicker text-center" id="tgl_awal" name="tgl_awal" data-date-format="dd-mm-yyyy" value="<?= date('d-m-Y'); ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md-3 ml-n5">
            <div class="form-group row">
                <label for="tgl_akhir" class="col-sm-4 col-form-label">Sampai</label>
                <div class="col-sm-7 ml-n3">
                    <input type="text" class="form-control form-control-sm datepicker" id="tgl_akhir" name="tgl_akhir" data-date-format="dd-mm-yyyy" value="<?= date('d-m-Y'); ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md-4 mr-3">
            <div class="form-group row">
                <label for="sales" class="col-sm-4 col-form-label">Area Kanvas</label>
                <div class="col-sm-8 ml-n3">
                    <select name="sales" id="sales" class="form-control form-control-sm">
                        <option value="">Pilih Sales</option>
                        <?php foreach ($sales as $s) : ?>
                            <option value="<?= $s['id']; ?>"><?= $s['nama_sales']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2 ml-n5">
            <button type="button" class="btn btn-primary btn-sm" id="cari"><i class="fas fa-search"></i> Cari laporan</button>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4" id="card-total">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered laporan table-striped table-hover" width="100%" cellspacing="0">
                    <thead class="bg-purple">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center" colspan="2">Omset</th>
                            <th class="text-right pr-5">Total</th>
                        </tr>
                    </thead>
                    <tbody id="tampil">

                    </tbody>
                </table>
            </div>


            <div class="d-flex justify-content-end">
                <a href="javascript:;" id="lihat-rinci" style="display: none"> Lihat Rincian <i class="fas fa-arrow-right text-primary"></i></a>
            </div>
        </div>
    </div>






    <!-- Card Rincian -->
    <div class="card shadow mb-4" id="card-rinci" style="display: none">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped table-hover  laporan" width="100%" cellspacing="0">
                    <thead class="bg-brown">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center" colspan="2">Omset</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-rinci">

                    </tbody>
                </table>
            </div>



            <div class="d-flex justify-content-end">
                <a href="javascript:;" id="kembali"><i class="fas fa-arrow-left text-primary"> </i> Kembali</a>
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
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });
    });

    $('#cari').on('click', function() {
        const tgl_awal = $('#tgl_awal').val();
        const tgl_akhir = $('#tgl_akhir').val();
        const sales = $('#sales option:selected').attr('value');
        if (sales == '') {
            alert('Sales belum dipilih');
        } else {
            $.ajax({
                type: 'get',
                url: base_url + 'laporan_sales/lap_ttlsales',
                data: {
                    tgl_awal: tgl_awal,
                    tgl_akhir: tgl_akhir,
                    sales: sales
                },
                success: function(html) {
                    $('#tampil').html(html);
                    tampil_rinci();
                }
            });

        }
    });


    function tampil_rinci() {
        const tgl_awal = $('#tgl_awal').val();
        const tgl_akhir = $('#tgl_akhir').val();
        const sales = $('#sales option:selected').attr('value');
        $.ajax({
            type: 'get',
            url: base_url + 'laporan_sales/rincian_sales',
            data: {
                tgl_awal: tgl_awal,
                tgl_akhir: tgl_akhir,
                sales: sales
            },
            success: function(html) {
                $('#tampil-rinci').html(html);
                $('#lihat-rinci').show('fadeIn');
            }
        });
    }



    $('#lihat-rinci').on('click', function() {

        $('#card-total').hide('blind', {
            direction: "vertical"
        }, 300);
        $('#card-rinci').show();
    });
    $('#kembali').on('click', function() {

        $('#card-total').show('blind', {
            direction: "vertical"
        }, 300);
        $('#card-rinci').hide();
    });
</script>
<?php $this->load->view('template/foothtml'); ?>