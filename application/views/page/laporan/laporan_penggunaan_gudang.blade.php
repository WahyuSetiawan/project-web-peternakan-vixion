@extends("_part.layout_laporan")

@section('title', $title)

@section("content")
<div style="width: 100%; display: flex;flex-direction: row;justify-content:space-between; margin-bottom: 10px">
    <div></div>
    <div> Tanggal:
        <?php echo date("Y-m-d") ?>
    </div>
</div>

<div id="outtable">
    <table class="data">
        <thead>
            <tr>
                <th class="no">No</th>
                <th class="id">ID</th>
                <th class="hari">Tanggal</th>
                <th class="kandang">Waktu</th>
                <th class="persediaan">Nama Kandang</th>
                <th class="center">Nama Pakan</th>
                <th class="center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $key => $value) { ?>
                <tr>
                    <td class="no">
                        <?= $key + 1 ?>
                    </td>
                    <td class="id">
                        <?= $value->id_detail_penggunaan_gudang ?>
                    </td>
                    <td class="hari">
                        <?= $value->tanggal_datetime ?>
                    </td>
                    <td>
                        <?= $value->tanggal_time_only ?>
                    </td>
                    <td class="kandang">
                        <?= $value->nama_kandang ?>
                    </td>
                    <td class="persediaan">
                        <?= $value->nama_gudang ?>
                    </td>
                    <td class="persediaan">
                        <?= $value->jumlah ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

@include('_part.footer_laporan')

@endsection

