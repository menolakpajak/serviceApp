<?php 
ob_start();
session_start();
$page = ['dashboard',''];

if(empty($_SESSION['login'])){
    header('Location: login/');
}

require 'config.php';


$kode = $_SESSION['kode'];
$login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
if($_SESSION['token'] != $login['token']){
    header('Location: logout.php');	
    die;
}
$data = data("SELECT * FROM data ORDER BY no_spk DESC");
$dashboard = data("SELECT * FROM data WHERE status != 'pickup' ORDER BY date DESC");
$akses = $_SESSION['akses'];

if($akses == 'master' || $akses == 'admin'){
	$userName = $_SESSION['user'];
	$kode = $_SESSION['kode'];
}else{ header('Location: logout.php'); }


$year = date('Y');
$month = date('m');
$monthc = [$year.'-01%',$year.'-02%',$year.'-03%',$year.'-04%',$year.'-05%',$year.'-06%',$year.'-07%',$year.'-08%',$year.'-09%',$year.'-10%',$year.'-11%',$year.'-12%'];
if($month > 6 ){
	$month = 'Juli,Agustus,September,Oktober,November,Desember';
	$i = 6; $a = 12;
}else{$month = 'Januari,Februari,Maret,April,Mei,Juni';
		$i = 0;
		$a = 6;
	}


$chart = [];
for($i = $i ; $i < $a; $i++ ){
array_push($chart,count(data("SELECT * FROM data WHERE date LIKE '$monthc[$i]' ")));
}
$chart = implode(',',$chart);

$canon = data("SELECT * FROM data WHERE tipe = 'canon'");
$nikon = data("SELECT * FROM data WHERE tipe = 'nikon'");
$fuji = data("SELECT * FROM data WHERE tipe = 'fujifilm'");
$sony = data("SELECT * FROM data WHERE tipe = 'sony'");
$gopro = data("SELECT * FROM data WHERE tipe = 'gopro'");
$godox = data("SELECT * FROM data WHERE tipe = 'godox'");
$dji = data("SELECT * FROM data WHERE tipe = 'dji'");
$other = data("SELECT * FROM data WHERE tipe = 'other'");

if(!empty($canon)){$per_canon = round(count($canon)/count($all)*100);}else{$per_canon = 0;}
if(!empty($nikon)){$per_nikon = round(count($nikon)/count($all)*100);}else{$per_nikon = 0;}
if(!empty($fuji)){$per_fuji = round(count($fuji)/count($all)*100);}else{$per_fuji = 0;}
if(!empty($sony)){$per_sony = round(count($sony)/count($all)*100);}else{$per_sony = 0;}
if(!empty($gopro)){$per_gopro = round(count($gopro)/count($all)*100);}else{$per_gopro = 0;}
if(!empty($godox)){$per_godox = round(count($godox)/count($all)*100);}else{$per_godox = 0;}
if(!empty($dji)){$per_dji = round(count($dji)/count($all)*100);}else{$per_dji = 0;}
if(!empty($other)){$per_other = round(count($other)/count($all)*100);}else{$per_other = 0;}



