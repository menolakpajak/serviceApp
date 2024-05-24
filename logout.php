<?php 
session_start();
if(empty($_SESSION["login"])){
    header('Location: login/');
    exit;
}
include 'koneksi.php';

$code = $_SESSION['kode'];
$query = "UPDATE logininfo SET
        status = 'offline' 
        WHERE kodeuser = '$code' ";
        mysqli_query($conn,$query);

$_SESSION = [];
session_unset();
session_destroy();
header('Location: login/');

?>