<?php
session_start();

if(empty($_SESSION['login'])){
    include_once '../struktur/ajax-logout.php';
}

if(!isset($_POST['submit'])){
  include_once '../struktur/action-noKey.php';
}

if(!isset($_POST['no'])){
  include_once '../struktur/action-noKey.php';
}
if(!isset($_POST['msg'])){
  include_once '../struktur/action-noKey.php';
}

if(!isset($_POST['kind'])){
  include_once '../struktur/action-noKey.php';
}

$no = $_POST['no'];
$kind = strtoupper($_POST['kind']);
$link = $_POST['msg'];
$msg = 'This is link for '.
$kind  . ' : 
'.
$link;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.fonnte.com/send',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array(
'target' => $no,
'message' => $msg
),
  CURLOPT_HTTPHEADER => array(
    'Authorization: i23dG-VkoqNjoH6Yn8wi' //change TOKEN to your actual token
  ),
));

$response = curl_exec($curl);
if (curl_errno($curl)) {
  $error_msg = curl_error($curl);
}
curl_close($curl);

if (isset($error_msg)) {
 echo $error_msg;
}
echo $response;