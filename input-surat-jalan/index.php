<?php 
ob_start();
session_start();
$page = ['input surat jalan','../'];

if(empty($_SESSION['login'])){
    header('Location: ../login');
}

require '../config.php';

$kode = $_SESSION['kode'];
login($kode,$_SESSION['token'],['master','admin']);
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];
$akses = $_SESSION['akses'];

if(isset($_GET['add'])){
	$add = $_GET['add'];
	}else{$add = 1;}

$data = data("SELECT * FROM data ORDER BY no_spk DESC");
$tujuan = data("SELECT * FROM service_center WHERE id != 1");
$str = "ABCDEFGHIJKLMNOPRSTUVWXYZ1234567890";
$kode_sc = substr(str_shuffle($str), 0, 6);

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Input Surat Jalan</title>
	
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
				<li class="active">Input Surat Jalan</li>
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
					<div class="row">	
						<div class="col-lg-12 page-header" style="padding: 0 3rem 0 3rem;">
							<div style="display: flex; flex-direction:row;">
								<h2>Surat Jalan </h2>
							</div>
							<h4 class="strong color-gray">kjkjkjk</h4>
						</div>
					</div>
					<div  class="panel-body">
						<div id="container" class="canvas-wrapper">
						
							<form onsubmit="inputSuratJalan(event)">
													<!-- HEAD -->
								<div id="head">
									<div class="form-group input">
										<label for="date">Date</label>
										<div class="box">
											<input type="datetime-local" class="form-control" id="date" name="date" >
										</div>
									</div>
									<div class="form-group">
										<label for="tujuan">Tujuan :</label>
										<div class="box">
											<select style="width: 150px;" id="tujuan" class="custom-select" name="tujuan" required>
												<option disabled selected>Pilih salah satu..</option>
											<?php foreach($tujuan as $tuju): ?>
												<option><?= $tuju['nama']; ?></option>
											<?php endforeach; ?>
											</select>
										</div>
									</div>
									<div id="nota-opsi">
										<div class="form-group input">
											<label for="item">Unit :</label>
											<div class="box">
												<input type="text" class="form-control" id="item" name="item" onkeyup="numSeperate(event)" value="<?= $add; ?>">
												<button onclick="addUnit()" type="button" class="btn btn-success">Add</button>
											</div>
										</div>
									</div>
								</div>
						<!-- _____________________________________________________________________________ -->
												<!-- UNIT INFO -->
						<div id="head6">
							<?php for($i=0; $i<$add; $i++) :?>
							<div class="unitinfo">
								<div class="title_fill">
									<h3>Unit Info</h3>
								</div>
										<div class="form-group input">
											<label>No Spk :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-list-alt" aria-hidden="true"></i>
												<input type="text" class="form-control spk" name="spk" maxlength="100" required>
											</div>
										</div>
										<div class="form-group input">
											<label>Serial Number :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-barcode" aria-hidden="true"></i>
												<input type="text" class="form-control sn" name="sn" maxlength="100" placeholder="Optional">
											</div>
										</div>
										<div class="form-group input">
											<label>Unit :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-camera" aria-hidden="true"></i>
												<input type="text" class="form-control unit" name="unit" maxlength="100" placeholder="Optional">
											</div>
										</div>
										<div class="form-group input">
											<label>Kerusakan :</label>
											<div class="box">
												<textarea class="form-control error" id="error" cols="20" rows="3" required></textarea>
											</div>
										</div>
										<div class="form-group input">
											<label>Kelengkapan :</label>
											<div class="box">
												<textarea class="form-control accecories" name="accecories" cols="20" rows="3" required></textarea>
											</div>
										</div>										
							</div>							
							<?php endfor; ?>
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
	<script src="../js/nota.js?versi=<?= $version ; ?>"></script>
	
		
</body>
</html>