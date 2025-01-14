@extends("_part.layout",  $head)

@section("content")

<div class="column">
    <h3 class="title-5 m-b-25">Jumlah Ayam Perkandang</h3>

    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-25">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kandang</th>
                        <th>Nama Kandang</th>
                        <th style="text-align: center">Jumlah Ayam</th>
                        <th style="text-align: center">Jumlah Transaksi</th>
                        <th style="text-align: center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jumlah_ayam as $key => $value) { ?>
                        <tr>
                            <td><?= $key + 1 ?></td>
                            <td><?= $value->id_kandang ?></td>
                            <td><?= $value->nama ?></td>
                            <td style="text-align: center"><?= $value->jumlah . " Ayam" ?></td>
                            <td style="text-align: center"><?= $value->jumlah_transaksi." Transaksi" ?></td>
                            <td style="text-align: center">
                                <button type="button" class="btn btn-success pembelian-ayam" data-kandang='<?= json_encode($value) ?>'><i class="fa fa-plus"></i> Detail Transaksi</button>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section("modal")

<!-- modal medium -->
<div class="modal fade" id="modal-pembelian" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" id="form-pembelian-ayam">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="mediumModalLabel">Tambah Supplier</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Nama Supplier</label>
                            <select class="form-control" name="supplier">
                                <?php foreach ($supplier as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->nama . " (" . $value->notelepon . ")" ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Umur ayam (bulan) </label>
                            <input type="number" class="form-control" name="umur" value="0">
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label>Jumlah Ayam</label>
                            <input type="number" class="form-control" name="jumlah" value="1">
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

<div class="modal" id="modal-penjualan">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h3 class="modal-title" id="mediumModalLabel">Penjualan Ayam</h3>
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
    $(document).on("click", ".pembelian-ayam", function () {
        var val = $(this).data("kandang");

        document.location.href = "stokkandang/detail/" + val.id_kandang;
    });
</script>
@endsection