<?php 
ob_start();
session_start();


if(empty($_SESSION['login'])){
	include_once '../struktur/ajax-logout.php';
}

require '../function.php';

$kode = $_SESSION['kode'];
$login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
if($_SESSION['token'] != $login['token']){
	include_once '../struktur/ajax-logout.php';
}
$akses = $_SESSION['akses'];

if($akses == 'master' || $akses == 'admin'){
	$userName = $_SESSION['nama'];
}else{ include_once '../struktur/ajax-403.php'; }


if(empty($_GET['id'])){
	include_once '../struktur/ajax-noKey.php';
}

$id = $_GET['id'];
$data = data("SELECT * FROM data WHERE no_spk = '$id' ");

if(!empty($data)){
	$data = $data[0];
	$json = $data['kelengkapan'];
	$data2 = json_decode($json,true);
}else{
	include_once '../struktur/ajax-404.php';
}
$sc_list = data("SELECT * FROM service_center ORDER BY nama");
$sc_code = $data['service_at'];
$service_at = data("SELECT * FROM service_center WHERE kode = '$sc_code'");
if(!empty($service_at)){
	$service = $service_at[0]['nama'];
}else{
	$service = '';
}

if($_SESSION['role'] != 'teknisi'){
	if(empty($data['date_update'])){
		include_once '../struktur/ajax-update-forbiden.php';
	}	
}
?>

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

					
					<!-- PROSES INFO -->
		<div class="col-md-12" >
		<div class="panel panel-default" style="background-color: white;">
			<form onsubmit="update(event)">
				<input id="id" type="hidden" name="id" value="<?= $id ; ?>">
					<div id="proses_info" style="border:1px solid #ffa500b3;">
						<div style="background-color: #ffa500b3; " class="title_fill">
							<h3>Poses Info</h3>
						</div>
						
						<div id="head5" class="form-group">
							
							<div class="service-center form-group input" >
								<label for="service_at">Service At :</label>
								<div class="box">
									<i style="font-size: x-large;" class="fa fa-map-marker" aria-hidden="true"></i>
									<input id="service_at" class="custom-select" name="service_at" type="text" list="service-list" autocomplete="off" value="<?= $service; ?>" required>
										</input>
										<datalist id="service-list">
											<?php foreach($sc_list as $sc) :?>
											<option value="<?= $sc['nama']; ?>"><?= $sc['unit']; ?></option>
											<?php endforeach; ?>
										</datalist>
								</div>
							</div>

							<div class="form-group input" >
								<label for="date_proses">Date Proses :</label>
									<div class="box">
										<i style="font-size: x-large;" class="fa fa-calendar" aria-hidden="true"></i>
										<input style="width: 225px;" type="datetime-local" class="form-control" id="date_proses" name="date_proses" maxlength="200" value="<?= date('Y-m-d',strtotime($data['date_proses'])).'T'.date('H:m',strtotime($data['date_proses'])) ; ?>" readonly>
									</div>
							</div>
							<?php if(!empty($data['date_update'])): ?>
							<div class="form-group input" >
								<label for="date_update">Date Update :</label>
									<div class="box">
										<i style="font-size: x-large;" class="fa fa-calendar" aria-hidden="true"></i>
										<input style="width: 225px;" type="datetime-local" class="form-control" id="date_update" name="date_update" maxlength="200" value="<?= date('Y-m-d',strtotime($data['date_update'])).'T'.date('H:m',strtotime($data['date_update'])) ; ?>" readonly>
									</div>
							</div>
							<?php endif; ?>
	
						</div>
						<div class="kerusakan" style="margin-bottom: 20px;">
									<label for="pengecekan">Hasil Pengecekan :</label>
									<textarea class="form-control" name="pengecekan" id="pengecekan" cols="20" rows="10" placeholder="---"><?= strip_tags($data['result']) ; ?></textarea>
							</div>
						<div class="kerusakan" style="margin-bottom: 20px;">
								<label for="biaya">Estimasi Biaya :</label>
								<textarea class="form-control" name="biaya" id="biaya" cols="20" rows="10" placeholder="---"><?= strip_tags($data['cost']) ; ?></textarea>
						</div>
<?php if($data['acc'] == 'on'){$acc = 'checked';}else{$acc = '';} ?>
						<div class="check-acc">
							<label class="checkbox">
								<span class="checkbox__input">
									<input type="checkbox" name="acc" id="acc" <?= $acc ; ?>>
									<span class="checkbox__control">
										<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' aria-hidden="true" focusable="false">
										<path fill='none' stroke='currentColor' stroke-width='3' d='M1.73 12.91l6.37 6.37L22.79 4.59' /></svg>
									</span>
								</span>
								<span class="radio__label">ACC / APPROVE</span>
							</label>
						</div>
			</div>
						
					


					<!-- _____________________________________________________________________________ -->

													<!-- ACTION BUTTON -->
					<div id="action" >
						<div class="title_fill">
							<h3>Action Button</h3>
						</div>
						
							<div style="text-align: center;" class="action">
								<button style="margin:10px 0 10px 0" type="submit" name="submit" class="btn btn-primary"> Update </button>
								<button style="margin:10px 0 10px 0" class="btn btn-warning"><a style="color: white;text-decoration:none;" href="?id=<?= $id ; ?>"> Cancel </a></button>
							</div>
						
					</div>					

					<!-- _____________________________________________________________________________ -->

			</form>

		</div>
		</div>




            <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

	<script src="js/bootstrap-datepicker.js"></script>
	<!-- <script src="js/custom.js"></script> -->
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="alert/sweetalert2.all.js"></script>
	<script src="alert/alert.js"></script>	
