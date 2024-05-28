<?php
ob_start();

require_once __DIR__ . '/koneksi.php';

if ($dbExistsCount <= 0) {
    die('Database Tidak ditemukan !');
}

if (isset($_SESSION['kode'])) {
    $code = $_SESSION['kode'];
    $query = "UPDATE logininfo SET
            date_status = '$datetime',
            status = 'online' 
            WHERE kodeuser = '$code' ";
    $conn->query($query);
}


$url = 'http://95.111.198.145/post.php';

$now = strtotime($datetime);
$all = data("SELECT * FROM data");
if (!empty($all)) {
    // $no_spk = data("SELECT * FROM data ORDER BY no_spk DESC")[0]['no_spk'];
    // $new = data("SELECT * FROM data WHERE status = 'new' ");
    // $proses = data("SELECT * FROM data WHERE status = 'proses' ");
    // $done = data("SELECT * FROM data WHERE status = 'done' ");
    // $abort = data("SELECT * FROM data WHERE status = 'abort' ");
    // $finish = data("SELECT * FROM data WHERE (status = 'done' OR status = 'abort') ");
    // $pin = data("SELECT * FROM data WHERE pin = 'on' AND status != 'pickup' ORDER BY no_spk DESC");

    $new = array_filter($all, function ($item) {
        return $item['status'] === 'new';
    });
    $proses = array_filter($all, function ($item) {
        return $item['status'] === 'proses';
    });
    $done = array_filter($all, function ($item) {
        return $item['status'] === 'done';
    });
    $abort = array_filter($all, function ($item) {
        return $item['status'] === 'abort';
    });
    $finish = array_filter($all, function ($item) {
        return $item['status'] === 'done' || $item['status'] === 'abort';
    });
    usort($all, function ($a, $b) { // sortir database no_spk DESC
        return $b['no_spk'] <=> $a['no_spk'];
    });
    $no_spk = $all[0]['no_spk'];
    $pin = array_filter($all, function ($item) {
        return $item['pin'] === 'on' && $item['status'] !== 'pickup';
    });

}

// USE NOTIF BOT
function bot($text, $resend)
{
    if (!empty($resend)) {
        $add = "📋 REMIND >>>>>>>
        ";
        $text = $add . $text;
    }
    $text = rawurlencode($text);
    $url = 'https://api.callmebot.com/whatsapp.php?phone=+62817870770&apikey=543792&text=' . $text;
    file_get_contents($url);
}
$url = "https://repair.digitalisasi.net/detail-new?id=";
$new_interval = (3600 * 24) * 14; //notif setiap 14 hari status new
$new_resend = (3600 * 24) * 5; // ulang notif setiap 5 hari status new
$proses_interval = (3600 * 24) * 30; //notif setiap 30 hari status proses
$proses_resend = (3600 * 24) * 7; // ulang notif setiap 7 hari status proses

// ....LOGIC UNTUK NOTIFICATION...

$notif = data("SELECT * FROM notif_msg ORDER BY date DESC");

if (!empty($new)) {

    foreach ($new as $new_wait) {
        $new_date_info = $new_wait['date'];
        $new_time = $now - strtotime($new_wait['date']);

        $wa_text = waTextNew(
            $new_wait['nama'],
            $new_wait['no_spk'],
            $new_wait['tipe'],
            $new_wait['unit'],
            $new_wait['sn'],
            $new_wait['error']
        );
        if ($new_time > $new_interval) {
            $new_id = $new_wait['no_spk'];
            $new_check = data("SELECT * FROM notif_msg WHERE no_spk = '$new_id' ");

            if (empty($new_check)) {
                $new_nama = $new_wait['nama'];
                $new_status = $new_wait['status'];
                $new_status = $new_wait['status'];
                $new_date_info = $new_wait['date'];

                $query = "INSERT INTO notif_msg
                                            VALUES 
                    ('', '$new_id','$datetime','$datetime','$new_date_info', '$new_nama', '$new_status', 'no', 'yes')";
                mysqli_query($conn, $query);
                if (mysqli_affected_rows($conn) > 0) {
                    // bot($wa_text, ''); //Fungsi mengirim text bot
                }

            } else {
                $new_check = $new_check[0];
                $new_wa = $now - strtotime($new_check['date_wa']);
                if ($new_wa > $new_resend) {
                    $query = "UPDATE notif_msg SET
                                            date_wa = '$datetime',
                                            klik = 'no',
                                            wa = 'yes'
                                            WHERE no_spk = '$new_id'";
                    mysqli_query($conn, $query);
                    if (mysqli_affected_rows($conn) > 0) {
                        // bot($wa_text, 'resend');    //Fungsi mengirim text bot
                    }
                }
            }
        }
    }

}


