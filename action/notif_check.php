<?php 
ob_start();
session_start();

require '../function.php';

if(empty($_SESSION['login'])){
    include_once '../struktur/action-logout.php';
}


$kode = $_SESSION['kode'];
$login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
if($_SESSION['token'] != $login['token']){
    include_once '../struktur/action-logout.php';
}

if(empty($_GET['nospk'])){
    include_once '../struktur/action-noKey.php';
}
$id = removeSpecialChar($_GET['nospk']);

if($_SESSION['akses'] != 'master'){
    if($_SESSION['akses'] != 'admin'){
        include_once '../struktur/action-403.php';
    }
    
}

$data = data("SELECT * FROM notif_msg WHERE no_spk = '$id'");

if(empty($data)){
    include_once '../struktur/action-404.php';
}

    klik_notif($id);
    header('Location: ../detail-new/?id='.$id);
