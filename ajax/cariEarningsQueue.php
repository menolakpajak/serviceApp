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

if (isset($_POST['bulan']) && !empty($_POST['bulan'])) {
    if (isset($_POST['tahun']) && !empty($_POST['tahun'])) {
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $date = "$tahun-$bulan";
        $query = "SELECT * FROM data
            WHERE
            penerima = '$kode' AND
            date LIKE '$date%'";
    }
}

$data = data($query);

?>
<table class="table table-striped rekap">
    <thead>
        <tr>
            <th scope="col" class="color-primary">ORDER</th>
            <th scope="col" class="color-success" style="text-align: right;">SHARING</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>
                <h3 class="color-blue"><strong><?= number_format(count($data), 0, '.', ','); ?></strong></h3>
            </th>
            <th style="text-align: right;">
                <h3 class="color-green"><strong>NULL</strong></h3>
            </th>
        </tr>

    </tbody>
</table>
<table class="table table-striped rekap">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Date</th>
            <th scope="col">No. SPK</th>
            <th scope="col">No. Invoice</th>
            <th scope="col">Profit</th>
            <th scope="col">Sharing</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>

        <?php foreach ($data as $datas): ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= date('d-M-Y', strtotime($datas['date'])); ?></td>
                <td><a target="_blank" href="<?= '../detail-new/?id=' . $datas['no_spk']; ?>">
                        <?php
                        $spk = str_split($datas['no_spk'], 7);
                        $huruf = $spk[1];
                        $angka = str_split($spk[0], 3);
                        $spk = "$angka[0]-$angka[1]$angka[2]-$huruf";
                        echo $spk;
                        ?>
                    </a>
                </td>
                <td>
                    <?php if (!empty($datas['invoice'])): ?>
                        <a target="_blank" href="<?= '../detail-invoice/?id=' . $datas['invoice']; ?>">
                            <?php
                            $kode_id = str_split($datas['invoice'], 8);
                            $huruf = $kode_id[0];
                            $angka = $kode_id[1];
                            $kode_id = "$huruf-$angka";
                            echo $kode_id;
                            ?>
                        </a>
                    <?php else: ?>
                        <p>NULL</p>
                    <?php endif; ?>
                </td>
                <td>NULL</td>
                <td>NULL</td>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </tbody>
</table>
<?php if (empty($data)) {
    echo '<h4 style="text-align:center;color:#f70000e0;font-weight:400;">Tidak ada data untuk ditampilkan !</h4>';

} ?>