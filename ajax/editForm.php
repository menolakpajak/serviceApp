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

if($akses == 'master' || $akses == 'admin' || $akses == 'cs'){
	$userName = $_SESSION['nama'];
}else{ include_once '../struktur/ajax-403.php';}


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
$penerima = $data['penerima'];

// <<<...LOGIC FOR CHECKBOX....>>

$kamera = '';
$lensa = '';
$battery = '';
$memory = '';
$strap = '';
$bodyCap = '';
$lensCap = '';
$filter = '';

$kamera_info = $data2['check_kamera_info'];
$lensa_info = $data2['check_lensa_info'];
$battery_info = $data2['check_battery_info'];
$memory_info = $data2['check_memory_info'];
$strap_info = $data2['check_strap_info'];
$bodyCap_info = $data2['check_bodycap_info'];
$lensCap_info = $data2['check_lenscap_info'];
$filter_info = $data2['check_filter_info'];
$other = $data2['other'];

if($data2['check_kamera'] == 'on'){$kamera = "checked";}
if($data2['check_lensa'] == 'on'){$lensa = "checked";}
if($data2['check_battery'] == 'on'){$battery = "checked";}
if($data2['check_memory'] == 'on'){$memory = "checked";}
if($data2['check_strap'] == 'on'){$strap = "checked";}
if($data2['check_bodycap'] == 'on'){$bodyCap = "checked";}
if($data2['check_lenscap'] == 'on'){$lensCap = "checked";}
if($data2['check_filter'] == 'on'){$filter = "checked";}

if(empty($data2['check_kamera_info'])){$kamera_info = "";}
if(empty($data2['check_lensa_info'])){$lensa_info = "";}
if(empty($data2['check_battery_info'])){$battery_info = "";}
if(empty($data2['check_memory_info'])){$memory_info = "";}
if(empty($data2['check_strap_info'])){$strap_info = "";}
if(empty($data2['check_bodycap_info'])){$bodyCap_info = "";}
if(empty($data2['check_lenscap_info'])){$lensCap_info = "";}
if(empty($data2['check_filter_info'])){$filter_info = "";}


?>

<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						DATA SERVICE
						
						</div>
					<div  class="panel-body">
						<div id="container" class="canvas-wrapper">
						
							<form onsubmit="confirmEditNew(event)">
													<!-- HEAD -->
