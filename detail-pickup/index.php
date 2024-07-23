<?php
ob_start();
session_start();
$page = ['detail-pickup', '../'];

if (empty($_SESSION['login'])) {
	header('Location: ../login');
}

require '../config.php';

$kode = $_SESSION['kode'];
login($kode, $_SESSION['token'], ['master', 'admin', 'audit', 'cs']);
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];
$akses = $_SESSION['akses'];

if (empty($_GET['id'])) {
	header('Location: ../');
	die;
}

$id = removeSpecialChar($_GET['id']);
$data = data("SELECT * FROM pickup WHERE no_spk = '$id'");
if (empty($data)) {
	include_once '../error/index.php';
	exit();
}
$data = $data[0];
$status = $data['status'];

//convert kode service center ke nama
$sc_code = $data['service_at'];
$service_at = data("SELECT * FROM service_center WHERE kode = '$sc_code'");
if (!empty($service_at)) {
	$service = $service_at[0]['nama'];
} else {
	$service = '';
}

$spk = str_split($data['no_spk'], 7);
$huruf = $spk[1];
$angka = str_split($spk[0], 3);
$spk = "$angka[0]-$angka[1]$angka[2]-$huruf";

$penerima = $data['penerima'];
$data['penerima'] = data("SELECT * FROM logininfo WHERE kodeuser = '$penerima'")[0]['nama'];
$json = $data['kelengkapan'];
$data2 = json_decode($json, true);

// <<<...LOGIC FOR CHECKBOX....>>

$kamera = 'style="display:none"';
$lensa = 'style="display:none"';
$battery = 'style="display:none"';
$memory = 'style="display:none"';
$strap = 'style="display:none"';
$bodyCap = 'style="display:none"';
$lensCap = 'style="display:none"';
$filter = 'style="display:none"';

$kamera_info = ucfirst($data2['check_kamera_info']);
$lensa_info = ucfirst($data2['check_lensa_info']);
$battery_info = ucfirst($data2['check_battery_info']);
$memory_info = ucfirst($data2['check_memory_info']);
$strap_info = ucfirst($data2['check_strap_info']);
$bodyCap_info = ucfirst($data2['check_bodycap_info']);
$lensCap_info = ucfirst($data2['check_lenscap_info']);
$filter_info = ucfirst($data2['check_filter_info']);
$other = ucfirst($data2['other']);

if ($data2['check_kamera'] == 'on') {
	$kamera = "";
}
if ($data2['check_lensa'] == 'on') {
	$lensa = "";
}
if ($data2['check_battery'] == 'on') {
	$battery = "";
}
if ($data2['check_memory'] == 'on') {
	$memory = "";
}
if ($data2['check_strap'] == 'on') {
	$strap = "";
}
if ($data2['check_bodycap'] == 'on') {
	$bodyCap = "";
}
if ($data2['check_lenscap'] == 'on') {
	$lensCap = "";
}
if ($data2['check_filter'] == 'on') {
	$filter = "";
}

