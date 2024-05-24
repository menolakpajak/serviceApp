<?php 
ob_start();
session_start();
$page = ['input service center','../'];

if(empty($_SESSION['login'])){
    header('Location: ../login');
}

require '../config.php';

$kode = $_SESSION['kode'];
login($kode,$_SESSION['token'],['master','admin']);
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];
$akses = $_SESSION['akses'];

$data = data("SELECT * FROM data ORDER BY no_spk DESC");
					
$str = "ABCDEFGHIJKLMNOPRSTUVWXYZ1234567890";
$kode_sc = substr(str_shuffle($str), 0, 6);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Input Service Center</title>
	
	<!-- favicon -->
	<?php include_once '../struktur/favicon.php' ?>

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
	<link href="../css/styles.css?versi=<?= $version ; ?>" rel="stylesheet">
	<link href="../css/detail.css?versi=<?= $version ; ?>" rel="stylesheet">
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
<?php include_once '../struktur/nav-bar.php';?> 
<!-- nav bar -->


	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<?php include_once '../struktur/profil.php' // foto profil ?>
		<div class="divider"></div>
		 
		<?php include_once('../struktur/page.php');  // side page >>?>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-address-book"></em>
				</a></li>
				<li class="active">Input Service Center</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">FORM INPUT</h1>
			</div>
		</div><!--/.row-->
		
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						DATA SERVICE CENTER
						
						</div>
					<div  class="panel-body">
						<div id="container" class="canvas-wrapper">
						
							<form onsubmit="inputServiceCenter(event)">
													<!-- HEAD -->
								<div id="head">
									<div class="form-group input">
										<label for="date">Date</label>
										<div class="box">
											<input type="datetime-local" class="form-control" id="date" name="date" >
										</div>
									</div>
									<div class="form-group input">
										<label style="text-align: right;" for="kode">Kode</label>
										<div class="box">
											<input type="text" class="form-control" id="kode" name="kode" value="<?= $kode_sc; ?>" maxlength="10">
										</div>
									</div>
								</div>
						<!-- _____________________________________________________________________________ -->

												<!-- PERSONAL INFO -->
						<div id="head2">
								<div id="personal_info">
								<div class="title_fill">
									<h3>Office Info</h3>
								</div>
										<div class="form-group input">
											<label for="nama">Nama :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-building" aria-hidden="true"></i>
												<input type="text" class="form-control" id="nama" name="nama" maxlength="100" required>
											</div>
										</div>
										<div class="form-group input">
											<label for="up">Up to :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-user" aria-hidden="true"></i>
												<input type="text" class="form-control" id="up" name="up" maxlength="100" placeholder="Optional">
											</div>
										</div>
										<div class="form-group input">
											<label for="no_tlp">No Tlp :</label>
											<div class="box">
												<textarea class="form-control" name="no_tlp" id="no_tlp" cols="20" rows="3" required></textarea>
											</div>
										</div>
										<div class="form-group input">
											<label for="alamat">Alamat :</label>
											<div class="box">
												<textarea class="form-control" name="alamat" id="alamat" cols="20" rows="10" required></textarea>
											</div>
										</div>										
								</div>

					<!-- _____________________________________________________________________________ -->
					
					
														<!-- Detail INFO -->
					
								<div id="unit_info">
									<div class="title_fill">
										<h3>Detail Info</h3>
									</div>
									<div class="form-group input">
									<label for="unit">Brand Coverage :</label>
										<div class="box">
												<i style="font-size: x-large;" class="fa fa-camera" aria-hidden="true"></i>
												<input type="text" class="form-control" id="unit" name="unit" maxlength="255" placeholder="Optional">
									</div>
								</div>
								<div class="form-group input">
											<label for="legal_name">Legal Name :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-address-card-o" aria-hidden="true"></i>
												<input type="text" class="form-control" id="legal_name" name="legal_name" maxlength="200" placeholder="Optional">
											</div>
								</div>
								<div class="form-group input">
											<label for="rek_number">Rek Number :</label>
											<div class="box">
												<textarea class="form-control" name="rek_number" id="rek_number" cols="20" rows="3" placeholder="Optional"></textarea>
											</div>
								</div>
								<div class="form-group input">
											<label for="note">Note :</label>
											<div class="box">
												<textarea class="form-control" name="note" id="note" cols="20" rows="10" placeholder="Optional"></textarea>
											</div>
										</div>	
							</div>									
					</div>
					<!-- _____________________________________________________________________________ -->


													<!-- ACTION BUTTON -->
					<div id="action" >
						<div class="title_fill">
							<h3>Action Button</h3>
						</div>
						
							<div style="text-align: center;" class="action">
								<button type="submit" name="submit" class="btn btn-primary"> Input </button>
								
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
	<script src="../js/bootstrap-datepicker.js"></script>
	<!-- <script src="js/custom.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="../alert/sweetalert2.all.js"></script>
	<script src="../alert/confirm.js?versi=<?= $version ; ?>"></script>
	<script src="../js/user.js?versi=<?= $version ; ?>"></script>
	<script src="../js/cPass.js?versi=<?= $version ; ?>"></script>
	
		
</body>
</html>