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

if (empty($_GET['keyword'])) {
    $keyword = '';
}

$keyword = $_POST['keyword'];
$query = "SELECT * FROM invoice
            WHERE
            save_as = 'invoice' AND
            (kode LIKE '%$keyword%' OR
            link LIKE '%$keyword%') limit 100";
if (isset($_POST['bulan']) && !empty($_POST['bulan'])) {
    if (isset($_POST['tahun']) && !empty($_POST['tahun'])) {
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $date = "$tahun-$bulan";
        $query = "SELECT * FROM invoice
            WHERE
            save_as = 'invoice' AND
            date LIKE '$date%'";
    }
}

$data = data($query);
$allOmset = [];
$allProfit = [];

foreach ($data as $input) {
    array_push($allOmset, str_replace(',', '', $input['subtotal']));
    array_push($allProfit, str_replace(',', '', $input['profit']));
}
$omset = array_sum($allOmset);
$profit = array_sum($allProfit);

?>
<table class="table table-striped rekap">
    <thead>
        <tr>
            <th scope="col" class="color-primary">OMSET</th>
            <th scope="col" class="color-success" style="text-align: right;">PROFIT</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th>
                <h3 class="color-blue"><strong><?= number_format($omset, 0, '.', ','); ?></strong></h3>
            </th>
            <th style="text-align: right;">
                <h3 class="color-green"><strong><?= number_format($profit, 0, '.', ','); ?></strong></h3>
            </th>
        </tr>

    </tbody>
</table>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Date</th>
            <th scope="col">Kode</th>
            <th scope="col">Total</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>

        <?php foreach ($data as $datas): ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= date('d-M-Y', strtotime($datas['date'])); ?></td>

                <td>
                    <a class="color-blue" href="<?= '../detail-invoice/?id=' . $datas['kode']; ?>" target="_blank">
                        <?php
                        $kode_id = str_split($datas['kode'], 8);
                        $huruf = $kode_id[0];
                        $angka = $kode_id[1];
                        $kode_id = "$huruf-$angka";
                        echo $kode_id
                            ?>
                    </a>
                </td>
                <td><?= $datas['subtotal']; ?></td>
                <?php if ($datas['status'] == 'pending'): ?>
                    <td style="font-weight:500;" class="color-orange"><?= ucfirst($datas['status']); ?></td>
                <?php endif; ?>
                <?php if ($datas['status'] == 'paid'): ?>
                    <td style="font-weight:500;" class="color-green"><?= ucfirst($datas['status']); ?></td>
                <?php endif; ?>
            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </tbody>
</table>
<?php if (empty($data)) {
    echo '<h4 style="text-align:center;color:#f70000e0;font-weight:400;">Tidak ada data untuk ditampilkan !</h4>';

} ?>