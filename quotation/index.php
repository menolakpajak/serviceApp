<?php

$page = ['quotation', '../'];

require '../koneksi.php';

if (empty($_GET['kode']) && empty($_GET['index'])) {
	include_once '../error/index.php';
	exit();
}

$id = $_GET['kode'];
$index = $_GET['index'];

$data = data("SELECT * FROM invoice WHERE kode = '$id'");
if (empty($data)) {
	include_once '../struktur/ajax-invoice-404.php';
}
$data = $data[0];
$quo = json_decode($data['quotation'],true)[$index];
// var_dump($quo);die;

include_once 'quotation.php';