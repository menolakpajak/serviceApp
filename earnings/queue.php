<?php
ob_start();
session_start();
$page = ['queue', '../'];

if (empty($_SESSION['login'])) {
	header('Location: ../login');
}

require '../config.php';

$kode = $_SESSION['kode'];
login($kode, $_SESSION['token'], ['cs', 'admin', 'audit']);
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];
$akses = $_SESSION['akses'];

$data = data("SELECT * FROM invoice WHERE save_as = 'invoice' ORDER BY date DESC LIMIT 100");
$allOmset = [];
$allProfit = [];

foreach ($data as $input) {
	array_push($allOmset, str_replace(',', '', $input['subtotal']));
	array_push($allProfit, str_replace(',', '', $input['profit']));
}
$omset = array_sum($allOmset);
$profit = array_sum($allProfit);

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Earnings - queue</title>

	<!-- favicon -->
	<?php include_once '../struktur/favicon.php' ?>

	<link href="../event/css/event.css" rel="stylesheet">
	<link href="../event/css/theme2.css" rel="stylesheet">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/styles.css?versi=<?= $version; ?>" rel="stylesheet">
	<link href="../alert/sweetalert2.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>

	<!-- nav bar -->
	<?php include_once '../struktur/nav-bar.php'; ?>
	<!-- nav bar -->

	<!-- HIDEN INPUT -->

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<?php include_once '../struktur/profil.php' // foto profil ?>
		<div class="divider"></div>
		<form onsubmit="cariInvoice(event)">
			<div class="form-group">
				<input id="keyword-nota" type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<?php include_once('../struktur/page.php');  // side page >> ?>
	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
						<em class="fa fa-book color-blue"></em>
					</a></li>
				<li class="active">Queue</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12" style="display:flex; justify-content:space-between">
				<h1 class="page-header color-blue">Earnings Queue</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						January 2025
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
									<em class="fa fa-sort"></em>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a onclick="cariInvoiceBulan()" href="javascript:void(0)">
													<em id="icon2" class="fa fa-sort-numeric-asc"></em>
													<p id="opsi2" style="display: inline;"> Bulan </p>
												</a>
											</li>
											<li class="divider"></li>
											<li><a id="periode" href="javascript:void(0)">
													<em class="fa fa-calendar"></em> Periode
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body">
						<div id="container" class="canvas-wrapper">
							<table class="table table-striped rekap">
								<thead>
									<tr>
										<th scope="col" class="color-primary">ORDER</th>
										<th scope="col" class="color-success" style="text-align: right;">SHARING</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<th>
											<h3 class="color-blue"><strong><?= number_format($omset, 0, '.', ','); ?></strong></h3>
										</th>
										<th style="text-align: right;">
											<h3 class="color-green"><strong><?= number_format($profit, 0, '.', ','); ?></strong></h3>
										</th>
									</tr>

								</tbody>
							</table>
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Date</th>
										<th scope="col">No. SPK</th>
										<th scope="col">No. Invoice</th>
										<th scope="col">Profit</th>
										<th scope="col">Sharing</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1; ?>

									<?php foreach ($data as $datas): ?>
										<tr>
											<th scope="row"><?= $i; ?></th>
											<td><?= date('d-M-Y', strtotime($datas['date'])); ?></td>
											<td><a href="<?= '../detail-invoice/?id=' . $datas['kode']; ?>">
													<?php
													$kode_id = str_split($datas['kode'], 8);
													$huruf = $kode_id[0];
													$angka = $kode_id[1];
													$kode_id = "$huruf-$angka";
													echo $kode_id
														?>
												</a></td>
											<td><?= $datas['subtotal']; ?></td>
											<?php if ($datas['status'] == 'pending'): ?>
												<td style="font-weight:500;" class="color-orange"><?= ucfirst($datas['status']); ?></td>
											<?php endif; ?>
											<?php if ($datas['status'] == 'paid'): ?>
												<td style="font-weight:500;" class="color-green"><?= ucfirst($datas['status']); ?></td>
											<?php endif; ?>
										</tr>
										<?php $i++; ?>
									<?php endforeach; ?>

								</tbody>
							</table>
							<?php if (empty($data)) {
								echo '<h4 style="text-align:center;color:#f70000e0;font-weight:400;">Tidak ada data untuk ditampilkan !</h4>';

							} ?>

						</div>
					</div>
				</div>
			</div>


		</div> <!--/.main-->

		<div id="bg">
			<div id="date-table" class="zoom">
				<h2>Periode Input</h2>
				<div class="mb-3">
					<input type="datetime-local" class="form-control" id="from">
				</div>
				<h5>To</h5>
				<div class="mb-3">
					<input type="datetime-local" class="form-control" id="to">
				</div>
				<div id="button">
					<button id="cancel" type="button" class="btn btn-danger">Cancel</button>
					<button id="ok" type="button" class="btn btn-primary">OK</button>
				</div>
			</div>

		</div>

		<script src="../js/jquery-1.11.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/custom.js?versi=<?= $version; ?>"></script>
		<script src="../event/js/caleandar.js"></script>
		<script src="../event/js/event.js"></script>
		<script src="../js/cari.js?versi=<?= $version; ?>"></script>
		<script src="../js/user.js?versi=<?= $version; ?>"></script>
		<script src="../js/cPass.js?versi=<?= $version; ?>"></script>
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script src="../alert/sweetalert2.all.js"></script>


</body>

</html>