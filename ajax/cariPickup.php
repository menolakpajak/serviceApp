<?php
session_start();

if (empty($_SESSION['login'])) {
    include_once '../struktur/ajax-logout.php';
}

require '../function.php';

$kode = $_SESSION['kode'];
$login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
if ($_SESSION['token'] != $login['token']) {
    include_once '../struktur/ajax-logout.php';
}
$data = data("SELECT * FROM pickup ORDER BY date_pickup DESC LIMIT 20");
$akses = $_SESSION['akses'];

// error_reporting(0);
if (empty($_GET['keyword'])) {
    $keyword = '';
}
$keyword = $_GET['keyword'];
$order = $_GET['order'];

$query = "SELECT * FROM pickup
            WHERE
            (no_spk LIKE '$keyword%' OR
            nama LIKE '$keyword%' OR 
            wa LIKE '$keyword%') ORDER BY $order LIMIT 20";

$data = data($query);

?>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Pickup</th>
            <th scope="col">SPK</th>
            <th scope="col">Nama</th>
            <th scope="col">Unit</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>

        <?php foreach ($data as $datas): ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= date('d-M-Y', strtotime($datas['date_pickup'])); ?></td>
                <td>
                    <a class="color-blue" href="<?= '../detail-pickup/?id=' . $datas['no_spk']; ?>" target="_blank">
                        <?php
                        $spk = str_split($datas['no_spk'], 7);
                        $huruf = $spk[1];
                        $angka = str_split($spk[0], 3);
                        $spk = "$angka[0]-$angka[1]$angka[2]-$huruf";
                        echo $spk;
                        ?>
                    </a>
                </td>
                <td><?= $datas['nama']; ?></td>
                <td style="font-weight:500;"><?= ucfirst($datas['tipe']); ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </tbody>
</table>
<?php if (empty($data)) {
    echo '<h4 style="text-align:center;color:#f70000e0;font-weight:400;">Tidak ada data untuk ditampilkan !</h4>';

} ?>