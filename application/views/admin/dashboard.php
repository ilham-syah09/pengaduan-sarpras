<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0"><?= $title; ?></h1>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<!-- Info boxes -->
			<div class="row">
				<div class="col-xl-3 col-lg-3 col-sm-6 col-md-6">
					<div class="info-box">
						<span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">User</span>
							<span class="info-box-number">
								<?= $user; ?>
							</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-xl-3 col-lg-3 col-sm-6 col-md-6">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Aduan</span>
							<span class="info-box-number"><?= $aduan; ?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<div class="col-xl-3 col-lg-3 col-sm-6 col-md-6">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-success elevation-1"><i class="fas fa-object-group"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Plot Aduan</span>
							<span class="info-box-number"><?= $plot; ?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
				<div class="col-xl-3 col-lg-3 col-sm-6 col-md-6">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Report Aduan</span>
							<span class="info-box-number"><?= $report; ?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->
			</div>
			<div class="row">
				<div class="col-lg-4 col-sm-12 col-md-12 d-flex flex-column">
					<div class="card">
						<div class="card-header bg-info text-center">
							<h5>Grafik User Level</h5>
						</div>
						<div class="card-body">
							<div id="chart-user"></div>
						</div>
					</div>
					<!-- /.info-box -->
				</div>
				<div class="col-lg-4 col-sm-12 col-md-12 d-flex flex-column">
					<div class="card">
						<div class="card-header bg-primary text-center">
							<h5>Grafik Status Aduan</h5>
						</div>
						<div class="card-body">
							<div id="chart-aduan"></div>
						</div>
					</div>
					<!-- /.info-box -->
				</div>
				<div class="col-lg-4 col-sm-12 col-md-12 d-flex flex-column">
					<div class="card">
						<div class="card-header bg-dark text-center">
							<h5>Grafik Aduan Hari Ini</h5>
						</div>
						<div class="card-body">
							<div id="chart-aduan-today"></div>
						</div>
					</div>
					<!-- /.info-box -->
				</div>
			</div>
			<!-- /.row -->
		</div>
		<!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="<?= base_url(); ?>assets/plugins/highcharts/highcharts.js"></script>
<script src="<?= base_url(); ?>assets/plugins/highcharts/exporting.js"></script>
<script src="<?= base_url(); ?>assets/plugins/highcharts/export-data.js"></script>
<script src="<?= base_url(); ?>assets/plugins/highcharts/accessibility.js"></script>

<script>
	let user = <?php echo json_encode($userGrafik); ?>;
	let dataUser = [];

	for (let i = 0; i < user.length; i++) {
		var level;
		if (user[i].level == 1) {
			level = 'Admin';
		} else if (user[i].level == 2) {
			level = 'Teknisi';
		} else if (user[i].level == 3) {
			level = 'Dosen';
		} else if (user[i].level == 4) {
			level = 'Mahasiswa';
		}

		dataUser.push({
			name: level,
			y: parseInt(user[i].total)
		});
	}

	Highcharts.chart('chart-user', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			backgroundColor: '#fff',
		},
		title: {
			text: 'Grafik User Level'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.y} User'
				},
				showInLegend: true
			}
		},
		series: [{
			name: 'Level User',
			colorByPoint: true,
			data: dataUser
		}],
		exporting: {
			buttons: {
				contextButton: {
					enabled: false
				}
			}
		}
	});

	let aduan = <?php echo json_encode($aduanGrafik); ?>;
	let dataAduan = [];

	for (let i = 0; i < aduan.length; i++) {
		var status;
		if (aduan[i].status == 1) {
			status = 'Selesai';
		} else if (aduan[i].status == 2) {
			status = 'Ditolak';
		} else {
			status = 'Belum di proses'
		}

		dataAduan.push({
			name: status,
			y: parseInt(aduan[i].total)
		});
	}

	Highcharts.chart('chart-aduan', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			backgroundColor: '#fff',
		},
		title: {
			text: 'Grafik Status Aduan'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.y} Aduan'
				},
				showInLegend: true
			}
		},
		series: [{
			name: 'Status Aduan',
			colorByPoint: true,
			data: dataAduan
		}],
		exporting: {
			buttons: {
				contextButton: {
					enabled: false
				}
			}
		}
	});

	let aduanToday = <?php echo json_encode($aduanTodayGrafik); ?>;
	let dataAduanToday = [];

	for (let i = 0; i < aduanToday.length; i++) {
		var statusTOday;
		if (aduanToday[i].status == 1) {
			statusTOday = 'Selesai';
		} else if (aduanToday[i].status == 2) {
			statusTOday = 'Ditolak';
		} else {
			statusTOday = 'Belum di proses'
		}

		dataAduanToday.push({
			name: statusTOday,
			y: parseInt(aduanToday[i].total)
		});
	}

	Highcharts.chart('chart-aduan-today', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie',
			backgroundColor: '#fff',
		},
		title: {
			text: 'Grafik Aduan Hari Ini'
		},
		accessibility: {
			point: {
				valueSuffix: '%'
			}
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: true,
					format: '<b>{point.name}</b>: {point.y} Aduan'
				},
				showInLegend: true
			}
		},
		series: [{
			name: 'Aduan Hari Ini',
			colorByPoint: true,
			data: dataAduanToday
		}],
		exporting: {
			buttons: {
				contextButton: {
					enabled: false
				}
			}
		}
	});
</script>