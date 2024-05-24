<?php 

$folderPath = "$page[1]imgs/profile/"; // Ganti dengan path folder yang sesuai

// Mencari foto
$foto = $_SESSION['kode'].'.jpg';
$jpgFile = glob($folderPath . $foto);

// Memeriksa apakah ada file .jpg
if (!empty($jpgFile)) {
    $src = $jpgFile[0];
} else {
    $src = "https://i.pravatar.cc/300?u=".$_SESSION['kode'];
}

?>

<div class="profile-sidebar">
    <div class="profile-userpic">
        <img src="<?= $src; ?>" class="img-responsive" alt="">
    </div>
    <div class="profile-usertitle">
        <div id="username" class="profile-usertitle-name"><?= $userName ; ?></div>
        <div class="profile-usertitle-status"><span class="indicator label-success"></span><?= $_SESSION['akses'] ; ?></div>
    </div>
    <div class="clear"></div>
</div>