<input id="no_spk" type="hidden" name="id" value="<?= $id ; ?>">
								<div id="head">
									<div class="form-group input">
										<label for="date">Date</label>
										<div class="box">
											<input type="datetime-local" class="form-control" id="date" name="date" value="<?= date('Y-m-d\TH:i:s',strtotime($data['date'])) ; ?>">

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
												<input type="text" class="form-control" id="nama" name="nama" maxlength="100" required value="<?= $data['nama'] ; ?>">
											</div>
										</div>
										<div class="form-group input">
											<label for="wa">WA no :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-whatsapp" aria-hidden="true"></i>
												<input type="number" class="form-control" id="wa" name="wa" maxlength="50" required value="<?= $data['wa'] ; ?>">
											</div>
										</div>
										<div class="form-group input">
											<label for="no_tlp">No Tlp :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-phone" aria-hidden="true"></i>
												<input type="number" class="form-control" id="no_tlp" name="no_tlp" maxlength="50" value="<?= $data['no_tlp'] ; ?>">
											</div>
										</div>
										<div class="form-group input">
											<label for="alamat">Alamat :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-location-arrow" aria-hidden="true"></i>
												<input type="text" class="form-control" id="alamat" name="alamat" required value="<?= $data['alamat'] ; ?>">
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
									<label >Tipe Unit :</label>
										<div class="box">
												<i style="font-size: x-large;" class="fa fa-camera" aria-hidden="true"></i>
										<select id="tipe_unit" class="custom-select" name="tipe_unit" required>
											<option selected value="<?= $data['tipe'] ; ?>">Default : <?= ucfirst($data['tipe']) ; ?></option>
											<option value="canon">Canon</option>
											<option value="nikon">Nikon</option>
											<option value="fujifilm">Fujifilm</option>
											<option value="sony">Sony</option>
											<option value="gopro">Go Pro</option>
											<option value="godox">Godox</option>
											<option value="dji">DJI</option>
											<option value="other">Other..</option>
										</select>
									</div>
								</div>
								<div class="form-group input">
											<label for="unit">Unit :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-camera-retro" aria-hidden="true"></i>
												<input type="text" class="form-control" id="unit" name="unit" maxlength="200" required value="<?= $data['unit'] ; ?>">
											</div>
								</div>
								<div class="form-group input">
											<label for="serial_number">Serial Number :</label>
											<div class="box">
												<i style="font-size: x-large;" class="fa fa-barcode" aria-hidden="true"></i>
												<input type="text" class="form-control" id="serial_number" name="serial_number" maxlength="255" value="<?= $data['sn'] ; ?>" required>
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
								<label >Counter :</label>
									<div class="box">
											<i style="font-size: x-large;" class="fa fa-building" aria-hidden="true"></i>
									<select id="counter" class="custom-select" name="counter" required>
										<?php if(in_array($_SESSION['akses'],['master','admin'])) : ?>
										<option value="<?= $data['counter'] ; ?>" selected>Default: <?= ucfirst($data['counter']) ; ?></option>
										<?php include_once("../struktur/select-counter.php"); ?>
										<?php else : ?>
										<option value="<?= $data['counter'] ; ?>" selected readonly><?= ucfirst($data['counter']) ; ?></option>
										<?php endif; ?>
									</select>
								</div>
							</div>
							<div class="form-group input">
									<label for="penerima">Penerima :</label>
									<div class="box">
										<i style="font-size: x-large;" class="fa fa-user" aria-hidden="true"></i>
										<input type="text" class="form-control" id="penerima" name="penerima" maxlength="20" readonly value="<?= ucfirst($data['penerima']) ; ?>">
									</div>
							</div>

							<div class="form-group">
								<label for="pin" class="text-danger">Pin :</label>
								<div class="box">
									<i style="font-size: x-large;" class="fa fa-thumb-tack" aria-hidden="true"></i>
									<select id="pin" class="custom-select" name="pin">
										<?php if($data['pin'] == 'on') :?>
										<option selected value="on">ON</option>
										<option value="">OFF</option>
										<?php endif; ?>
										<?php if($data['pin'] != 'on') :?>
										<option selected value="">OFF</option>
										<option value="on">ON</option>
										<?php endif; ?>
									</select>
								</div>
							</div>
	
						</div>
						<div class="note">
							<textarea style="height: 100px;" class="form-control" name="note" id="note" cols="5" rows="10" placeholder="Keterangan PIN"><?= strip_tags($data['note']) ; ?></textarea>
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
									<input type="checkbox" class="custom-control-input" id="check_kamera" name="check_kamera" <?= $kamera ; ?>>
									<label class="custom-control-label" for="check_kamera">Kamera</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_kamera_info" name="check_kamera_info" maxlength="150" value="<?= $kamera_info ; ?>">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_lensa" name="check_lensa" <?= $lensa ; ?>>
									<label class="custom-control-label" for="check_lensa">Lensa</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_lensa_info" name="check_lensa_info" maxlength="150" value="<?= $lensa_info ; ?>">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_battery" name="check_battery" <?= $battery ; ?>>
									<label class="custom-control-label" for="check_battery">Battery</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_battery_info" name="check_battery_info" maxlength="150" value="<?= $battery_info ; ?>">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_memory" name="check_memory" <?= $memory ; ?>>
									<label class="custom-control-label" for="check_memory">Memory</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_memory_info" name="check_memory_info" maxlength="150" value="<?= $memory_info ; ?>">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_strap" name="check_strap" <?= $strap ; ?>>
									<label class="custom-control-label" for="check_strap">Strap</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_strap_info" name="check_strap_info" maxlength="150" value="<?= $strap_info ; ?>">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_bodycap" name="check_bodycap" <?= $bodyCap ; ?>>
									<label class="custom-control-label" for="check_bodycap">Body cap</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_bodycap_info" name="check_bodycap_info" maxlength="150" value="<?= $bodyCap_info ; ?>">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_lenscap" name="check_lenscap" <?= $lensCap ; ?>>
									<label class="custom-control-label" for="check_lenscap">Lens cap</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_lenscap_info" name="check_lenscap_info" maxlength="150" value="<?= $lensCap_info ; ?>">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>

							<div>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" id="check_filter" name="check_filter" <?= $filter ; ?>>
									<label class="custom-control-label" for="check_filter">Filter</label>
								</div>
								<div class="box">
									<input type="text" class="form-control" id="check_filter_info" name="check_filter_info" maxlength="150" value="<?= $filter_info ; ?>">
									<i style="font-size: x-large;" class="fa fa-sticky-note" aria-hidden="true"></i>
								</div>
							</div>


						</div>	
						<div class="other">
								<textarea class="form-control" name="other" id="other" cols="20" rows="10" placeholder="Kelengkapan Lainnya.."><?= strip_tags($data2['other']) ; ?></textarea>
						</div>
						
					</div>

					<!-- _____________________________________________________________________________ -->

											<!-- INFO KERUSAKAN -->
					<div id="kerusakan" >
						<div class="title_fill">
							<h3>Info Kerusakan</h3>
						</div>
						
						
							<div class="kerusakan">
									<textarea class="form-control" name="error" id="error" cols="20" rows="10" placeholder="Info Kerusakan..." required><?= strip_tags($data['error']) ; ?></textarea>
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
	
