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
}else{ include_once '../struktur/ajax-403.php';}


if(empty($_GET['id'])){
	include_once '../struktur/ajax-noKey.php';
}

$id = $_GET['id'];
$data = data("SELECT * FROM service_center WHERE kode = '$id' ");
if(!empty($data)){
	$data = $data[0];
}else{
	include_once '../struktur/ajax-404.php';
}



?>

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
					EDIT SERVICE CENTER
						
						</div>
					<div  class="panel-body">
						<div id="container" class="canvas-wrapper">
						
							<form onsubmit="editServiceCenter(event)">
													<!-- HEAD -->
							<input id="no_spk" type="hidden" name="id" value="<?= $id ; ?>">
								<div id="head">
									<div class="form-group input">
										<label for="date">Date</label>
										<div class="box">
											<input type="datetime-local" class="form-control" id="date" name="date" value="<?= date('Y-m-d\TH:i:s',strtotime($data['date'])) ; ?>" readonly>
										</div>
									</div>
									<div class="form-group input">
										<label style="text-align: right;" for="kode">Kode</label>
										<div class="box">
											<input type="text" class="form-control" id="kode" name="kode" value="<?= $data['kode']; ?>" maxlength="10" readonly>
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
												<input type="text" class="form-control" id="nama" name="nama" maxlength="100" required value="<?= $data['nama']; ?>">
											</div>
										</div>
										<div class="form-group input">
											<label for="up">Up to :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-user" aria-hidden="true"></i>
												<input type="text" class="form-control" id="up" name="up" maxlength="100" placeholder="Optional" value="<?= $data['up_to']; ?>">
											</div>
										</div>
										<div class="form-group input">
											<label for="no_tlp">No Tlp :</label>
											<div class="box">
												<textarea class="form-control" name="no_tlp" id="no_tlp" cols="20" rows="3" required><?= $data['no_tlp']; ?></textarea>
											</div>
										</div>
										<div class="form-group input">
											<label for="alamat">Alamat :</label>
											<div class="box">
												<textarea class="form-control" name="alamat" id="alamat" cols="20" rows="10" required><?= $data['alamat']; ?></textarea>
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
												<input type="text" class="form-control" id="unit" name="unit" maxlength="255" placeholder="Optional" value="<?= $data['unit']; ?>">
									</div>
								</div>
								<div class="form-group input">
											<label for="legal_name">Legal Name :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-address-card-o" aria-hidden="true"></i>
												<input type="text" class="form-control" id="legal_name" name="legal_name" maxlength="200" placeholder="Optional" value="<?= $data['legal_name']; ?>">
											</div>
								</div>
								<div class="form-group input">
											<label for="rek_number">Rek Number :</label>
											<div class="box">
												<textarea class="form-control" name="rek_number" id="rek_number" cols="20" rows="3" placeholder="Optional"><?= $data['rek_number']; ?></textarea>
											</div>
								</div>
								<div class="form-group input">
											<label for="note">Note :</label>
											<div class="box">
												<textarea class="form-control" name="note" id="note" cols="20" rows="10" placeholder="Optional"><?= $data['note']; ?></textarea>
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
								<button type="submit" name="submit" class="btn btn-primary"> Edit </button>
								<a href="?id=<?= $id ; ?>" class="btn btn-warning"> Cancel </a>
							</div>
						
					</div>					

					<!-- _____________________________________________________________________________ -->

							</form>

						</div>
					</div>
				</div>
			</div>
	
