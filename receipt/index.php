<?php
require '../koneksi.php';

$page = ['receipt', '../'];
$id = decrypt($_GET['spk']);
$data = data("SELECT * FROM data WHERE no_spk = '$id'");
if (empty($data)) {
    include_once '../struktur/ajax-receipt-404.php';
}
$data = $data[0];
$date = date('d/m/Y', strtotime($data['date']));
$penerima = $data['penerima'];
$data['penerima'] = data("SELECT * FROM logininfo WHERE kodeuser = '$penerima'")[0]['nama'];
$json = $data['kelengkapan'];
$data2 = json_decode($json, true);

$spk = str_split($data['no_spk'], 7);
$huruf = $spk[1];
$angka = str_split($spk[0], 3);
$spk = "$angka[0]-$angka[1]$angka[2]-$huruf";
$qrcode = "https://repair.digitalisasi.net/receipt?spk=" . urlencode(encrypt($id));
$send_spk = encrypt($data['no_spk']);
// <<<...LOGIC FOR CHECKBOX....>>

$kamera = '';
$lensa = '';
$battery = '';
$memory = '';
$strap = '';
$bodyCap = '';
$lensCap = '';
$eyeCap = '';
$filter = '';
$other = '';

$kamera_info = ucfirst($data2['check_kamera_info']);
$lensa_info = ucfirst($data2['check_lensa_info']);
$battery_info = ucfirst($data2['check_battery_info']);
$memory_info = ucfirst($data2['check_memory_info']);
$strap_info = ucfirst($data2['check_strap_info']);
$bodyCap_info = ucfirst($data2['check_bodycap_info']);
$lensCap_info = ucfirst($data2['check_lenscap_info']);
$filter_info = ucfirst($data2['check_filter_info']);
$other_info = ucfirst($data2['other']);


if (!empty($data2['check_kamera'])) {
    $kamera = '
        <div class="col-3">
        <strong class="d-block">- Kamera</strong>
        <div class="ps-2">
        <span>' . $kamera_info . '</span>
        </div>
        </div>';
}
if (!empty($data2['check_lensa'])) {
    $lensa = '
        <div class="col-3">
        <strong class="d-block">- Lensa</strong>
        <div class="ps-2">
        <span>' . $lensa_info . '</span>
        </div>
        </div>';
}
if (!empty($data2['check_battery'])) {
    $battery = '
        <div class="col-3">
        <strong class="d-block">- Battery</strong>
        <div class="ps-2">
        <span>' . $battery_info . '</span>
        </div>
        </div>';
}
if (!empty($data2['check_memory'])) {
    $memory = '
        <div class="col-3">
        <strong class="d-block">- Memory</strong>
        <div class="ps-2">
        <span>' . $memory_info . '</span>
        </div>
        </div>';
}
if (!empty($data2['check_strap'])) {
    $strap = '
        <div class="col-3">
        <strong class="d-block">- Strap</strong>
        <div class="ps-2">
        <span>' . $strap_info . '</span>
        </div>
        </div>';
}
if (!empty($data2['check_bodycap'])) {
    $bodyCap = '
        <div class="col-3">
        <strong class="d-block">- Body Cap</strong>
        <div class="ps-2">
        <span>' . $bodyCap_info . '</span>
        </div>
        </div>';
}
if (!empty($data2['check_lenscap'])) {
    $lensCap = '
        <div class="col-3">
        <strong class="d-block">- Lens Cap</strong>
        <div class="ps-2">
        <span>' . $lensCap_info . '</span>
        </div>
        </div>';
}
if (!empty($data2['check_filter'])) {
    $filter = '
        <div class="col-3">
        <strong class="d-block">- Filter</strong>
        <div class="ps-2">
        <span>' . $filter_info . '</span>
        </div>
        </div>';
}
if (!empty($data2['other'])) {
    $other = '
        <div class="col-12">
        <strong class="d-block">- Other</strong>
        <div class="ps-2">
        <span>' . $other_info . '</span>
        </div>
        </div>';
}

