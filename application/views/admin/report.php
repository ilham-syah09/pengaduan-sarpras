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
				<div class="col-xl-4">
					<div class="form-group">
						<label for="tanggal">Tanggal Awal</label>
						<input type="date" name="tanggal_awal" id="by_tanggal_awal" class="form-control" value="<?= $tanggal_awal; ?>">
					</div>
				</div>
				<div class="col-xl-4">
					<div class="form-group">
						<label for="tanggal">Tanggal Akhir</label>
						<input type="date" name="tanggal_akhir" id="by_tanggal_akhir" class="form-control" value="<?= $tanggal_akhir; ?>">
					</div>
				</div>
			</div>
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
													<a href="<?= base_url('admin/report/delete/' . $dt->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
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
<script>
	$('#by_tanggal_awal').change(function() {
		let tanggal_awal = $(this).val();
		let tanggal_akhir = $('#by_tanggal_akhir').val();

		document.location.href = `<?= base_url('admin/report/${tanggal_awal}/${tanggal_akhir}'); ?>`;
	});

	$('#by_tanggal_akhir').change(function() {
		let tanggal_awal = $('#by_tanggal_awal').val();
		let tanggal_akhir = $(this).val();

		document.location.href = `<?= base_url('admin/report/${tanggal_awal}/${tanggal_akhir}'); ?>`;
	});
</script>