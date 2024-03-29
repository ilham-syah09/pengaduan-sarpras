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
							<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addKategori">Add Kategori</a>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-bordered table-hover" id="example">
									<thead>
										<tr>
											<th class="text-center">#</th>
											<th>Nama</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php $i = 1;
										foreach ($kategori as $dt) : ?>
											<tr>
												<td class="text-center"><?= $i++; ?></td>
												<td><?= $dt->namaKategori; ?></td>
												<td>
													<a href="#" class="badge badge-warning edit_btn" data-toggle="modal" data-target="#editKategori" data-id="<?= $dt->id; ?>" data-namakategori="<?= $dt->namaKategori; ?>">Edit</a>
													<a href="<?= base_url('admin/kategori/delete/' . $dt->id); ?>" onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')" class="badge badge-danger">Delete</a>
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
<div class="modal fade" id="addKategori" tabindex="-1" role="dialog" aria-labelledby="addKategori" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?= base_url('admin/kategori/add'); ?>" method="post" id="form-addkategori">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama Kategori</label>
								<input type="text" class="form-control" name="namaKategori" required>
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
<div class="modal fade" id="editKategori" tabindex="-1" role="dialog" aria-labelledby="editKategori" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('admin/kategori/edit'); ?>" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Nama Kategori</label>
								<input type="hidden" name="idKategori" id="idKategori">
								<input type="text" class="form-control" name="namaKategori" id="namaKategori">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$("#form-addkategori").validate({
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
			let namaKategori = $(this).data('namakategori');

			$('#idKategori').val(id);
			$('#namaKategori').val(namaKategori);
		});
	});
</script>