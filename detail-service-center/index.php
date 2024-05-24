<?php 
ob_start();
session_start();
$page = ['detail-service-center','../'];


if(empty($_SESSION['login'])){
    header('Location: ../login');
}

require '../config.php';

$kode = $_SESSION['kode'];
login($kode,$_SESSION['token'],['master','admin']);
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];
$akses = $_SESSION['akses'];




if(empty($_GET['id'])){
	header('Location: ../');
	die;
}


$id = removeSpecialChar($_GET['id']);
$data = data("SELECT * FROM service_center WHERE kode = '$id'");
if(empty($data)){
	include_once '../error/index.php';
	exit();
}
$data = $data[0];

$spk = str_split($data['kode'],3);
$spk = implode('-',$spk);



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Detail - Service Center</title>
	
	<!-- favicon -->
	<?php include_once '../struktur/favicon.php' ?>
	
	<link href="../css/bootstrap.min.css?versi=<?= $version ; ?>" rel="stylesheet">
	<link href="../css/font-awesome.min.css?versi=<?= $version ; ?>" rel="stylesheet">
	<link href="../css/datepicker3.css?versi=<?= $version ; ?>" rel="stylesheet">
	<link href="../css/styles.css?versi=<?= $version ; ?>" rel="stylesheet">
	<link href="../css/detail.css?versi=<?= $version ; ?>" rel="stylesheet">
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

<div id="popup">
			<div id="pop">
					<h3 id="catat"></h3>
			</div>

		</div>

<!-- nav bar -->
<?php include_once '../struktur/nav-bar.php';?> 
<!-- nav bar -->

	<!-- HIDEN INPUT -->
	<input type="hidden" id="id" value="<?= $id ; ?>">

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
	<?php include_once '../struktur/profil.php' // foto profil ?>
		<div class="divider"></div>
		 
		<?php include_once('../struktur/page.php');  // side page >>?>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-sticky-note"></em>
				</a></li>
				<li class="active">Detail Service Center</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">	
			<div class="col-lg-12" >
				<div style="display: flex; flex-direction:row;">
					<h1 style="font-weight: 500;" class="page-header color-gray"><?= 'Service Center' ; ?> </h1>
				</div>
				<h3 class="page-header strong color-gray"><?= $spk ; ?></h3>
			</div>
		</div><!--/.row-->
		
		
		<div id="edit" class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div style="font-weight: bold;" class="panel-heading">
						<?= date('d-M-Y', strtotime($data['date'])) ; ?>
						
						</div>
					<div  class="panel-body">
						<div id="container" class="canvas-wrapper">
						
							<form>
								
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
												<input type="text" class="form-control" id="nama" name="nama" maxlength="100" readonly value="<?= $data['nama']; ?>">
											</div>
										</div>
										<div class="form-group input">
											<label for="up">Up to :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-user" aria-hidden="true"></i>
												<input type="text" class="form-control" id="up" name="up" maxlength="100" placeholder="Optional" readonly value="<?= $data['up_to']; ?>">
											</div>
										</div>
										<div class="form-group input">
											<label for="no_tlp">No Tlp :</label>
											<div class="box">
												<textarea class="form-control" name="no_tlp" id="no_tlp" cols="20" rows="3" readonly><?= $data['no_tlp']; ?></textarea>
											</div>
										</div>
										<div class="form-group input">
											<label for="alamat">Alamat :</label>
											<div class="box">
												<textarea class="form-control" name="alamat" id="alamat" cols="20" rows="10" readonly><?= $data['alamat']; ?></textarea>
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
												<input type="text" class="form-control" id="unit" name="unit" maxlength="255" readonly value="<?= $data['unit']; ?>">
									</div>
								</div>
								<div class="form-group input">
											<label for="legal_name">Legal Name :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-address-card-o" aria-hidden="true"></i>
												<input type="text" class="form-control" id="legal_name" name="legal_name" maxlength="200" readonly value="<?= $data['legal_name']; ?>">
											</div>
								</div>
								<div class="form-group input">
											<label for="rek_number">Rek Number :</label>
											<div class="box">
												<textarea class="form-control" name="rek_number" id="rek_number" cols="20" rows="3" readonly><?= $data['rek_number']; ?></textarea>
											</div>
								</div>
								<div class="form-group input">
											<label for="note">Note :</label>
											<div class="box">
												<textarea class="form-control" name="note" id="note" cols="20" rows="10" readonly><?= $data['note']; ?></textarea>
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
						
							<div class="action">
								<a href="javascript:void(0)" onclick="editSC()" class="btn btn-primary"> Edit </a>
								<a href="javascript:void(0)" class="btn btn-danger" onclick="deleteServiceCenter('<?= $id ; ?>')"> Delete </a>
								<a href="../print/?id=<?= $id ; ?>" class="btn btn-dark" target="_blank">Print Preview</a>
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
	<script src="../js/ajax.js?versi=<?= $version ; ?>"></script>
	<script src="../js/popup.js?versi=<?= $version ; ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="../alert/sweetalert2.all.js"></script>
	<script src="../alert/confirm.js?versi=<?= $version ; ?>"></script>
	<script src="../js/user.js?versi=<?= $version ; ?>"></script>
	<script src="../js/custom.js?versi=<?= $version ; ?>"></script>
	<script src="../js/cPass.js?versi=<?= $version ; ?>"></script>
	
</body>
</html>