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
											<th>Tanggal</th>
											<th>Gambar</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($pengaduan as $dt) : ?>
											<tr>
												<td class="text-center"><?= $i++; ?></td>
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
														<span class="badge badge-warning">Disetujui</span>
													<?php elseif ($dt->status == 3) : ?>
														<span class="badge badge-danger">Ditolak</span>
													<?php endif; ?>
												</td>
												<td>
													<?php if ($dt->status == 0) : ?>
														<a href="#" class="badge badge-warning edit_btn" data-toggle="modal" data-target="#editPengaduan" data-id="<?= $dt->id; ?>" data-juduladuan="<?= $dt->judulAduan; ?>" data-kendala="<?= $dt->kendala; ?>" data-tanggal="<?= $dt->tanggal; ?>">Edit</a>
														<a href="<?= base_url('user/pengaduan/delete/' . $dt->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
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

<!-- modal edit -->
<div class="modal fade" id="editPengaduan" tabindex="-1" role="dialog" aria-labelledby="editPengaduan" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit PEngaduan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('user/pengaduan/edit'); ?>" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Judul Aduan</label>
								<input type="hidden" name="idPengaduan" id="idPengaduan">
								<input type="text" class="form-control" name="judulAduan" id="judulAduan">
							</div>
							<div class="form-group">
								<label>Kendala</label>
								<input type="text" class="form-control" name="kendala" id="kendala">
							</div>
							<div class="form-group">
								<label>Gambar <sup class="text-warning">(opsional)</sup></label>
								<input type="file" class="form-control" name="gambar" accept=".jpeg, .jpg, .png">
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
	let edit_btn = $('.edit_btn');

	$(edit_btn).each(function(i) {
		$(edit_btn[i]).click(function() {
			let id = $(this).data('id');
			let judulAduan = $(this).data('juduladuan');
			let kendala = $(this).data('kendala');

			$('#idPengaduan').val(id);
			$('#judulAduan').val(judulAduan);
			$('#kendala').val(kendala);
		});
	});
</script>