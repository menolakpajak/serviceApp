<?php 
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


if(!isset($_POST['submit'])){
        include_once '../struktur/action-noKey.php';
    }
$kode = $_POST['kode'];
$spk = $_POST['spk'];
$query = "SELECT * FROM invoice
            WHERE
            kode = '$kode'";
            
$data = data($query);
if(!empty($data)){
    echo 'ok';
}else{
    $query = "UPDATE data SET 
    invoice = ''
    WHERE no_spk = '$spk' ";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);
    echo $result;
}