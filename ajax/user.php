<?php 
session_start();
include '../function.php';

$user = $_SESSION['user'];
$useronline = data("SELECT * FROM logininfo WHERE username != '$user' AND status = 'online' AND akses != 'master' ORDER BY username");

if(!empty($useronline)){
    foreach($useronline as $usr){
        $code = $usr['kodeuser'];
        $now_usr = strtotime($datetime);
        $time_usr = strtotime($usr['date_status']) + 3600;
        
        if($now_usr >= $time_usr){
            $query = "UPDATE logininfo SET
                    date_status = '$datetime',
                    status = 'offline'
                    WHERE kodeuser = '$code' ";
            $conn->query($query);
        }
    }
}

$useroffline = data("SELECT * FROM logininfo WHERE username != '$user' AND status != 'online' AND akses != 'master' ORDER BY username");



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php foreach($useronline as $orang): ?>
            <?php if($orang['status'] == 'online'){
                $online = 'color-green';
            }else{
                $online = '';
            } ?>
        <li><a class="" href="#">
            <span class="fa fa-user <?= $online ; ?>">&nbsp;</span> <?= $orang['nama'] ; ?>
            </a>
        </li>
		<?php endforeach; ?>
        <?php if(!empty($useronline)) : ?>
<hr style="margin:0 20px 0 20px;border:1px solid #4444448a;color:#4444448a !important;">
        <?php endif; ?>
<?php foreach($useroffline as $orangoff): ?>
            <!-- <li><a class="" href="#">
                <span class="fa fa-user">&nbsp;</span> <?= $orangoff['nama'] ; ?>
                </a>
            </li> -->
<?php endforeach; ?>

</html>