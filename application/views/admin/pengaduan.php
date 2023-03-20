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
								<table class="table table-bordered table-hover" id="examples">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Nama Pelapor</th>
											<th>Kategori</th>
											<th>Judul Aduan</th>
											<th>Kendala</th>
											<th>Tanggal</th>
											<th>Gambar</th>
											<th>Status</th>
											<th>Tanggal Ditanggapi</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($pengaduan as $dt) : ?>
											<tr>
												<td class="text-center"><?= $i++; ?></td>
												<td><?= $dt->nama; ?></td>
												<td><?= $dt->namaKategori; ?></td>
												<td><?= $dt->judulAduan; ?></td>
												<td><?= $dt->kendala; ?></td>
												<td><?= date('d M Y', strtotime($dt->tanggal)); ?></td>
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
													<?php if ($dt->status == 0) : ?>
														<span class="badge badge-warning">Menunggu</span>
													<?php elseif ($dt->status == 1) : ?>
														<span class="badge badge-success">Disetujui</span>
													<?php elseif ($dt->status == 2) : ?>
														<span class="badge badge-danger">Ditolak</span>
													<?php endif; ?>
												</td>
												<td><?= ($dt->ditanggapi) ?  date('d M Y', strtotime($dt->ditanggapi)) : ''; ?></td>
												<td>
													<?php if ($dt->status == 0) : ?>
														<a href="<?= base_url('admin/pengaduan/delete/' . $dt->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
													<?php elseif ($dt->status == 1) : ?>
														<?php if (cekPlot($dt->id) == false) : ?>
															<a href="#" class="badge badge-primary plot_btn" data-toggle="modal" data-target="#plotPengaduan" data-id="<?= $dt->id; ?>">Plot Pengaduan</a>
														<?php endif; ?>
													<?php endif; ?>
													<a href="#" class="badge badge-warning status_btn" data-toggle="modal" data-target="#editStatus" data-id="<?= $dt->id; ?>" data-status="<?= $dt->status; ?>">Status</a>
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
<div class="modal fade" id="editStatus" tabindex="-1" role="dialog" aria-labelledby="editStatus" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Status</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/pengaduan/status'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Status</label>
								<input type="hidden" name="idPengaduan" id="idPengaduan">
								<select name="status" id="status" class="form-control">
									<option value="0">Menunggu</option>
									<option value="1">Disetujui</option>
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

<!-- modal plot -->
<div class="modal fade" id="plotPengaduan" tabindex="-1" role="dialog" aria-labelledby="plotPengaduan" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Plot Pengaduan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/pengaduan/plot'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Teknisi</label>
								<input type="hidden" name="idPengaduan" id="idPengaduanPlot">
								<select name="idUser" class="form-control">
									<option value="">-- Pilih Teknisi --</option>
									<?php foreach ($teknisi as $user) : ?>
										<option value="<?= $user->id; ?>"><?= $user->nama; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Urgensi</label>
								<select name="urgensi" class="form-control">
									<option value="">-- Pilih Urgensi --</option>
									<option value="Low">Low</option>
									<option value="Middle">Middle</option>
									<option value="High">High</option>
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

<script>
	let status_btn = $('.status_btn');

	$(status_btn).each(function(i) {
		$(status_btn[i]).click(function() {
			let id = $(this).data('id');
			let status = $(this).data('status');

			$('#idPengaduan').val(id);
			$('#status').val(status);
		});
	});

	let plot_btn = $('.plot_btn');

	$(plot_btn).each(function(i) {
		$(plot_btn[i]).click(function() {
			let id = $(this).data('id');

			$('#idPengaduanPlot').val(id);
		});
	});
</script>