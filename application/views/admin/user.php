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
						<div class="card-header">
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addUser">Add User</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover" id="example">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Nama</th>
											<th>Username</th>
											<th>Level</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($user as $dt) : ?>
											<tr>
												<td class="text-center"><?= $i++; ?></td>
												<td><?= $dt->nama; ?></td>
												<td><?= $dt->username; ?></td>
												<td>
													<?php if ($dt->level == 1) : ?>
														<span class="badge badge-danger">Admin</span>
													<?php elseif ($dt->level == 2) : ?>
														<span class="badge badge-warning">Teknisi</span>
													<?php elseif ($dt->level == 3) : ?>
														<span class="badge badge-info">Dosen</span>
													<?php elseif ($dt->level == 4) : ?>
														<span class="badge badge-success">Mahasiswa</span>
													<?php endif; ?>
												</td>
												<td>
													<a href="#" class="badge badge-warning edit_btn" data-toggle="modal" data-target="#editUser" data-id="<?= $dt->id; ?>" data-nama="<?= $dt->nama; ?>" data-level="<?= $dt->level; ?>" data-username="<?= $dt->username; ?>">Edit</a>
													<a href="<?= base_url('admin/user/delete/' . $dt->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
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


<!-- modal add -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="addUser" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/user/add'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama</label>
								<input type="text" class="form-control" name="nama">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" name="username">
							</div>
							<div class="form-group">
								<label>Level</label>
								<select name="level" class="form-control">
									<option value="">-- Pilih Level --</option>
									<option value="1">Admin</option>
									<option value="2">Teknisi</option>
									<option value="3">Dosen</option>
									<option value="4">Mahasiswa</option>
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

<!-- modal edit -->
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUser" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/user/edit'); ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama</label>
								<input type="hidden" name="idUser" id="idUser">
								<input type="text" class="form-control" name="nama" id="nama">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" name="username" id="username">
							</div>
							<div class="form-group">
								<label>Level</label>
								<select name="level" class="form-control" id="level">
									<option value="">-- Pilih Level --</option>
									<option value="1">Admin</option>
									<option value="2">Teknisi</option>
									<option value="3">Dosen</option>
									<option value="4">Mahasiswa</option>
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
	let edit_btn = $('.edit_btn');

	$(edit_btn).each(function(i) {
		$(edit_btn[i]).click(function() {
			let id = $(this).data('id');
			let nama = $(this).data('nama');
			let username = $(this).data('username');
			let level = $(this).data('level');

			$('#idUser').val(id);
			$('#nama').val(nama);
			$('#username').val(username);
			$('#level').val(level);
		});
	});
</script>