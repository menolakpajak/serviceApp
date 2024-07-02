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

if($akses == 'master'){
	$userName = $_SESSION['nama'];
}else{ include_once '../struktur/ajax-403.php'; }


if(!isset($_POST['versi']) || empty($_POST['versi'])){
	include_once '../struktur/ajax-noKey.php';
}

$versi = $_POST['versi'];
$data = data("SELECT * FROM version where versi = '$versi' ");

if(!empty($data)){
	echo 'Versi yang anda update sama dengan versi yang sebelumnya !';
}

$result = update_version($versi);
echo $result;