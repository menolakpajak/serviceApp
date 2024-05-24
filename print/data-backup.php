<?php 


if(empty($_SESSION['login'])){
    header('Location: ../');
}

$kode = $_SESSION['kode'];
$login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
if($_SESSION['token'] != $login['token']){
	header('Location: ../logout.php');
    die;
}
$akses = $_SESSION['akses'];

if($akses == 'master' || $akses == 'admin'){
	$userName = $_SESSION['nama'];
}else{ header('Location: ../logout.php');
	die; }


if(empty($_GET['id'])){
	include_once '../error/index.php';
	exit();
}

$id = $_GET['id'];
$data = data("SELECT * FROM data WHERE no_spk = '$id'");
if(empty($data)){
    include_once '../struktur/ajax-404.php';
}
$data = $data[0];
$penerima = $data['penerima'];
$data['penerima'] = data("SELECT * FROM logininfo WHERE kodeuser = '$penerima'")[0]['nama'];
$json = $data['kelengkapan'];
$data2 = json_decode($json,true);

						// <<<...LOGIC FOR CHECKBOX....>>

$kamera = ['','style="display:none"'];
$lensa = ['','style="display:none"'];
$battery = ['','style="display:none"'];
$memory = ['','style="display:none"'];
$strap = ['','style="display:none"'];
$bodyCap = ['','style="display:none"'];
$lensCap = ['','style="display:none"'];
$eyeCap = ['','style="display:none"'];
$ifCap = ['','style="display:none"'];
$filter = ['','style="display:none"'];

$kamera_info = ucfirst($data2['check_kamera_info']);
$lensa_info = ucfirst($data2['check_lensa_info']);
$battery_info = ucfirst($data2['check_battery_info']);
$memory_info = ucfirst($data2['check_memory_info']);
$strap_info = ucfirst($data2['check_strap_info']);
$bodyCap_info = ucfirst($data2['check_bodycap_info']);
$lensCap_info = ucfirst($data2['check_lenscap_info']);
$filter_info = ucfirst($data2['check_filter_info']);
$other = ucfirst($data2['other']);

    if(!empty($data2['check_kamera'])){$kamera = ['&#10004; Kamera',''];}
    if(!empty($data2['check_lensa'])){$lensa = ['&#10004; Lensa',''];}
    if(!empty($data2['check_battery'])){$battery = ['&#10004; Battery',''];}
    if(!empty($data2['check_memory'])){$memory = ['&#10004; Memory',''];}
    if(!empty($data2['check_strap'])){$strap = ['&#10004; Strap',''];}
    if(!empty($data2['check_bodycap'])){$bodyCap = ['&#10004; Body Cap',''];}
    if(!empty($data2['check_lenscap'])){$lensCap = ['&#10004; Lens Cap',''];}
    if(!empty($data2['check_filter'])){$filter = ['&#10004; Filter',''];}

    if(empty($data2['check_kamera_info'])){$kamera_info = "";}
    if(empty($data2['check_lensa_info'])){$lensa_info = "";}
    if(empty($data2['check_battery_info'])){$battery_info = "";}
    if(empty($data2['check_memory_info'])){$memory_info = "";}
    if(empty($data2['check_strap_info'])){$strap_info = "";}
    if(empty($data2['check_bodycap_info'])){$bodyCap_info = "";}
    if(empty($data2['check_lenscap_info'])){$lensCap_info = "";}
    if(empty($data2['check_filter_info'])){$filter_info = "";}
    if(empty($data2['other'])){$other = "";}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    
    



    <link rel="stylesheet" href="../css/print.css?versi=<?= $version ; ?>">

    <title><?= $data['no_spk']; ?></title>
    
	<!-- favicon -->
	<?php include_once '../struktur/favicon.php' ?>
	
