<?php 

$page = ['invoice','../'];

require '../koneksi.php';

if(empty($_GET['kode'])){
	include_once '../error/index.php';
	exit();
}

$id = $_GET['kode'];

$id = decrypt($_GET['kode']);

$data = data("SELECT * FROM invoice WHERE kode = '$id'");
if(empty($data)){
	include_once '../error/index.php';
	exit();
}
$data = $data[0];

include_once 'invoice.php';