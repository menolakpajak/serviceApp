<?php 
ob_start();
session_start();


if(empty($_SESSION['login'])){
    header('Location: ../');
}

require '../function.php';

$kode = $_SESSION['kode'];
$login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
if($_SESSION['token'] != $login['token']){
    header('Location: ../logout.php');
    die;
}

if(!empty($_GET['id'])){
    $id = $_GET['id'];
}else{
    header('Location: ../');

}
if($_SESSION['akses'] == 'admin'){
    $hub = 'master';
}else {
    $hub = 'master atau admin';
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../alert/sweetalert2.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
	<link href="../css/detail.css" rel="stylesheet">
    <title>Konfirmasi Delete</title>
</head>
<body style="padding: 10px;">
    <!-- <input type="hidden" id="result" value="<?= $result ; ?>" >
    <input type="hidden" id="id" value="<?= $id ; ?>" > -->

    

    <div style=" text-align:center; width:fit-content; background-color: white; border-radius:20px;margin-left:auto ;margin-right:auto; padding:10px;" >
        <form action="delete.php" method="post">
            <h2 style=" color:red; text-align: center; margin-left:10px ;margin-right:10px; margin-bottom:0;">AKSES DIBATASI</h2>
            <h3 style="color:black; text-align: center; margin-bottom:5px;">Anda tidak memiliki akses untuk melakukan opsi ini</h3>
            <div class="form-group input" style="margin-left:auto ;margin-right:auto ; text-align:center; display:flex;flex-direction:column;">
                <p style="font-size: large;">Hubungi <?= $hub ; ?> untuk melakukan Perubahan</p>
                <input type="hidden" value="<?= $id ; ?>" id="id">
                <h1 id="time" style=" color:black; text-align: center;">10</h1>
                <div style="margin-top: 10px;">
                    <a href="../detail-new/?id=<?= $id ; ?>" class="btn btn-primary">BACK</a>
                </div>
            </div>

        </form>

    </div>
<script>

    window.addEventListener('load', function(){
        setInterval(() => {
            var time = document.getElementById('time').innerText
            var count = time - 1
            document.getElementById('time').innerText = count
        }, 1000);
        setTimeout(function(){
          var id = document.getElementById('id').value
          window.location.href = "../detail-new/?id=" + id 
      },10000)

    })

    

</script>
    <!-- <script src="../alert/sweetalert2.all.min.js"></script>
    <script src="../alert/alert.js"></script> -->
</body>
</html>