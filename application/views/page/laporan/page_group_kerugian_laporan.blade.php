@extends("_part.layout", $head)

@section("content")

<div class="column">
    <h3 class="title-5 m-b-25">Riwayat Laporan Kerugian Ayam Pada ID Detail Transaksi : <?=$id_group?> </h3>

    <div class="row m-b-25">
        <div class="row">
            <div class="row">
                <form method="get">
                    <input type="hidden" name="per_page" value="0" />

                    <div class="row">

                        <div class="form-select">
                            <select class="js-select2" name="kandang">
                                <option value="0" <?=($id_kandang == "0") ? "selected" : ""?>>Semua Kandang</option>
                                <?php foreach ($semua_kandang as $value) {?>
                                <option value="<?=$value->id_kandang?>"
                                    <?=($value->id_kandang == $id_kandang) ? "selected" : ""?>>
                                    <?=$value->nama?>
                                </option>
                                <?php }?>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>

                        <button class="btn" type="submit">
                            <i class="zmdi "></i>Refresh</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-data__tool-right">
            <button class="btn btn-success" href="<?=base_url("laporan/group/kerugian/" . $id_group . "/html")?>">
                <i class="fa fa-pencil"></i> Cetak Semua</button>
        </div>
    </div>

    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-25">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Kerugian</th>
                        <th>ID Kandang</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($data) <= 0) {?>
                    <tr>
                        <td colspan="7">
                            Tidak terdapat data kerugian ayam
                        </td>
                    </tr>
                    <?php
} else {
    foreach ($data as $key => $value) {?>
                    <tr>
                        <td>
                            <?=($limit * $offset) + $key + 1?>
                        </td>
                        <td>
                            <?=$value->id_detail_kerugian_ayam?>
                        </td>
                        <td>
                            <?=$value->nama_kandang?>
                        </td>
                        <td>
                            <?=$value->tanggal?>
                        </td>
                        <td>
                            <?=$value->jumlah . " Ayam"?>
                        </td>
                        <td>
                            <?=$value->keterangan?>
                        </td>
                    </tr>
                    <?php }
}?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-5">
        Showing
        <?=$offset + 1?> to
        <?=($count < ($limit + $offset)) ? $count : ($limit + $offset)?> of
        <?=$count?> entries
    </div>
    <div class="col-lg-7 ">
        <div class="row pull-right">
            <div class="col">
                <?=$pagination?>
            </div>
        </div>
    </div>
</div>

@endsection

@section("modal")

<div class="modal" id="modal-detail-penjualan">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="detailTitleModal">Detail Penjualan Ayam <strong class="id"></strong></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <td style="width: 200px">Kode Pembelian Bibit</td>
                        <td class="id"> : </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong> Data Terkait :</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal Transaksi</td>
                        <td class="tanggal"> : </td>
                    </tr>
                    <tr>
                        <td>Kandang</td>
                        <td class="kandang"> : </td>
                    </tr>
                    <tr>
                        <td>Jumlah Ayam</td>
                        <td><strong class="jumlah"></strong> Ayam</td>
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
                <button type="button" class="btn btn-info edit-penjualan" data-dismiss="modal">Ubah Data</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>

        </div>
    </div>
</div>

@endsection

@section('js')

<script>
var modal = $('#modal-form-penjualan');
var modaldetail = $('#modal-detail-penjualan');

$(document).on("click", ".detail-penjualan", function() {
    var data = $(this).data("penjualan");

    modaldetail.find(".id").html(data.id_detail_kerugian_ayam);

    modaldetail.find(".id").html(": " + data.id_detail_kerugian_ayam);
    modaldetail.find(".tanggal").html(": " + data.tanggal);
    modaldetail.find(".kandang").html(": " + data.nama_kandang + " (" + data.id_kandang + ")");
    modaldetail.find(".jumlah").html(": " + data.jumlah);
    modaldetail.find(".created_at").html(": " + data.created_at);

    if (data.id_karyawan !== null) {
        modaldetail.find(".created_by").html(": " + data.nama_karyawan + " (Karyawan)");
    } else {
        modaldetail.find(".created_by").html(": " + data.nama_admin + " (Admin)");
    }

    if (data.udpated_at !== null) {
        modaldetail.find(".udpated_at").html(": " + data.udpated_at);

        if (data.update_by_karyawan !== null) {
            modaldetail.find(".update_by").html(": " + data.update_by_karyawan_nama + " (Karyawan)");
        } else {
            modaldetail.find(".update_by").html(": " + data.update_by_admin_nama + " (Admin)");
        }
    } else {
        modaldetail.find(".udpated_at").html(":");
        modaldetail.find(".update_by").html(":");
    }

    modaldetail.find(".edit-penjualan").attr("data-penjualan", JSON.stringify(data));
    modaldetail.modal('show');
});
</script>
@endsection