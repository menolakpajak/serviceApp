<?php
ob_start();
session_start();
$page = ['detail invoice', '../'];

if (empty($_SESSION['login'])) {
	header('Location: ../login');
}

require '../config.php';

$kode = $_SESSION['kode'];
login($kode, $_SESSION['token'], ['master', 'admin', 'audit', 'cs']);
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];
$akses = $_SESSION['akses'];

$id = $_GET['id'];
$data = data("SELECT * FROM invoice WHERE kode = '$id'");
if (empty($data)) {
	include_once '../error/index.php';
	die;
}
$data = $data[0];

$link_spk = removeSpecialChar($data['link']);
$date = date('d-M-Y', strtotime($data['date']));
$status = strtoupper($data['status']);
$save_as = strtoupper($data['save_as']);
$qtss = json_decode($data['qts'], true);
$kodes = json_decode($data['kode_part'], true);
$descs = json_decode($data['deskripsi'], true);
$buys = json_decode($data['buy'], true);
$margins = json_decode($data['margin'], true);
$sells = json_decode($data['sell'], true);
$profit = $data['profit'];
$subtotal = $data['subtotal'];
$dpp = $data['dpp'];
$ppn = $data['ppn'];
$deposit = $data['deposit'];
$total = $data['total'];
$note = $data['note'];
$rekening = $data['rek'];
if(!empty($data['cancel'])){
	$cancel = $data['cancel'];
}else{
	$cancel = 0;
}
$spk = '';

if (!empty($link)) {
	$spk = str_split($link_spk, 7);
	$huruf = $spk[1];
	$angka = str_split($spk[0], 3);
	$spk = "$angka[0]-$angka[1]$angka[2]-$huruf";
}

