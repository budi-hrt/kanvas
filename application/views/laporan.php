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
                <label for="tgl_akhir" class="col-sm-4 col-form-label">Area Kanvas</label>
                <div class="col-sm-8 ml-n3">
                    <select name="area" id="area" class="form-control form-control-sm">
                        <option value="">Pilih Area Kanvas</option>
                        <?php foreach ($area as $a) : ?>
                            <option value="<?= $a['kode_area']; ?>"><?= $a['nama_area']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2 ml-n5">
            <button type="button" class="btn btn-primary btn-sm" id="cari"><i class="fas fa-search"></i> Cari</button>
            <button type="button" class="btn btn-success btn-sm" id="total" style="display: none">Lihat Total</button>

        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4" id="card-rinci">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-striped table-hover  laporan " width="100%" cellspacing="0">
                    <thead class="bg-brown">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center" colspan="2">Omset</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody id="tampil">

                    </tbody>
                </table>
            </div>
        </div>
    </div>








    <!-- Card Total -->
    <div class="card shadow mb-4" id="card-total" style="display: none">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm laporan table-bordered table-striped table-hover  " width="100%" cellspacing="0">
                    <thead class="bg-brown">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nama Produk</th>
                            <th class="text-center" colspan="2">Omset</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody id="tampil_total">

                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                <a href="javascript:;" id="back-rinci"><i class="fas fa-arrow-left text-primary"></i> Kembali</a>
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
        const area = $('#area option:selected').attr('value');
        if (area == '') {
            alert('area belum dipilih');
        } else {
            $.ajax({
                type: 'get',
                url: base_url + 'laporan/cari_laporan',
                data: {
                    tgl_awal: tgl_awal,
                    tgl_akhir: tgl_akhir,
                    area: area
                },
                success: function(html) {
                    $('#tampil').html(html);
                    tampil_total();
                    $('#total').show().fadeIn();
                }
            });

        }
    });


    function tampil_total() {
        const tgl_awal = $('#tgl_awal').val();
        const tgl_akhir = $('#tgl_akhir').val();
        const area = $('#area option:selected').attr('value');
        $.ajax({
            type: 'get',
            url: base_url + 'laporan/lap_ttldaerah',
            data: {
                tgl_awal: tgl_awal,
                tgl_akhir: tgl_akhir,
                area: area
            },
            success: function(html) {
                $('#tampil_total').html(html);
            }
        });
    }


    $('#total').on('click', function() {

        $('#card-rinci').hide('blind', {
            direction: "vertical"
        }, 300);
        $('#card-total').show();
        $('#total').hide()
    });
    $('#back-rinci').on('click', function() {

        $('#card-rinci').show('blind', {
            direction: "vertical"
        }, 300);
        $('#card-total').hide();
        $('#total').show()
    });
</script>
<?php $this->load->view('template/foothtml'); ?>