include_once '../print/languages/receipt/id.php';
if (isset($_GET['en'])) {
    include_once '../print/languages/receipt/en.php';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://repair.digitalisasi.net/receipt?spk=<?= $_GET['spk']; ?>" />
    <meta property="og:title" content="RECEIPT <?= $id; ?>" />
    <meta property="og:description" content="Online Receipt" />
    <meta property="og:image" content="https://repair.digitalisasi.net/assets/img/meta/receipt.png" />

    <!-- favicon -->
    <?php include_once '../struktur/favicon.php'; ?>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="../alert/sweetalert2.css" rel="stylesheet">
    <link rel="stylesheet" href="../print/print.css?versi=<?= $version; ?>">

    <title><?= $spk; ?></title>

</head>

<body>
    <div class="container-fluid send">
        <div class="col-3 col-sm-1 mt-0 mb-1">
            <select class="form-select" aria-label="Default select example" onchange="language(this)">
                <option value="id" <?php if (!isset($_GET))
                    echo 'selected'; ?>>ID</option>
                <option value="en" <?php if (isset($_GET['en']))
                    echo 'selected'; ?>>EN</option>
            </select>
        </div>
    </div>
    <div class="container-xl rounded">
        <!-- head -->
        <div id="head" class="row rounded">
            <div class="col-8">
                <div class="row pt-2 ps-3">
                    <img src="../imgs/logo/only-logo-terang.png" class="col-6 h-100 p-1 gx-0 w-25">
                    <div class="col-6 gx-0 d-flex align-items-center">
                        <div>
                            <h3 class="m-0 font-head head-color">Digital Repair</h3>
                            <h6 class="m-0 font-head">
                                Jl. Tukad Pancoran IV <br>block A4 no 12B <br>
                                Denpasar - Bali <br>
                                08980000703</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex text-end justify-content-end align-items-center">
                <h1 class="text-primary mb-0 font-stamp">RECEIPT</h1>
            </div>
        </div>
        <!-- close head -->

        <!-- info -->
        <div id="info" class="row px-2">
            <div class="col-6 border border-1 border-dark">
                <div class="row p-2">
                    <div class="col-3">
                        <strong class="m-0 d-block">DATE</strong>
                        <strong class="m-0 d-block">UNIT</strong>
                        <strong class="m-0 d-block">SN</strong>
                        <strong class="m-0 d-block">STATUS</strong>
                    </div>
                    <div class="col-1">
                        <strong class="m-0 d-block">:</strong>
                        <strong class="m-0 d-block">:</strong>
                        <strong class="m-0 d-block">:</strong>
                        <strong class="m-0 d-block">:</strong>
                    </div>
                    <div class="col-8 d-flex flex-column">
                        <span class="tb-right fw-bold"><?= $date; ?></span>
                        <span class="tb-right"><?= ucfirst($data['unit']); ?></span>
                        <span class="tb-right"><?= $data['sn']; ?></span>
                        <span class="tb-right"><?= ucfirst($data['status']); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-6 text-center border border-1 border-dark position-relative">
                <svg class="w-75 h-100 m-0 position-absolute" id="barcode" jsbarcode-value="<?= $spk; ?>" jsbarcode-textmargin="0" jsbarcode-fontoptions="bold"></svg>
            </div>
        </div>
        <!-- close info -->

        <!-- gap -->
        <div id="gap" class="row px-2">
            <div class="col-6 text-center border border-1 border-dark bg-secondary-subtle">
                <strong>Costumer :</strong>
            </div>
            <div class="col-6 text-center border border-1 border-dark bg-secondary-subtle">
                <strong>Error Info :</strong>
            </div>
        </div>
        <!-- close gap -->

        <!-- identity -->
        <div id="identity" class="row px-2">
            <div class="col-6 border border-1 border-dark py-1">
                <strong class="d-block"><?= ucwords($data['nama']); ?></strong>
                <span class="d-block"><?= $data['wa']; ?></span>
                <span class="d-block"><?= nl2br($data['alamat']); ?></span>
            </div>
            <div class="col-6 border border-1 border-dark py-1">
                <span class="d-block"><?= removeInputChar(ucfirst($data['error'])); ?></span>
            </div>
        </div>
        <!-- close identity -->

        <!-- kelengkapan -->
        <div id="kelengkapan" class="row px-2">
            <div class="col-12 text-center border border-1 border-dark bg-secondary-subtle">
                <strong><?= $lang['kelengkapan']; ?></strong>
            </div>
            <div class="col-12 border border-1 border-dark py-1 pe-3">
                <div class="row">
                    <?= $kamera; ?>
                    <?= $battery; ?>
                    <?= $lensa; ?>
                    <?= $memory; ?>
                    <?= $strap; ?>
                    <?= $bodyCap; ?>
                    <?= $lensCap; ?>
                    <?= $filter; ?>
                    <?= $other; ?>
                </div>
            </div>
        </div>
        <!-- close kelengkapan -->

        <!-- syarat -->
        <div id="syarat" class="row px-2">
            <div class="col-12 text-center border border-1 border-dark bg-secondary-subtle">
                <strong><?= $lang['syarat']; ?></strong>
            </div>
            <div class="col-12 border border-1 border-dark py-1">
                <div class="row">
                    <div class="container">
                        <ul>
                            <li>
                                <p class="mb-0"><?= $lang[1]; ?></p>
                            </li>
                            <li>
                                <p class="mb-0"><?= $lang[2]; ?></p>
                            </li>
                            <li>
                                <p class="mb-0"><strong><?= $lang[3]; ?></strong></p>
                            </li>
                            <li>
                                <p class="mb-0"><strong><?= $lang[4]; ?></strong></p>
                            </li>
                            <li>
                                <p class="mb-0"><strong><?= $lang[5]; ?></strong></p>
                            </li>
                            <li>
                                <p class="mb-0"><strong><?= $lang[6]; ?></strong></p>
                            </li>
                            <li>
                                <p class="mb-0"><?= $lang[7]; ?></p>
                            </li>
                            <li>
                                <p class="mb-0"><?= $lang[8]; ?></p>
                            </li>
                            <li>
                                <p><?= $lang[9]; ?></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- close syarat -->

        <?php if (empty($data['signature'])): ?>
            <!-- hormat kami -->
            <div id="hormat kami" class="mt-1 row justify-content-end">
                <div class="col-3">
                    <p class="text-center fw-bold mb-1"><?= $lang['agree']; ?></p>
                    <div id="s-canvas" class="border border-1 border-dark" style="width: 100%;height:100px;">
                        <canvas id="signature-pad" width="171" height="98"></canvas>
                    </div>
                    <p class="m-0 text-center fw-bold"><?= ucwords($data['nama']); ?></p>
                    <div id="save-button" class="d-flex justify-content-between">
                        <button type="button" class="btn btn-sm btn-success" onclick="saveSignature('<?= $send_spk; ?>')">Save</button>
                        <button type="button" class="btn btn-sm btn-primary" onclick="clearSignature()">Clear</button>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div id="hormat kami" class="mt-1 row justify-content-end">
                <div class="col-3">
                    <p class="text-center fw-bold mb-1"><?= $lang['agree']; ?></p>
                    <div style="width: 100%;height:100px;">
                        <!-- <canvas id="signature-pad" width="171" height="98"></canvas> -->
                        <img id="displayed-signature" width="171" height="98" src="<?= $data['signature']; ?>" alt="costumer signature" />
                    </div>
                    <p class="m-0 text-center fw-bold"><?= ucwords($data['nama']); ?></p>
                </div>
            </div>
            <!-- close hormat -->
        <?php endif ?>

    </div>



    <script src="../alert/sweetalert2.all.js?versi=<?= $version; ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- html2canvas -->
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <!-- signature_pad -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
    <script src="../print/barcode.js?versi=<?= $version; ?>"></script>
    <script src="../print/print.js?versi=<?= $version; ?>"></script>

</body>


</html>