?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Service - Dashboard</title>

	<!-- favicon -->
	<?php include_once 'struktur/favicon.php' ?>

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css?versi=<?= $version ; ?>" rel="stylesheet">
	<link href="alert/sweetalert2.css" rel="stylesheet">
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
<?php include_once 'struktur/nav-bar.php';?> 
<!-- nav bar -->
		

	<!-- HIDEN INPUT -->
	<input type="hidden" id="month" value="<?= $month ; ?>">
	<input type="hidden" id="chartval" value="<?= $chart ; ?>">

	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<?php include_once 'struktur/profil.php' // foto profil ?>
		<div class="divider"></div>
		<form action="javacript:void(0)">
			<div class="form-group">
				<input id="keyword" type="text" class="form-control" placeholder="Search">
			</div>
		</form> 
		<?php include_once('struktur/page.php');  // side page >>?>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12" style="display:flex; justify-content:space-between">
				<h1 class="page-header">Dashboard</h1>
				<a style="height:fit-content; margin-top:25px;" class="btn btn-warning" href="inputOrder/">Input Order !</a>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-plus color-blue"></em>	
							<div class="large"><?php if(isset($new)){echo count($new);}else{echo 0;} ?></div>
							<div class="text-muted">New Orders</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-cogs color-orange"></em>
							<div class="large"><?php if(isset($proses)){echo count($proses);}else{echo 0;} ?></div>
							<div class="text-muted">On Process</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-check color-green"></em>
							<div class="large"><?php if(isset($done)){echo count($done);}else{echo 0;} ?></div>
							<div class="text-muted">Done</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-times color-red"></em>
							<div class="large"><?php if(isset($abort)){echo count($abort);}else{echo 0;} ?></div>
							<div class="text-muted">Abort</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						DATA SERVICE
						<ul class="pull-right panel-settings panel-button-tab-right">
							<li class="dropdown"><a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
								<em class="fa fa-sort"></em>
							</a>
								<ul class="dropdown-menu dropdown-menu-right">
									<li>
										<ul class="dropdown-settings">
											<li><a id="select1" class="naik" href="javascript:void(0)">
												<em id="icon1" class="fa fa-sort-alpha-asc"></em><p id="opsi1" style="display: inline;"> Nama </p>
												</a>
											</li>
											<li class="divider"></li>
											<li><a id="select2" class="naik" href="javascript:void(0)">
												<em id="icon2" class="fa fa-sort-numeric-asc"></em><p id="opsi2" style="display: inline;"> Tanggal </p>
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
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
					<div  class="panel-body">
						<div id="container" class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>

							<table class="table table-striped">
							<thead>
									<tr>
									<th scope="col">No</th>
									<th scope="col">Date</th>
									<th scope="col">SPK</th>
									<th scope="col">Nama</th>
									<th scope="col">Status</th>
									</tr>
								</thead>
								<tbody>
										<?php $i = 1; $color = '';?>
        								<?php foreach($dashboard as $datas) : ?>
										<?php 
											if($datas['status'] == 'new'){
												$color = 'color-blue';
												$link = 'detail-new/?id='.$datas['no_spk'];
											}elseif($datas['status'] == 'proses'){
												$color = 'color-orange';
												$link = 'detail-proses/?id='.$datas['no_spk'];
											}elseif($datas['status'] == 'done'){
												$color = 'color-green';
												$link = 'detail-done/?id='.$datas['no_spk'];
											}elseif($datas['status'] == 'abort'){
												$color = 'color-red';
												$link = 'detail-abort/?id='.$datas['no_spk'];
											}else{
												$color = 'color-purple';
												$link = 'detail-pickup/?id='.$datas['no_spk'];}
										?>
									<tr>
									<th scope="row"><?= $i ; ?></th>
									<td><?= date('d-M-Y', strtotime($datas['date'])) ; ?></td>
									<td><a href="<?= $link ; ?>">
									<?php
										$spk = str_split($datas['no_spk'],7);
										$huruf = $spk[1];
										$angka = str_split($spk[0],3);
										$spk = "$angka[0]-$angka[1]$angka[2]-$huruf";
										echo $spk; ?>
									</a></td>
									<td><?= $datas['nama'] ; ?></td>
									<td style="font-weight:bold" class="<?= $color ; ?>"><?= $datas['status'] ; ?></td>
									</tr>
									<?php $i++ ; ?>
									<?php endforeach; ?>
				
								</tbody>
							</table>
							

						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>CANON</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="<?= $per_canon ; ?>" ><span class="percent"><?= $per_canon ; ?>%</span></div>
						<h4 class="color-red text-center strong"><?= number_format(count($canon),0,',','.'); ?></h4>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>NIKON</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="<?= $per_nikon ; ?>" ><span class="percent"><?= $per_nikon ; ?>%</span></div>
						<h4 class="color-orange text-center strong"><?= number_format(count($nikon),0,',','.'); ?></h4>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>FUJIFILM</h4>
						<div class="easypiechart" id="easypiechart-green" data-percent="<?= $per_fuji ; ?>" ><span class="percent"><?= $per_fuji ; ?>%</span></div>
						<h4 class="color-green text-center strong"><?= number_format(count($fuji),0,',','.'); ?></h4>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>SONY</h4>
						<div class="easypiechart" id="easypiechart-black" data-percent="<?= $per_sony ; ?>" ><span class="percent"><?= $per_sony ; ?>%</span></div>
						<h4 class="color-gray text-center strong"><?= number_format(count($sony),0,',','.'); ?></h4>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Go Pro</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="<?= $per_gopro ; ?>" ><span class="percent"><?= $per_gopro ; ?>%</span></div>
						<h4 class="color-darkblue text-center strong"><?= number_format(count($gopro),0,',','.'); ?></h4>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>GODOX</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="<?= $per_godox ; ?>" ><span class="percent"><?= $per_godox ; ?>%</span></div>
						<h4 class="color-teal text-center strong"><?= number_format(count($godox),0,',','.'); ?></h4>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>DJI</h4>
						<div class="easypiechart" id="easypiechart-grey" data-percent="<?= $per_dji ; ?>" ><span class="percent"><?= $per_dji ; ?>%</span></div>
						<h4 class="color-gray strong"><?= number_format(count($dji),0,',','.'); ?></h4>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>OTHER</h4>
						<div class="easypiechart" id="easypiechart-purple" data-percent="<?= $per_other ; ?>" ><span class="percent"><?= $per_other ; ?>%</span></div>
						<h4 class="color-purple text-center strong"><?= number_format(count($other),0,',','.'); ?></h4>
					</div>
				</div>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->

	<div id="bg">
		<div id="date-table" class="zoom">
			<h2>Periode Input</h2>
				<div class="mb-3">
					<input type="datetime-local" class="form-control" id="from" >
				</div>
			<h5>To</h5>
				<div class="mb-3">
					<input type="datetime-local" class="form-control" id="to" >
				</div>
				<div id="button">
					<button id="cancel" type="button" class="btn btn-danger">Cancel</button>
					<button id="ok" type="button" class="btn btn-primary">OK</button>
				</div>
		</div>

	</div>
	

	<script src="js/cari.js?versi=<?= $version ; ?>"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="alert/sweetalert2.all.js"></script>		
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js?versi=<?= $version ; ?>"></script>
	<script src="js/chart-data.js?versi=<?= $version ; ?>"></script>
	<script src="js/easypiechart.js?versi=<?= $version ; ?>"></script>
	<script src="js/easypiechart-data.js?versi=<?= $version ; ?>"></script>
	<!-- <script src="js/bootstrap-datepicker.js"></script> -->
	<script src="js/custom.js?versi=<?= $version ; ?>"></script>
	<script src="js/cPass.js?versi=<?= $version ; ?>"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};

setInterval(userUpdate,5000);
    function userUpdate(){
        
        var ajax = new XMLHttpRequest()
        
        var user = document.getElementById('sub-item-1');
        //cek kesiapan ajax
        ajax.onreadystatechange = function(){
            if( ajax.readyState == 4 && ajax.status == 200){
                user.innerHTML = ajax.responseText ;
				console.log(ajax.responseText)
            }
        }
    
                // jalankan ajaxnya
        ajax.open('GET', 'ajax/user.php' , 'true') ;
        ajax.send() ;
                                
        }
	</script>
		
</body>
</html>