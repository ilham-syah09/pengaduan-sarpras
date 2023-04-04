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
				<div class="col-xl-6 col-lg-6 col-sm-6 col-md-6">
					<div class="info-box mb-3">
						<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-book"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Plot Aduan</span>
							<span class="info-box-number"><?= $aduan; ?></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				</div>
				<!-- /.col -->

				<div class="col-xl-6 col-lg-6 col-sm-6 col-md-6">
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
			<!-- <div class="row">
				<div class="col-lg-12 col-sm-12 col-md-12 d-flex flex-column">
					<div class="card">
						<div class="card-header bg-primary text-center">
							<h5>Grafik Status Aduan</h5>
						</div>
						<div class="card-body">
							<div id="chart-aduan"></div>
						</div>
					</div>
				</div>
			</div> -->
			<!-- /.row -->
		</div>
		<!--/. container-fluid -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script src="<?= base_url(); ?>assets/plugins/highcharts/highcharts.js"></script>

<script>
	let aduan = <?php echo json_encode($aduanGrafik); ?>;
	let dataAduan = [];

	for (let i = 0; i < aduan.length; i++) {
		var status;
		if (aduan[i].status == 1) {
			status = 'Selesai';
		} else if (aduan[i].status == 2) {
			status = 'Ditolak';
		} else {
			status = 'Menunggu';
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
</script>