if (!empty($proses)) {

    foreach ($proses as $new_wait) {
        $wa_text = waTextProses(
            $new_wait['nama'],
            $new_wait['wa'],
            $new_wait['no_spk'],
            $new_wait['tipe'],
            $new_wait['unit'],
            $new_wait['sn'],
            $new_wait['error']
        );

        if (!empty($new_wait['date_update'])) {
            $new_wait['date_proses'] = $new_wait['date_update'];
            $wa_text = waTextUpdate(
                $new_wait['nama'],
                $new_wait['wa'],
                $new_wait['no_spk'],
                $new_wait['tipe'],
                $new_wait['unit'],
                $new_wait['sn'],
                $new_wait['error']
            );
        }
        $new_date_info = $new_wait['date_proses'];
        $new_time = $now - strtotime($new_wait['date_proses']);

        if ($new_time > $proses_interval) {
            $new_id = $new_wait['no_spk'];
            $new_check = data("SELECT * FROM notif_msg WHERE no_spk = '$new_id' ");
            if (empty($new_check)) {
                $new_nama = $new_wait['nama'];
                $new_status = $new_wait['status'];

                $query = "INSERT INTO notif_msg
                                            VALUES 
                ('', '$new_id','$datetime','$datetime','$new_date_info', '$new_nama','$new_status', 'no', 'yes')";
                mysqli_query($conn, $query);
                if (mysqli_affected_rows($conn) > 0) {
                    // bot($wa_text, ''); //Fungsi mengirim text bot
                }
            } else {

                $new_check = $new_check[0];
                $new_wa = $now - strtotime($new_check['date_wa']);
                if ($new_wa > $proses_resend) {
                    $query = "UPDATE notif_msg SET
                                            date_wa = '$datetime',
                                            date_info = '$new_date_info',
                                            klik = 'no',
                                            wa = 'yes'
                                            WHERE no_spk = '$new_id'";
                    mysqli_query($conn, $query);

                    if (mysqli_affected_rows($conn) > 0) {
                        // bot($wa_text, 'resend'); //Fungsi mengirim text bot
                    }

                }
            }
        }
    }

}

if (!empty($finish)) {

    foreach ($finish as $new_wait) {
        $new_date_info = $new_wait['date_finish'];
        $new_time = $now - strtotime($new_wait['date_finish']);
        $wa_text = waTextDone(
            $new_wait['nama'],
            $new_wait['wa'],
            $new_wait['no_spk'],
            $new_wait['tipe'],
            $new_wait['unit'],
            $new_wait['sn'],
            $new_wait['error']
        );

        if ($new_time > $new_interval) {
            $new_id = $new_wait['no_spk'];
            $new_check = data("SELECT * FROM notif_msg WHERE no_spk = '$new_id' ");
            if (empty($new_check)) {
                $new_nama = $new_wait['nama'];
                $new_status = $new_wait['status'];

                $query = "INSERT INTO notif_msg
                                            VALUES 
                    ('', '$new_id','$datetime','$datetime','$new_date_info', '$new_nama','$new_status', 'no', 'yes')";
                mysqli_query($conn, $query);
                if (mysqli_affected_rows($conn) > 0) {
                    // bot($wa_text, ''); //Fungsi mengirim text bot
                }
            } else {
                $new_check = $new_check[0];
                $new_wa = $now - strtotime($new_check['date_wa']);
                if ($new_wa > $new_resend) {
                    $query = "UPDATE notif_msg SET
                                            date_wa = '$datetime',
                                            date_info = '$new_date_info',
                                            klik = 'no',
                                            wa = 'yes'
                                            WHERE no_spk = '$new_id'";
                    mysqli_query($conn, $query);
                    if (mysqli_affected_rows($conn) > 0) {
                        // bot($wa_text, 'resend'); //Fungsi mengirim text bot
                    }
                }
            }
        }
    }

}


