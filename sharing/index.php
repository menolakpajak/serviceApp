<?php

use PSpell\Config;

ob_start();
session_start();


if (empty($_SESSION['login'])) {
    header('Location: ../login');
}

require '../config.php';
login($_SESSION['kode'], $_SESSION['token'], ['master']);

if (empty($_GET)) {
    header('Location : ../admin');
    die;
} else {
    $user = array_keys($_GET)[0];
}

if (array_key_exists('paid', $_GET)) {
    include_once 'paid.php';
    die;
}

include_once 'sharing.php';
die;


; ?>