<?php
ob_start();
session_start();

require '../function.php';

if (isset($_POST['submit'])) {
    $result = signature($_POST);
    echo $result;
} else {
    include_once '../struktur/action-noKey.php';
}


?>