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

$id = $_POST['id'];
// $id = '1';
$query = "SELECT * FROM invoice
            WHERE
            kode = '$id' ";
            
$data = data($query);
if(!empty($data)){
    $data = $data[0]['quotation'];
}else{
    $data = json_encode([]);
}

echo $data;

?>