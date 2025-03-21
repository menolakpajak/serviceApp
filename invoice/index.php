<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
$page = ['invoice', '../'];

require '../koneksi.php';

if (empty($_GET['kode'])) {
	include_once '../error/index.php';
	exit();
}

$id = $_GET['kode'];

$id = decrypt($_GET['kode']);
$data = data("SELECT * FROM invoice WHERE kode = '$id'");
if (empty($data)) {
	include_once '../struktur/ajax-invoice-404.php';
}
$data = $data[0];

include_once 'invoice.php';