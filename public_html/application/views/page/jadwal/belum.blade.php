@extends("_part.layout", $head)

@section("css")
<style>
    table tr .kandang {
        width: 15px;
        word-wrap: break-word;
        text-align: center
    }

    table tr .hari {
        width: 15px;
        word-wrap: break-word;
        text-align: center
    }

    table tr .gudang {
        width: 10px;
        word-wrap: break-word;
        text-align: center
    }
</style>
@endsection

@section("content")

<div class="column">
    <h3 class="title-5 m-b-25">Jadwal Pakan yang belum di berikan (Waktu sekarang : <?= $current_date ?>)</h3>

    <div class="col-2  m-b-25">
        <div class="row">
            <form method="get">
                <input type="hidden" name="per_page" value="0" />
                <input type="hidden" name="gudang" value="<?= $id_gudang ?>" />
                <input type="hidden" name="kandang" value="<?= $id_kandang ?>" />

                <div class="row">
                    <div class="col-4">
                        <label class="center">Pindah ke tanggal : </label>
                    </div>
                    <div class="col-4">
                        <input type="text" id="datepicker" name="tanggal" placeholder="<?= $current_date_view ?>" value="<?= (isset($current_date_view_target)) ? $current_date_view_target : '' ?>">
                    </div>
                    <div class="col-4">
                        <button class="btn" type="submit">
                            <i class="zmdi zmdi-filter-list"></i>Lihat</button>
                    </div>
                </div>
            </form>

            <div class="col-2">
                <form method="get">

                    <input type="hidden" name="per_page" value="0" />
                    <input type="hidden" name="gudang" value="<?= $id_gudang ?>" />
                    <input type="hidden" name="kandang" value="<?= $id_kandang ?>" />


                    <button class="btn btn-info" type="submit" name="tanggal" value="<?= $current_date_view ?>">
                        <i class="zmdi zmdi-filter-list"></i>Tanggal Sekarang</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row m-b-25">
    <div class="row beetwen">
        <div>
            <form method="get">
                <div class="row">
                    <input type="hidden" name="per_page" value="0" />

                    <div class="form-select">
                        <select class="js-select2" name="kandang">
                            <option value="0" <?= ($id_kandang == "0") ? "selected" : "" ?>>Semua Kandang</option>
                            <?php foreach ($kandang as $value) { ?>
                                <option value="<?= $value->id_kandang ?>" <?= ($value->id_kandang == $id_kandang) ?
                                                                                "selected" : "" ?>>
                                    <?= $value->nama ?>
                                </option>
                            <?php } ?>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>

                    <div class="form-select">
                        <select class="js-select2" name="gudang">
                            <option value="0" <?= ($id_gudang == "0") ? "selected" : "" ?>>Semua Gudang</option>
                            <?php foreach ($gudang as $value) { ?>
                                <option value="<?= $value->id_gudang ?>" <?= ($value->id_gudang ==
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
    </div>
</div>

<div class="table-responsive table--no-card m-b-25">
    <table class="table table-borderless table-striped table-earning">
        <thead>
            <tr>
                <th class="no">No</th>
                <th class="id">ID</th>
                <th class="kandang">Kandang</th>
                <th class="gudang">Pakan</th>
                <th class="hari">Hari</th>
                <th class="hari">Waktu Pemberian</th>
                <th class="center">Catatan</th>
                <th class="aksi">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (count($data) == 0) { ?>
                <tr>
                    <td colspan="8"> Tidak terdapat jadwal pakan ternak untuk hari ini</td>
                </tr>

            <?php            }


            foreach ($data as $key => $value) { ?>
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
                    <td class="gudang">
                        <?= $value->nama_gudang ?>
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
                    <td class="hari">
                        <?= $value->waktu_mulai ?> - <?= $value->waktu_selesai ?>
                    </td>
                    <td>
                        <?= substr($value->catatan, 0, 15) ?>
                    </td>
                    <td class="aksi">
                        <?php
                        $date1 = DateTime::createFromFormat('Y-m-d H:i', $current_date);
                        $date2 = DateTime::createFromFormat('H:i', $value->waktu_mulai);
                        $date3 = DateTime::createFromFormat('H:i', $value->waktu_selesai);

                        if ($date1 > $date2 && $date1 < $date3) { ?>
                            <button type="button" class="btn btn-primary edit-jadwal" data-jadwal='<?= json_encode($value) ?>'>Masukan data</button>
                        <?php }

                        if ($date1 > $date3) {
                            echo "Jadwal belum diinputkan atau jadwal tidak dilaksanakan";
                        }

                        ?>
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
                            <input type="text" class="form-control" name="id" readonly />
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="form-group">
                            <label>Kandang</label>
                            <input type="text" class="form-control" name="kandang" readonly />
                            <input type="hidden" class="form-control" name="id_kandang" readonly />
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="form-group">
                            <label>Pakan : </label>
                            <input type="text" class="form-control" name="gudang" readonly />
                            <input type="hidden" class="form-control" name="id_gudang" readonly />
                        </div>
                    </div>

                    <div class="col-8">
                        <div class="form-group">
                            <label>Hari</label>
                            <input type="text" class="form-control" name="hari" readonly />
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>Waktu Mulai</label>
                            <input type="text" class="form-control" name="waktu_mulai" readonly>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Waktu Selesai</label>
                            <input type="text" class="form-control" name="waktu_selesai" readonly>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label>Jumlah pakan yang diberikan</label>
                            <input type="text" class="form-control" name="jumlah" placeholder="0">
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

    $(function() {
        // $("#datepicker").datepicker();
        // $("#datepicker").datepicker('setDate', new Date(
        //     "<?= (isset($current_date_view_target)) ? $current_date_view_target : $current_date_view ?>"
        //     .replace(/(\d{4})-(\d{2})-(\d{2})/, "$2/$3/$1")));

        // $("#datepicker").datepicker("option", "dateFormat", "yy-mm-dd");

        // modal.find("form").find("input[name=waktu_mulai]").datetimepicker({
        //     datepicker: false,
        //     format: 'H:i',
        //     step: 5
        // });

        // modal.find("form").find("input[name=waktu_selesai]").datetimepicker({
        //     datepicker: false,
        //     format: 'H:i',
        //     step: 5
        // });
    });


    $(document).on("click", ".btn-add-jadwal", function() {
        modal.find('form').find("input[name='id']").val("");
        modal.find('form').find("select[name='kandang']").val("");
        modal.find('form').find("select[name='hari']").val("");
        modal.find('form').find("select[name='gudang']").val("");
        modal.find('form').find("textarea[name='catatan']").html("");
        modal.find("form").find("input[name=waktu_mulai]").val("00:00");
        modal.find("form").find("input[name=waktu_selesai]").val("00:00");
        modal.find('form').find("button[name='submit']").attr('name', 'submit');

        modal.modal('show');
    });

    $(document).on("click", ".edit-jadwal", function() {
        var data = $(this).data('jadwal');

        modal.find('form').find("input[name='id']").val(data.id_jadwal_kandang);
        modal.find('form').find("input[name='kandang']").val(data.nama_kandang);
        switch (data.hari) {
            case "0":
                modal.find('form').find("input[name='hari']").val("minggu");
            case "1":
                modal.find('form').find("input[name='hari']").val("senin");
            case "2":
                modal.find('form').find("input[name='hari']").val("selasa");
            case "3":
                modal.find('form').find("input[name='hari']").val("rabu");
            case "4":
                modal.find('form').find("input[name='hari']").val("kamis");
            case "5":
                modal.find('form').find("input[name='hari']").val("jumat");
            case "6":
                modal.find('form').find("input[name='hari']").val("sabtu");
        }

        modal.find('form').find("input[name='gudang']").val(data.nama_gudang);
        modal.find('form').find("input[name='id_gudang']").val(data.id_gudang);
        modal.find('form').find("input[name='id_kandang']").val(data.id_kandang);
        modal.find('form').find("textarea[name='catatan']").html(data.catatan);
        modal.find("form").find("input[name=waktu_mulai]").val(data.waktu_mulai);
        modal.find("form").find("input[name=waktu_selesai]").val(data.waktu_selesai);
        modal.find('form').find("button[name='submit']").attr('name', 'submit');

        modal.modal('show');
    });

    $(document).on("click", '.del-jadwal', function() {
        var data = $(this).data('jadwal');

        var modal = $("#modal-del-jadwal");

        modal.find('form').find("input[name='id']").val(data.id_jadwal_kandang);
        modal.find('form').find("span[class='id']").html(data.id_jadwal_kandang);
        modal.modal("show");
    });

    $(document).ready(function() {
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
            errorPlacement: function(error, element) {
                error.addClass("help-block");

                if (element.prop("type") == "checkbox") {
                    error.insertAfter(element.parent("label"));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).parent(".form-group").addClass("has-warning").removeClass("has-success");
                $(element).addClass("is-invalid").removeClass("is-valid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parent(".form-group").addClass("has-success").removeClass("has-warning");
                $(element).addClass("is-valid").removeClass("is-invalid");
            }
        });
    });
</script>
@endsection