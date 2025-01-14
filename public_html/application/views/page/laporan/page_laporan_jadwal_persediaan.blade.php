@extends("_part.layout", $head)


@section("content")

<?php
$CI = &get_instance();
?>
<div class="column">
    <h3 class="title-5 m-b-25">
        <?php echo $title ?>
    </h3>

    @include('_part.message', ['flashdata' => $flashdata])

    <div class="row m-b-25">
        <div class="row">
            <div class="row">

                <input type="hidden" name="per_page" value="0" />
                <div class="row">

                    <div class="form-select">
                        <select class="js-select2" name="supplier">
                            <option value="0" <?=($id['supplier']=="0" ) ? "selected" : "" ?>>Supplier</option>
                            <?php foreach ($supplier as $value) { ?>
                            <option value="<?= $value->id_supplier ?>" <?=($value->id_supplier == $id['supplier']) ?
                                "selected" : "" ?>>
                                {{ $value->nama }}
                            </option>
                            <?php } ?>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>

                    <div class="form-select">
                        <select class="js-select2" name="aksi">
                            <option>Semua</option>
                            <option value="in" <?=($id['aksi']=="in" ) ? "selected" : "" ?>>Pemasukan</option>
                            <option value="out" <?=($id['aksi']=="out" ) ? "selected" : "" ?>>Pengeluaran</option>
                        </select>
                        <div class="dropDownSelect2"></div>
                    </div>


                    <button class="btn" type="submit">
                        <i class="zmdi zmdi-filter-list"></i>filters</button>

                </div>
            </div>

        </div>
        </form>
    </div>



    <div class="col-lg-12">
        <div class="table-responsive table--no-card m-b-25">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th class="no">No</th>
                        <th class="id">ID</th>
                        <th class="kandang">Kadang</th>
                        <th class="hari">Hari</th>
                        <th class="persediaan">Gudang</th>
                        <th class="center">Catatan</th>
                        <th class="aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $key => $value) { ?>
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
                        <td class="persediaan">
                            <?= $value->nama_gudang ?>
                        </td>
                        <td>
                            <?= substr($value->catatan, 0, 15) ?>
                        </td>
                        <td class="aksi">
                            <a class="btn btn-primary edit-jadwal" href="{{base_url("laporan/jadwalpakan/".$value->id_jadwal_kandang. "/html")}}"><i
                                    class="fa fa-pen-square"></i> Cetak</a>
                            <a href="{{base_url("laporan/jadwalpakan/".$value->id_jadwal_kandang."/pdf")}}" class="btn btn-warning">Cetak
                                Pdf</a>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>
    </div>
    <div class="col-lg-5">Showing
        {{$offset+1}} to
        {{($count < ($limit + $offset)) ? $count : ($limit + $offset)}} of {{$count}} entries </div> <div class="col-lg-12">
            <div class="row pull-right">
                <div class="row">
                    <?= $pagination ?>
                </div>
            </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var modal = $("#filter_data");

    modal.find("select[name='tahun']").on("click", function () {
        changeBulan();
    });

    function changeBulan() {
        var select = modal.find("select[name='tahun']");

        var data = $(select).find('option[value="' + $(select).val() + '"]').data("bulan");
        var bulan = modal.find("select[name='bulan']");

        bulan.empty();

        bulan.append(
            $('<option />')
            .text("Semua")
        );

        $.each(data, function (index, value) {
            bulan.append(
                $('<option />').val(value.bulan)
                .text(value.bulan)
            );
        });
    }
</script>
@endsection