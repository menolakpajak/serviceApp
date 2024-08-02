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
        $words['note'][1] = "<p class='syarat mb-0'><strong>1.</strong> Garansi service berlaku untuk kerusakan yang sama dan bukan dari kesalahan pengguna, hingga 1 bulan terhitung dari tanggal invoice ini diterbitkan.</p>";
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
        $words['note'][5] = "<p class='syarat mb-0 text-danger'><strong class='text-dark'>5.</strong> Jika batal akan dikenakan biaya inspeksi Rp.$cancel.</p>";
        $words['note'][6] = "<p class='syarat mb-0'><strong>6.</strong> Harga diatas belum termasuk ongkos kirim.</p>";
        $words['note'][7] = "<p class='syarat mb-0'><strong>7.</strong> Pembayaran bisa di trf ke rekening :</p>";
        $words['note'][8] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[0]</p>";
        $words['note'][9] = "<p class='syarat mb-0 ms-3 fw-bold'>$rek[1]</p>";
    }
}