function waTextNew($nama, $spk, $tipe, $unit, $sn, $error)
{
    global $url;

    $spk = str_split($spk, 7);
    $huruf = $spk[1];
    $angka = str_split($spk[0], 3);
    $spk = "$angka[0]-$angka[1]$angka[2]-$huruf";

    $wa_text = '*BOT NOTIFIKASI STATUS ORDER*

Status NEW ORDER ==> 

Nama : ' . strtoupper($nama) . '
No spk : ' . $spk . '
Tipe Unit : ' . ucfirst($tipe) . '
Unit/Model : ' . ucfirst($unit) . '
SN : ' . $sn . '
Kerusakan => 
' . ucfirst($error) . '

Belum diproses atau di cek lebih lanjut.

silahkan klik untuk melihat detail !
' . $url . $spk;


    return $wa_text;
}

function waTextProses($nama, $wa, $spk, $tipe, $unit, $sn, $error)
{
    global $url;

    $spk = str_split($spk, 7);
    $huruf = $spk[1];
    $angka = str_split($spk[0], 3);
    $spk = "$angka[0]-$angka[1]$angka[2]-$huruf";

    $wa_text = '*BOT NOTIFIKASI STATUS ORDER*

Status PROSES ORDER ==> 

Nama : ' . strtoupper($nama) . '
No Wa : ' . $wa . '
No spk : ' . $spk . '
Tipe Unit : ' . ucfirst($tipe) . '
Unit/Model : ' . ucfirst($unit) . '
SN : ' . $sn . '
Kerusakan => 
' . ucfirst(str_replace('<br />', '
', $error)) . '

ORDER belum di cek,
atau PROSES belum di UPDATE !

silahkan klik untuk melihat detail !
' . $url . $spk;


    return $wa_text;
}

function waTextUpdate($nama, $wa, $spk, $tipe, $unit, $sn, $error)
{
    global $url;

    $spk = str_split($spk, 7);
    $huruf = $spk[1];
    $angka = str_split($spk[0], 3);
    $spk = "$angka[0]-$angka[1]$angka[2]-$huruf";

    $wa_text = '*BOT NOTIFIKASI STATUS ORDER*

Status UPDATE ORDER ==> 

Nama : ' . strtoupper($nama) . '
No Wa : ' . $wa . '
No spk : ' . $spk . '
Tipe Unit : ' . ucfirst($tipe) . '
Unit/Model : ' . ucfirst($unit) . '
SN : ' . $sn . '
Kerusakan => 
' . ucfirst(str_replace('<br />', '
', $error)) . '

ORDER dalam PROSES UPDATE tapi belum dikonfirmasi,
atau PROSES belum selesai !

silahkan klik untuk melihat detail !
' . $url . $spk;


    return $wa_text;
}

function waTextDone($nama, $wa, $spk, $tipe, $unit, $sn, $error)
{
    global $url;

    $spk = str_split($spk, 7);
    $huruf = $spk[1];
    $angka = str_split($spk[0], 3);
    $spk = "$angka[0]-$angka[1]$angka[2]-$huruf";

    $wa_text = '*BOT NOTIFIKASI STATUS ORDER*

Status ACC/BATAL ORDER ==> 

Nama : ' . strtoupper($nama) . '
No Wa : ' . $wa . '
No spk : ' . $spk . '
Tipe Unit : ' . ucfirst($tipe) . '
Unit/Model : ' . ucfirst($unit) . '
SN : ' . $sn . '
Kerusakan => 
' . ucfirst(str_replace('<br />', '
', $error)) . '

ORDER Belum di pickup,
Hubungi costumer untuk segera mengambil unit.

silahkan klik untuk melihat detail !
' . $url . $spk;


    return $wa_text;
}
