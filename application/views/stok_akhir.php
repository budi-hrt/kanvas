<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <h5 class="h5 mb-2 text-gray-800">Pemasukan Stok Akhir</h5>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group row">
                <label for="inputPassword" class="col-sm-5 col-form-label">Nomor Stok</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control form-control-sm" id="nomor" name="nomor" value="<?= $this->session->userdata('nmr'); ?>" readonly>
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
                <input type="hidden" name="id_sales" id="id_sales" class="id_sales" value="<?= $this->session->userdata('id_sls'); ?>">
                <input type="text" class="form-control " name="nama_sales" id="nama_sales" placeholder="Cari/Pilih Sales" readonly value="<?= $this->session->userdata('nm_sales'); ?>">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" data-toggle="modal" data-target="#modal-sales"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List Stok</h6>
            <div class="d-flex justify-content-end mt-n4">
                <a href="javascript:;" class="btn btn-sm btn-success mb-n2" id="simpan" style="display: none"> Simpan & Print</a>
                <a href="javascript:;" class="btn btn-sm btn-warning mb-n2" id="cek">Cek Data Stok</a>
                <a href="javascript:;" class="btn btn-sm btn-danger mb-n2 ml-1 kosongkan" style="display: none">Kosongkan</a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th rowspan="2"></th>
                            <th rowspan="2">Kode</th>
                            <th rowspan="2">Produk</th>
                            <th colspan="2">Awal</th>
                            <th colspan="2">Akhir</th>
                        </tr>
                        <tr>
                            <th>Dos</th>
                            <th>Bks</th>
                            <th>Dos</th>
                            <th>Bks</th>
                        </tr>
                    </thead>
                    <tbody id="detil_akhir">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->





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




<div class="modal fade" id="modal-stok" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Masukan Stok Akhir</h5>
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



<?php $this->load->view('template/footer'); ?>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        });

        tampil_stok();
        show_hide();
    });


    function show_hide() {
        const sls = $('input[name="id_sales"]');
        if (sls.val() == '') {
            $('#simpan').hide();
            $('.kosongkan').hide();
        } else {
            $('#simpan').show();
            $('#cek').hide();
            $('.kosongkan').show();
        }

    }


    function nomor() {
        const id = $('#id_sales').val();
        $.ajax({
            type: 'get',
            url: base_url + 'stok_akhir/nomor',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $('input[name=nomor]').val(data.nomor_transaksi);
            }
        });
    }

    $('#table-sales').on('click', '.item-sales', function() {
        const id_sales = $(this).attr('data-id');
        const nama_sales = $(this).attr('data-nama');
        $('#modal-sales').modal('hide');
        $('input[name=id_sales]').val(id_sales);
        $('input[name=nama_sales]').val(nama_sales);
    });

    $('#cek').on('click', function() {
        const id = $('#id_sales').val();
        if (id == '') {
            alert('Pilih Sales');
        } else {
            $.ajax({
                type: 'get',
                url: base_url + 'stok_akhir/get_stok',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        if (response.type == 'ada') {
                            console.log(response.nomor);
                            $('input[name="nomor"]').val(response.nomor);
                            setTimeout(function() {
                                simpan_session_sales();
                                tampil_stok();
                            }, 300);
                        } else if (response.type == 'kosong') {
                            alert('kosong');
                            // simpan_detil();
                            // simpan_session_sales();
                            // setTimeout(function() {
                            //     tampil_stok();
                            //     $('#simpan').show();
                            //     $('#buat').hide();
                            // }, 500)
                        }
                    }
                }
            });
        }
    });



    function simpan_session_sales() {
        const id_sales = $('#id_sales').val();
        const nama_sales = $('#nama_sales').val();
        const nomor = $('#nomor').val();
        $.ajax({
            type: 'post',
            url: base_url + 'stok_akhir/simpan_session_sales',
            data: {
                nama_sales: nama_sales,
                id_sales: id_sales,
                nomor: nomor
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
            url: base_url + 'stok_akhir/tampil_stok',
            data: {
                nomor: nomor
            },
            success: function(html) {
                $('#detil_akhir').html(html);
                show_hide();
            }
        });
    }

    $('.kosongkan').on('click', function() {
        $('#modal-loading').modal('show');
        hapus_session_sales();
        setTimeout(function() {
            $('#modal-loading').modal('hide');
            window.location.href = base_url + "stok_akhir";
        }, 500);
    });

    $('#detil_akhir').on('click', '.item-edit', function() {
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
            url: base_url + 'stok_akhir/update_akhir',
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
        const nomor = $('#nomor').val();
        const tanggal = $('#tanggal').val();
        const subttl = $('input[name="subttl"]').val();
        const id_user = '<?= $user['id_user']; ?>';
        $.ajax({
            type: 'post',
            url: base_url + 'stok_akhir/update_tb',
            data: {
                nomor: nomor,
                tanggal: tanggal,
                subttl: subttl,
                id_user: id_user
            },
            success: function() {
                hapus_session_sales();
                update_detil();
                $('#modal-loading').modal('show');
                setTimeout(function() {
                    $('#modal-loading').modal('hide');
                    window.location.href = base_url + 'stok_akhir/penjualan/' + nomor;
                }, 300);
            }
        });
    });

    function hapus_session_sales() {
        $.ajax({
            url: base_url + 'stok_akhir/hapus_session_sales'
        });

    }


    function update_detil() {
        const id_trs = [];
        $('.id_trs').each(function() {
            id_trs.push($(this).val());
        });

        $.ajax({
            type: 'post',
            url: base_url + 'stok_akhir/update_detil',
            data: {
                id_trs: id_trs

            }
        });
    }
</script>
<?php $this->load->view('template/foothtml'); ?>