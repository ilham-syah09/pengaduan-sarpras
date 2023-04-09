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
											<th>Nama Pengadu</th>
											<th>Nama Teknisi</th>
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
												<td><?= nama($dt->userId); ?></td>
												<td><?= nama($dt->idUser); ?></td>
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
													<?php if ($dt->status == 0) : ?>
														<a href="#" class="badge badge-info edit_btn" data-toggle="modal" data-target="#editPlot" data-id="<?= $dt->id; ?>" data-iduser="<?= $dt->idUser; ?>" data-urgensi="<?= $dt->urgensi; ?>">Edit</a>
														<a href="<?= base_url('admin/plot/delete/' . $dt->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
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
<div class="modal fade" id="editPlot" tabindex="-1" role="dialog" aria-labelledby="editPlot" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Plot Pengaduan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/plot/edit'); ?>" method="post" id="form-plotpengaduan">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Teknisi</label>
								<input type="hidden" name="idPlot" id="idPlot">
								<select name="idUser" class="form-control" id="idUser" required>
									<option value="">-- Pilih Teknisi --</option>
									<?php foreach ($teknisi as $user) : ?>
										<option value="<?= $user->id; ?>"><?= $user->nama; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group">
								<label>Urgensi</label>
								<select name="urgensi" class="form-control" id="urgensi" required>
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
	$(document).ready(function() {
		$("#form-plotpengaduan").validate({
			errorPlacement: function(label, element) {
				label.addClass('arrow text-sm text-danger');
				label.insertAfter(element);
			},
			wrapper: 'span'
		});
	})

	let edit_btn = $('.edit_btn');

	$(edit_btn).each(function(i) {
		$(edit_btn[i]).click(function() {
			let id = $(this).data('id');
			let idUser = $(this).data('iduser');
			let urgensi = $(this).data('urgensi');

			$('#idPlot').val(id);
			$('#idUser').val(idUser);
			$('#urgensi').val(urgensi);
		});
	});
</script>