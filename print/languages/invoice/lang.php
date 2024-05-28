<?php
$words = [];

$words['date'] = 'TGL';
$words['kode'] = 'Kode';
$words['harga'] = 'Harga';
$words['jumlah'] = 'Total';
$words['ppn'] = 'PPN 11%';
$words['status'] = 'LUNAS';
$words['hormat'] = 'Hormat kami,';
$words['status_unit'] = 'On Procces';
$words['result'] = 'Hasil Pengecekan';
if (isset($_GET['en'])) {
    $words['date'] = 'Date';
    $words['kode'] = 'Code';
    $words['harga'] = 'Price';
    $words['jumlah'] = 'Amount';
    $words['ppn'] = 'VAT 11%';
    $words['status'] = 'PAID';
    $words['hormat'] = 'Yours sincerely,';
    $words['result'] = 'Checking Result';
}

if ($detail == 'invoice_for') {
    if (isset($status_unit)) {
        if ($status_unit == 'done') {
            $words['status_unit'] = 'Selesai Service';
        }
        if ($status_unit == 'abort') {
            $words['status_unit'] = 'Batal Service';
        }
    } else {
        $words['status_unit'] = '';
    }
    if ($save_as == 'invoice') {
        $words['note'][0] = "<h6 class='fw-bold'>Note :</h6>";
        $words['note'][1] = "<p class='syarat mb-0'><strong>1.</strong> Garansi service berlaku hingga 1 bulan terhitung dari tanggal invoice ini diterbitkan.</p>";
        $words['note'][2] = "<p class='syarat mb-0'><strong>2.</strong> Proses Cleaning tidak dicover garansi.</p>";
        $words['note'][3] = "<p class='syarat mb-0'><strong>3.</strong> Kami tidak bertanggung jawab atas kerusakan atau kehilangan unit jika pengambilan unit di luar masa garansi service.</p>";
        $words['note'][4] = "<p class='syarat mb-0 text-danger'><strong class='text-dark'>4.</strong> Cek kembali kelengkapan unit anda, sebab kami tidak menerima komplain atas unit yang hilang/tidak lengkap setelah meninggalkan toko.</p>";
        $words['note'][5] = "<p class='syarat mb-0'><strong>5.</strong> Pembayaran bisa di trf ke rekening :</p>";
        $words['note'][6] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[0]</p>";
        $words['note'][7] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[1]</p>";
        if ($status_unit == 'abort') {
            $words['note'] = [];
            $words['note'][0] = "<h6 class='fw-bold'>Note :</h6>";
            $words['note'][1] = "<p class='syarat mb-0'><strong>1.</strong> Pengambilan Unit maksimal 1 minggu setelah invoice ini diterbitkan.</p>";
            $words['note'][2] = "<p class='syarat mb-0'><strong>2.</strong> Kami tidak bertanggung jawab atas kerusakan atau kehilangan unit jika pengambilan unit di atas 1 minggu.</p>";
            $words['note'][3] = "<p class='syarat mb-0 text-danger'><strong class='text-dark'>3.</strong>Cek kembali kelengkapan unit anda, sebab kami tidak menerima komplain atas unit yang hilang/tidak lengkap setelah meninggalkan toko.</p>";
            $words['note'][4] = "<p class='syarat mb-0'><strong>4.</strong> Pembayaran bisa di trf ke rekening :</p>";
            $words['note'][5] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[0]</p>";
            $words['note'][6] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[1]</p>";
        }
    } else {
        $words['note'][0] = "<h6 class='fw-bold'>Syarat dan ketentuan :</h6>";
        $words['note'][1] = "<p class='syarat mb-0'><strong>1.</strong> Membayar DP sebesar <strong class='text-primary'>($dp)</strong>, 50% dari total biaya.</p>";
        $words['note'][2] = "<p class='syarat mb-0'><strong>2.</strong> Penawaran berlaku s/d 14 hari kalender.</p>";
        $words['note'][3] = "<p class='syarat mb-0'><strong>3.</strong> Jika tidak ada konfirmasi maka akan dianggap batal.</p>";
        $words['note'][4] = "<p class='syarat mb-0'><strong>4.</strong> Harap melakukan pelunasan sebelum pengiriman atau pengambilan unit.</p>";
        $words['note'][5] = "<p class='syarat mb-0 text-danger'><strong class='text-dark'>5.</strong> Jika batal akan dikenakan biaya inspeksi Rp.150.000 .</p>";
        $words['note'][6] = "<p class='syarat mb-0'><strong>6.</strong> Harga diatas belum termasuk ongkos kirim.</p>";
        $words['note'][7] = "<p class='syarat mb-0'><strong>7.</strong> Pembayaran bisa di trf ke rekening :</p>";
        $words['note'][8] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[0]</p>";
        $words['note'][9] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[1]</p>";
        $words['note'][10] = "<p class='syarat mb-0'><strong>10.</strong> Harga sudah termasuk PPN .</p>";
    }
    if (isset($_GET['en'])) {
        if ($status_unit == 'done') {
            $words['status_unit'] = 'Done';
        }
        if ($status_unit == 'abort') {
            $words['status_unit'] = 'Canceled';
        }
        if ($save_as == 'invoice') {
            $words['note'][0] = "<h6 class='fw-bold'>Note :</h6>";
            $words['note'][1] = "<p class='syarat mb-0'><strong>1.</strong> The service warranty is valid for 1 month from the date this invoice is issued.</p>";
            $words['note'][2] = "<p class='syarat mb-0'><strong>2.</strong> The cleaning process is not covered by the warranty.</p>";
            $words['note'][3] = "<p class='syarat mb-0'><strong>3.</strong> We are not responsible for any damage or loss of the unit if the unit is collected outside the warranty service period.</p>";
            $words['note'][4] = "<p class='syarat mb-0 text-danger'><strong class='text-dark'>4.</strong> Please double-check the completeness of your unit, as we do not accept complaints about missing/incomplete units after leaving the store.</p>";
            $words['note'][5] = "<p class='syarat mb-0'><strong>5.</strong> Payments can be transferred to the following bank account:</p>";
            $words['note'][6] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[0]</p>";
            $words['note'][7] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[1]</p>";
            if ($status_unit == 'abort') {
                $words['note'] = [];
                $words['note'][0] = "<h6 class='fw-bold'>Note :</h6>";
                $words['note'][1] = "<p class='syarat mb-0'><strong>1.</strong> Unit must be collected within a maximum of 1 week after this invoice is issued.</p>";
                $words['note'][2] = "<p class='syarat mb-0'><strong>2.</strong> We are not responsible for any damage or loss of the unit if the unit is collected after 1 week.</p>";
                $words['note'][3] = "<p class='syarat mb-0 text-danger'><strong class='text-dark'>3.</strong>Please double-check the completeness of your unit, as we do not accept complaints about missing/incomplete units after leaving the store.</p>";
                $words['note'][4] = "<p class='syarat mb-0'><strong>4.</strong> Payments can be transferred to the following bank account:</p>";
                $words['note'][5] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[0]</p>";
                $words['note'][6] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[1]</p>";
            }
        } else {
            $words['note'][0] = "<h6 class='fw-bold'>Terms and conditions:</h6>";
            $words['note'][1] = "<p class='syarat mb-0'><strong>1.</strong> Paying a deposit of  <strong class='text-primary'>($dp)</strong>, which is 50% of the total cost.</p>";
            $words['note'][2] = "<p class='syarat mb-0'><strong>2.</strong> The offer is valid until 14 calendar days.</p>";
            $words['note'][3] = "<p class='syarat mb-0'><strong>3.</strong> If no confirmation is received, it will be considered as canceled.</p>";
            $words['note'][4] = "<p class='syarat mb-0'><strong>4.</strong> Please settle the remaining payment before the delivery or collection of the unit.</p>";
            $words['note'][5] = "<p class='syarat mb-0 text-danger'><strong class='text-dark'>5.</strong> Cancellation will incur an inspection fee of Rp.150,000.</p>";
            $words['note'][6] = "<p class='syarat mb-0'><strong>6.</strong> The above price does not include shipping costs.</p>";
            $words['note'][7] = "<p class='syarat mb-0'><strong>7.</strong> Payments can be transferred to the following bank account:</p>";
            $words['note'][8] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[0]</p>";
            $words['note'][9] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[1]</p>";
            $words['note'][10] = "<p class='syarat mb-0'><strong>10.</strong> The price already includes VAT (Value Added Tax).</p>";
        }
    }
}
?>