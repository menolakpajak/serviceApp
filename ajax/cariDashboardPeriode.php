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

date_default_timezone_set("Asia/Hong_Kong");

error_reporting(0);

if(empty($_GET['from'])){
    $from = '2011-12-12';
}else{$from = explode('T',$_GET['from'])[0].' 00:00:01';}

if(empty($_GET['to'])){
    $to = date('Y-m-d');
}else{$to = explode('T',$_GET['to'])[0].' 23:59:59'; }

$query = "SELECT * FROM data
            WHERE
            status != 'pickup' AND
            (date >= '$from' AND date <= '$to') ORDER BY date 
             ";
$data = data($query);

$akses = $_SESSION['akses'];






?>


                <table class="table table-striped">
                <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Date</th>
                        <th scope="col">SPK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php $i = 1; $color=''; ?>
                            
                            <?php foreach($data as $datas) : ?>
                                <?php 
                                if($datas['status'] == 'new'){
                                    $color = 'color-blue';
                                }elseif($datas['status'] == 'proses'){
                                    $color = 'color-orange';
                                }elseif($datas['status'] == 'done'){
                                    $color = 'color-green';
                                }elseif($datas['status'] == 'abort'){
                                    $color = 'color-red';
                                }else{
                                    $color = 'color-purple';
                                }
                            ?>
                        <tr>
                        <th scope="row"><?= $i ; ?></th>
                        <td><?= date('d-M-Y', strtotime($datas['date'])) ; ?></td>
                        
                        <td>
                        <a class="color-blue" href="<?= '../detail-new/?id='.$datas['no_spk']; ?>" target="_blank">
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
                        <td style="font-weight:bold" class="<?= $color ; ?>"><?= $datas['status'] ; ?></td>
                        </tr>
                        <?php $i++ ; ?>
                        <?php endforeach; ?>
    
                    </tbody>
                </table>


            <script src="../js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>