<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?= $title; ?></h1>
				</div>
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Info boxes -->
			<div class="row">
				<div class="col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover" id="example">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Judul Aduan</th>
											<th>Kendala</th>
											<th>Gambar</th>
											<th>Urgensi</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($plot as $dt) : ?>
											<tr>
												<td class="text-center"><?= $i++; ?></td>
												<td><?= $dt->judulAduan; ?></td>
												<td><?= $dt->kendala; ?></td>
												<td class="text-center">
													<?php if ($dt->gambar != null) : ?>
														<a href="<?= base_url('upload/pengaduan/' . $dt
																		->gambar); ?>">
															<img src="<?= base_url('upload/pengaduan/' . $dt
																			->gambar); ?>" alt="<?= $dt->judulAduan; ?>" class="img-thumbnail" width="180">
														</a>
													<?php else : ?>
														-
													<?php endif; ?>
												</td>
												<td>
													<?php if ($dt->urgensi == 'Low') : ?>
														<span class="badge badge-warning">Low</span>
													<?php elseif ($dt->urgensi == 'Middle') : ?>
														<span class="badge badge-info">Middle</span>
													<?php elseif ($dt->urgensi == 'High') : ?>
														<span class="badge badge-danger">High</span>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($dt->status == 0) : ?>
														<span class="badge badge-warning">Belum Diproses</span>
													<?php elseif ($dt->status == 1) : ?>
														<span class="badge badge-success">Selesai</span>
													<?php elseif ($dt->status == 2) : ?>
														<span class="badge badge-danger">Ditolak</span>
													<?php endif; ?>
												</td>
												<td>
													<a href="#" class="badge badge-warning status_btn" data-toggle="modal" data-target="#editStatus" data-id="<?= $dt->id; ?>" data-status="<?= $dt->status; ?>">Status</a>
													<?php if ($dt->status == 0) : ?>
														<a href="#" class="badge badge-info report_btn" data-toggle="modal" data-target="#report" data-id="<?= $dt->id; ?>" data-idpengaduan="<?= $dt->idPengaduan; ?>" data-tanggaladuan="<?= $dt->tanggalAduan; ?>">Report</a>
													<?php endif; ?>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal plot -->
<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="report" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Report Pengaduan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('teknisi/plot/report'); ?>" method="post" enctype="multipart/form-data" id="form-plotTeknisi">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" name="idPlot" id="idPlot">
							<input type="hidden" name="idPengaduan" id="idPengaduan">
							<div class="form-group">
								<label>Solusi</label>
								<input type="text" name="solusi" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Rincian Pekerjaan</label>
								<textarea name="rincian" class="form-control" cols="30" rows="8" required></textarea>
							</div>
							<div class="form-group">
								<label>Gambar</label>
								<input type="file" name="gambar" class="form-control" accept=".jpeg, .jpg, .png" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Tanggal Mulai</label>
								<input type="text" name="tanggal_mulai" class="form-control datepicker" id="tanggal_mulai" autocomplete="off" placeholder="yyyy/mm/dd" required>
							</div>
							<div class="form-group">
								<label>Jam Mulai</label>
								<input type="text" name="jam_mulai" class="form-control js-masked-time" placeholder="__:__" required>
							</div>
							<div class="form-group">
								<label>Tanggal Selesai</label>
								<input type="text" name="tanggal_selesai" class="form-control datepicker" id="tanggal_selesai" autocomplete="off" placeholder="yyyy/mm/dd" required>
							</div>
							<div class=" form-group">
								<label>Jam Selesai</label>
								<input type="text" name="jam_selesai" class="form-control js-masked-time" placeholder="__:__" required>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="editStatus" tabindex="-1" role="dialog" aria-labelledby="editStatus" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Status</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('teknisi/plot/status'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Status</label>
								<input type="hidden" name="idPlot" id="idPlotStatus">
								<select name="status" id="status" class="form-control">
									<option value="0">Belum Diproses</option>
									<option value="1">Selesai</option>
									<option value="2">Ditolak</option>
								</select>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo base_url() ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
	$(document).ready(function() {
		$("#form-plotTeknisi").validate({
			errorPlacement: function(label, element) {
				label.addClass('arrow text-sm text-danger');
				label.insertAfter(element);
			},
			wrapper: 'span'
		});
	})

	let report_btn = $('.report_btn');

	$(report_btn).each(function(i) {
		$(report_btn[i]).click(function() {
			let id = $(this).data('id');
			let idPengaduan = $(this).data('idpengaduan');
			let tanggalAduan = $(this).data('tanggaladuan');

			$('#idPlot').val(id);
			$('#idPengaduan').val(idPengaduan);

			$('#tanggal_mulai').datepicker('setStartDate', new Date(tanggalAduan));
		});
	});

	let status_btn = $('.status_btn');

	$(status_btn).each(function(i) {
		$(status_btn[i]).click(function() {
			let id = $(this).data('id');
			let status = $(this).data('status');

			$('#idPlotStatus').val(id);
			$('#status').val(status);
		});
	});

	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd'
	});

	$("#tanggal_mulai").datepicker({
		todayBtn: 1,
		autoclose: true,
	}).on('changeDate', function(selected) {
		var minDate = new Date(selected.date.valueOf());
		$('#tanggal_selesai').datepicker('setStartDate', minDate);
	});
</script>