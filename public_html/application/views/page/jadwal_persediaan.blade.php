@extends("_part.layout", $head)

@section("css")
<style>
    table tr .kandang { width:15px; word-wrap:  break-word; text-align: center}
    table tr .hari { width:15px; word-wrap:  break-word; text-align: center}
    table tr .gudang { width: 10px; word-wrap:  break-word; text-align: center}
</style>
@endsection

@section("content")

<div class="column">
    <h3 class="title-5 m-b-25">Jadwal Pakan</h3>

    <div class="row m-b-25">
        <div class="row beetwen">
            <div>
                <form method="get">
                    <div class="row">
                        <input type="hidden" name="per_page" value="0" />

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
                            <select class="js-select2" name="gudang">
                                <option value="0" <?=($id_gudang=="0" ) ? "selected" : "" ?>>gudang</option>
                                <?php foreach ($gudang as $value) { ?>
                                <option value="<?= $value->id_gudang ?>" <?=($value->id_gudang ==
                                    $id_gudang) ? "selected" : "" ?>>
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
            <div>
                <button class="btn btn-success btn-add-jadwal">
                    <i class="zmdi zmdi-plus"></i>Tambah Jadwal</button>
            </div>
        </div>
    </div>

    <div class="table-responsive table--no-card m-b-25">
        <table class="table table-borderless table-striped table-earning">
            <thead>
                <tr>
                    <th class="no">No</th>
                    <th class="id">ID</th>
                    <th class="kandang">Kadang</th>
                    <th class="hari">Hari</th>
                    <th class="gudang">gudang</th>
                    <th class="center">Catatan</th>
                    <th class="aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $key => $value) { ?>
                <tr>
                    <td class="no">
                        <?= $key + 1 ?>
                    </td>
                    <td class="id">
                        <?= $value->id_jadwal_kandang ?>
                    </td>
                    <td class="kandang">
                        <?= $value->nama_kandang ?>
                    </td>
                    <td class="hari">
                        <?php
                                switch ($value->hari) {
                                    case 0:
                                        echo "Minggu";
                                        break;
                                    case 1:
                                        echo "Senin";
                                        break;
                                    case 2:
                                        echo "Selasa";
                                        break;
                                    case 3:
                                        echo "Rabu";
                                        break;
                                    case 4:
                                        echo "Kamis";
                                        break;
                                    case 5:
                                        echo 'Jumat';
                                        break;
                                    case 6:
                                        echo 'Sabtu';
                                        break;
                                    default:
                                        break;
                                }
                                ?>
                    </td>
                    <td class="gudang">
                        <?= $value->nama_gudang ?>
                    </td>
                    <td>
                        <?= substr($value->catatan, 0, 15) ?>
                    </td>
                    <td class="aksi">
                        <button type="button" class="btn btn-primary edit-jadwal" data-jadwal='<?= json_encode($value) ?>'><i
                                class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger del-jadwal" data-jadwal='<?= json_encode($value) ?>'><i
                                class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>

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
<div class="modal fade" id="modal-jadwal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" id="form-kandang">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="mediumModalLabel">Tambah Jadwal Kandang</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-6">
                        <div class="form-group">
                            <label>ID Jadwal Kandang</label>
                            <input type="text" class="form-control" name="id" readonly="" />
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label>Kandang</label>
                            <select class="form-control" name="kandang">
                                <?php foreach ($kandang as $value) { ?>
                                <option value="<?= $value->id_kandang ?>">
                                    <?= $value->nama ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label>Hari</label>
                            <select class="form-control" name="hari">
                                <option value="0">Minggu</option>
                                <option value="1">Senin</option>
                                <option value="2">Selasa</option>
                                <option value="3">Rabu</option>
                                <option value="4">Kamis</option>
                                <option value="5">Jumat</option>
                                <option value="6">Sabtu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label>gudang</label>
                            <select class="form-control" name="gudang">
                                <?php foreach ($gudang as $value) { ?>
                                <option value="<?= $value->id_gudang ?>">
                                    <?= $value->nama ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Catatan</label>
                            <textarea class="form-control" name="catatan"></textarea>
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

<div class="modal" id="modal-del-jadwal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h3 class="modal-title" id="mediumModalLabel">Hapus Jadwal</h3>
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

@endsection

@section('js')

<script>
    var modal = $('#modal-jadwal');


    $(document).on("click", ".btn-add-jadwal", function () {


        modal.find('form').find("input[name='id']").val("");
        modal.find('form').find("select[name='kandang']").val("");
        modal.find('form').find("select[name='hari']").val("");
        modal.find('form').find("select[name='gudang']").val("");
        modal.find('form').find("textarea[name='catatan']").html("");

        modal.find('form').find("button[name='submit']").attr('name', 'submit');

        modal.modal('show');
    });

    $(document).on("click", ".edit-jadwal", function () {
        var data = $(this).data('jadwal');

        modal.find('form').find("input[name='id']").val(data.id_jadwal_kandang);
        modal.find('form').find("select[name='kandang']").val(data.id_kandang);
        modal.find('form').find("select[name='hari']").val(data.hari);
        modal.find('form').find("select[name='gudang']").val(data.id_gudang);
        modal.find('form').find("textarea[name='catatan']").html(data.catatan);
        modal.find('form').find("button[name='submit']").attr('name', 'put');

        modal.modal('show');
    });

    $(document).on("click", '.del-jadwal', function () {
        var data = $(this).data('jadwal');

        var modal = $("#modal-del-jadwal");

        modal.find('form').find("input[name='id']").val(data.id_jadwal_kandang);
        modal.find('form').find("span[class='id']").html(data.id_jadwal_kandang);
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