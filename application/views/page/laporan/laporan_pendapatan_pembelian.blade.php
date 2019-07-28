@extends("_part.layout_laporan")

@section('title', $title)

@section("content")
<div style="width: 100%; display: flex;flex-direction: row;justify-content:space-between; margin-bottom: 10px">
    <div></div>
    <div> Tanggal:
        <?php echo date("Y-m-d") ?>
    </div>
</div>

<table style="margin-bottom: 50px">
    <thead>

    </thead>
    <tbody>
        <tr>
            <td colspan="4">Data Pembelian dari data ayam yang dimasukan pada tanggal <?php echo $data->tanggal ?> dengan tanggal</td>
        </tr>
        <tr>
            <td>ID Pembelian</td>
            <td colspan="3">: <?= $data->id_detail_pembelian_ayam ?></td>
        </tr>
        <tr>
            <td>Kandang</td>
            <td colspan="3">: <?= $data->id_kandang . " - " . $data->nama_kandang ?></td>
        </tr>
        <tr>
            <td>Supplier</td>
            <td colspan="3">: <?= $data->id_supplier . " - " . $data->nama_supplier ?></td>
        </tr>
        <tr>
            <td style="min-width: 100px">Jumlah</td>
            <td style="min-width: 300px">: <?= $data->jumlah_ayam ?> Ayam</td>
            <td>Harga Pembelian Ayam</td>
            <td>: Rp. <?= number_format($data->harga_ayam, 2, ',', '.') ?></td>
        </tr>
        <tr>
            <td>Jumlah Penjualan</td>
            <td>: <?= $data->jumlah_penjualan ?> Ayam</td>
            <td>harga Penjulan Ayam</td>
            <td>: Rp. <?= number_format($data->jumlah_penjualan_harga, 2, ',', '.') ?></td>
        </tr>
        <tr>
            <td>Jumlah Ayam Tersisa</td>
            <td>: <?= $data->jumlah_sisa_ayam ?> Ayam</td>
            <td>Laba dari pembelian ayam</td>
            <td>: Rp. <?= number_format($data->harga_sisa, 2, ',', '.') ?></td>
        </tr>
    </tbody>
</table>

<div id="outtable">
    <table class="data">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Detail Penjualan</th>
                <th>ID Detail Pembelian</th>
                <th>ID Kandang</th>
                <th>Tanggal</th>
                <th>Karyawan</th>
                <th>Jumlah</th>
                <th>Harga Terjual</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_pembelian as $key => $value) { ?>
                <tr>
                    <td>
                        <?= ($limit * $offset) + $key + 1 ?>
                    </td>
                    <td>
                        <?= $value->id_detail_penjualan_ayam ?>
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
                        <?= $value->nama_karyawan ?>
                    </td>
                    <td>
                        <?= $value->jumlah_ayam . " Ayam" ?>
                    </td>
                    <td>
                        Rp. <?= number_format($value->harga, 2, ',', '.') ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

@include('_part.footer_laporan')
@endsection