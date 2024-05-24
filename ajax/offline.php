<?php 

session_start();
include '../koneksi.php';

$code = $_SESSION['kode'];
$query = "UPDATE logininfo SET
        status = 'offline' 
        WHERE kodeuser = '$code' ";
        mysqli_query($conn,$query);

?>