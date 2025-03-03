<?php
ob_start();
session_start();


if (empty($_SESSION['login'])) {
    include_once '../struktur/action-logout.php';
}

require '../function.php';

$kode = $_SESSION['kode'];
$login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
if ($_SESSION['token'] != $login['token']) {
    include_once '../struktur/action-logout.php';
}

if (!in_array($_SESSION['akses'], ['master', 'admin'])) {
    include_once '../struktur/action-403.php';
}


if (isset($_POST['submit'])) {
    $ids = explode(",", $_POST["kode"]);
    $result = setPaidSpending($ids);
    echo $result;
} else {
    include_once '../struktur/action-noKey.php';
}



// $id = $ids[0];

// $data = data("SELECT * FROM earnings WHERE id = $id ");
// var_dump($data);