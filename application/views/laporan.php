<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-3">
            <div class="form-group row">
                <label for="tgl_awal" class="col-sm-4 col-form-label">Dari</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control form-control-sm datepicker" id="tgl_awal" name="tgl_awal" data-date-format="dd-mm-yyyy" value="<?= date('d-m-Y'); ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group row">
                <label for="tgl_akhir" class="col-sm-4 col-form-label">Sampai</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control form-control-sm datepicker" id="tgl_akhir" name="tgl_akhir" data-date-format="dd-mm-yyyy" value="<?= date('d-m-Y'); ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group row">
                <label for="tgl_akhir" class="col-sm-4 col-form-label">Area Kanvas</label>
                <div class="col-sm-7">
                    <select name="area" id="area" class="form-control form-control-sm">
                        <option value="">Pilih Area Kanvas</option>
                        <?php foreach ($area as $a) : ?>
                            <option value="<?= $a['kode_area']; ?>"><?= $a['nama_area']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <button type="button" class="btn btn-primary btn-sm" id="cari"><i class="fas fa-search"></i> Cari</button>
        </div>
    </div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Sales</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Tanggal</th>
                            <th>Produk</th>
                            <th>terjual</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="tampil">

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
                }
            });

        }
    });
</script>
<?php $this->load->view('template/foothtml'); ?>