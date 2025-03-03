<?php
ob_start();
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

if ($akses == 'master' || $akses == 'admin') {
	$userName = $_SESSION['nama'];
} else {
	include_once '../struktur/ajax-403.php';
}


if (empty($_GET['id'])) {
	include_once '../struktur/ajax-noKey.php';
}
$id = $_GET['id'];

$akses = $_SESSION['akses'];
$userName = $_SESSION['user'];
$kode = $_SESSION['kode'];

$data = data("SELECT * FROM invoice WHERE kode = '$id'");
if (empty($data)) {
	include_once '../struktur/action-404.php';
}
$data = $data[0];

if (isset($_GET['add'])) {
	$add = $_GET['add'];
} else {
	$add = 0;
}

$link_spk = removeSpecialChar($data['link']);
$date = date('d-M-Y', strtotime($data['date']));
$status = strtoupper($data['status']);
$save_as = strtoupper($data['save_as']);
$qtss = json_decode($data['qts'], true);
$kodes = json_decode($data['kode_part'], true);
$descs = json_decode($data['deskripsi'], true);
$buys = json_decode($data['buy'], true);
$margins = json_decode($data['margin'], true);
$sells = json_decode($data['sell'], true);
$profit = $data['profit'];
$subtotal = $data['subtotal'];
$dpp = $data['dpp'];
$ppn = $data['ppn'];
$deposit = $data['deposit'];
if (!empty($data['discount'])) {
	$discount = $data['discount'];
} else {
	$discount = 0;
}
$total = $data['total'];
$note = $data['note'];
$rekening = $data['rek'];
if (!empty($data['cancel'])) {
	$cancel = $data['cancel'];
} else {
	$cancel = 0;
}


?>

