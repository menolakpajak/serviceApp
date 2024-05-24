<?php
ob_start();
session_start();

$page = ['login', '../'];
if(isset($_SESSION["login"])){
    header('Location: ../dashboard');
    die;
}

include '../config.php';


if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM logininfo WHERE username = '$username'");
        if(mysqli_num_rows($result) === 1){
            
            $match = mysqli_fetch_assoc($result);
                 
                if(password_verify($password,$match["password"])){
                    $code = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890%&*?!@";
                    $token = substr(str_shuffle($code),0,40);
                    $id  = $match['id'];
                    
                    $_SESSION['nama'] = $match['nama'];
                    $_SESSION['login'] = true;
                    $_SESSION['akses'] = $match['akses'];
                    $_SESSION['role'] = $match['role'];
                    $_SESSION['user'] = $match['username'];
                    $_SESSION['kode'] = $match['kodeuser'];
                    $_SESSION['counter'] = $match['counter'];
                    $_SESSION['token'] = $token;                    
                            $query = "UPDATE logininfo SET
                                token = '$token',
                                status = 'online' 
                                WHERE id = $id ";
                                mysqli_query($conn,$query);
                    header("Location: ../dashboard");
                    exit;
                }

            }
        $error = true;
}






?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    	<!-- favicon -->
	<?php include_once '../struktur/favicon.php' ?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css?versi=<?= $version ; ?>">
    <title>LOGIN AREA</title>
</head>
<body >
    <img id="img" style="width: 150px; padding:10px; box-sizing:border-box; " src="../imgs/logo/logo-login.png" alt="">
    <p id="version" style="color: white; font-style: italic ; ">Version : <?= $version ; ?></p>
    <div id="container" style="width: 30%; margin-top:7%;" class="container ">
        <h1 style="text-align: center;">login akses</h1>
            <?php if(isset($error)) : ?>
                <p style="color: red; font-style: italic ; ">username / password salah</p>
            <?php endif; ?>
        
            <form id="login" action="" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username" autocomplete="off" maxlength="20">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    </div>
                    
                    <button type="submit" class="btn btn-grey mb-3" name="login">Log In</button>
                    
            </form>
    </div>


    
</body>
</html>