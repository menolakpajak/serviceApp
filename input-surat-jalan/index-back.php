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
	}else{$add = 3;}



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
					<em class="fa fa-book"></em>
				</a></li>
				<li class="active">Surat Jalan</li>
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
						SURAT JALAN						
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
									<div class="form-group input">
										<label style="text-align: right;" for="kode">Kode</label>
										<div class="box">
											<input type="text" class="form-control" id="kode" name="kode" value="Auto Generate" maxlength="10" readonly>
										</div>
									</div>
									<div class="form-group input color-blue">
										<label for="saveas">Save As :</label>
											<div class="box">
											<select id="saveas" style="width: 100px;" class="custom-select" name="saveas" required>
												<option value="" selected disabled>Pilih satu</option>
												<option value="quotation">Quotation</option>
												<option value="invoice">Final Invoice</option>
											</select>
										</div>
									</div>
								</div>
						<!-- _____________________________________________________________________________ -->

												<!-- Nota INFO -->
						<div id="nota">
								<div class="title_fill">
									<h3>Detail</h3>
								</div>

								<div id="nota-opsi">
									<div class="form-group input">
										<label for="item">Unit :</label>
										<div class="box">
											<input type="text" class="form-control" id="item" name="item" onkeyup="numSeperate(event)" value="<?= $add; ?>">
											<button onclick="add()" type="button" class="btn btn-success">Add</button>
										</div>
									</div>
								
								</div>
								<hr>
<!-- ////////////////// -->
								<div class="col-12 of-x-auto">
									<table class="table table-striped table-nota">
											<thead>
												<tr class="title_fill color-white">
												<th scope="col">spk</th>
												<th scope="col">SN</th>
												<th scope="col">Unit</th>
												<th scope="col">Kelengkapan</th>
												<th scope="col">Kerusakan</th>
												</tr>
											</thead>
											<tbody>
											
											<?php for($i = 0; $i < $add; $i++) :?>
												<tr>
												<td>
													<div class="form-group input">
														<div class="box">
															<input type="text" class="form-control qts" style="max-width: 50px; margin:0;" onkeyup="numSeperate(event)" value="1">
														</div>
													</div>
												</td>
												<td>
													<div class="form-group input">
														<input type="text" class="form-control kode" style="max-width: 120px; margin:0;">
													</div>
												</td>
												<td>
													<div class="form-group input">
														<input type="text" class="form-control desc" style="max-width: 250px; margin:0;" list="opsi">
														<datalist id="opsi">
															<option value="Cleaning Sensor APSC"></option>
															<option value="Cleaning Sensor FF"></option>
															<option value="Cleaning Lensa"></option>
														</datalist>
													</div>
												</td>
												<td>
													<div class="form-group input" style="float: right;">
														<input type="text" class="form-control buy" style="max-width: 150px; margin:0;" onkeyup="numSeperate(event)" value="0">
													</div>
												</td>
												<td>
													<div class="form-group input" style="float: right;">
														<div class="box">
															<input type="text" class="form-control margin" style="max-width: 70px; margin:0;" onkeyup="numSeperate(event)" value="0">
														</div>
													</div>
												</td>
											</tr>
											<?php endfor; ?>
							
											</tbody>
									</table>
								</div>
							<!-- ////////////////////////// -->
<hr class="divider"></hr>
									<div id="total-group">
										<div class="box-total">
											<div class="form-group input color-blue">
												<div class="box">
													<label for="profit">Profit :</label>
													<input type="text" class="form-control color-blue" id="profit" onkeyup="numSeperate(event)" value="0" readonly>
												</div>
											</div>
											<div class="form-group input">
												<div class="box">
													<label for="subtotal">Sub Total :</label>
													<input type="text" class="form-control" id="subtotal" onkeyup="numSeperate(event)" value="0">
												</div>
											</div>
											<div class="form-group input">
												<div class="box">
													<label for="dpp">DPP :</label>
													<input type="text" class="form-control" id="dpp" onkeyup="numSeperate(event)" value="0">
												</div>
											</div>
											<div class="form-group input">
												<div class="box">
													<label for="ppn">PPN 11%:</label>
													<input type="text" class="form-control" id="ppn" onkeyup="numSeperate(event)" value="0">
												</div>
											</div>
											<div class="form-group input color-orange">
												<div class="box">
													<label for="deposit">Deposit :</label>
													<input type="text" class="form-control" id="deposit" onkeyup="numSeperate(event)" value="0">
												</div>
											</div>
											<div class="form-group input color-purple">
												<div class="box">
													<label for="total">TOTAL :</label>
													<input type="text" class="form-control color-purple" id="total" onkeyup="numSeperate(event)" value="0">
												</div>
											</div>
											<div class="form-group input">
												<div class="box" style="justify-content: space-between;">
													<button onclick="calInvoice()" type="button" class="btn btn-primary">Calculate</button>
													<button type="submit" class="btn btn-success">Save</button>
												</div>
											</div>
											<div class="form-group input">
												<div style="margin-bottom: 20px;">
													<label for="note">Note :</label>
													<textarea class="form-control" name="note" id="note" cols="3" rows="3" placeholder="---"></textarea>
												</div>
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
	<!-- <script src="js/custom.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="../alert/sweetalert2.all.js"></script>
	<script src="../js/nota.js?versi=<?= $version ; ?>"></script>
	<script src="../alert/confirm.js?versi=<?= $version ; ?>"></script>
	<script src="../js/user.js?versi=<?= $version ; ?>"></script>
	<script src="../js/cPass.js?versi=<?= $version ; ?>"></script>
	
		
</body>
</html>