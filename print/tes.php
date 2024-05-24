<?php 

ob_start();
session_start();
$page = ['print','../'];

if(empty($_SESSION['login'])){
    header('Location: ../');
}

require '../config.php';

$kode = $_SESSION['kode'];
$login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
if($_SESSION['token'] != $login['token']){
	header('Location: ../logout.php');
    die;
}
$akses = $_SESSION['akses'];

if($akses == 'master' || $akses == 'admin'){
	$userName = $_SESSION['nama'];
}else{ header('Location: ../');
	die; }


if(empty($_GET['id'])){
	include_once '../error/index.php';
	exit();
}

$id = $_GET['id'];

$data = data("SELECT * FROM invoice WHERE kode = '$id'");
if(!empty($data)){
	$data = $data[0];
	if(!empty($data['link'])){
		include_once 'invoice-for.php';
		die;
	}else{
		include_once 'invoice.php';
		die;
	}
}

include_once 'data2.php';