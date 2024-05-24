<?php 
$detail = 'invoice';
$date = date('d/m/Y',strtotime($data['date'])) ;
if(!empty($data['date_paid'])){
    $date_paid = date('d/m/Y',strtotime($data['date_paid'])) ;
}else{
    $date_paid = '';
}
$status = strtoupper($data['status']);
$save_as = $data['save_as'];
$qtss = json_decode($data['qts'],true) ;
$kodes = json_decode($data['kode_part'],true) ;
$descs = json_decode($data['deskripsi'],true) ;
$buys =json_decode($data['buy'],true) ;
$margins = json_decode($data['margin'],true) ;
$sells = json_decode($data['sell'],true) ;
$profit = $data['profit'];
$subtotal = $data['subtotal'];
$dpp = $data['dpp'];
$ppn = $data['ppn'];
$deposit = $data['deposit'];
$total = $data['total'];
$note = $data['note'];
$dp = number_format(str_replace(',','',$subtotal)/2,0,'.',',');


$kode_id = str_split($id,8);
$huruf = $kode_id[0];
$angka = $kode_id[1];
$kode_id = "$huruf-$angka";
$barcode = "QTS-$kode_id";
$qrcode = "https://repair.digitalisasi.net/invoice?kode=". urlencode(encrypt($id));
if($save_as == 'invoice'){
    $barcode = "INV-$kode_id";
}
if(isset($_GET['en'])){
    $qrcode .= '&en';
}

include_once 'languages/invoice/id.php';
if(isset($_GET['en'])){
    include_once 'languages/invoice/en.php';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicon -->
    <?php include_once '../struktur/favicon.php'; ?>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="print.css?versi=<?= $version ; ?>">

    <title><?= $barcode; ?></title>
	
</head>
<body>
    <div class="container-fluid send">
    <div class="col-3 col-sm-1 mt-0 mb-1">
        <select class="form-select" aria-label="Default select example" onchange="language(this)">
            <option value="id" <?php if(!isset($_GET)) echo 'selected'; ?>>ID</option>
            <option value="en" <?php if(isset($_GET['en'])) echo 'selected'; ?>>EN</option>
        </select>
        </div>
    </div>
    <div class="container-xl rounded">
        <!-- head -->
        <?php include_once("../struktur/print-head.php"); ?>
        <!-- close head -->

        <!-- info -->
        <div id="info" class="row px-2">
            <div class="col-6 border border-1 border-dark">
                <div class="row p-2">
                    <div class="col-3">
                        <strong class="m-0 d-block"><?= $words['date']; ?></strong>
                        <strong class="m-0 d-block">SPK No</strong>
                        <strong class="m-0 d-block">UNIT</strong>
                        <strong class="m-0 d-block">SN</strong>
                        <strong class="m-0 d-block">STATUS</strong>
                        </div>
                    <div class="col-1">
                        <strong class="m-0 d-block">:</strong>
                        <strong class="m-0 d-block">:</strong>
                        <strong class="m-0 d-block">:</strong>
                        <strong class="m-0 d-block">:</strong>
                        <strong class="m-0 d-block">:</strong>
                    </div>
                    <div class="col-8 d-flex flex-column">
                        <span class="tb-right fw-bold"><?= $date; ?></span>

                    </div>
                </div>
            </div>
            <div class="col-6 text-center border border-1 border-dark position-relative">
                <svg class="w-75 h-100 m-0 position-absolute" id="barcode"
                        jsbarcode-value="<?= $barcode; ?>"
                        jsbarcode-textmargin="0"
                        jsbarcode-fontoptions="bold"></svg>
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
                <div style="height: 100px;"></div>
            </div>
            <div class="col-6 border border-1 border-dark py-1">
            </div>
        </div>
        <!-- close identity -->

        <!-- table -->
        <div id="table" class="row">
            <div class="col-12 mt-3 px-2">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                        <th scope="col" class="tb-center">Qty</th>
                        <th scope="col"><?= $words['kode']; ?></th>
                        <th scope="col">Item</th>
                        <th scope="col" class="tb-right"><?= $words['harga']; ?></th>
                        <th scope="col" class="tb-right"><?= $words['jumlah']; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($qtss); $i++): ?>
                            <?php $sell = str_replace(',','',$sells[$i]);
                                $qts = str_replace(',','',$qtss[$i]);?>
                        <tr>
                        <th scope="row" class="tb-center py-0"><?= $qtss[$i]; ?></th>
                        <td class="py-0"><?= $kodes[$i]; ?></td>
                        <td class="py-0"><?= $descs[$i]; ?></td>
                        <td class="tb-right py-0"><?= number_format(round($sell/$qts),0,'.',','); ?></td>
                        <td class="tb-right py-0"><?= $sells[$i]; ?></td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>    
            </div>
        </div>
        <!-- close table -->

        <!-- total -->
        <div id="total" class="row p-2">
            <div class="col-8">
                <div class="row gx-0 justify-content-between">
                    <div class="col-9">
                        <h6 class='fw-bold'>Note :</h6>
                        <p class='syarat mb-0'><?= ucfirst(nl2br($data['note'])); ?></p>
                    </div>
                    
                </div>
            </div>
            <div class="col-4 border border-dark border-start-0 border-end-0 bg-secondary-subtle h-fit-content">
                <div class="row position-relative py-2">
                    <div class="col-6">
                        <div class="row">
                            <strong>Subtotal</strong>
                            <span>DPP</span>
                            <span><?= $words['ppn']; ?></span>
                            <?php if($data['save_as'] == 'invoice'): ?>
                            <span>Deposit</span>
                            <?php endif; ?>
                            <strong>TOTAL</strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <span class="tb-right"><?= $subtotal; ?></span>
                            <span class="tb-right"><?= $dpp; ?></span>
                            <span class="tb-right"><?= $ppn; ?></span>
                            <?php if($data['save_as'] == 'invoice'): ?>
                            <span class="tb-right"><?= $deposit; ?></span>
                            <strong class="tb-right"><?= $total; ?></strong>
                            <?php else: ?>
                            <strong class="tb-right"><?= $subtotal; ?></strong>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if($data['status'] == 'paid') :?>
                    <div id="stamp" class="row position-absolute">
                        <div class="col-8 stamp text-center font-stamp fw-bold">
                            <p class="mb-min-1 fs-3"><?= $words['status']; ?></p>
                            <p class="m-0 fs-6"><?= $date_paid; ?></p>
                        </div>
                    </div>
                    <?php endif ;?>
                </div>
            </div>
            <!-- close total -->

            <!-- hormat kami -->
            <div id="hormat kami" class="row justify-content-end mt-5">
                <div class="col-3">
                    <p class="text-center fw-bold mb-5"><?= $words['hormat']; ?></p>
                    <p class="mb-0 text-center fw-bold"><?= ucwords($data['admin']) ?></p>
                    <hr class="border border-dark border-1 opacity-50 m-0">
                    <p class="mt-0 text-center"><?= 'Admin' ?></p>
                </div>
            </div>
            <!-- close hormat -->

        </div>
            <hr id='foot-hr' class="mt-1">
        <button id="print" class="btn btn-secondary mb-3" onclick="printDocument()"><i class="bi bi-printer-fill"></i> Print</button>
    </div>




<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

<script src="barcode.js"></script>
<script src="print.js?versi=<?= $version ; ?>"></script>
<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>

<script>

function printDocument() {
  window.print();
}
JsBarcode("#barcode").init();

var data = '<?= $qrcode; ?>';
    var qrcode = new QRCode(document.getElementById('qrcode'), {
        text: data,
        width: 85,
        height: 85,
    });

</script>
</body>


</html>


