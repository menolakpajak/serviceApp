<?php

ob_start();
session_start();
$page = ['print', '../'];

if (empty($_SESSION['login'])) {
	header('Location: ../login');
}

require '../config.php';

$kode = $_SESSION['kode'];
login($kode, $_SESSION['token'], ['master', 'admin', 'audit', 'cs']);
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];
$akses = $_SESSION['akses'];

if (empty($_GET['id'])) {
	include_once '../error/index.php';
	exit();
}

$id = $_GET['id'];

$data = data("SELECT * FROM data WHERE no_spk = '$id'");
if (!empty($data)) {
	include_once 'data.php';
	die;
}


$data = data("SELECT * FROM invoice WHERE kode = '$id'");
if (!empty($data)) {
	$data = $data[0];
	if (!empty($data['link'])) {
		include_once 'invoice-for.php';
		die;
	} else {
		include_once 'invoice.php';
		die;
	}
}

$data = data("SELECT * FROM pickup WHERE no_spk = '$id'");
if (!empty($data)) {
	include_once 'pickup.php';
	die;
}