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
											<th>Solusi</th>
											<th>Rincian Pekerjaan</th>
											<th>Waktu Mulai</th>
											<th>Waktu Selesai</th>
											<th>Gambar</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($report as $dt) : ?>
											<tr>
												<td class="text-center"><?= $i++; ?></td>
												<td><?= $dt->judulAduan; ?></td>
												<td><?= $dt->kendala; ?></td>
												<td><?= $dt->solusi; ?></td>
												<td><?= $dt->rincian; ?></td>
												<td class="align-middle">
													<?= date('d M Y', strtotime($dt->tanggal_mulai)) . ' - ' . $dt->jam_mulai; ?>
												</td>
												<td class="align-middle">
													<?= date('d M Y', strtotime($dt->tanggal_selesai)) . ' - ' . $dt->jam_selesai; ?>
												</td>
												<td class="text-center">
													<?php if ($dt->gambar != null) : ?>
														<a href="<?= base_url('upload/report/' . $dt
																		->gambar); ?>">
															<img src="<?= base_url('upload/report/' . $dt
																			->gambar); ?>" alt="<?= $dt->judulAduan; ?>" class="img-thumbnail" width="180">
														</a>
													<?php else : ?>
														-
													<?php endif; ?>
												</td>
												<td>
													<a href="#" class="badge badge-info report_btn" data-toggle="modal" data-target="#report" data-id="<?= $dt->id; ?>" data-solusi="<?= $dt->solusi; ?>" data-rincian="<?= $dt->rincian; ?>" data-tanggal_mulai="<?= $dt->tanggal_mulai; ?>" data-jam_mulai="<?= $dt->jam_mulai; ?>" data-tanggal_selesai="<?= $dt->tanggal_selesai; ?>" data-jam_selesai="<?= $dt->jam_selesai; ?>">Edit</a>
													<a href="<?= base_url('teknisi/report/delete/' . $dt->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
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

<!-- modal edit -->
<div class="modal fade" id="report" tabindex="-1" role="dialog" aria-labelledby="report" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Report Pengaduan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('teknisi/report/edit'); ?>" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<input type="hidden" name="idReport" id="idReport">
							<div class="form-group">
								<label>Solusi</label>
								<input type="text" name="solusi" class="form-control" id="solusi">
							</div>
							<div class="form-group">
								<label>Rincian Pekerjaan</label>
								<textarea name="rincian" class="form-control" cols="30" rows="8" id="rincian"></textarea>
							</div>
							<div class="form-group">
								<label>Gambar</label>
								<input type="file" name="gambar" class="form-control" accept=".jpeg, .jpg, .png">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Tanggal Mulai</label>
								<input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai">
							</div>
							<div class="form-group">
								<label>Jam Mulai</label>
								<input type="text" name="jam_mulai" class="form-control js-masked-time" placeholder="__:__" id="jam_mulai">
							</div>
							<div class="form-group">
								<label>Tanggal Selesai</label>
								<input type="date" name="tanggal_selesai" class="form-control" id="tanggal_selesai">
							</div>
							<div class="form-group">
								<label>Jam Selesai</label>
								<input type="text" name="jam_selesai" class="form-control js-masked-time" placeholder="__:__" id="jam_selesai">
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

<script>
	let report_btn = $('.report_btn');

	$(report_btn).each(function(i) {
		$(report_btn[i]).click(function() {
			let id = $(this).data('id');
			let idPengaduan = $(this).data('idpengaduan');
			let solusi = $(this).data('solusi');
			let rincian = $(this).data('rincian');
			let tanggal_mulai = $(this).data('tanggal_mulai');
			let jam_mulai = $(this).data('jam_mulai');
			let tanggal_selesai = $(this).data('tanggal_selesai');
			let jam_selesai = $(this).data('jam_selesai');

			$('#idReport').val(id);
			$('#idPengaduan').val(idPengaduan);
			$('#solusi').val(solusi);
			$('#rincian').text(rincian);
			$('#tanggal_mulai').val(tanggal_mulai);
			$('#jam_mulai').val(jam_mulai);
			$('#tanggal_selesai').val(tanggal_selesai);
			$('#jam_selesai').val(jam_selesai);
		});
	});
</script>