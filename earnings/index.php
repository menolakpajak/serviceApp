<?php
ob_start();
session_start();


if (empty($_SESSION['login'])) {
    header('Location: ../login');
}

if (empty($_GET)) {
    include_once('queue.php');
    die;
} else {
    $direct = array_keys($_GET)[0];
}

if (!in_array($direct, ['pending', 'paid'], true)) {
    include_once('queue.php');
    die;
}
if ($direct == 'pending') {
    include_once('pending.php');
    die;
}
if ($direct == 'paid') {
    include_once('paid.php');
    die;
}

; ?>