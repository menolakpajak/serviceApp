<?php 
session_start();

if(empty($_SESSION['login'])){
    include_once '../struktur/ajax-logout.php';
}

require '../function.php';

$kode = $_SESSION['kode'];
$login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
if($_SESSION['token'] != $login['token']){
    include_once '../struktur/ajax-logout.php';
}

$akses = $_SESSION['akses'];

if(!isset($_GET['acc']) && !isset($_GET['pending'])
    && !isset($_GET['sinar']) && !isset($_GET['send'])){
    if(empty($_GET['keyword'])){
        $keyword = '';    
    }
    $keyword = $_GET['keyword'];
    $order = $_GET['order'];

    $query = "SELECT * FROM data
                WHERE
                status = 'proses' AND
                (no_spk LIKE '%$keyword%' OR
                nama LIKE '%$keyword%' OR 
                no_tlp LIKE '%$keyword%') ORDER BY $order ";
}
// if sort by acc button
if(isset($_GET['acc'])){
    $query = "SELECT * FROM data
                WHERE
                status = 'proses' AND
                acc = 'on' ORDER BY date";
}
// if sort by pending button
if(isset($_GET['pending'])){
    $query = "SELECT * FROM data
                WHERE
                status = 'proses' AND
                date_update IS NULL ORDER BY date";
}
// if sort by sinar button
if(isset($_GET['sinar'])){
    $query = "SELECT * FROM data
                WHERE
                status = 'proses' AND
                service_at = 'sinar' AND
                date_update IS NOT NULL ORDER BY date";
}
// if sort by send button
if(isset($_GET['send'])){
    $query = "SELECT * FROM data
                WHERE
                status = 'proses' AND
                service_at != 'sinar' AND 
                date_update IS NOT NULL ORDER BY date";
}

            
$data = data($query);


?>

                <table class="table table-striped">
                <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Date</th>
                        <th scope="col">SPK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php $i = 1;?>
                            
                            <?php foreach($data as $datas) : ?>
                                <?php if($datas['acc'] == 'on'){
												$class_acc = 'class="acc-col"';
											}else{$class_acc = '';}
											?>
                        <tr <?= $class_acc; ?>>
                        <th scope="row"><?= $i ; ?></th>
                        <td><?= date('d-M-Y', strtotime($datas['date'])) ; ?></td>
                            
                        <td>
                            <a class="color-blue" href="<?= '../detail-proses/?id='.$datas['no_spk']; ?>" target="_blank">
                                <?php
                                    $spk = str_split($datas['no_spk'],7);
                                    $huruf = $spk[1];
                                    $angka = str_split($spk[0],3);
                                    $spk = "$angka[0]-$angka[1]$angka[2]-$huruf";
                                    echo $spk; 
                                ?>
                            </a>
                        </td>
                        <td><?= $datas['nama'] ; ?></td>
                        <td style="font-weight:500;"><?= ucfirst($datas['tipe']) ; ?></td>
                        </tr>
                        <?php $i++ ; ?>
                        <?php endforeach; ?>
    
                    </tbody>
                </table>
                <?php if(empty($data)){
                        echo '<h4 style="text-align:center;color:#f70000e0;font-weight:400;">Tidak ada data untuk ditampilkan !</h4>';

                    } ?>

