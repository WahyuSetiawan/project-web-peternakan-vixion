<div class="row">
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Sistem Peternakan Ayam Boiler</h2>
        </div>
    </div>
</div>


<div class="row  m-b-25" style="justify-content: space-between;">
    <div class="card card-info" style="width:30%">
        <div class="card-header">
            Stok Ayam Perkandang
        </div>
        <div class="card-body" style="position:relative">
            <div id="graph" style="width:100%"></div>
        </div>
        <div class="card-footer row">
        </div>
    </div>

    <div class="card card-info" style="width:30%">
        <div class="card-header">
            Stok Ayam Umur
        </div>
        <div class="card-body" style="position:relative">
            <div id="graph-home" style="width:100%"></div>
        </div>
        <div class="card-footer row">
        </div>
    </div>
    <div class="card card-info" style="width:30%">
        <div class="card-header">
            Stok Pakan Ayam
        </div>
        <div class="card-body" style="position:relative">
            <div id="graph-stok" style="width:100%"></div>
        </div>
        <div class="card-footer row">
        </div>
    </div>
</div>

<div class="row  m-b-25" style="justify-content: space-between;">
    <div class="card card-info" style="width:100%">
        <div class="table-responsive table--no-card m-b-25">
            <table class="table table-borderless table-striped table-earning">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kandang</th>
                        <th>Umur Ayam</th>
                        <th>Jumlah Stok Ayam</th>
                        <th>Jumlah Pembelian</th>
                        <th>Jumlah Penjualan</th>
                        <th>Jumlah kerugian ayam</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transaksi as $key => $value) {?>
                    <tr>
                        <td><?php echo $key + 1 ?></td>
                        <td><?php echo $value->nama ?></td>
                        <td><?php echo $value->umur_ayam_sekarang . " Hari" ?></td>
                        <td><?php echo $value->jumlah . " Ayam" ?></td>
                        <td><?php echo $value->jumlah_transaksi_masuk ?></td>
                        <td><?php echo $value->jumlah_transaksi_keluar ?></td>
                        <td><?php echo $value->jumlah_kerugian ?></td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>