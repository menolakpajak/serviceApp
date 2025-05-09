<?php
ob_start();
session_start();
$page = ['user', '../'];

if (empty($_SESSION['login'])) {
	header('Location: ../login');
}

require '../config.php';

$kode = $_SESSION['kode'];
login($kode, $_SESSION['token'], ['master']);
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];
$akses = $_SESSION['akses'];

$data = data("SELECT * FROM logininfo WHERE akses != 'master'");

?>


<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User List</title>

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
		<form action="javascript:void(0)">
			<div class="form-group">
				<input id="keyword-new" type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<?php include_once('../struktur/page.php');  // side page >> ?>
	</div><!--/.sidebar-->

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
						<em class="fa fa-user-plus color-blue"></em>
					</a></li>
				<li class="active">Order-User</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12" style="display:flex; justify-content:space-between">
				<h1 class="page-header color-blue">User list</h1>
				<a style="height:fit-content; margin-top:25px;" class="btn btn-primary" href="javascript:void(0)" onclick="InputNewUser()">New User !</a>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						USER LIST
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
									<em class="fa fa-sort"></em>
								</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a id="select1" class="naik" href="javascript:void(0)">
													<em id="icon1" class="fa fa-sort-alpha-asc"></em>
													<p id="opsi1" style="display: inline;"> Nama </p>
												</a>
											</li>
											<li class="divider"></li>
											<li><a id="select2" class="naik" href="javascript:void(0)">
													<em id="icon2" class="fa fa-sort-numeric-asc"></em>
													<p id="opsi2" style="display: inline;"> Tanggal </p>
												</a></li>
											<li class="divider"></li>
											<li><a id="periode" href="javascript:void(0)">
													<em class="fa fa-calendar"></em> Periode
												</a></li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body">
						<div id="container" class="canvas-wrapper of-x-auto">

							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Nama</th>
										<th scope="col">Username</th>
										<th scope="col">Akses</th>
										<th scope="col">Role</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php $i = 1;
									$color = ''; ?>
									<?php foreach ($data as $datas): ?>
										<tr>
											<th scope="row"><?= $i; ?></th>
											<td><strong class="color-blue">
													<?= ucwords($datas['nama']); ?>
												</strong></td>
											<td><?= ucwords($datas['username']); ?></td>
											<td><?= ucwords($datas['akses']); ?></td>
											<td><?= ucwords($datas['role']); ?></td>
											<td>

												<ul class="panel-settings panel-button-tab-right">
													<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
															<em style="margin:0 12px" class="fa fa-tasks"></em>
														</a>
														<ul class="dropdown-menu dropdown-menu-right">
															<li>
																<ul class="dropdown-settings">
																	<li><a href="javascript:void(0)" onclick="editUser('<?= $datas['id']; ?>','<?= $datas['kodeuser']; ?>','<?= $datas['akses']; ?>','<?= $datas['counter']; ?>','<?= $datas['username']; ?>','<?= $datas['role']; ?>')">
																			<em class="fa fa-pencil-square color-orange"></em>
																			<p class="color-orange" style="display: inline;"> EDIT </p>
																		</a>
																	</li>
																	<li class="divider"></li>
																	<li><a href="javascript:void(0)" onclick="resetUserPwd('<?= $datas['kodeuser']; ?>')">
																			<em class="fa fa-key color-blue"></em>
																			<p class="color-blue" style="display: inline;"> Reset Password </p>
																		</a>
																	</li>
																	<li class="divider"></li>
																	<li><a href="javascript:void(0)" onclick="deleteUser('<?= $datas['kodeuser']; ?>')">
																			<em class="fa fa-trash-o color-red"></em>
																			<p class="color-red" style="display: inline;"> DELETE </p>
																		</a>
																	</li>
																</ul>
															</li>
														</ul>
													</li>
												</ul>

											</td>
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
		<script src="../event/js/event.js"></script>
		<script src="../js/cari.js?versi=<?= $version; ?>"></script>
		<script src="../js/user.js?versi=<?= $version; ?>"></script>
		<script src="../js/cPass.js?versi=<?= $version; ?>"></script>
		<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
		<script src="../alert/sweetalert2.all.js"></script>
		<script src="../alert/confirm.js"></script>

</body>

</html>