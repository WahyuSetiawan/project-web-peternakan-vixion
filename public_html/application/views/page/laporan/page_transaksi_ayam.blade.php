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

	<div class="col-lg-12  m-b-12">
		<form method="get" action="" id="filter_data">
			<div class="card card-info">

				<div class="card-header">
					Filter tampilan data
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label>Tahun : </label>
								<select class="form-control" name="tahun">
									<option {{($id['tahun']=="0" ) ? "selected" : ""}} value="0">Semua</option>
									<?php foreach ($tahun as $key => $value) { ?>
									<option value="{{$value->tahun}}" {{($value->tahun === $id['tahun']) ? "selected" : "" }} data-bulan="{{json_encode($value->bulan)}}">
										<?= $value->tahun ?>
									</option>
									<?php } ?>
								</select>
							</div>
						</div>

						<div class="col-6">
							<div class="form-group">
								<label>Bulan : </label>
								<select class="form-control" name="bulan">
									<option selected value="0">Semua</option>
									<?php foreach ($bulan as $key => $value) { ?>
									<option value="{{$value->bulan}}" {{($value->bulan === $id['bulan']) ? "selected" : "" }}>
										{{ $value->bulan }}
									</option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer row">
					<button type="submit" class="btn">Tampilkan Data</button>
				</div>
			</div>
	</div>

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
			<div class="table-data__tool-right">
				<div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
					<select class="js-select2" name="type" onchange="this.form.submit()">
						<option selected="selected">Cetak</option>
						<option value="html">HTML</option>
						<option value="pdf">PDF</option>
					</select>
					<div class="dropDownSelect2"></div>
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
						<th>No</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Aksi</th>
						<th>Masuk</th>
						<th>Keluar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($transaksi as $key => $value) { ?>
					<tr>
						<td>{{ $key + 1 }} </td>
						<td>{{ $value->id_kandang }} </td>
						<td>{{ $value->nama_kandang }} </td>
						<td>{{ $value->aksi }} </td>
						<td>{{ $value->id_kandang }} </td>
						<td>{{ $value->id_kandang }} </td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
    <div class="col-lg-5">Showing
        {{$offset+1}} to
        {{($count < ($limit + $offset)) ? $count : ($limit + $offset)}} of
        {{$count}} entries </div>

	<div class="col-lg-12">
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