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

$akses = $_SESSION['akses'];

// error_reporting(0);
if (empty($_GET['keyword'])) {
    $keyword = '';
}
$keyword = $_GET['keyword'];
$order = $_GET['order'];

$query = "SELECT * FROM data
            WHERE
            status != 'pickup' AND
            (no_spk LIKE '%$keyword%' OR
            nama LIKE '%$keyword%' OR 
            wa LIKE '%$keyword%') ORDER BY $order ";

$data = data($query);


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
        <?php $i = 1;
        $color = ''; ?>

        <?php foreach ($data as $datas): ?>
            <?php
            if ($datas['status'] == 'new') {
                $color = 'color-blue';
            } elseif ($datas['status'] == 'proses') {
                $color = 'color-orange';
            } elseif ($datas['status'] == 'done') {
                $color = 'color-green';
            } elseif ($datas['status'] == 'abort') {
                $color = 'color-red';
            } else {
                $color = 'color-purple';
            }
            ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= date('d-M-Y', strtotime($datas['date'])); ?></td>

                <td>
                    <a class="color-blue" href="<?= '../detail-new/?id=' . $datas['no_spk']; ?>" target="_blank">
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
                <td style="font-weight:bold" class="<?= $color; ?>"><?= $datas['status']; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </tbody>
</table>
<?php if (empty($data)) {
    echo '<h4 style="text-align:center;color:#f70000e0;font-weight:400;">Tidak ada data untuk ditampilkan !</h4>';

} ?>