<?php

if (!isset($user)) {
	header('Location: ../admin');
	die;
}
$page = [$user, '../'];



$kode = $_SESSION['kode'];
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];
$akses = $_SESSION['akses'];
$now = explode(' ', $datetime)[0];
$now = explode('-', $now);
$datenow = $months[(int) $now[1]] . ' ' . $now[0];
$now = $now[0] . '-' . $now[1];

$data = data("SELECT * FROM earnings WHERE (penerima = '$user' AND date like '$now%' AND status IS NOT NULL) ORDER BY date");

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sharing - Paid</title>

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

		<?php include_once('../struktur/page.php');  // side page >> ?>
	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
						<em class="fa fa-book color-blue"></em>
					</a></li>
				<li class="active">Sharing Paid</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12" style="display:flex; justify-content:space-between">
				<h1 class="page-header color-green">Sharing Paid</h1>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<?= ucfirst($datenow); ?>
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
									<em class="fa fa-sort"></em>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a onclick="cariSharingBulan('sharingPaid','<?= $user; ?>')" href="javascript:void(0)">
													<em id="icon2" class="fa fa-calendar"></em>
													<p id="opsi2" style="display: inline;"> Bulan </p>
												</a>
											</li>
											<li class="divider"></li>
											<li><a href="../sharing/?<?= $user; ?>" class="color-purple">
													<em id="icon2" class="fa fa-usd"></em>
													<p style="display: inline;" class="color-orange"> UNPAID PAGE</p>
												</a>
											</li>
											<li class="divider"></li>
											<li>
												<a href="javascript:void(0)">
													<em class="fa fa-trash color-red"></em>
													<p style="display: inline;" class="color-red"> DELETE</p>
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
						<div id="container" class="canvas-wrapper of-x-auto">
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
											<h3 class="color-blue"><strong><?= number_format(count($data), 0, '.', ','); ?></strong></h3>
										</th>
										<th style="text-align: right;">
											<h3 class="color-green"><strong id="display-share">0</strong></h3>
										</th>
									</tr>

								</tbody>
							</table>
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col"><input class="form-check-input" type="checkbox" id="checkall" value="" aria-label="..."> All</th>
										<th scope="col">PAID Date</th>
										<th scope="col">No. SPK</th>
										<th scope="col">No. Invoice</th>
										<th scope="col">Profit</th>
										<th scope="col">Sharing</th>
									</tr>
								</thead>
								<tbody>
									<?php $totalShare = 0; ?>
									<?php foreach ($data as $datas): ?>
										<?php if (empty($datas['sharing'])) {
											$sharing = (int) str_replace(',', '', $datas['profit']) / 10;
											if ($sharing < 50000) {
												$sharing = 50000;
											}
										} else {
											$sharing = (int) str_replace(',', '', $datas['sharing']);
										}
										?>

										<tr>
											<th scope="row"><input class="form-check-input orderCheckBox" type="checkbox" id="checkboxNoLabel" value="<?= $datas['id']; ?>" aria-label="..."></th>
											<td><?= date('d-M-Y', strtotime($datas['date'])); ?></td>
											<td><a target="_blank" href="<?= '../detail-pickup/?id=' . $datas['no_spk']; ?>">
													<?php
													$spk = str_split($datas['no_spk'], 7);
													$huruf = $spk[1];
													$angka = str_split($spk[0], 3);
													$spk = "$angka[0]-$angka[1]$angka[2]-$huruf";
													echo $spk;
													?>
												</a>
											</td>
											<td>
												<?php if (!empty($datas['invoice'])): ?>
													<a target="_blank" href="<?= '../detail-invoice/?id=' . $datas['invoice']; ?>">
														<?php
														$kode_id = str_split($datas['invoice'], 8);
														$huruf = $kode_id[0];
														$angka = $kode_id[1];
														$kode_id = "$huruf-$angka";
														echo $kode_id;
														?>
													</a>
												<?php else: ?>
													<p>NULL</p>
												<?php endif; ?>
											</td>
											<td><?= $datas['profit']; ?></td>
											<td><?= number_format($sharing, 0, '.', ','); ?></td>
										</tr>
										<?php $totalShare += $sharing; ?>
									<?php endforeach; ?>

								</tbody>
							</table>
							<input id="totalshare" type="hidden" value="<?= number_format($totalShare, 0, '.', ','); ?>">
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
		<script src="../alert/confirm.js?versi=<?= $version; ?>"></script>
		<script src="../js/user.js?versi=<?= $version; ?>"></script>
		<script src="../js/cPass.js?versi=<?= $version; ?>"></script>
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script src="../alert/sweetalert2.all.js"></script>

		<script>
			totalSharing();

			document.getElementById('checkall').addEventListener("change", function () {
				let checkbox = document.querySelectorAll(".orderCheckBox");
				checkbox.forEach(checkbox => {
					checkbox.checked = this.checked
				})
			})
		</script>


</body>

</html>