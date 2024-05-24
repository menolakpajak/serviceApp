<?php 
$page =['installation','../'];
$master_kode = 'kmzwa8awaa';
$pass = '';

if(!empty($_POST['kode'])){
    $kode = $_POST['kode'];
    if($kode === $master_kode){
        $pass = true;
    }else{
        $pass = false;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<!-- favicon -->
	<?php include_once '../struktur/favicon.php' ?>
    <title>Installation Setup</title>
<style>
    .color-green {
        color: green;
    }
    .color-red {
        color: red;
    }
    .color-orange {
        font-weight: 500;
        color: #ffa377;
    }
    .italic {
        font-style: italic;
    }
</style>

</head>
<body style="background-color: #d9d0cf;">
<?php if(!isset($_POST['kode']) || empty($pass)) : ?>
    <form action="" method="post">
        <label for="kode">KODE :</label>
        <input id="kode" type="password" name="kode" autofocus autocomplete="off">
        <button type="submit">OK</button>
    </form>
    <?php if($pass === false){echo 'Kode Salah !';} ?>
<?php die; endif; ?>
    <strong id="version"></strong>
    <h1 style="text-align:center;margin: 30px auto 30px auto;">
    Installation Status
    </h1>
    <div style="max-width:800px;display:flex;flex-direction:column; margin: 30px auto 30px auto;">
        <div style="background-color:aqua; height:30px;position:relative;">
        <strong style="position: absolute; right:12px; height:30px; margin-right:10px;line-height:30px;">_</strong>
        <a href="../" style="color:black; text-decoration:none; position: absolute; right:0; height:30px; margin-right:10px;line-height:30px;">X</a>
        </div>
        <div style="background-color:black;color:white;padding:20px;">
            <?php require_once 'install.php'; // PROSES INSTALSI   ?>
        </div>
    </div>

</body>
</html>

<?php if(isset($version)){
    $versi = $version;
}else{
    $versi = '0.0.0';
} ?>

<script>
    function versi(versi){
        var version = document.querySelector('#version');
        version.innerHTML = `VERSION : ${versi}`;
    }

versi('<?= $versi; ?>');
</script>
