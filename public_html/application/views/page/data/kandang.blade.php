@extends("_part.layout", $head)

@section("content")

<div class="column full-width">
    <h3 class="title-5 m-b-25">Halaman Manajemen Kandang</h3>

    <div class="col-lg-12  m-b-25">
        <button class="btn btn-success js-btn-add-kandang">
            <i class="fa fa-pencil"></i> Tambah Kandang</button>
    </div>

    <div class="col-lg-12 m-b-25">
        <table class="table data table-borderless table-striped table-earning">
            <thead>
                <tr>
                    <th class="center">No</th>
                    <th>ID Kandang</th>
                    <th>Nama</th>
                    <th>Penanggung Jawab</th>
                    <th>Karyawan</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kandang as $key => $value) { ?>
                <tr>
                    <td class="center">
                        {{ ($limit * $offset) + $key + 1 }}
                    </td>
                    <td>
                        {{ $value->id_kandang}}
                    </td>
                    <td>
                        {{ $value->nama }}
                    </td>
                    <td>
                         {{$value->nama_karyawan }}
                    </td>
                    <td>
                        {{ $value->nama_karyawan }}
                    </td>
                    <td style="text-align: center">
                        <button type="button" class="btn btn-primary edit-kandang" data-supplier='<?= json_encode($value) ?>'><i
                                class="fa fa-edit"></i></button>
                        <button type="button" class="btn btn-danger del-kandang" data-supplier='<?= json_encode($value) ?>'><i
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
<div class="modal fade" id="modalKandang" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" id="form-kandang">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="mediumModalLabel">Tambah Kandang</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="col-8">
                        <div class="form-group">
                            <label>Nama Kandang</label>
                            <input type="text" class="form-control" name="nama" placeholder="nama kandang">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Penanggung Jawab Kandang</label>
                            <select class="form-control" name="karyawan">
                                <?php foreach ($karyawan as $value) { ?>
                                <option value="<?= $value->id_karyawan ?>">
                                    <?= $value->nama ?>
                                </option>
                                <?php } ?>
                            </select>
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

@endsection

@section('js')

<script>
    $(document).on("click", ".js-btn-add-kandang", function () {
        var modal = $('#modalKandang');

        modal.find('form').find("input[name='id']").val("");
        modal.find('form').find("input[name='nama']").val("");
        modal.find('form').find("input[name='tanggal']").val(""); 
        modal.find('form').find("button[name='submit']").attr('name', 'submit');

        modal.modal('show');
    });

    $(document).on("click", ".edit-kandang", function () {
        var data = $(this).data('supplier');
        var modal = $('#modalKandang');

        modal.find('form').find("input[name='id']").val(data.id_kandang);
        modal.find('form').find("input[name='nama']").val(data.nama);
        modal.find('form').find("input[name='tanggal']").val(data.tanggal);
        modal.find('form').find("select[name='karyawan']").val(data.id_karyawan);
        modal.find('form').find("button[name='submit']").attr('name', 'put');

        modal.modal('show');
    });

    $(document).on("click", '.del-kandang', function () {
        var data = $(this).data('supplier');

        var modal = $("#modal-del-supplier");

        modal.find('form').find("input[name='id']").val(data.id_kandang);
        modal.find('form').find("span[class='id']").html(data.id_kandang);
        modal.find('form').find("span[class='nama']").html(data.nama);

        modal.modal("show");
    });

    $(document).ready(function () {
        $("#form-kandang").validate({
            rules: {
                nama: {
                    required: true,
                    minlength: 4
                },
                karyawan: {
                    required: true,
                }
            },
            messages: {
                nama: {
                    required: "Nama tidak boleh kosong",
                    minlength: "Minimal karakter adalah 4"
                },
                karyawan: {
                    required: "Karyawan harus ada",
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