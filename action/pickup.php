<?php 
ob_start();
session_start();


if(empty($_SESSION['login'])){
    include_once '../struktur/action-logout.php';
}

require '../function.php';

$kode = $_SESSION['kode'];
$login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
if($_SESSION['token'] != $login['token']){
    include_once '../struktur/action-logout.php';
}

if(empty($_POST['no_spk'])){
    include_once '../struktur/action-noKey.php';
}

$id = $_POST['no_spk'];

if(isset($_POST['submit'])){
    $result =  pickup($_POST);
        echo $result;
    }else{
        include_once '../struktur/action-noKey.php';
    }

?>
