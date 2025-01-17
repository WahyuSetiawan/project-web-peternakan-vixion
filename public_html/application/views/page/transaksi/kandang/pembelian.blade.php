@extends("_part.layout", $head)

@section("content")

<div class="column">
    <h3 class="title-5 m-b-25">Pembelian Bibit Ayam</h3>

    @include('_part.message', ['flashdata' => $flashdata])

    <div class="row m-b-25">
        <div class="row">
            <form method="get">
                <input type="hidden" name="per_page" value="0" />
                <div class="row">
                    <div class="form-select">
                        <select class="js-select2" name="kandang">
                            <option value="0" <?=($id_kandang=="0" ) ? "selected" : "" ?>>Kandang</option>
                            <?php foreach ($kandang as $value) { ?>
                            <option value="<?= $value->id_kandang ?>" <?=($value->id_kandang == $id_kandang) ?
                                "selected" : "" ?>>
                                <?= $value->nama ?>
                            </option>
                            <?php } ?>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>

                    <div class="form-select">
                        <select class="js-select2" name="supplier">
                            <option value="0" <?=($id_supplier=="0" ) ? "selected" : "" ?>>Supplier</option>
                            <?php foreach ($supplier as $value) { ?>
                            <option value="<?= $value->id_supplier ?>" <?=($value->id_supplier == $id_supplier) ?
                                "selected" : "" ?>>
                                <?= $value->nama ?>
                            </option>
                            <?php } ?>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>

                    <button class="btn" type="submit">
                        <i class="zmdi zmdi-filter-list"></i>filters</button>
                </div>

            </form>
        </div>
        <div class="table-data__tool-right">
            <button class="btn btn-success btn-add-kandang">
                <i class="fa fa-pencil"></i> Tambah Pembelian</button>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-25">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Detail Pembelian</th>
                        <th>Kandang</th>
                        <th>Tanggal</th>
                        <th>Supplier</th>
                        <th>Jumlah</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $key => $value) { ?>
                    <tr>
                        <td>
                            <?= ($limit * $offset) + $key + 1 ?>
                        </td>
                        <td>
                            <?= $value->id_detail_pembelian_ayam ?>
                        </td>
                        <td>
                            <?= $value->nama_kandang ?>
                        </td>
                        <td>
                            <?= $value->tanggal ?>
                        </td>
                        <td>
                            <?= $value->nama_supplier ?>
                        </td>
                        <td>
                            <?= $value->jumlah_ayam . " Ayam" ?>
                        </td>
                        <td style="text-align: center">
                            <button type="button" class="btn btn-success detail-pembelian" data-pembelian='<?= json_encode($value) ?>'><i
                                    class="fa fa-info-circle"></i></button>
                            <button type="button" class="btn btn-primary edit-pembelian" data-pembelian='<?= json_encode($value) ?>'><i
                                    class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger del-pembelian" data-pembelian='<?= json_encode($value) ?>'><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-5">
        Showing
        <?= $offset + 1 ?> to
        <?= ($count < ($limit + $offset)) ? $count : ($limit + $offset) ?> of
        <?= $count ?> entries
    </div>
    <div class="col-lg-7 ">
        <div class="row pull-right">
            <div class="col">
                <?= $pagination ?>
            </div>
        </div>
    </div>
</div>

@endsection

@section("modal")

<!-- modal medium -->
<div class="modal fade" id="modalKandang" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" id="form-kandang">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="mediumModalLabel">Tambah Pembelian Ayam</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="col-8">
                        <div class="form-group">
                            <label>No Pembelian Ayam</label>
                            <input type="text" class="form-control" name="id" placeholder="MA_xxxx" readonly="">
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="form-group">
                            <label>Kandang</label>
                            <select class="form-control" name="kandang">
                                <?php foreach ($kandang as $key => $value) { ?>
                                <option value="<?php echo $value->id_kandang ?>">
                                    <?php echo $value->nama ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-5">
                        <div class="form-group">
                            <label>Supplier</label>
                            <select class="form-control" name="supplier">
                                <?php foreach ($supplier as $key => $value) { ?>
                                <option value="<?php echo $value->id_supplier ?>">
                                    <?php echo $value->nama ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="form-group">
                            <label>Tanggal Transaksi</label>
                            <input type="text" class="form-control" name="tanggal" placeholder="<?= date(" d-m-Y") ?>"/>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="class-group">
                            <label>Jumlah Ayam</label>
                            <input type="text" class="form-control" name="jumlah" placeholder="0" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- end modal medium -->

<div class="modal" id="modal-del-supplier">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h3 class="modal-title" id="mediumModalLabel">Hapus Supplier</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    Anda yakin menghapus data <span class="id"></span> dengan nama <span class="nama"></span> ?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="del">Ya</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal detail -->
<div class="modal" id="modal-detail-pembelian">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="detailTitleModal">Detail Pembelian <strong class="id"></strong></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 200px">Kode Pembelian Bibit</td>
                        <td class="id"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong> Data Terkait :</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Transaksi</td>
                        <td class="tanggal"> </td>
                    </tr>
                    <tr>
                        <td>Kandang</td>
                        <td class="kandang"> </td>
                    </tr>

                    <tr>
                        <td>Supplier</td>
                        <td class="supplier"> </td>
                    </tr>
                    <tr>
                        <td>Jumlah Ayam</td>
                        <td><strong class="jumlah">10</strong> Ayam</td>
                    </tr>

                    <tr>
                        <td colspan="2"><strong>Mediator : </strong></td>
                    </tr>
                    <tr>
                        <td>Dibuat Pada</td>
                        <td class="created_at"></td>
                    </tr>
                    <tr>
                        <td>Dibuat Oleh</td>
                        <td class="created_by"></td>
                    </tr>
                    <tr>
                        <td>Diubah Terakhir</td>
                        <td class="udpated_at"></td>
                    </tr>
                    <tr>
                        <td>Diubah Oleh</td>
                        <td class="update_by"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info edit-pembelian" data-dismiss="modal">Ubah Data</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script>
    var modal = $('#modalKandang');
    var modaldetail = $("#modal-detail-pembelian");

    modal.find('form').find("input[name='tanggal']").datepicker(defaultDatePicker);

    $(document).on("click", ".btn-add-kandang", function () {
        modal.find('form').find("input[name='id']").val("");
        modal.find('form').find("input[name='nama']").val("");
        modal.find('form').find("input[name='tanggal']").val("");
        modal.find('form').find("button[name='submit']").attr('name', 'submit');

        modal.modal('show');
    });

    $(document).on("click", ".edit-pembelian", function () {
        var data = $(this).data('pembelian');

        modal.find('form').find("input[name='id']").val(data.id_detail_pembelian_ayam);
        modal.find('form').find("select[name='kandang']").val(data.id_kandang);
        modal.find('form').find("select[name='supplier']").val(data.id_supplier);
        modal.find('form').find("input[name='karyawan']").val(data.id_karyawan);
        modal.find('form').find("input[name='jumlah']").val(data.jumlah_ayam);
        modal.find('form').find("input[name='tanggal']").val(data.tanggal);
        modal.find('form').find("button[name='submit']").attr('name', 'put');

        modal.modal('show');
    });

    $(document).on("click", '.detail-pembelian', function () {
        var data = $(this).data('pembelian');

        modaldetail.find(".id").html(": " + data.id_detail_pembelian_ayam);
        modaldetail.find(".tanggal").html(": " + data.tanggal);
        modaldetail.find(".kandang").html(": " + data.nama_kandang + " (" + data.id_kandang + ")");
        modaldetail.find(".supplier").html(": " + data.nama_supplier + " (" + data.id_supplier + ")");
        modaldetail.find(".jumlah").html(": " + data.jumlah_ayam);
        modaldetail.find(".created_at").html(": " + data.created_at);

        if (data.id_karyawan !== null) {
            modaldetail.find(".created_by").html(": " + data.nama_karyawan + " (Karyawan)");
        } else {
            modaldetail.find(".created_by").html(": " + data.nama_admin + " (Admin)");
        }

        console.log(data);

        if (data.udpated_at !== null) {
            modaldetail.find(".udpated_at").html(": " + data.updated_at);

            if (data.update_by_karyawan !== null) {
                modaldetail.find(".update_by").html(": " + data.update_by_karyawan_nama + " (Karyawan)");
            } else {
                modaldetail.find(".update_by").html(": " + data.update_by_admin_nama + " (Admin)");
            }
        } else {
            modaldetail.find(".udpated_at").html(":");
            modaldetail.find(".update_by").html(":");
        }

        modaldetail.find('.edit-pembelian').attr('data-pembelian', JSON.stringify(data));


        modaldetail.modal('show');
    });

    $(document).on("click", '.del-pembelian', function () {
        var data = $(this).data('pembelian');

        var modal = $("#modal-del-supplier");

        modal.find('form').find("input[name='id']").val(data.id_detail_pembelian_ayam);
        modal.find('form').find("span[class='id']").html(data.id_detail_pembelian_ayam);
        modal.find('form').find("span[class='nama']").html(data.nama);

        modal.modal("show");
    });

    $(document).ready(function () {
        $("#form-kandang").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 1
                },
                maksimal_jumlah: {
                    number: true,
                    min: 1,
                }
            },
            messages: {
                nama: {
                    required: "Nama tidak boleh kosong",
                    minlength: "Minimal karakter adalah 1"
                },
                maksimal_jumlah: {
                    number: "Harus Berupa Angka",
                    min: "Minimal jumlah yang dinputkan adalah 1"
                }
            },
            errorElement: "em",
            errorPlacement: function (error, element) {
                error.addClass("help-block");

                if (element.prop("type") == "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).parent(".form-group").addClass("has-warning").removeClass("has-success");
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parent(".form-group").addClass("has-success").removeClass("has-warning");
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });
    });
</script>
@endsection