$kode_id = str_split($id, 8);
$huruf = $kode_id[0];
$angka = $kode_id[1];
$kode_id = "$huruf-$angka";

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Invoice : <?= $kode_id; ?></title>

	<!-- favicon -->
	<?php include_once '../struktur/favicon.php' ?>

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css?versi=<?= $version; ?>" rel="stylesheet">
	<link href="../css/detail.css?versi=<?= $version; ?>" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	<link href="../alert/sweetalert2.css" rel="stylesheet">


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


	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<?php include_once '../struktur/profil.php' // foto profil ?>
		<div class="divider"></div>

		<?php include_once ('../struktur/page.php');  // side page >> ?>
	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
						<em class="fa fa-book"></em>
					</a></li>
				<li class="active">Invoice</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">DETAIL INVOICE</h1>
			</div>
		</div><!--/.row-->


		<div id="edit" class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						KODE : <strong class="color-blue"><?= $kode_id; ?></strong>

					</div>
					<div class="panel-body">
						<div id="container" class="canvas-wrapper">

							<form>
								<!-- HEAD -->
								<div id="head">
									<div class="form-group input">
										<strong style="text-align: right;">Date :</strong>
										<div class="box">
											<h4>
												<strong><?= $date; ?></strong>
											</h4>
										</div>
									</div>
									<?php if (!empty($spk)): ?>
										<div class="form-group input">
											<strong style="text-align: right;">FOR :</strong>
											<div class="box">
												<h4>
													<strong><?= $spk; ?></strong>
												</h4>
											</div>
										</div>
									<?php endif; ?>
								</div>
								<!-- _____________________________________________________________________________ -->

								<!-- Nota INFO -->
								<div id="nota">
									<div class="title_fill">
										<h3>Detail Invoice</h3>
									</div>

									<div id="nota-opsi">
										<div class="form-group input">
											<strong style="text-align: right;">AS :</strong>
											<div class="box">
												<h4>
													<?php if ($save_as == 'QUOTATION'): ?>
														<strong class="color-orange"><?= $save_as; ?></strong>
													<?php else: ?>
														<strong class="color-purple"><?= $save_as; ?></strong>
													<?php endif; ?>
												</h4>
											</div>
										</div>
										<div class="form-group input">
											<strong style="text-align: right;">Status :</strong>
											<div class="box">
												<h4>
													<?php if ($status == 'PAID'): ?>
														<strong class="color-purple"><?= $status; ?></strong>
													<?php else: ?>
														<strong class="color-orange"><?= $status; ?></strong>
													<?php endif; ?>
												</h4>
											</div>
										</div>
									</div>
									<hr>
									<!-- ////////////////// -->
									<!-- <div class="row"> -->
									<div class="col-12 of-x-auto">
										<table class="table table-striped">
											<thead>
												<tr class="title_fill color-white">
													<th scope="col">Qty</th>
													<th scope="col">Kode</th>
													<th scope="col">Description</th>
													<th style="text-align: right;" scope="col">Buy</th>
													<th style="text-align: right;" scope="col">Mg %</th>
													<th style="text-align: right;" scope="col">Sell</th>
												</tr>
											</thead>
											<tbody>

												<?php for ($i = 0; $i < count($qtss); $i++): ?>
													<tr>
														<td><?= $qtss[$i]; ?></td>
														<td><?= $kodes[$i]; ?></td>
														<td><?= $descs[$i]; ?></td>
														<td style="text-align: right;"><?= $buys[$i]; ?></td>
														</td>
														<td style="text-align: right;"><?= $margins[$i]; ?></td>
														</td>
														<td style="text-align: right;"><?= $sells[$i]; ?></td>
														</td>
													</tr>
												<?php endfor; ?>

											</tbody>
										</table>
									</div>
									<!-- </div> -->

									<!-- ////////////////////////// -->
									<hr class="divider">
									</hr>
									<div id="total-group">
										<div class="box-total" style="min-width: 250px;">
											<div class="form-group input color-blue">
												<div class="box" onclick="profitShow('<?= $profit; ?>')">
													<label>Profit</label>
													<div style="text-align: right;width:100%">
														<strong class="profitShow">*****</strong>
													</div>
												</div>
											</div>
											<div class="form-group input">
												<div class="box">
													<strong style="width: fit-content; text-wrap:nowrap;">Sub Total</strong>
													<div style="text-align: right;width:100%">
														<strong><?= $subtotal; ?></strong>
													</div>
												</div>
											</div>
											<div class="form-group input">
												<div class="box">
													<label>DPP</label>
													<div style="text-align: right;width:100%">
														<strong><?= $dpp; ?></strong>
													</div>
												</div>
											</div>
											<div class="form-group input">
												<div class="box">
													<strong style="width: fit-content; text-wrap:nowrap;">PPN 11%</strong>
													<div style="text-align: right;width:100%">
														<strong><?= $ppn; ?></strong>
													</div>
												</div>
											</div>
											<div class="form-group input color-orange">
												<div class="box">
													<strong style="width: fit-content; text-wrap:nowrap;">Deposit</strong>
													<div style="text-align: right;width:100%">
														<strong><?= $deposit; ?></strong>
													</div>
												</div>
											</div>
											<div class="form-group input color-red">
												<div class="box">
													<strong style="font-size:18px; width: fit-content; text-wrap:nowrap;">CANCEL</strong>
													<div style="font-size:18px; text-align: right;width:100%">
														<strong><?= $cancel; ?></strong>
													</div>
												</div>
											</div>
											<div class="form-group input color-purple">
												<div class="box">
													<strong style="font-size:20px; width: fit-content; text-wrap:nowrap;">TOTAL</strong>
													<div style="font-size:20px; text-align: right;width:100%">
														<strong><?= $total; ?></strong>
													</div>
												</div>
											</div>
											<div class="form-group input">
												<div class="box" style="justify-content: space-between;flex-wrap:wrap;">
													<?php if ($data['save_as'] == 'quotation'): ?>
														<button onclick="editINV('<?= $id; ?>')" type="button" class="btn btn-warning mt-1">Update</button>
													<?php else: ?>
														<?php if ($data['status'] != 'paid'): ?>
															<button onclick="setPaid('<?= $id; ?>')" type="button" class="btn btn-success mt-1">Set Paid</button>
														<?php endif; ?>
														<button onclick="quo('<?= $id; ?>')" type="button" class="btn btn-warning mt-1"><i class="fa fa-folder-open" aria-hidden="true"></i> Quo</button>
													<?php endif; ?>
													<a href="../print?invoice-for=true&id=<?= $id; ?>" class="btn btn-info mt-1"><i class="fa fa-print" aria-hidden="true"></i> Print Preview</a>
												</div>
											</div>
											<?php if ($data['save_as'] == 'quotation'): ?>
												<div class="form-group input">
													<div class="box" style="justify-content: space-between;">
														<button onclick="setInvoice('<?= $id; ?>')" type="button" class="btn btn-success">Set AS Invoice</button>
														<button type="button" class="btn btn-danger">Cancel</button>
													</div>
												</div>
											<?php endif; ?>
											<?php if ($_SESSION['akses'] == 'master'): ?>
												<button onclick="editINV('<?= $id; ?>')" type="button" class="btn btn-primary">Edit</button>
												<button onclick="deleteINV('<?= $id; ?>')" type="button" class="btn btn-danger">Delete</button>
											<?php endif; ?>
											<div class="form-group input">
												<div style="margin-bottom: 20px;">
													<label for="note">Note :</label>
													<textarea class="form-control" name="note" id="note" cols="3" rows="3" placeholder="---" disabled>
														<?= $note; ?>
													</textarea>
												</div>
											</div>
											<div class="form-group input">
												<label for="note">Rekening :</label>
												<input id="rekening" type="text" class="form-control desc" style="max-width: 250px; margin:0;" value="<?= $rekening; ?>" disabled>
											</div>
										</div>

									</div>

								</div>
						</div>
						<!-- _____________________________________________________________________________ -->


						<!-- ACTION BUTTON -->
						<!-- <div id="action" >
						<div class="title_fill">
							<h3>Action Button</h3>
						</div>
						
							<div style="text-align: center;" class="action">
								<button type="submit" name="submit" class="btn btn-primary"> Input </button>
								
							</div>
						
					</div>					 -->

						<!-- _____________________________________________________________________________ -->

						</form>

					</div>
				</div>
			</div>
		</div>
	</div><!--/.row-->





	<script src="../js/jquery-1.11.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/bootstrap-datepicker.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="../alert/sweetalert2.all.js"></script>
	<script src="../js/nota.js?versi=<?= $version; ?>"></script>
	<script src="../js/ajax.js?versi=<?= $version; ?>"></script>
	<script src="../alert/confirm.js?versi=<?= $version; ?>"></script>
	<script src="../js/user.js?versi=<?= $version; ?>"></script>
	<script src="../js/cPass.js?versi=<?= $version; ?>"></script>

</body>

</html>