</head>
<body >
<div  class="container mt-1">
    <div class="d-flex justify-content-center row">
            <h6 style="margin-right:10px; text-align:right"><?= date('d-M-Y', strtotime($data["date"])) ; ?></h6>
        <div class="col-md-8">
        <!-- bg-white rounded -->
            <div class="p-3">
                <div class="rowe">
                    <div id="head" class="col-md-7 ">
                        <img  src="../imgs/logo/logo.png" alt="">
                        <div id="headText">

                            <!-- <h1>SINAR PHOTO</h1> -->
                            <p>Jl. Waturenggong no.137<br>
                            Kota Denpasar Bali<br>            
                            0811-3896-776</p>
                        </div>
                    </div>
                    <div style="text-align: right;" class="col-md text-right">
                        <h3 class="text-uppercase"><?= $data['no_spk'] ; ?></h3>
                        <div class="billed"><span class="font-weight-bold"><?= ucwords($data['nama']) ; ?></span></div>
                        <div class="billed"><span class="font-weight-bold"><?= ucfirst($data['alamat']) ; ?></span></div>
                        <div class="billed"><span class="font-weight-bold"><?= $data['wa'] ; ?></span></div>
                        <?php if(!empty($data['no_tlp'])): ?>
                            <div class="billed"><span class="font-weight-bold"><?= $data['no_tlp'] ; ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
                <hr>
                                        <!-- UNIT INFO -->
                <div id="unit">

                    <div class="form-group input">
                        <label for="nama">UNIT :</label>
                        <div class="box">
                            <h6><?= ucfirst($data['unit']) ; ?></h6>
                        </div>
                    </div>
                    <div class="form-group input">
                        <label for="nama">SERIAL NUMBER :</label>
                        <div class="box">
                            <h6><?= $data['sn'] ; ?></h6>
                        </div>
                    </div>
                    
                </div>
                <div id="kelengkapan" class="mt-3">
                        <h5 style="text-align: center;">KELENGKAPAN</h5>
                        <hr>
                    
                    <div class="kelengkapan">

                        <div <?= $kamera[1] ; ?> class="form-group input">
                            <label><?= $kamera[0] ; ?></label>
                            <div class="box">
                                <p><?= ucfirst($kamera_info) ; ?></p>
                            </div>
                        </div>

                        <div class="form-group input" <?= $lensa[1] ; ?> >
                            <label><?= $lensa[0] ; ?></label>
                            <div class="box">
                                <p><?= ucfirst($lensa_info) ; ?></p>
                            </div>
                        </div>

                        <div class="form-group input" <?= $battery[1] ; ?> >
                            <label><?= $battery[0] ; ?></label>
                            <div class="box">
                                <p><?= ucfirst($battery_info) ; ?></p>
                            </div>
                        </div>

                        <div class="form-group input" <?= $memory[1] ; ?> >
                            <label><?= $memory[0] ; ?></label>
                            <div class="box">
                                <p><?= ucfirst($memory_info) ; ?></p>
                            </div>
                        </div>

                        <div class="form-group input" <?= $strap[1] ; ?> >
                            <label><?= $strap[0] ; ?></label>
                            <div class="box">
                                <p><?= ucfirst($strap_info) ; ?></p>
                            </div>
                        </div>

                        <div class="form-group input" <?= $bodyCap[1] ; ?> >
                            <label><?= $bodyCap[0] ; ?></label>
                            <div class="box">
                                <p><?= ucfirst($bodyCap_info) ; ?></p>
                            </div>
                        </div>

                        <div class="form-group input" <?= $lensCap[1] ; ?> >
                            <label><?= $lensCap[0] ; ?></label>
                            <div class="box">
                                <p><?= ucfirst($lensCap_info) ; ?></p>
                            </div>
                        </div>

                        <div class="form-group input" <?= $filter[1] ; ?> >
                            <label><?= $filter[0] ; ?></label>
                            <div class="box">
                                <p><?= ucfirst($filter_info) ; ?></p>
                            </div>
                        </div>

                    </div>
                        <div class="other">
                            <label style="display : block; width:max-content" >Kelengkapan Lain :</label>
                            <p><?= ucfirst($other) ; ?></p>
                        </div>
                        

                </div>
                <div id="kerusakan" class="mt-3">
                        <h5 style="text-align: center;">KERUSAKAN</h5>
                        <hr>
                    <div>
                        <p><?= ucfirst($data['error']) ; ?></p>
                    </div>
                </div>

                <div id="ketentuan" class="mt-3">
                        <h5 style="text-align: center;">SYARAT DAN KETENTUAN SERVICE</h5>
                        <hr>
                    <div>
                        <ul>
                            <li>
                                <p>SPK ini berlaku sebagai tanda terima UNIT dan harus diserahkan kembali saat pengambilan UNIT.</p>
                            </li>
                            <li>
                                <p>Konfirmasi service akan dikirimkan ke pelanggan apabila diperlukan pergantian spare part, bila tidak ada sparepart yang perlu diganti kami akan langsung melakukan service dengan biaya sesuai jasa service yang berlaku.</p>
                            </li>
                            <li>
                                <p style="font-weight: bold;">Untuk setiap PEMBATALAN service pelanggan akan dikenakan biaya pemeriksaaan sebesar 50% dari biaya service</p>
                            </li>
                            <li>
                                <p style="font-weight: bold;">Apabila konfirmasi penawaran biaya service yang kami ajukan tidak ditanggapi dalam waktu 2 minggu, maka service dianggap BATAL. Kami tidak bertanggung jawab atas kerusakan lain / kehilangan apabila unit tidak segera diambil.</p>
                            </li>
                            <li>
                                <p style="font-weight: bold;">Kami tidak bertanggung jawab atas KEHILANGAN / KERUSAKAN unit yang SELESAI / BATAL service yang tidak diambil dalam waktu 30 hari sejak konfirmasi bahwa unit sudah bisa diambil.</p>
                            </li>
                            <li>
                                <p>Garansi service berlaku selama 30 hari terhitung dari tanggal konfirmasi pengambilan atau tanggal yang tertera pada nota, untuk kerusakan yang sama dan bukan karena kesalahan pemakaian atau bencana alam.</p>
                            </li>
                            <li>
                                <p>Unit yang prosesnya melalui service centre di luar bali akan dikenakan biaya pengiriman sesuai tujuan service.</p>
                            </li>

                        </ul>
                    </div>
                </div>

                <div id="ttd">
                        <div style="margin-left: 50px; display:flex;flex-direction:column;justify-content:space-between">
                            <label ><?= ucfirst($data['counter']) ; ?></label>
                            <label ><?= ucfirst($data['penerima']) ; ?></label>
                        </div>
                        <div style="margin-right: 50px; display:flex;flex-direction:column;justify-content:space-between">
                            <p>saya mengerti dan menyetujui<br>ketentuan diatas</p>
                            <label ><?= ucfirst($data['nama']) ; ?></label>
                        </div>
                </div>
                
                <div id="print" class="text-right mb-3">
                    <a href="javascript:void(0)" class="btn btn-success btn-sm mr-5" onclick="document.title='<?= $data['nama'] ; ?>_<?= $data['no_spk'] ; ?>';window.print(); return false;">PRINT</a>
                    
                </div>
            </div>
        </div>
    </div>
</div>






<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js'></script>

</body>


</html>