if (empty($data2['check_kamera_info'])) {
	$kamera_info = "------";
}
if (empty($data2['check_lensa_info'])) {
	$lensa_info = "------";
}
if (empty($data2['check_battery_info'])) {
	$battery_info = "------";
}
if (empty($data2['check_memory_info'])) {
	$memory_info = "------";
}
if (empty($data2['check_strap_info'])) {
	$strap_info = "------";
}
if (empty($data2['check_bodycap_info'])) {
	$bodyCap_info = "------";
}
if (empty($data2['check_lenscap_info'])) {
	$lensCap_info = "------";
}
if (empty($data2['check_filter_info'])) {
	$filter_info = "------";
}

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Detail - Pickup</title>

	<!-- favicon -->
	<?php include_once '../struktur/favicon.php' ?>

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css?versi=<?= $version; ?>" rel="stylesheet">
	<link href="../css/detail.css?versi=<?= $version; ?>" rel="stylesheet">
	<link href="../alert/sweetalert2.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/checkbox.css">
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
	<input type="hidden" id="id" value="<?= $id; ?>">

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<?php include_once '../struktur/profil.php' // foto profil ?>
		<div class="divider"></div>

		<?php include_once ('../struktur/page.php');  // side page >> ?>
	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
						<em class="fa fa-sticky-note"></em>
					</a></li>
				<li class="active">Detail Order</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div style="display: flex; flex-direction:row;">
					<h1 style="font-weight: 500;" class="page-header color-purple">Pickup</h1>
					<i style="font-size: x-large; margin-top:8px;" class="fa fa-handshake-o color-purple" aria-hidden="true"></i>
				</div>
				<h4 class="page-header strong color-gray"><?= $spk; ?></h4>
			</div>
		</div><!--/.row-->


		<div id="edit" class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div style="font-weight: bold;" class="panel-heading">
						<div style="display:flex; justify-content:space-between">
							<div>
								<?= date('d-M-Y', strtotime($data['date'])); ?>
							</div>
							<?php if ($data['status'] == 'done'): ?>
								<div class="color-green">
									<?= strtoupper($data['status']); ?>
								</div>
							<?php else: ?>
								<div class="color-red">
									<?= strtoupper($data['status']); ?>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<div class="panel-body">
						<div id="container" class="canvas-wrapper">

							<form action="tes.php" method="post">


								<!-- PERSONAL INFO -->
								<div id="head2">
									<div id="personal_info">
										<div class="title_fill">
											<h3>Personal Info</h3>
										</div>
										<div class="form-group input">
											<label for="nama">Nama :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-id-card-o" aria-hidden="true"></i>
												<input type="text" class="form-control" id="nama" name="nama" maxlength="100" value="<?= ucfirst($data['nama']); ?> " readonly>
											</div>
										</div>
										<div class="form-group input">
											<label for="wa">WA no :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-whatsapp" aria-hidden="true"></i>
												<input type="number" class="form-control" id="wa" name="wa" maxlength="50" value="<?= $data['wa']; ?>" readonly>
											</div>
										</div>
										<div class="form-group input">
											<label for="no_tlp">No Tlp :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-phone" aria-hidden="true"></i>
												<input type="number" class="form-control" id="no_tlp" name="no_tlp" maxlength="50" value="<?= $data['no_tlp']; ?>" readonly>
											</div>
										</div>
										<div class="form-group input">
											<label for="alamat">Alamat :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-location-arrow" aria-hidden="true"></i>
												<input type="text" class="form-control" id="alamat" name="alamat" value="<?= ucfirst($data['alamat']); ?>" readonly>
											</div>
										</div>
									</div>

									<!-- _____________________________________________________________________________ -->


									<!-- UNIT INFO -->

									<div id="unit_info">
										<div class="title_fill">
											<h3>Unit Info</h3>
										</div>
										<div class="form-group input">
											<label for="tipe">Tipe Unit :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-camera" aria-hidden="true"></i>
												<input style="width: 100px;" type="text" class="form-control" id="tipe" name="tipe" maxlength="200" value="<?= ucfirst($data['tipe']); ?>" readonly>
											</div>
										</div>
										<div class="form-group input">
											<label for="unit">Unit :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-camera-retro" aria-hidden="true"></i>
												<input type="text" class="form-control" id="unit" name="unit" maxlength="200" value="<?= ucfirst($data['unit']); ?>" readonly>
											</div>
										</div>
										<div class="form-group input">
											<label for="serial_number">Serial Number :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-barcode" aria-hidden="true"></i>
												<input type="text" class="form-control" id="serial_number" name="serial_number" maxlength="255" value="<?= $data['sn']; ?>" readonly>
											</div>
										</div>
									</div>
								</div>

								<!-- _____________________________________________________________________________ -->

								<!-- INPUT INFO -->

								<div id="input_info">
									<div class="title_fill">
										<h3>Input Info</h3>
									</div>

									<div id="head3" class="form-group">

										<div class="form-group input">
											<label for="counter">Counter :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-building" aria-hidden="true"></i>
												<input style="width: 100px;" type="text" class="form-control" id="counter" name="counter" maxlength="200" value="<?= ucfirst($data['counter']); ?>" readonly>
											</div>
										</div>
										<div class="form-group input">
											<label for="penerima">Penerima :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-user" aria-hidden="true"></i>
												<input type="text" class="form-control" id="penerima" name="penerima" maxlength="20" readonly value="<?= ucfirst($data['penerima']); ?>">
											</div>
										</div>

										<?php if ($data['pin'] == 'on'): ?>
											<div class="form-group">
												<label for="pin" class="text-danger">Pin :</label>
												<div class="box">
													<i style="font-size: x-large;" class="fa fa-thumb-tack" aria-hidden="true"></i>
													<input id="pin" class="custom-select" name="pin" readonly value="on"></input>
												</div>
											</div>
										<?php endif; ?>

									</div>
									<?php if ($data['pin'] == 'on'): ?>
										<div class="note">
											<div style="background-color:#3836362e;border-radius:10px;padding:10px;">
												<p style="color:black !important;"><?= ucfirst(nl2br($data['note'])); ?></p>
											</div>
										</div>
									<?php endif; ?>
								</div>


								<!-- _____________________________________________________________________________ -->


								<!-- KELENGKAPAN -->

								<div id="kelengkapan">
									<div class="title_fill">
										<h3>Kelengkapan</h3>
									</div>

									<div id="head4" class="form-group input">

										<div <?= $kamera; ?>>
											<div class="custom-control custom-checkbox">
												<i style="font-size: medium; color:blue;" class="fa fa-check-square-o " aria-hidden="true"> </i>
												<label class="custom-control-label">Kamera</label>
											</div>
											<div class="box">
												<input type="text" class="form-control" id="check_kamera_info" name="check_kamera_info" maxlength="150" value="<?= $kamera_info; ?>" disabled>
												<i id="info1" style="font-size: x-large;" class="fa fa-sticky-note rotate" aria-hidden="true"></i>
											</div>
										</div>

										<div <?= $lensa; ?>>
											<div class="custom-control custom-checkbox">

												<i style="font-size: medium; color:blue;" class="fa fa-check-square-o " aria-hidden="true"> </i>
												<label class="custom-control-label">Lensa</label>
											</div>
											<div class="box">
												<input type="text" class="form-control" id="check_lensa_info" name="check_lensa_info" maxlength="150" value="<?= $lensa_info; ?>" disabled>
												<i id="info2" style="font-size: x-large;" class="fa fa-sticky-note rotate" aria-hidden="true"></i>
											</div>
										</div>

										<div <?= $battery; ?>>
											<div class="custom-control custom-checkbox">

												<i style="font-size: medium; color:blue;" class="fa fa-check-square-o " aria-hidden="true"> </i>
												<label class="custom-control-label">Battery</label>
											</div>
											<div class="box">
												<input type="text" class="form-control" id="check_battery_info" name="check_battery_info" value="<?= $battery_info; ?>" maxlength="150" disabled>
												<i id="info3" style="font-size: x-large;" class="fa fa-sticky-note rotate" aria-hidden="true"></i>
											</div>
										</div>

										<div <?= $memory; ?>>
											<div class="custom-control custom-checkbox">

												<i style="font-size: medium; color:blue;" class="fa fa-check-square-o " aria-hidden="true"> </i>
												<label class="custom-control-label">Memory</label>
											</div>
											<div class="box">
												<input type="text" class="form-control" id="check_memory_info" name="check_memory_info" value="<?= $memory_info; ?>" maxlength="150" disabled>
												<i id="info4" style="font-size: x-large;" class="fa fa-sticky-note rotate" aria-hidden="true"></i>
											</div>
										</div>

										<div <?= $strap; ?>>
											<div class="custom-control custom-checkbox">
												<i style="font-size: medium; color:blue;" class="fa fa-check-square-o " aria-hidden="true"> </i>
												<label class="custom-control-label">Strap</label>
											</div>
											<div class="box">
												<input type="text" class="form-control" id="check_strap_info" name="check_strap_info" value="<?= $strap_info; ?>" maxlength="150" disabled>
												<i id="info5" style="font-size: x-large;" class="fa fa-sticky-note rotate" aria-hidden="true"></i>
											</div>
										</div>

										<div <?= $bodyCap; ?>>
											<div class="custom-control custom-checkbox">

												<i style="font-size: medium; color:blue;" class="fa fa-check-square-o " aria-hidden="true"> </i>
												<label class="custom-control-label">Body cap</label>
											</div>
											<div class="box">
												<input type="text" class="form-control" id="check_bodycap_info" name="check_bodycap_info" value="<?= $bodyCap_info; ?>" maxlength="150" disabled>
												<i id="info6" style="font-size: x-large;" class="fa fa-sticky-note rotate" aria-hidden="true"></i>
											</div>
										</div>

										<div <?= $lensCap; ?>>
											<div class="custom-control custom-checkbox">
												<i style="font-size: medium; color:blue;" class="fa fa-check-square-o " aria-hidden="true"> </i>
												<label class="custom-control-label">Lens cap</label>
											</div>
											<div class="box">
												<input type="text" class="form-control" id="check_lenscap_info" name="check_lenscap_info" value="<?= $lensCap_info; ?>" maxlength="150">
												<i id="info7" style="font-size: x-large;" class="fa fa-sticky-note rotate" aria-hidden="true"></i>
											</div>
										</div>

										<div <?= $filter; ?>>
											<div class="custom-control custom-checkbox">
												<i style="font-size: medium; color:blue;" class="fa fa-check-square-o " aria-hidden="true"> </i>
												<label class="custom-control-label">Filter</label>
											</div>
											<div class="box">
												<input type="text" class="form-control" id="check_filter_info" name="check_filter_info" value="<?= $filter_info; ?>" maxlength="150" disabled>
												<i id="info8" style="font-size: x-large;" class="fa fa-sticky-note rotate" aria-hidden="true"></i>
											</div>
										</div>


									</div>
									<div class="kelengkapan_lain">
										<div style="background-color:#3836362e;border-radius:10px;padding:10px;">
											<p style="color:black !important;"><?= ucfirst(nl2br($other)); ?></p>
										</div>
									</div>

								</div>

								<!-- _____________________________________________________________________________ -->

								<!-- INFO KERUSAKAN -->
								<div id="kerusakan">
									<div class="title_fill">
										<h3>Info Kerusakan</h3>
									</div>


									<div class="kerusakan">
										<div style="background-color:#3836362e;border-radius:10px;padding:10px;">
											<p style="color:black !important;"><?= ucfirst(nl2br($data['error'])); ?></p>
										</div>
									</div>

								</div>

								<!-- _____________________________________________________________________________ -->

								<hr>

								<div id="ajax-update">
									<!-- ABORT INFO -->
									<?php if ($data['acc'] == 'on') {
										$acc = 'acc';
									} else {
										$acc = '';
									} ?>
									<div id="proses_info" style="border:1px solid #ffa500b3 !important;" class="<?= $acc; ?>">
										<div style="background-color: #a30fc9; " class="title_fill">
											<h3>Proses Info</h3>
										</div>

										<div id="head5" class="form-group">

											<div class="form-group input">
												<label for="service_center">Service At :</label>
												<div class="box">
													<i style="font-size: x-large;" class="fa fa-plane" aria-hidden="true"></i>
													<input type="text" class="form-control" id="service_center" name="service_center" maxlength="200" value="<?= ucwords($service); ?>" readonly>
												</div>
											</div>
											<div class="form-group input">
												<label for="date_proses">Date Proses :</label>
												<div class="box">
													<i style="font-size: x-large;" class="fa fa-calendar" aria-hidden="true"></i>
													<input style="width: 120px;" type="text" class="form-control" id="date_proses" name="date_proses" maxlength="200" value="<?= date('d-M-Y', strtotime($data['date_proses'])); ?>" readonly>
												</div>
											</div>
											<?php if (!empty($data['date_update'])): ?>
												<div class="form-group input">
													<label for="date_update">Date Update :</label>
													<div class="box">
														<i style="font-size: x-large;" class="fa fa-calendar" aria-hidden="true"></i>
														<input style="width: 120px;" type="text" class="form-control" id="date_update" name="date_update" maxlength="200" value="<?= date('d-M-Y', strtotime($data['date_update'])); ?>" readonly>
													</div>
												</div>
											<?php endif; ?>
											<div class="form-group input">
												<label for="date_update">Date Finish :</label>
												<div class="box">
													<i style="font-size: x-large;" class="fa fa-calendar" aria-hidden="true"></i>
													<input style="width: 120px;" type="text" class="form-control" id="date_update" name="date_update" maxlength="200" value="<?= date('d-M-Y', strtotime($data['date_finish'])); ?>" readonly>
												</div>
											</div>
											<div class="form-group input">
												<label for="date_update">Date Pickup :</label>
												<div class="box">
													<i style="font-size: x-large;" class="fa fa-calendar" aria-hidden="true"></i>
													<input style="width: 120px;" type="text" class="form-control" id="date_update" name="date_update" maxlength="200" value="<?= date('d-M-Y', strtotime($data['date_pickup'])); ?>" readonly>
												</div>
											</div>

										</div>
										<div class="note">
											<div style="background-color:#3836362e;border-radius:10px;padding:10px; margin-bottom: 10px">
												<h5 style="font-weight: bold; text-decoration: underline;">Hasil Pengecekan :</h5>
												<p style="color:black !important;"><?= ucfirst(nl2br($data['result'])); ?></p>
											</div>
										</div>
										<div class="note">
											<div style="background-color:#3836362e;border-radius:10px;padding:10px; margin-bottom: 10px">
												<h5 style="font-weight: bold; text-decoration: underline;">Estimasi Biaya :</h5>
												<p style="color:black !important;"><?= ucfirst(nl2br($data['cost'])); ?></p>
											</div>
										</div>
										<div class="action-grup">
											<?php if (empty($data['invoice'])): ?>
												<a href="../invoice-for/?spk=<?= $id; ?>" class="btn btn-primary">New Invoice </a>
											<?php else: ?>
												<a href="../detail-invoice/?id=<?= $data['invoice']; ?>" class="btn btn-success">Invoice </a>
											<?php endif; ?>
											<?php if (!empty($data['surat_jalan'])): ?>
												<a href="javascript:void(0)" class="btn btn-warning"> Surat Jalan </a>
											<?php endif; ?>
										</div>
									</div>


									<!-- _____________________________________________________________________________ -->
									<!-- ACTION BUTTON -->
									<div id="action">
										<div class="title_fill">
											<h3>Action Button</h3>
										</div>

										<div class="action">
											<?php if ($akses == 'master'): ?>
												<a href="javascript:void(0)" class="btn btn-danger mt-1" onclick="deleteData('pickup','<?= $id; ?>')"> Delete </a>
											<?php endif; ?>
											<a href="../duplicateOrder/?id=<?= $id; ?>" class="btn btn-info mt-1">Duplicate</a>
											<a href="../print/?id=<?= $id; ?>" class="btn btn-dark mt-1" target="_blank">Receipt</a>
										</div>

									</div>
								</div>

								<!-- _____________________________________________________________________________ -->

							</form>

						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->




		<script src="../js/jquery-1.11.1.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script src="../js/ajax.js?versi=<?= $version; ?>"></script>
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script src="../alert/sweetalert2.all.js"></script>
		<script src="../js/popup.js?versi=<?= $version; ?>"></script>
		<script src="../alert/confirm.js?versi=<?= $version; ?>"></script>
		<script src="../js/user.js?versi=<?= $version; ?>"></script>
		<script src="../js/cPass.js?versi=<?= $version; ?>"></script>
</body>

</html>