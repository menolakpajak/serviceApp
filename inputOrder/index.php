<?php 
ob_start();
session_start();
$page = ['input-order','../'];


if(empty($_SESSION['login'])){
    header('Location: ../login');
}

require '../config.php';

$kode = $_SESSION['kode'];
login($kode,$_SESSION['token'],['master','admin','cs']);
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];
$akses = $_SESSION['akses'];

$data = data("SELECT * FROM data ORDER BY no_spk DESC");

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Input New Order</title>
	
	<!-- favicon -->
	<?php include_once '../struktur/favicon.php' ?>

	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/font-awesome.min.css" rel="stylesheet">
	<link href="../css/datepicker3.css" rel="stylesheet">
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
				<li class="active">Input Order</li>
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
						DATA SERVICE
						
						</div>
					<div  class="panel-body">
						<div id="container" class="canvas-wrapper">
						
							<form onsubmit="confirmInput(event)">
													<!-- HEAD -->
								<div id="head">
									<div class="form-group input">
										<label for="date">Date</label>
										<div class="box">
											<input type="datetime-local" class="form-control" id="date" name="date" >
										</div>
									</div>
									<div class="form-group input">
										<label style="text-align: right;" for="no_spk">No Spk</label>
										<div class="box">
											<input type="text" class="form-control" id="no_spk" name="no_spk" readonly value="Auto Generate">
										</div>
									</div>
								</div>
						<!-- _____________________________________________________________________________ -->

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
												<input type="text" class="form-control" id="nama" name="nama" maxlength="100" autocomplete="off" required>
											</div>
										</div>
										<div class="form-group input">
											<label for="wa">WA no :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-whatsapp" aria-hidden="true"></i>
												<input type="number" class="form-control" id="wa" name="wa" maxlength="50" autocomplete="off" required>
											</div>
										</div>
										<div class="form-group input">
											<label for="no_tlp">No Tlp :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-phone" aria-hidden="true"></i>
												<input type="number" class="form-control" id="no_tlp" name="no_tlp" maxlength="50" autocomplete="off" placeholder="Optional">
											</div>
										</div>
										<div class="form-group input">
											<label for="alamat">Alamat :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-location-arrow" aria-hidden="true"></i>
												<input type="text" class="form-control" id="alamat" name="alamat" autocomplete="off" required>
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
									<label for="tipe_unit">Tipe Unit :</label>
										<div class="box">
												<i style="font-size: x-large;" class="fa fa-camera" aria-hidden="true"></i>
										<select id="tipe_unit" class="custom-select" name="tipe_unit" autocomplete="off" required>
											<option disabled selected value="">Pilih Salah satu..</option>
											<option value="canon">Canon</option>
											<option value="nikon">Nikon</option>
											<option value="fujifilm">Fujifilm</option>
											<option value="sony">Sony</option>
											<option value="gopro">Go Pro</option>
											<option value="godox">godox</option>
											<option value="dji">DJI</option>
											<option value="other">Other..</option>
										</select>
									</div>
								</div>
								<div class="form-group input">
									<label for="unit">Unit :</label>
									<div class="box">
										<i style="font-size: x-large;" class="fa fa-camera-retro" aria-hidden="true"></i>
										<input type="text" class="form-control" id="unit" name="unit" maxlength="200" autocomplete="off" required>
									</div>
								</div>
								<div class="form-group input">
									<label for="serial_number">Serial Number :</label>
									<div class="box">
										<i style="font-size: x-large;" class="fa fa-barcode" aria-hidden="true"></i>
										<input type="text" class="form-control" id="serial_number" name="serial_number" maxlength="255" autocomplete="off" required>
									</div>
								</div>	
							</div>									
					</div>
					<!-- _____________________________________________________________________________ -->

											<!-- INPUT INFO -->
				
				<div id="input_info" >
						<div class="title_fill">
							<h3>Input Info</h3>
						</div>
						
						<div id="head3" class="form-group">

							<div class="form-group">
								<label for="counter">Counter :</label>
									<div class="box">
											<i style="font-size: x-large;" class="fa fa-building" aria-hidden="true"></i>
									<select id="counter" class="custom-select" name="counter" required>
										<option readonly selected value="<?= $_SESSION['counter']; ?>"><?=  ucfirst($_SESSION['counter']); ?></option>
									</select>
								</div>
							</div>
							<div class="form-group input">
									<label for="penerima">Penerima :</label>
									<div class="box">
										<i style="font-size: x-large;" class="fa fa-user" aria-hidden="true"></i>
										<input type="text" class="form-control" id="penerima" name="penerima" maxlength="20" readonly required value="<?= $_SESSION['nama'] ; ?>">
									</div>
							</div>
							<div class="form-group">
								<label for="pin" class="text-danger">Pin :</label>
									<div class="box">
											<i style="font-size: x-large;" class="fa fa-thumb-tack" aria-hidden="true"></i>
									<select id="pin" class="custom-select" name="pin">
										<option disabled selected value="">Jika Urgent..</option>
										<option value="">OFF</option>
										<option value="on">ON</option>
									</select>
								</div>
							</div>
	
						</div>
						<div class="note">
							<textarea style="height: 100px;" class="form-control" name="note" id="note" cols="5" rows="10" autocomplete="off" placeholder="Keterangan PIN"></textarea>
						</div>
					</div>					


					<!-- _____________________________________________________________________________ -->


											<!-- KELENGKAPAN -->

					<div id="kelengkapan" >
						<div class="title_fill">
							<h3>Kelengkapan</h3>
						</div>
						
						<div id="head4" class="form-group input">

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_kamera" name="check_kamera">
									<label class="custom-control-label" for="check_kamera">Kamera</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_kamera_info" name="check_kamera_info" autocomplete="off" placeholder="Keterangan tambahan" maxlength="150">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_lensa" name="check_lensa">
									<label class="custom-control-label" for="check_lensa">Lensa</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_lensa_info" name="check_lensa_info" autocomplete="off" placeholder="Keterangan tambahan" maxlength="150">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_battery" name="check_battery">
									<label class="custom-control-label" for="check_battery">Battery</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_battery_info" name="check_battery_info" autocomplete="off" placeholder="Keterangan tambahan" maxlength="150">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_memory" name="check_memory">
									<label class="custom-control-label" for="check_memory">Memory</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_memory_info" name="check_memory_info" autocomplete="off" placeholder="Keterangan tambahan" maxlength="150">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_strap" name="check_strap">
									<label class="custom-control-label" for="check_strap">Strap</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_strap_info" name="check_strap_info" autocomplete="off" placeholder="Keterangan tambahan" maxlength="150">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_bodycap" name="check_bodycap">
									<label class="custom-control-label" for="check_bodycap">Body cap</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_bodycap_info" name="check_bodycap_info" autocomplete="off" placeholder="Keterangan tambahan" maxlength="150">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_lenscap" name="check_lenscap">
									<label class="custom-control-label" for="check_lenscap">Lens cap</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_lenscap_info" name="check_lenscap_info" autocomplete="off" placeholder="Keterangan tambahan" maxlength="150">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_filter" name="check_filter">
									<label class="custom-control-label" for="check_filter">Filter</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_filter_info" name="check_filter_info" autocomplete="off" placeholder="Keterangan tambahan" maxlength="150">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>


						</div>	
						<div class="other">
								<textarea class="form-control" name="other" id="other" cols="20" rows="10" placeholder="Kelengkapan Lainnya.." autocomplete="off"></textarea>
						</div>
						
					</div>

					<!-- _____________________________________________________________________________ -->

											<!-- INFO KERUSAKAN -->
					<div id="kerusakan" >
						<div class="title_fill">
							<h3>Info Kerusakan</h3>
						</div>
						
						
							<div class="kerusakan">
									<textarea class="form-control" name="error" id="error" cols="20" rows="10" placeholder="Info Kerusakan..." required autocomplete="off"></textarea>
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