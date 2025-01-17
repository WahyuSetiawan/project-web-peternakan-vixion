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
                <th class="hari">Hari</th>
                <th class="kandang">Nama Kandang</th>
                <th class="persediaan">Nama Gudang</th>
                <th class="center">Catatan</th>
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
                <td class="hari">
                    <?php switch ($value->hari) {
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
                                        }                                        ?>
                </td>
                <td class="kandang">
                    <?= $value->nama_kandang ?>
                </td>

                <td class="persediaan">
                    <?= $value->nama_gudang ?>
                </td>
                <td>
                    <?= substr($value->catatan, 0, 15) ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
@endsection