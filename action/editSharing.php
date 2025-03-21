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
    $result = editSharing($_POST);
    echo $result;
} else {
    include_once '../struktur/action-noKey.php';
}


?>