<div class="col-md-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			EDIT INVOICE

		</div>
		<div class="panel-body">
			<div id="container" class="canvas-wrapper">

				<form onsubmit="editNota(event)">
					<input type="hidden" id="id" value="<?= $data['kode']; ?>">
					<!-- HEAD -->
					<div id="head">
						<div class="form-group input">
							<label for="date">Date</label>
							<div class="box">
								<input type="datetime-local" class="form-control" id="date" name="date" value="<?= $data['date']; ?>">
							</div>
						</div>
						<div class="form-group input">
							<label style="text-align: right;" for="kode">Invoice no.</label>
							<div class="box">
								<input type="text" class="form-control" id="kode" name="kode" value="<?= $data['kode']; ?>" maxlength="10" readonly>
							</div>
						</div>
						<div class="color-blue">
							<label for="saveas">Save As :</label>
							<div id="saveas" class="box">
								<h4 class="fw-bold color-orange">
									<strong><?= strtoupper($data['save_as']); ?></strong>
								</h4>
							</div>
						</div>
					</div>
					<!-- _____________________________________________________________________________ -->

					<!-- Nota INFO -->
					<div id="nota">
						<div class="title_fill">
							<h3>Detail Invoice</h3>
						</div>

						<div id="nota-opsi">
							<div class="form-group input">
								<label for="item">Item :</label>
								<div class="box">
									<input type="text" class="form-control" id="item" name="item" onkeyup="numSeperate(event)" value="<?= $add; ?>">
									<button onclick="addEdit()" type="button" class="btn btn-success">Add</button>
								</div>
							</div>
							<div class="form-group input">
								<label for="inv-for">Invoice For :</label>
								<div class="box">
									<input type="text" class="form-control" id="inv-for" name="inv-for" value="<?= $data['link']; ?>" readonly>
								</div>
							</div>

						</div>
						<hr>
						<!-- ////////////////// -->
						<div id="reset-nota" class="col-12 of-x-auto">
							<table class="table table-striped table-nota">
								<thead>
									<tr class="title_fill color-white">
										<th scope="col">Qty</th>
										<th scope="col">Kode</th>
										<th scope="col">Description</th>
										<th scope="col" style="text-align: right;">Buy</th>
										<th scope="col" style="text-align: right;">Mg %</th>
										<th scope="col" style="text-align: right;">Sell</th>
									</tr>
								</thead>
								<tbody>

									<?php for ($i = 0; $i < count($descs); $i++): ?>
										<tr>
											<td>
												<div class="form-group input">
													<div class="box">
														<input type="text" class="form-control qts" style="max-width: 50px; margin:0;" onkeyup="numSeperate(event)" value="<?= $qtss[$i]; ?>">
													</div>
												</div>
											</td>
											<td>
												<div class="form-group input">
													<input type="text" class="form-control kode" style="max-width: 120px; margin:0;" value="<?= $kodes[$i]; ?>">
												</div>
											</td>
											<td>
												<div class="form-group input">
													<input type="text" class="form-control desc" style="max-width: 250px; margin:0;" list="opsi" value="<?= $descs[$i]; ?>">
													<datalist id="opsi">
														<?php include_once '../struktur/datalist-nota.html'; ?>
													</datalist>
												</div>
											</td>
											<td>
												<div class="form-group input" style="float:right;">
													<input type="text" class="form-control buy" style="max-width: 150px; margin:0;" onkeyup="numSeperate(event)" value="<?= $buys[$i]; ?>">
												</div>
											</td>
											<td>
												<div class="form-group input" style="float:right;">
													<div class="box">
														<input type="text" class="form-control margin" style="max-width: 70px; margin:0;" onkeyup="numSeperate(event)" value="<?= $margins[$i]; ?>">
													</div>
												</div>
											</td>
											<td>
												<div class="form-group input" style="float:right;">
													<input type="text" class="form-control sell" style="max-width: 150px; margin:0; text-align:right;" onkeyup="numSeperate(event)" value="<?= $sells[$i]; ?>">
												</div>
											</td>
										</tr>
									<?php endfor; ?>
									<?php for ($i = 0; $i < $add; $i++): ?>
										<tr>
											<td>
												<div class="form-group input">
													<div class="box">
														<input type="text" class="form-control qts" style="max-width: 50px; margin:0;" onkeyup="numSeperate(event)" value="1">
													</div>
												</div>
											</td>
											<td>
												<div class="form-group input">
													<input type="text" class="form-control kode" style="max-width: 120px; margin:0;">
												</div>
											</td>
											<td>
												<div class="form-group input">
													<input type="text" class="form-control desc" style="max-width: 250px; margin:0;" list="opsi">
													<datalist id="opsi">
														<option value="Cleaning Sensor APSC"></option>
														<option value="Cleaning Sensor FF"></option>
														<option value="Cleaning Lensa"></option>
													</datalist>
												</div>
											</td>
											<td>
												<div class="form-group input" style="float:right;">
													<input type="text" class="form-control buy" style="max-width: 150px; margin:0;" onkeyup="numSeperate(event)" value="0">
												</div>
											</td>
											<td>
												<div class="form-group input" style="float:right;">
													<div class="box">
														<input type="text" class="form-control margin" style="max-width: 70px; margin:0;" onkeyup="numSeperate(event)" value="0">
													</div>
												</div>
											</td>
											<td>
												<div class="form-group input" style="float:right;">
													<input type="text" class="form-control sell" style="max-width: 150px; margin:0;" onkeyup="numSeperate(event)" value="0">
												</div>
											</td>
										</tr>
									<?php endfor; ?>

								</tbody>
							</table>
						</div>

						<!-- ////////////////////////// -->
						<hr class="divider">
						</hr>
						<div id="total-group">
							<div class="box-total">
								<div class="form-group input color-blue">
									<div class="box">
										<label for="profit">Profit :</label>
										<input type="text" class="form-control color-blue" id="profit" onkeyup="numSeperate(event)" value="<?= $profit; ?>" readonly>
									</div>
								</div>
								<div class="form-group input">
									<div class="box">
										<label for="subtotal">Sub Total :</label>
										<input type="text" class="form-control" id="subtotal" onkeyup="numSeperate(event)" value="<?= $subtotal; ?>">
									</div>
								</div>
								<div class="form-group input">
									<div class="box">
										<label for="dpp">DPP :</label>
										<input type="text" class="form-control" id="dpp" onkeyup="numSeperate(event)" value="<?= $dpp; ?>">
									</div>
								</div>
								<div class="form-group input">
									<div class="box">
										<label for="ppn">PPN 11%:</label>
										<input type="text" class="form-control" id="ppn" onkeyup="numSeperate(event)" value="<?= $ppn; ?>">
									</div>
								</div>
								<div class="form-group input color-orange">
									<div class="box">
										<label for="deposit">Deposit :</label>
										<input type="text" class="form-control color-orange" id="deposit" onkeyup="numSeperate(event)" value="<?= $deposit; ?>">
									</div>
								</div>
								<div class="form-group input color-green">
									<div class="box">
										<label for="discount">Discount :</label>
										<input type="text" class="form-control color-green" id="discount" onkeyup="numSeperate(event)" value="<?= $discount; ?>">
									</div>
								</div>
								<div class="form-group input color-purple">
									<div class="box">
										<label for="total">TOTAL :</label>
										<input type="text" class="form-control color-purple" id="total" onkeyup="numSeperate(event)" value="<?= $total; ?>">
									</div>
								</div>
								<div class="form-group input color-red">
									<div class="box">
										<label for="cancel">Cancel :</label>
										<input type="text" class="form-control color-red" id="cancel" onkeyup="numSeperate(event)" value="<?= $cancel; ?>">
									</div>
								</div>
								<div class="form-group input color-red">
									<div class="box">
										<label for="spend">Spend :</label>
										<input type="text" class="form-control color-red" id="spend" onkeyup="numSeperate(event)" value="0">
									</div>
								</div>
								<div class="form-group input">
									<div class="box" style="justify-content: space-between;">
										<button onclick="calInvoice()" type="button" class="btn btn-primary">Calculate</button>
										<button type="submit" class="btn btn-success">Update</button>
										<button onclick="resetValue()" type="button" class="btn btn-danger">Reset</button>
									</div>
								</div>
								<div class="form-group input">
									<div style="margin-bottom: 20px;">
										<label for="note">Note :</label>
										<textarea class="form-control" name="note" id="note" cols="3" rows="3" placeholder="---"><?= $data['note']; ?></textarea>
									</div>
								</div>
								<div class="form-group input">
									<label for="note">Rekening :</label>
									<input id="rekening" type="text" class="form-control desc" style="max-width: 250px; margin:0;" list="rekening-list" value="<?= $rekening; ?>" autocomplete="off">
									<datalist id="rekening-list">
										<option value="putu artana"></option>
										<option value="wayan sutama"></option>
										<option value="komang adi"></option>
									</datalist>
								</div>
							</div>

						</div>

					</div>
			</div>
			<!-- _____________________________________________________________________________ -->

			</form>

		</div>
	</div>
</div>