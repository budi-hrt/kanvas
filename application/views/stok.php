<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h5 class="h5 mb-2 text-gray-800">Pemasukan Stok Awal</h5>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-5 col-form-label">Nomor Stok</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control form-control-sm" id="nomor" name="nomor" value="<?= $nomor; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-3 col-form-label">Tanggal </label>
                <div class="col-sm-7">
                    <input type="text" class="form-control form-control-sm datepicker" id="tanggal" name="tanggal" data-date-format="dd-mm-yyyy" value="<?= date('d-m-Y'); ?>" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="input-group input-group-sm mb-3">
                <input type="hidden" name="id_sales" id="id_sales" class="id_sales">
                <input type="text" class="form-control " name="nama_sales" id="nama_sales" placeholder="Cari/Pilih Sales" readonly>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-toggle="modal" data-target="#modal-sales"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Stok Awal</h6>
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

<!-- Table hideen -->
<table class="table table-sm table-bordered" width="100%" cellspacing="0" style="display: none">
    <thead class="bg-primary text-white">
        <tr>
            <th>Kode</th>
            <th>Produk</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($produk as $p) : ?>
            <tr>
                <input type="hidden" class="kode" value="<?= $p['kode']; ?>">
                <td width="150px"><?= $p['kode']; ?></td>
                <td width="150px"><?= $p['nama_produk']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->



<!-- Modal -->
<div class="modal fade" id="modal-sales" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Sales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-sm" id="table-sales">
                    <thead>
                        <th>#</th>
                        <th>Sales</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($sales as $s) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $s['nama_sales']; ?></td>
                                <td><a href="javascript:;" class="item-sales" data-id="<?= $s['id']; ?>" data-nama="<?= $s['nama_sales']; ?>">Pilih</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
    });



    $('#table-sales').on('click', '.item-sales', function() {
        const id_sales = $(this).attr('data-id');
        const nama_sales = $(this).attr('data-nama');
        $('#modal-sales').modal('hide');
        $('input[name=id_sales]').val(id_sales);
        $('input[name=nama_sales]').val(nama_sales);
    });

    $('#buat').on('click', function() {
        const id = $('#id_sales').val();
        if (id == '') {
            alert('Pilih Sales');
        } else {
            $.ajax({
                type: 'get',
                url: base_url + 'stok/get_stok',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        if (response.type == 'ada') {
                            alert('ada');
                        } else if (response.type == 'kosong') {
                            simpan_detil();
                            simpan_tb();
                            setTimeout(function() {
                                tampil_stok();
                            }, 500)
                        }
                    }
                }
            });
        }
    });


    function simpan_detil() {
        const kode = [];
        $('.kode').each(function() {
            kode.push($(this).val());
        });

        const nomor = $('#nomor').val();
        const tanggal = $('#tanggal').val();
        const id_sales = $('#id_sales').val();
        $.ajax({
            type: 'post',
            url: base_url + 'stok/simpan_detil',
            data: {
                nomor: nomor,
                kode: kode,
                tanggal: tanggal,
                id_sales: id_sales
            }
        });

    }

    function simpan_tb() {
        const nomor = $('#nomor').val();
        const tanggal = $('#tanggal').val();
        const id_sales = $('#id_sales').val();
        $.ajax({
            type: 'post',
            url: base_url + 'stok/simpan_tb',
            data: {
                nomor: nomor,
                tanggal: tanggal,
                id_sales: id_sales
            }
        });
    }



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
</script>
<?php $this->load->view('template/foothtml'); ?>