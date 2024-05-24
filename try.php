<?php 


$qts = 1;
$beli = 123456;
$margin = 11;
$margin_num = round(($qts*$beli)*$margin/100);
$jual_saya = round(($qts*$beli)+$margin_num);
$jual = round(($qts * $beli) / (100 - $margin) * 100);

$perpcs = $jual_saya/$qts;



echo 'jual :'. number_format(round($qts*$beli),0,'.',',');
echo '<br>';
echo 'margin% :'. $margin.' %';
echo '<br>';
echo 'margin = '. number_format($margin_num,0,'.',',');
echo '<br>';
echo 'jual + margin = '.number_format($jual_saya,0,'.',',');
echo '<br>';
echo 'jual per pcs = '.number_format($perpcs,0,'.',',');
echo '<br>';
echo 'total :'. number_format($jual,0,'.',',');
die;

$url = 'http://95.111.198.145/post.php';
$token = 'coba';
$no = 62817870770;
$text = 'https://facebook.com';

$data = [
    'token' => $token,
    'no' => $no,
    'text' => $text
   ];

// use key 'http' even if you send the request to https://...
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
if ($result === FALSE) {
     echo 'ERROR'; 
    }
if($result != 'ok'){
    echo 'FAIL';
    echo '<br>';
    echo($result);
}

if($result == 'ok'){
    echo 'SUKSES';
    echo '<br>';
    echo 'No Wa ; ' .$no;
    echo '<br>';
    echo 'msg : '. $text;
    echo '<br>';
    echo 'MESSEAGE SEND';

}

