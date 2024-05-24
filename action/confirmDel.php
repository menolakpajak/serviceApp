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

if(empty($_POST)){

    if(!empty($_GET['id'])){
        $id = $_GET['id'];
        }else{
            header('Location: ../');
            die;
        }
}else{

    if(isset($_POST['submit'])){
        $id = $_POST['id'];
        
}

    
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
            <h2 style="text-align: center; margin-left:10px ;margin-right:10px ;">KODE KONFIRMASI DELETE SUDAH TERKIRIM KE MASTER</h2>
            <h2 style="text-align: center;">0817870770</h2>
            <div class="form-group input" style="margin-left:auto ;margin-right:auto ; text-align:center; display:flex;flex-direction:column;">
                <label style="margin-bottom: 10px;" for="kode">KODE VERIFIKASI</label>
                <input type="hidden" value="<?= $id ; ?>" name="id">
                <input style="text-align:center; font-size: 30px; margin-left:auto ;margin-right:auto ; width: 150px; height: 75px; border-radius: 10px; background-color:#87898c2e;" type="number" name="code" id="kode" maxlength="5">
                <div style="margin-top: 10px;">
                    <button id="ok" type="submit" class="btn btn-primary" name="submit" disabled>OK</button>
                    <a href="../detail-new/?id=<?= $id ; ?>" class="btn btn-dark">BACK</a>
                </div>
            </div>

        </form>

    </div>
<script>
        var input = document.getElementById('kode')
    input.addEventListener('input', function(){
            var ok = document.getElementById('ok')
            if (this.value.length > 5 ){
                this.value = this.value.slice(0, 5)
            }
            if(this.value.length == 5){
                ok.removeAttribute("disabled")
            }else {
                ok.setAttribute("disabled", true)
            }




    })

</script>
    <!-- <script src="../alert/sweetalert2.all.min.js"></script>
    <script src="../alert/alert.js"></script> -->
</body>
</html>