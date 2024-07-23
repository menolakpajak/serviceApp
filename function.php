<?php
ob_start();
// require 'koneksi.php';
require_once __DIR__ . '/koneksi.php';

// Fungsi notif BOT
function bot($text)
{
    $add = "📋 NOTIF FROM SERVER >>>>>>>
";
    $text = $add . $text;
    $text = rawurlencode($text);
    $url = 'https://api.callmebot.com/whatsapp.php?phone=+62817870770&apikey=543792&text=' . $text;
    file_get_contents($url);
}

//FUNGSI MERUBAH STATUS KLIK PADA notif_msg
function klik_notif($no_spk)
{
    global $conn;
    $query = "UPDATE notif_msg SET 
                        klik = 'yes',
                        wa = 'no'
                    WHERE no_spk = '$no_spk'";
    $conn->query($query);
}

// FUNGSI TAMBAH DATA.......>>>

function input($order)
{
    global $conn;
    global $datetime;
    if (empty($order['date'])) {
        $date = $datetime;
    } else {
        $date = date('Y-m-d H:i', strtotime($order['date']));
    }

    $str = "ABCDEFGHJKLMNPRSTUVWXYZ";
    // $no_spk =  time(). substr(str_shuffle($str), 0, 4);
    $no_spk = floor(time() / 1000) . substr(str_shuffle($str), 0, 4);
    $nama = htmlspecialchars($order['nama']);
    if (substr($order['wa'], 0, 1) == 0) {
        $order['wa'] = '62' . ltrim($order['wa'], '0');
    }

    $log = array();
    $isi_log = array();
    $isi_log['date'] = $date;
    $isi_log['status'] = 'input';
    $isi_log['action'] = 'input';
    $isi_log['detail'] = ["start input new data"];
    $isi_log['user'] = $_SESSION['kode'];

    array_push($log, $isi_log);
    $log = json_encode($log, JSON_PRETTY_PRINT);
    $log = mysqli_real_escape_string($conn, $log);

    $wa = htmlspecialchars($order['wa']);
    $no_tlp = htmlspecialchars($order['no_tlp']);
    $alamat = htmlspecialchars($order['alamat']);
    $tipe_unit = htmlspecialchars($order['tipe_unit']);
    $unit = htmlspecialchars($order['unit']);
    $serial_number = htmlspecialchars($order['serial_number']);
    $counter = $_SESSION['counter'];
    $pin = htmlspecialchars($order['pin']);
    $note = htmlentities($order['note'], ENT_QUOTES, 'UTF-8');
    $penerima = $_SESSION['kode'];
    $error = htmlentities($order['error'], ENT_QUOTES, 'UTF-8');

    $kelengkapan = array();
    $kelengkapan['check_kamera'] = htmlspecialchars($order['check_kamera']);
    $kelengkapan['check_kamera_info'] = htmlspecialchars($order['check_kamera_info']);
    $kelengkapan['check_lensa'] = htmlspecialchars($order['check_lensa']);
    $kelengkapan['check_lensa_info'] = htmlspecialchars($order['check_lensa_info']);
    $kelengkapan['check_battery'] = htmlspecialchars($order['check_battery']);
    $kelengkapan['check_battery_info'] = htmlspecialchars($order['check_battery_info']);
    $kelengkapan['check_memory'] = htmlspecialchars($order['check_memory']);
    $kelengkapan['check_memory_info'] = htmlspecialchars($order['check_memory_info']);
    $kelengkapan['check_strap'] = htmlspecialchars($order['check_strap']);
    $kelengkapan['check_strap_info'] = htmlspecialchars($order['check_strap_info']);
    $kelengkapan['check_bodycap'] = htmlspecialchars($order['check_bodycap']);
    $kelengkapan['check_bodycap_info'] = htmlspecialchars($order['check_bodycap_info']);
    $kelengkapan['check_lenscap'] = htmlspecialchars($order['check_lenscap']);
    $kelengkapan['check_lenscap_info'] = htmlspecialchars($order['check_lenscap_info']);
    $kelengkapan['check_filter'] = htmlspecialchars($order['check_filter']);
    $kelengkapan['check_filter_info'] = htmlspecialchars($order['check_filter_info']);
    $kelengkapan['other'] = htmlspecialchars($order['other']);
    $kelengkapan = json_encode($kelengkapan, JSON_PRETTY_PRINT);
    $json = $conn->real_escape_string($kelengkapan);

    $query = "INSERT INTO data (no_spk,date,counter,nama,alamat,wa,no_tlp,tipe,unit,sn,error,pin,note,status,penerima,kelengkapan,log)
                    VALUES 
                    ('$no_spk',
                    '$date',
                    '$counter', 
                    '$nama',
                    '$alamat',
                    '$wa',
                    '$no_tlp',
                    '$tipe_unit',
                    '$unit',
                    '$serial_number',
                    '$error',
                    '$pin',
                    '$note',
                    'new',
                    '$penerima',
                    '$json',
                    '$log')";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);
    if (mysqli_affected_rows($conn) > 0) {
        $url_bot = urlencode(encrypt($no_spk));
        $text = '
Input Baru ==>

NO SPK : ' . $no_spk . '
NAMA : ' . $nama . '
UNIT : ' . $unit . '
ERROR : ' . $error . '
LINK : https://repair.digitalisasi.net/receipt?spk=' . $url_bot;
        bot($text);
        return 'ok';
    } else {
        return $result;
    }
}


// FUNGSI EDIT DATA

// EDIT NEW

function editNew($order)
{
    global $conn;
    global $datetime;
    $id = $order['no_spk'];
    $data = data("SELECT * FROM data WHERE no_spk = '$id' ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $data = $data[0];
    if ($data['status'] !== 'new') {
        return 'Data telah berubah status, refresh aplikasi anda !';
    }
    $data2 = json_decode($data['kelengkapan'], true);
    $prev_log = json_decode($data['log'], true);

    $log = array();
    $log['date'] = $datetime;
    $log['status'] = 'new';
    $log['action'] = 'edit';
    $log['detail'] = [];
    $log['user'] = $_SESSION['kode'];


    $order['date'] = date('Y-m-d H:i:s', strtotime($order['date']));
    if ($data['date'] != $order['date']) {
        array_push($log['detail'], 'Date : ' . $data['date'] . ' => ' . $order['date']);
        $date = date('Y-m-d H:i:s', strtotime($order['date']));
    } else {
        $date = $data['date'];
    }
    if ($data['nama'] != $order['nama']) {
        array_push($log['detail'], 'Nama : ' . $data['nama'] . ' => ' . $order['nama']);
    }
    if ($data['wa'] != $order['wa']) {
        array_push($log['detail'], 'No wa : ' . $data['wa'] . ' => ' . $order['wa']);
    }
    if ($data['no_tlp'] != $order['no_tlp']) {
        array_push($log['detail'], 'No tlp : ' . $data['no_tlp'] . ' => ' . $order['no_tlp']);
    }
    if ($data['alamat'] != $order['alamat']) {
        array_push($log['detail'], 'Alamat : ' . $data['alamat'] . ' => ' . $order['alamat']);
    }
    if ($data['tipe'] != $order['tipe_unit']) {
        array_push($log['detail'], 'Tipe Unit : ' . $data['tipe'] . ' => ' . $order['tipe_unit']);
    }
    if ($data['unit'] != $order['unit']) {
        array_push($log['detail'], 'Unit : ' . $data['unit'] . ' => ' . $order['unit']);
    }
    if ($data['sn'] != $order['serial_number']) {
        array_push($log['detail'], 'Serial Number : ' . $data['sn'] . ' => ' . $order['serial_number']);
    }
    if ($data['counter'] != $order['counter']) {
        array_push($log['detail'], 'Counter : ' . $data['counter'] . ' => ' . $order['counter']);
    }
    if ($data['pin'] != $order['pin']) {
        array_push($log['detail'], 'Pin : ' . $data['pin'] . ' => ' . $order['pin']);
    }
    if ($data['note'] != $order['note']) {
        array_push($log['detail'], 'Note : ' . $data['note'] . ' => ' . $order['note']);
    }

    if ($data2['check_kamera'] != $order['check_kamera']) {
        if ($data2['check_kamera'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_kamera'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Kamera : ' . $from . ' => ' . $to);
    }
    if ($data2['check_lensa'] != $order['check_lensa']) {
        if ($data2['check_lensa'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_lensa'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Lensa : ' . $from . ' => ' . $to);
    }
    if ($data2['check_battery'] != $order['check_battery']) {
        if ($data2['check_battery'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_battery'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Battery : ' . $from . ' => ' . $to);
    }
    if ($data2['check_memory'] != $order['check_memory']) {
        if ($data2['check_memory'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_memory'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Memory : ' . $from . ' => ' . $to);
    }
    if ($data2['check_strap'] != $order['check_strap']) {
        if ($data2['check_strap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_strap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Strap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_bodycap'] != $order['check_bodycap']) {
        if ($data2['check_bodycap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_bodycap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Bodycap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_lenscap'] != $order['check_lenscap']) {
        if ($data2['check_lenscap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_lenscap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Lenscap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_filter'] != $order['check_filter']) {
        if ($data2['check_filter'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_filter'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'filter : ' . $from . ' => ' . $to);
    }
    if ($data2['check_kamera_info'] != $order['check_kamera_info']) {
        array_push($log['detail'], 'Kamera info : ' . $data2['check_kamera_info'] . ' => ' . $order['check_kamera_info']);
    }
    if ($data2['check_lensa_info'] != $order['check_lensa_info']) {
        array_push($log['detail'], 'Lensa info : ' . $data2['check_lensa_info'] . ' => ' . $order['check_lensa_info']);
    }
    if ($data2['check_battery_info'] != $order['check_battery_info']) {
        array_push($log['detail'], 'Battery info : ' . $data2['check_battery_info'] . ' => ' . $order['check_battery_info']);
    }
    if ($data2['check_memory_info'] != $order['check_memory_info']) {
        array_push($log['detail'], 'Memory info : ' . $data2['check_memory_info'] . ' => ' . $order['check_memory_info']);
    }
    if ($data2['check_strap_info'] != $order['check_strap_info']) {
        array_push($log['detail'], 'Strap info : ' . $data2['check_strap_info'] . ' => ' . $order['check_strap_info']);
    }
    if ($data2['check_bodycap_info'] != $order['check_bodycap_info']) {
        array_push($log['detail'], 'Bodycap info : ' . $data2['check_bodycap_info'] . ' => ' . $order['check_bodycap_info']);
    }
    if ($data2['check_lenscap_info'] != $order['check_lenscap_info']) {
        array_push($log['detail'], 'Lenscap info : ' . $data2['check_lenscap_info'] . ' => ' . $order['check_lenscap_info']);
    }
    if ($data2['check_filter_info'] != $order['check_filter_info']) {
        array_push($log['detail'], 'Filter info : ' . $data2['check_filter_info'] . ' => ' . $order['check_filter_info']);
    }

    if ($data2['other'] != $order['other']) {
        array_push($log['detail'], 'Other : ' . $data2['other'] . ' => ' . $order['other']);
    }

    if ($data['error'] != $order['error']) {
        array_push($log['detail'], 'Kerusakan : ' . $data['error'] . ' => ' . $order['error']);
    }

    if (empty($log['detail'])) {
        return 'tidak ada perubahan !';
    }

    array_push($prev_log, $log);
    $log = json_encode($prev_log, JSON_PRETTY_PRINT);
    $log = mysqli_real_escape_string($conn, $log);


    $nama = htmlspecialchars($order['nama']);
    if (substr($order['wa'], 0, 1) == 0) {
        $order['wa'] = '62' . ltrim($order['wa'], '0');
    }
    $wa = htmlspecialchars($order['wa']);
    $no_tlp = htmlspecialchars($order['no_tlp']);
    $alamat = htmlspecialchars($order['alamat']);
    $tipe_unit = htmlspecialchars($order['tipe_unit']);
    $unit = htmlspecialchars($order['unit']);
    $serial_number = htmlspecialchars($order['serial_number']);
    $counter = htmlspecialchars($order['counter']);
    $pin = htmlspecialchars($order['pin']);
    $note = htmlentities($order['note'], ENT_QUOTES, 'UTF-8');
    if (!in_array($_SESSION['akses'], ['master', 'admin'])) {
        $counter = $data['counter'];
    }


    $kelengkapan = array();
    $kelengkapan['check_kamera'] = htmlspecialchars($order['check_kamera']);
    $kelengkapan['check_kamera_info'] = htmlspecialchars($order['check_kamera_info']);
    $kelengkapan['check_lensa'] = htmlspecialchars($order['check_lensa']);
    $kelengkapan['check_lensa_info'] = htmlspecialchars($order['check_lensa_info']);
    $kelengkapan['check_battery'] = htmlspecialchars($order['check_battery']);
    $kelengkapan['check_battery_info'] = htmlspecialchars($order['check_battery_info']);
    $kelengkapan['check_memory'] = htmlspecialchars($order['check_memory']);
    $kelengkapan['check_memory_info'] = htmlspecialchars($order['check_memory_info']);
    $kelengkapan['check_strap'] = htmlspecialchars($order['check_strap']);
    $kelengkapan['check_strap_info'] = htmlspecialchars($order['check_strap_info']);
    $kelengkapan['check_bodycap'] = htmlspecialchars($order['check_bodycap']);
    $kelengkapan['check_bodycap_info'] = htmlspecialchars($order['check_bodycap_info']);
    $kelengkapan['check_lenscap'] = htmlspecialchars($order['check_lenscap']);
    $kelengkapan['check_lenscap_info'] = htmlspecialchars($order['check_lenscap_info']);
    $kelengkapan['check_filter'] = htmlspecialchars($order['check_filter']);
    $kelengkapan['check_filter_info'] = htmlspecialchars($order['check_filter_info']);
    $kelengkapan['other'] = htmlspecialchars($order['other']);
    $kelengkapan = json_encode($kelengkapan, JSON_PRETTY_PRINT);
    $json = mysqli_real_escape_string($conn, $kelengkapan);

    $error = htmlentities($order['error'], ENT_QUOTES, 'UTF-8');


    $query = "UPDATE data SET 
                        date = '$date',
                        nama = '$nama',
                        alamat = '$alamat',
                        wa = '$wa',
                        no_tlp = '$no_tlp',
                        tipe = '$tipe_unit',
                        unit = '$unit',
                        sn = '$serial_number',
                        counter = '$counter',
                        pin = '$pin',
                        note = '$note',
                        error = '$error',
                        kelengkapan = '$json',
                        log = '$log'
                    WHERE no_spk = '$id' ";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        if (empty($result)) {
            return 'Anda Tidak Melakukan Perubahan !';
        }
    }
    return $result;
}
;

// EDIT PROSES
function editProses($order)
{
    global $conn;
    global $datetime;
    $id = $order['no_spk'];
    $data = data("SELECT * FROM data WHERE no_spk = '$id' ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $data = $data[0];
    if ($data['status'] !== 'proses') {
        return 'Data telah berubah status, refresh aplikasi anda !';
    }
    $service_at = htmlspecialchars($order['service_at']);
    $cek_sc = data("SELECT * FROM service_center WHERE nama = '$service_at' ");
    if (empty($cek_sc)) {
        return 'Service Center yang anda pilih Belum terdaftar !';
    }
    $service_at = $cek_sc[0]['kode'];

    $data2 = json_decode($data['kelengkapan'], true);
    $prev_log = json_decode($data['log'], true);

    $log = array();
    $log['date'] = $datetime;
    $log['status'] = 'proses';
    $log['action'] = 'edit';
    $log['detail'] = [];
    $log['user'] = $_SESSION['kode'];


    $order['date'] = date('Y-m-d H:i:s', strtotime($order['date']));
    $order['date_proses'] = date('Y-m-d H:i:s', strtotime($order['date_proses']));
    if (!empty($order['date_update'])) {
        $order['date_update'] = date('Y-m-d H:i:s', strtotime($order['date_update']));
    }
    if ($data['date'] != $order['date']) {
        array_push($log['detail'], 'Date : ' . $data['date'] . ' => ' . $order['date']);
        $date = date('Y-m-d H:i:s', strtotime($order['date']));
    } else {
        $date = $data['date'];
    }
    if ($data['date_proses'] != $order['date_proses']) {
        array_push($log['detail'], 'Date Proses : ' . $data['date_proses'] . ' => ' . $order['date_proses']);
        $date_proses = date('Y-m-d H:i:s', strtotime($order['date_proses']));
    } else {
        $date_proses = $data['date_proses'];
    }
    if (!empty($order['date_update'])) {
        if ($data['date_update'] != $order['date_update']) {
            array_push($log['detail'], 'Date Update : ' . $data['date_update'] . ' => ' . $order['date_update']);
            $date_update = 'date_update = \'' . date('Y-m-d H:i:s', strtotime($order['date_update'])) . '\',';
        } else {
            $date_update = 'date_update = \'' . $data['date_update'] . '\',';
        }
    } else {
        $date_update = '';
    }

    if ($data['nama'] != $order['nama']) {
        array_push($log['detail'], 'Nama : ' . $data['nama'] . ' => ' . $order['nama']);
    }
    if ($data['wa'] != $order['wa']) {
        array_push($log['detail'], 'No wa : ' . $data['wa'] . ' => ' . $order['wa']);
    }
    if ($data['no_tlp'] != $order['no_tlp']) {
        array_push($log['detail'], 'No tlp : ' . $data['no_tlp'] . ' => ' . $order['no_tlp']);
    }
    if ($data['alamat'] != $order['alamat']) {
        array_push($log['detail'], 'Alamat : ' . $data['alamat'] . ' => ' . $order['alamat']);
    }
    if ($data['tipe'] != $order['tipe_unit']) {
        array_push($log['detail'], 'Tipe Unit : ' . $data['tipe'] . ' => ' . $order['tipe_unit']);
    }
    if ($data['unit'] != $order['unit']) {
        array_push($log['detail'], 'Unit : ' . $data['unit'] . ' => ' . $order['unit']);
    }
    if ($data['sn'] != $order['serial_number']) {
        array_push($log['detail'], 'Serial Number : ' . $data['sn'] . ' => ' . $order['serial_number']);
    }
    if ($data['counter'] != $order['counter']) {
        array_push($log['detail'], 'Counter : ' . $data['counter'] . ' => ' . $order['counter']);
    }
    if ($data['pin'] != $order['pin']) {
        array_push($log['detail'], 'Pin : ' . $data['pin'] . ' => ' . $order['pin']);
    }
    if ($data['note'] != $order['note']) {
        array_push($log['detail'], 'Note : ' . $data['note'] . ' => ' . $order['note']);
    }
    if ($data['service_at'] != $service_at) {
        array_push($log['detail'], 'Service At : ' . $data['service_at'] . ' => ' . $service_at);
    }
    if ($data['result'] != $order['result']) {
        array_push($log['detail'], 'Hasil Pengecekan : ' . $data['result'] . ' => ' . $order['result']);
    }
    if ($data['cost'] != $order['cost']) {
        array_push($log['detail'], 'Estimasi Biaya : ' . $data['cost'] . ' => ' . $order['cost']);
    }
    if ($data['acc'] != $order['acc']) {
        array_push($log['detail'], 'ACC : ' . $data['acc'] . ' => ' . $order['acc']);
    }


    if ($data2['check_kamera'] != $order['check_kamera']) {
        if ($data2['check_kamera'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_kamera'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Kamera : ' . $from . ' => ' . $to);
    }
    if ($data2['check_lensa'] != $order['check_lensa']) {
        if ($data2['check_lensa'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_lensa'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Lensa : ' . $from . ' => ' . $to);
    }
    if ($data2['check_battery'] != $order['check_battery']) {
        if ($data2['check_battery'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_battery'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Battery : ' . $from . ' => ' . $to);
    }
    if ($data2['check_memory'] != $order['check_memory']) {
        if ($data2['check_memory'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_memory'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Memory : ' . $from . ' => ' . $to);
    }
    if ($data2['check_strap'] != $order['check_strap']) {
        if ($data2['check_strap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_strap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Strap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_bodycap'] != $order['check_bodycap']) {
        if ($data2['check_bodycap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_bodycap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Bodycap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_lenscap'] != $order['check_lenscap']) {
        if ($data2['check_lenscap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_lenscap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Lenscap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_filter'] != $order['check_filter']) {
        if ($data2['check_filter'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_filter'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'filter : ' . $from . ' => ' . $to);
    }
    if ($data2['check_kamera_info'] != $order['check_kamera_info']) {
        array_push($log['detail'], 'Kamera info : ' . $data2['check_kamera_info'] . ' => ' . $order['check_kamera_info']);
    }
    if ($data2['check_lensa_info'] != $order['check_lensa_info']) {
        array_push($log['detail'], 'Lensa info : ' . $data2['check_lensa_info'] . ' => ' . $order['check_lensa_info']);
    }
    if ($data2['check_battery_info'] != $order['check_battery_info']) {
        array_push($log['detail'], 'Battery info : ' . $data2['check_battery_info'] . ' => ' . $order['check_battery_info']);
    }
    if ($data2['check_memory_info'] != $order['check_memory_info']) {
        array_push($log['detail'], 'Memory info : ' . $data2['check_memory_info'] . ' => ' . $order['check_memory_info']);
    }
    if ($data2['check_strap_info'] != $order['check_strap_info']) {
        array_push($log['detail'], 'Strap info : ' . $data2['check_strap_info'] . ' => ' . $order['check_strap_info']);
    }
    if ($data2['check_bodycap_info'] != $order['check_bodycap_info']) {
        array_push($log['detail'], 'Bodycap info : ' . $data2['check_bodycap_info'] . ' => ' . $order['check_bodycap_info']);
    }
    if ($data2['check_lenscap_info'] != $order['check_lenscap_info']) {
        array_push($log['detail'], 'Lenscap info : ' . $data2['check_lenscap_info'] . ' => ' . $order['check_lenscap_info']);
    }
    if ($data2['check_filter_info'] != $order['check_filter_info']) {
        array_push($log['detail'], 'Filter info : ' . $data2['check_filter_info'] . ' => ' . $order['check_filter_info']);
    }
    if ($data2['other'] != $order['other']) {
        array_push($log['detail'], 'Other : ' . $data2['other'] . ' => ' . $order['other']);
    }

    if ($data['error'] != $order['error']) {
        array_push($log['detail'], 'Kerusakan : ' . $data['error'] . ' => ' . $order['error']);
    }

    if (empty($log['detail'])) {
        return 'tidak ada perubahan !';
    }


    array_push($prev_log, $log);
    $log = json_encode($prev_log, JSON_PRETTY_PRINT);
    $log = mysqli_real_escape_string($conn, $log);


    $nama = htmlspecialchars($order['nama']);
    if (substr($order['wa'], 0, 1) == 0) {
        $order['wa'] = '62' . ltrim($order['wa'], '0');
    }
    $wa = htmlspecialchars($order['wa']);
    $no_tlp = htmlspecialchars($order['no_tlp']);
    $alamat = htmlspecialchars($order['alamat']);
    $tipe_unit = htmlspecialchars($order['tipe_unit']);
    $unit = htmlspecialchars($order['unit']);
    $serial_number = htmlspecialchars($order['serial_number']);
    $counter = htmlspecialchars($order['counter']);
    $pin = htmlspecialchars($order['pin']);
    $note = htmlentities($order['note'], ENT_QUOTES, 'UTF-8');
    $result = htmlentities($order['result'], ENT_QUOTES, 'UTF-8');
    $cost = htmlentities($order['cost'], ENT_QUOTES, 'UTF-8');
    $acc = htmlspecialchars($order['acc']);

    // if(empty($date_update)){
    //     $date_update = null;
    // }

    $kelengkapan = array();
    $kelengkapan['check_kamera'] = htmlspecialchars($order['check_kamera']);
    $kelengkapan['check_kamera_info'] = htmlspecialchars($order['check_kamera_info']);
    $kelengkapan['check_lensa'] = htmlspecialchars($order['check_lensa']);
    $kelengkapan['check_lensa_info'] = htmlspecialchars($order['check_lensa_info']);
    $kelengkapan['check_battery'] = htmlspecialchars($order['check_battery']);
    $kelengkapan['check_battery_info'] = htmlspecialchars($order['check_battery_info']);
    $kelengkapan['check_memory'] = htmlspecialchars($order['check_memory']);
    $kelengkapan['check_memory_info'] = htmlspecialchars($order['check_memory_info']);
    $kelengkapan['check_strap'] = htmlspecialchars($order['check_strap']);
    $kelengkapan['check_strap_info'] = htmlspecialchars($order['check_strap_info']);
    $kelengkapan['check_bodycap'] = htmlspecialchars($order['check_bodycap']);
    $kelengkapan['check_bodycap_info'] = htmlspecialchars($order['check_bodycap_info']);
    $kelengkapan['check_lenscap'] = htmlspecialchars($order['check_lenscap']);
    $kelengkapan['check_lenscap_info'] = htmlspecialchars($order['check_lenscap_info']);
    $kelengkapan['check_filter'] = htmlspecialchars($order['check_filter']);
    $kelengkapan['check_filter_info'] = htmlspecialchars($order['check_filter_info']);
    $kelengkapan['other'] = htmlspecialchars($order['other']);
    $kelengkapan = json_encode($kelengkapan, JSON_PRETTY_PRINT);
    $json = mysqli_real_escape_string($conn, $kelengkapan);

    $error = htmlentities($order['error'], ENT_QUOTES, 'UTF-8');


    $query = "UPDATE data SET 
                        date = '$date',
                        date_proses = '$date_proses',
                        $date_update
                        nama = '$nama',
                        alamat = '$alamat',
                        wa = '$wa',
                        no_tlp = '$no_tlp',
                        tipe = '$tipe_unit',
                        unit = '$unit',
                        sn = '$serial_number',
                        counter = '$counter',
                        pin = '$pin',
                        service_at = '$service_at',
                        result = '$result',
                        cost = '$cost',
                        acc = '$acc',
                        note = '$note',
                        error = '$error',
                        kelengkapan = '$json',
                        log = '$log'
                    WHERE no_spk = '$id' ";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        if (empty($result)) {
            return 'Anda Tidak Melakukan Perubahan !';
        }
    }
    return $result;
}
;


// EDIT DONE
function editDone($order)
{
    global $conn;
    global $datetime;
    $id = $order['no_spk'];
    $data = data("SELECT * FROM data WHERE no_spk = '$id' ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $data = $data[0];
    if ($data['status'] !== 'done') {
        return 'Data telah berubah status, refresh aplikasi anda !';
    }
    $service_at = htmlspecialchars($order['service_at']);
    $cek_sc = data("SELECT * FROM service_center WHERE nama = '$service_at' ");
    if (empty($cek_sc)) {
        return 'Service Center yang anda pilih Belum terdaftar !';
    }
    $service_at = $cek_sc[0]['kode'];

    $data2 = json_decode($data['kelengkapan'], true);
    $prev_log = json_decode($data['log'], true);

    $log = array();
    $log['date'] = $datetime;
    $log['status'] = 'done';
    $log['action'] = 'edit';
    $log['detail'] = [];
    $log['user'] = $_SESSION['kode'];


    $order['date'] = date('Y-m-d H:i:s', strtotime($order['date']));
    $order['date_proses'] = date('Y-m-d H:i:s', strtotime($order['date_proses']));
    $order['date_update'] = date('Y-m-d H:i:s', strtotime($order['date_update']));
    $order['date_finish'] = date('Y-m-d H:i:s', strtotime($order['date_finish']));
    if ($data['date'] != $order['date']) {
        array_push($log['detail'], 'Date : ' . $data['date'] . ' => ' . $order['date']);
        $date = date('Y-m-d H:i:s', strtotime($order['date']));
    } else {
        $date = $data['date'];
    }
    if ($data['date_proses'] != $order['date_proses']) {
        array_push($log['detail'], 'Date Proses : ' . $data['date_proses'] . ' => ' . $order['date_proses']);
        $date_proses = date('Y-m-d H:i:s', strtotime($order['date_proses']));
    } else {
        $date_proses = $data['date_proses'];
    }
    if ($data['date_update'] != $order['date_update']) {
        array_push($log['detail'], 'Date Update : ' . $data['date_update'] . ' => ' . $order['date_update']);
        $date_update = date('Y-m-d H:i:s', strtotime($order['date_update']));
    } else {
        $date_update = $data['date_update'];
    }
    if ($data['date_finish'] != $order['date_finish']) {
        array_push($log['detail'], 'Date Finish : ' . $data['date_finish'] . ' => ' . $order['date_finish']);
        $date_finish = date('Y-m-d H:i:s', strtotime($order['date_finish']));
    } else {
        $date_finish = $data['date_finish'];
    }

    if ($data['nama'] != $order['nama']) {
        array_push($log['detail'], 'Nama : ' . $data['nama'] . ' => ' . $order['nama']);
    }
    if ($data['wa'] != $order['wa']) {
        array_push($log['detail'], 'No wa : ' . $data['wa'] . ' => ' . $order['wa']);
    }
    if ($data['no_tlp'] != $order['no_tlp']) {
        array_push($log['detail'], 'No tlp : ' . $data['no_tlp'] . ' => ' . $order['no_tlp']);
    }
    if ($data['alamat'] != $order['alamat']) {
        array_push($log['detail'], 'Alamat : ' . $data['alamat'] . ' => ' . $order['alamat']);
    }
    if ($data['tipe'] != $order['tipe_unit']) {
        array_push($log['detail'], 'Tipe Unit : ' . $data['tipe'] . ' => ' . $order['tipe_unit']);
    }
    if ($data['unit'] != $order['unit']) {
        array_push($log['detail'], 'Unit : ' . $data['unit'] . ' => ' . $order['unit']);
    }
    if ($data['sn'] != $order['serial_number']) {
        array_push($log['detail'], 'Serial Number : ' . $data['sn'] . ' => ' . $order['serial_number']);
    }
    if ($data['counter'] != $order['counter']) {
        array_push($log['detail'], 'Counter : ' . $data['counter'] . ' => ' . $order['counter']);
    }
    if ($data['pin'] != $order['pin']) {
        array_push($log['detail'], 'Pin : ' . $data['pin'] . ' => ' . $order['pin']);
    }
    if ($data['note'] != $order['note']) {
        array_push($log['detail'], 'Note : ' . $data['note'] . ' => ' . $order['note']);
    }
    if ($data['service_at'] != $service_at) {
        array_push($log['detail'], 'Service At : ' . $data['service_at'] . ' => ' . $service_at);
    }
    if ($data['result'] != $order['result']) {
        array_push($log['detail'], 'Hasil Pengecekan : ' . $data['result'] . ' => ' . $order['result']);
    }
    if ($data['cost'] != $order['cost']) {
        array_push($log['detail'], 'Estimasi Biaya : ' . $data['cost'] . ' => ' . $order['cost']);
    }
    if ($data['acc'] != $order['acc']) {
        array_push($log['detail'], 'ACC : ' . $data['acc'] . ' => ' . $order['acc']);
    }


    if ($data2['check_kamera'] != $order['check_kamera']) {
        if ($data2['check_kamera'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_kamera'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Kamera : ' . $from . ' => ' . $to);
    }
    if ($data2['check_lensa'] != $order['check_lensa']) {
        if ($data2['check_lensa'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_lensa'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Lensa : ' . $from . ' => ' . $to);
    }
    if ($data2['check_battery'] != $order['check_battery']) {
        if ($data2['check_battery'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_battery'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Battery : ' . $from . ' => ' . $to);
    }
    if ($data2['check_memory'] != $order['check_memory']) {
        if ($data2['check_memory'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_memory'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Memory : ' . $from . ' => ' . $to);
    }
    if ($data2['check_strap'] != $order['check_strap']) {
        if ($data2['check_strap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_strap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Strap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_bodycap'] != $order['check_bodycap']) {
        if ($data2['check_bodycap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_bodycap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Bodycap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_lenscap'] != $order['check_lenscap']) {
        if ($data2['check_lenscap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_lenscap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Lenscap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_filter'] != $order['check_filter']) {
        if ($data2['check_filter'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_filter'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'filter : ' . $from . ' => ' . $to);
    }
    if ($data2['check_kamera_info'] != $order['check_kamera_info']) {
        array_push($log['detail'], 'Kamera info : ' . $data2['check_kamera_info'] . ' => ' . $order['check_kamera_info']);
    }
    if ($data2['check_lensa_info'] != $order['check_lensa_info']) {
        array_push($log['detail'], 'Lensa info : ' . $data2['check_lensa_info'] . ' => ' . $order['check_lensa_info']);
    }
    if ($data2['check_battery_info'] != $order['check_battery_info']) {
        array_push($log['detail'], 'Battery info : ' . $data2['check_battery_info'] . ' => ' . $order['check_battery_info']);
    }
    if ($data2['check_memory_info'] != $order['check_memory_info']) {
        array_push($log['detail'], 'Memory info : ' . $data2['check_memory_info'] . ' => ' . $order['check_memory_info']);
    }
    if ($data2['check_strap_info'] != $order['check_strap_info']) {
        array_push($log['detail'], 'Strap info : ' . $data2['check_strap_info'] . ' => ' . $order['check_strap_info']);
    }
    if ($data2['check_bodycap_info'] != $order['check_bodycap_info']) {
        array_push($log['detail'], 'Bodycap info : ' . $data2['check_bodycap_info'] . ' => ' . $order['check_bodycap_info']);
    }
    if ($data2['check_lenscap_info'] != $order['check_lenscap_info']) {
        array_push($log['detail'], 'Lenscap info : ' . $data2['check_lenscap_info'] . ' => ' . $order['check_lenscap_info']);
    }
    if ($data2['check_filter_info'] != $order['check_filter_info']) {
        array_push($log['detail'], 'Filter info : ' . $data2['check_filter_info'] . ' => ' . $order['check_filter_info']);
    }
    if ($data2['other'] != $order['other']) {
        array_push($log['detail'], 'Other : ' . $data2['other'] . ' => ' . $order['other']);
    }

    if ($data['error'] != $order['error']) {
        array_push($log['detail'], 'Kerusakan : ' . $data['error'] . ' => ' . $order['error']);
    }

    if (empty($log['detail'])) {
        return 'tidak ada perubahan !';
    }


    array_push($prev_log, $log);
    $log = json_encode($prev_log, JSON_PRETTY_PRINT);
    $log = mysqli_real_escape_string($conn, $log);


    $nama = htmlspecialchars($order['nama']);
    if (substr($order['wa'], 0, 1) == 0) {
        $order['wa'] = '62' . ltrim($order['wa'], '0');
    }
    $wa = htmlspecialchars($order['wa']);
    $no_tlp = htmlspecialchars($order['no_tlp']);
    $alamat = htmlspecialchars($order['alamat']);
    $tipe_unit = htmlspecialchars($order['tipe_unit']);
    $unit = htmlspecialchars($order['unit']);
    $serial_number = htmlspecialchars($order['serial_number']);
    $counter = htmlspecialchars($order['counter']);
    $pin = htmlspecialchars($order['pin']);
    $note = htmlentities($order['note'], ENT_QUOTES, 'UTF-8');
    $result = htmlentities($order['result'], ENT_QUOTES, 'UTF-8');
    $cost = htmlentities($order['cost'], ENT_QUOTES, 'UTF-8');
    $acc = htmlspecialchars($order['acc']);

    $kelengkapan = array();
    $kelengkapan['check_kamera'] = htmlspecialchars($order['check_kamera']);
    $kelengkapan['check_kamera_info'] = htmlspecialchars($order['check_kamera_info']);
    $kelengkapan['check_lensa'] = htmlspecialchars($order['check_lensa']);
    $kelengkapan['check_lensa_info'] = htmlspecialchars($order['check_lensa_info']);
    $kelengkapan['check_battery'] = htmlspecialchars($order['check_battery']);
    $kelengkapan['check_battery_info'] = htmlspecialchars($order['check_battery_info']);
    $kelengkapan['check_memory'] = htmlspecialchars($order['check_memory']);
    $kelengkapan['check_memory_info'] = htmlspecialchars($order['check_memory_info']);
    $kelengkapan['check_strap'] = htmlspecialchars($order['check_strap']);
    $kelengkapan['check_strap_info'] = htmlspecialchars($order['check_strap_info']);
    $kelengkapan['check_bodycap'] = htmlspecialchars($order['check_bodycap']);
    $kelengkapan['check_bodycap_info'] = htmlspecialchars($order['check_bodycap_info']);
    $kelengkapan['check_lenscap'] = htmlspecialchars($order['check_lenscap']);
    $kelengkapan['check_lenscap_info'] = htmlspecialchars($order['check_lenscap_info']);
    $kelengkapan['check_filter'] = htmlspecialchars($order['check_filter']);
    $kelengkapan['check_filter_info'] = htmlspecialchars($order['check_filter_info']);
    $kelengkapan['other'] = htmlspecialchars($order['other']);
    $kelengkapan = json_encode($kelengkapan, JSON_PRETTY_PRINT);
    $json = mysqli_real_escape_string($conn, $kelengkapan);

    $error = htmlentities($order['error'], ENT_QUOTES, 'UTF-8');


    $query = "UPDATE data SET 
                        date = '$date',
                        date_proses = '$date_proses',
                        date_update = '$date_update',
                        date_finish = '$date_finish',
                        nama = '$nama',
                        alamat = '$alamat',
                        wa = '$wa',
                        no_tlp = '$no_tlp',
                        tipe = '$tipe_unit',
                        unit = '$unit',
                        sn = '$serial_number',
                        counter = '$counter',
                        pin = '$pin',
                        service_at = '$service_at',
                        result = '$result',
                        cost = '$cost',
                        acc = '$acc',
                        note = '$note',
                        error = '$error',
                        kelengkapan = '$json',
                        log = '$log'
                    WHERE no_spk = '$id' ";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        if (empty($result)) {
            return 'Anda Tidak Melakukan Perubahan !';
        }
    }
    return $result;
}
;

// EDIT ABORT
function editAbort($order)
{
    global $conn;
    global $datetime;
    $id = $order['no_spk'];
    $data = data("SELECT * FROM data WHERE no_spk = '$id' ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $data = $data[0];
    if ($data['status'] !== 'abort') {
        return 'Data telah berubah status, refresh aplikasi anda !';
    }
    $service_at = htmlspecialchars($order['service_at']);
    $cek_sc = data("SELECT * FROM service_center WHERE nama = '$service_at' ");
    if (empty($cek_sc)) {
        return 'Service Center yang anda pilih Belum terdaftar !';
    }
    $service_at = $cek_sc[0]['kode'];

    $data2 = json_decode($data['kelengkapan'], true);
    $prev_log = json_decode($data['log'], true);

    $log = array();
    $log['date'] = $datetime;
    $log['status'] = 'abort';
    $log['action'] = 'edit';
    $log['detail'] = [];
    $log['user'] = $_SESSION['kode'];


    $order['date'] = date('Y-m-d H:i:s', strtotime($order['date']));
    $order['date_proses'] = date('Y-m-d H:i:s', strtotime($order['date_proses']));
    $order['date_update'] = date('Y-m-d H:i:s', strtotime($order['date_update']));
    $order['date_finish'] = date('Y-m-d H:i:s', strtotime($order['date_finish']));
    if ($data['date'] != $order['date']) {
        array_push($log['detail'], 'Date : ' . $data['date'] . ' => ' . $order['date']);
        $date = date('Y-m-d H:i:s', strtotime($order['date']));
    } else {
        $date = $data['date'];
    }
    if ($data['date_proses'] != $order['date_proses']) {
        array_push($log['detail'], 'Date Proses : ' . $data['date_proses'] . ' => ' . $order['date_proses']);
        $date_proses = date('Y-m-d H:i:s', strtotime($order['date_proses']));
    } else {
        $date_proses = $data['date_proses'];
    }
    if ($data['date_update'] != $order['date_update']) {
        array_push($log['detail'], 'Date Update : ' . $data['date_update'] . ' => ' . $order['date_update']);
        $date_update = date('Y-m-d H:i:s', strtotime($order['date_update']));
    } else {
        $date_update = $data['date_update'];
    }
    if ($data['date_finish'] != $order['date_finish']) {
        array_push($log['detail'], 'Date Finish : ' . $data['date_finish'] . ' => ' . $order['date_finish']);
        $date_finish = date('Y-m-d H:i:s', strtotime($order['date_finish']));
    } else {
        $date_finish = $data['date_finish'];
    }

    if ($data['nama'] != $order['nama']) {
        array_push($log['detail'], 'Nama : ' . $data['nama'] . ' => ' . $order['nama']);
    }
    if ($data['wa'] != $order['wa']) {
        array_push($log['detail'], 'No wa : ' . $data['wa'] . ' => ' . $order['wa']);
    }
    if ($data['no_tlp'] != $order['no_tlp']) {
        array_push($log['detail'], 'No tlp : ' . $data['no_tlp'] . ' => ' . $order['no_tlp']);
    }
    if ($data['alamat'] != $order['alamat']) {
        array_push($log['detail'], 'Alamat : ' . $data['alamat'] . ' => ' . $order['alamat']);
    }
    if ($data['tipe'] != $order['tipe_unit']) {
        array_push($log['detail'], 'Tipe Unit : ' . $data['tipe'] . ' => ' . $order['tipe_unit']);
    }
    if ($data['unit'] != $order['unit']) {
        array_push($log['detail'], 'Unit : ' . $data['unit'] . ' => ' . $order['unit']);
    }
    if ($data['sn'] != $order['serial_number']) {
        array_push($log['detail'], 'Serial Number : ' . $data['sn'] . ' => ' . $order['serial_number']);
    }
    if ($data['counter'] != $order['counter']) {
        array_push($log['detail'], 'Counter : ' . $data['counter'] . ' => ' . $order['counter']);
    }
    if ($data['pin'] != $order['pin']) {
        array_push($log['detail'], 'Pin : ' . $data['pin'] . ' => ' . $order['pin']);
    }
    if ($data['note'] != $order['note']) {
        array_push($log['detail'], 'Note : ' . $data['note'] . ' => ' . $order['note']);
    }
    if ($data['service_at'] != $service_at) {
        array_push($log['detail'], 'Service At : ' . $data['service_at'] . ' => ' . $service_at);
    }
    if ($data['result'] != $order['result']) {
        array_push($log['detail'], 'Hasil Pengecekan : ' . $data['result'] . ' => ' . $order['result']);
    }
    if ($data['cost'] != $order['cost']) {
        array_push($log['detail'], 'Estimasi Biaya : ' . $data['cost'] . ' => ' . $order['cost']);
    }
    if ($data['acc'] != $order['acc']) {
        array_push($log['detail'], 'ACC : ' . $data['acc'] . ' => ' . $order['acc']);
    }


    if ($data2['check_kamera'] != $order['check_kamera']) {
        if ($data2['check_kamera'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_kamera'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Kamera : ' . $from . ' => ' . $to);
    }
    if ($data2['check_lensa'] != $order['check_lensa']) {
        if ($data2['check_lensa'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_lensa'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Lensa : ' . $from . ' => ' . $to);
    }
    if ($data2['check_battery'] != $order['check_battery']) {
        if ($data2['check_battery'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_battery'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Battery : ' . $from . ' => ' . $to);
    }
    if ($data2['check_memory'] != $order['check_memory']) {
        if ($data2['check_memory'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_memory'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Memory : ' . $from . ' => ' . $to);
    }
    if ($data2['check_strap'] != $order['check_strap']) {
        if ($data2['check_strap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_strap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Strap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_bodycap'] != $order['check_bodycap']) {
        if ($data2['check_bodycap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_bodycap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Bodycap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_lenscap'] != $order['check_lenscap']) {
        if ($data2['check_lenscap'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_lenscap'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'Lenscap : ' . $from . ' => ' . $to);
    }
    if ($data2['check_filter'] != $order['check_filter']) {
        if ($data2['check_filter'] === 'on') {
            $from = 'check';
        } else {
            $from = 'uncheck';
        }
        if ($order['check_filter'] === 'on') {
            $to = 'check';
        } else {
            $to = 'uncheck';
        }
        array_push($log['detail'], 'filter : ' . $from . ' => ' . $to);
    }
    if ($data2['check_kamera_info'] != $order['check_kamera_info']) {
        array_push($log['detail'], 'Kamera info : ' . $data2['check_kamera_info'] . ' => ' . $order['check_kamera_info']);
    }
    if ($data2['check_lensa_info'] != $order['check_lensa_info']) {
        array_push($log['detail'], 'Lensa info : ' . $data2['check_lensa_info'] . ' => ' . $order['check_lensa_info']);
    }
    if ($data2['check_battery_info'] != $order['check_battery_info']) {
        array_push($log['detail'], 'Battery info : ' . $data2['check_battery_info'] . ' => ' . $order['check_battery_info']);
    }
    if ($data2['check_memory_info'] != $order['check_memory_info']) {
        array_push($log['detail'], 'Memory info : ' . $data2['check_memory_info'] . ' => ' . $order['check_memory_info']);
    }
    if ($data2['check_strap_info'] != $order['check_strap_info']) {
        array_push($log['detail'], 'Strap info : ' . $data2['check_strap_info'] . ' => ' . $order['check_strap_info']);
    }
    if ($data2['check_bodycap_info'] != $order['check_bodycap_info']) {
        array_push($log['detail'], 'Bodycap info : ' . $data2['check_bodycap_info'] . ' => ' . $order['check_bodycap_info']);
    }
    if ($data2['check_lenscap_info'] != $order['check_lenscap_info']) {
        array_push($log['detail'], 'Lenscap info : ' . $data2['check_lenscap_info'] . ' => ' . $order['check_lenscap_info']);
    }
    if ($data2['check_filter_info'] != $order['check_filter_info']) {
        array_push($log['detail'], 'Filter info : ' . $data2['check_filter_info'] . ' => ' . $order['check_filter_info']);
    }
    if ($data2['other'] != $order['other']) {
        array_push($log['detail'], 'Other : ' . $data2['other'] . ' => ' . $order['other']);
    }

    if ($data['error'] != $order['error']) {
        array_push($log['detail'], 'Kerusakan : ' . $data['error'] . ' => ' . $order['error']);
    }


    if (empty($log['detail'])) {
        return 'tidak ada perubahan !';
    }


    array_push($prev_log, $log);
    $log = json_encode($prev_log, JSON_PRETTY_PRINT);
    $log = mysqli_real_escape_string($conn, $log);


    $nama = htmlspecialchars($order['nama']);
    if (substr($order['wa'], 0, 1) == 0) {
        $order['wa'] = '62' . ltrim($order['wa'], '0');
    }
    $wa = htmlspecialchars($order['wa']);
    $no_tlp = htmlspecialchars($order['no_tlp']);
    $alamat = htmlspecialchars($order['alamat']);
    $tipe_unit = htmlspecialchars($order['tipe_unit']);
    $unit = htmlspecialchars($order['unit']);
    $serial_number = htmlspecialchars($order['serial_number']);
    $counter = htmlspecialchars($order['counter']);
    $pin = htmlspecialchars($order['pin']);
    $note = htmlentities($order['note'], ENT_QUOTES, 'UTF-8');
    $result = htmlentities($order['result'], ENT_QUOTES, 'UTF-8');
    $cost = htmlentities($order['cost'], ENT_QUOTES, 'UTF-8');
    $acc = htmlspecialchars($order['acc']);

    $kelengkapan = array();
    $kelengkapan['check_kamera'] = htmlspecialchars($order['check_kamera']);
    $kelengkapan['check_kamera_info'] = htmlspecialchars($order['check_kamera_info']);
    $kelengkapan['check_lensa'] = htmlspecialchars($order['check_lensa']);
    $kelengkapan['check_lensa_info'] = htmlspecialchars($order['check_lensa_info']);
    $kelengkapan['check_battery'] = htmlspecialchars($order['check_battery']);
    $kelengkapan['check_battery_info'] = htmlspecialchars($order['check_battery_info']);
    $kelengkapan['check_memory'] = htmlspecialchars($order['check_memory']);
    $kelengkapan['check_memory_info'] = htmlspecialchars($order['check_memory_info']);
    $kelengkapan['check_strap'] = htmlspecialchars($order['check_strap']);
    $kelengkapan['check_strap_info'] = htmlspecialchars($order['check_strap_info']);
    $kelengkapan['check_bodycap'] = htmlspecialchars($order['check_bodycap']);
    $kelengkapan['check_bodycap_info'] = htmlspecialchars($order['check_bodycap_info']);
    $kelengkapan['check_lenscap'] = htmlspecialchars($order['check_lenscap']);
    $kelengkapan['check_lenscap_info'] = htmlspecialchars($order['check_lenscap_info']);
    $kelengkapan['check_filter'] = htmlspecialchars($order['check_filter']);
    $kelengkapan['check_filter_info'] = htmlspecialchars($order['check_filter_info']);
    $kelengkapan['other'] = htmlspecialchars($order['other']);
    $kelengkapan = json_encode($kelengkapan, JSON_PRETTY_PRINT);
    $json = mysqli_real_escape_string($conn, $kelengkapan);

    $error = htmlentities($order['error'], ENT_QUOTES, 'UTF-8');


    $query = "UPDATE data SET 
                        date = '$date',
                        date_proses = '$date_proses',
                        date_update = '$date_update',
                        date_finish = '$date_finish',
                        nama = '$nama',
                        alamat = '$alamat',
                        wa = '$wa',
                        no_tlp = '$no_tlp',
                        tipe = '$tipe_unit',
                        unit = '$unit',
                        sn = '$serial_number',
                        counter = '$counter',
                        pin = '$pin',
                        service_at = '$service_at',
                        result = '$result',
                        cost = '$cost',
                        acc = '$acc',
                        note = '$note',
                        error = '$error',
                        kelengkapan = '$json',
                        log = '$log'
                    WHERE no_spk = '$id' ";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        if (empty($result)) {
            return 'Anda Tidak Melakukan Perubahan !';
        }
    }
    return $result;
}
;

// UPDATE PROSES

function update($order)
{
    global $conn;
    global $datetime;
    $id = $order['no_spk'];
    $data = data("SELECT * FROM data WHERE no_spk = '$id' ");
    if (empty($data)) {
        return 'Data tidak ditemukan, mungkin telah terhapus !';
    }
    $data = $data[0];

    if ($data['status'] !== 'proses') {
        return 'Data telah berubah status, refresh aplikasi anda !';
    }

    $service_at = htmlspecialchars($order['service_at']);
    $cek_sc = data("SELECT * FROM service_center WHERE nama = '$service_at' ");
    if (empty($cek_sc)) {
        return 'Service Center yang anda pilih Belum terdaftar !';
    }
    $service_at = $cek_sc[0]['kode'];

    $result = htmlentities($order['result'], ENT_QUOTES, 'UTF-8');
    $cost = htmlentities($order['cost'], ENT_QUOTES, 'UTF-8');
    $acc = htmlspecialchars($order['acc']);



    $query = "UPDATE data SET 
                    service_at = '$service_at',
                    date_update = '$datetime',
                    result = '$result',
                    cost = '$cost',
                    acc = '$acc'
                WHERE no_spk = '$id' ";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);


    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        return $result;
    }

}
;


// RUBAH STATUS NEW KE PROSES

function proses($order)
{
    global $datetime;
    global $conn;
    $id = $order['no_spk'];

    $data = data("SELECT * FROM data WHERE no_spk = '$id' ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $data = $data[0];
    $prev_log = json_decode($data['log'], true);

    $log = array();
    $log['date'] = $datetime;
    $log['status'] = 'new';
    $log['action'] = 'move';
    $log['detail'] = [];
    $log['user'] = $_SESSION['kode'];

    array_push($log['detail'], 'Perpindahan status dari NEW => PROSES');

    array_push($prev_log, $log);
    $log = json_encode($prev_log, JSON_PRETTY_PRINT);
    $log = mysqli_real_escape_string($conn, $log);

    $query = "UPDATE data SET 
                service_at = 'SNR',
                date_proses = '$datetime',
                log = '$log',
                status = 'proses'
            WHERE no_spk = '$id' ";
    mysqli_query($conn, $query);
    $result = mysqli_error($conn);


    if (mysqli_affected_rows($conn) > 0) {
        $notif = data("SELECT * FROM notif_msg WHERE no_spk = '$id' ");
        if (!empty($notif)) {
            $query = "DELETE FROM notif_msg WHERE no_spk = '$id' ";
        }
        mysqli_query($conn, $query);
        return 'ok';
    } else {
        return $result;
    }


}

// RUBAH STATUS PROSES KE DONE

function done($order)
{
    global $datetime;
    global $conn;
    $id = $order['no_spk'];

    $data = data("SELECT * FROM data WHERE no_spk = '$id' ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $data = $data[0];
    if (empty($data['date_update'])) {
        return 'Anda tidak bisa merubah STATUS sebelum ada UPDATE proses !';
    }
    $prev_log = json_decode($data['log'], true);

    $log = array();
    $log['date'] = $datetime;
    $log['status'] = 'proses';
    $log['action'] = 'move';
    $log['detail'] = [];
    $log['user'] = $_SESSION['kode'];

    array_push($log['detail'], 'Perpindahan status dari PROSES => DONE');

    array_push($prev_log, $log);
    $log = json_encode($prev_log, JSON_PRETTY_PRINT);
    $log = mysqli_real_escape_string($conn, $log);

    $query = "UPDATE data SET 
                    date_finish = '$datetime',
                    log = '$log',
                    status = 'done'
                WHERE no_spk = '$id' ";
    mysqli_query($conn, $query);
    $result = mysqli_error($conn);


    if (mysqli_affected_rows($conn) > 0) {
        $notif = data("SELECT * FROM notif_msg WHERE no_spk = '$id' ");
        if (!empty($notif)) {
            $query = "DELETE FROM notif_msg WHERE no_spk = '$id' ";
        }
        mysqli_query($conn, $query);
        return 'ok';
    } else {
        return $result;
    }
}

// RUBAH STATUS PROSES KE ABORT

function abort($order)
{
    global $datetime;
    global $conn;
    $id = $order['no_spk'];

    $data = data("SELECT * FROM data WHERE no_spk = '$id' ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $data = $data[0];
    if (empty($data['date_update'])) {
        return 'Anda tidak bisa merubah STATUS sebelum ada UPDATE proses !';
    }
    $prev_log = json_decode($data['log'], true);

    $log = array();
    $log['date'] = $datetime;
    $log['status'] = 'proses';
    $log['action'] = 'move';
    $log['detail'] = [];
    $log['user'] = $_SESSION['kode'];

    array_push($log['detail'], 'Perpindahan status dari PROSES => ABORT');

    array_push($prev_log, $log);
    $log = json_encode($prev_log, JSON_PRETTY_PRINT);
    $log = mysqli_real_escape_string($conn, $log);

    $query = "UPDATE data SET 
            date_finish = '$datetime',
            acc = '',
            log = '$log',
            status = 'abort'
        WHERE no_spk = '$id' ";
    mysqli_query($conn, $query);
    $result = mysqli_error($conn);


    if (mysqli_affected_rows($conn) > 0) {
        $notif = data("SELECT * FROM notif_msg WHERE no_spk = '$id' ");
        if (!empty($notif)) {
            $query = "DELETE FROM notif_msg WHERE no_spk = '$id' ";
        }
        mysqli_query($conn, $query);
        return 'ok';
    } else {
        return $result;
    }
}

// RUBAH STATUS DONE KE PICKUP

function pickup($order)
{
    global $datetime;
    global $conn;
    $id = $order['no_spk'];

    $data = data("SELECT * FROM data WHERE no_spk = '$id' ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $data = $data[0];
    $status = strtoupper($data['status']);
    $prev_log = json_decode($data['log'], true);

    $log = array();
    $log['date'] = $datetime;
    $log['status'] = 'proses';
    $log['action'] = 'move';
    $log['detail'] = [];
    $log['user'] = $_SESSION['kode'];

    array_push($log['detail'], "Perpindahan status dari $status => PICKUP");

    array_push($prev_log, $log);
    $log = json_encode($prev_log, JSON_PRETTY_PRINT);
    $log = mysqli_real_escape_string($conn, $log);


    $date = $data['date'];
    $date_proses = $data['date_proses'];
    $date_update = $data['date_update'];
    $date_finish = $data['date_finish'];
    $date_pickup = $datetime;
    $counter = $data['counter'];
    $service_at = $data['service_at'];
    $location = $data['location'];
    $nama = $data['nama'];
    $alamat = $data['alamat'];
    $wa = $data['wa'];
    $no_tlp = $data['no_tlp'];
    $tipe_unit = $data['tipe'];
    $unit = $data['unit'];
    $serial_number = $data['sn'];
    $pin = $data['pin'];
    $note = $data['note'];
    $result = $data['result'];
    $cost = $data['cost'];
    $acc = $data['acc'];
    $penerima = $data['penerima'];
    $time_line = $data['time_line'];
    $signature = $data['signature'];
    $invoice = $data['invoice'];
    $surat_jalan = $data['surat_jalan'];
    $status = $data['status'];
    $kelengkapan = $data['kelengkapan'];
    $error = $data['error'];

    $query = "INSERT INTO pickup (no_spk, date, date_proses,date_update,date_finish,date_pickup,counter,service_at,location,nama,alamat,wa,no_tlp,tipe,unit,sn,error,result,cost,acc,note,pin,status,penerima,kelengkapan,signature,time_line,invoice,surat_jalan,log)
        
    VALUES('$id','$date','$date_proses','$date_update','$date_finish','$date_pickup','$counter','$service_at','$location', '$nama','$alamat','$wa','$no_tlp','$tipe_unit','$unit','$serial_number','$error','$result','$cost','$acc','$note','$pin','$status','$penerima','$kelengkapan','$signature','$time_line','$invoice','$surat_jalan','$log')";

    $deleteData = "DELETE FROM data WHERE no_spk = '$id'";

    // Memulai transaksi
    $conn->begin_transaction();


    try {
        // Melakukan query INSERT
        if ($conn->query($query) === TRUE) {
            // Melakukan query DELETE
            if ($conn->query($deleteData) === TRUE) {
                // Commit transaksi jika keduanya berhasil
                $conn->commit();
                echo 'ok';
            } else {
                throw new Exception("Error in DELETE query: " . $conn->error);
            }
        } else {
            throw new Exception("Error in INSERT query: " . $conn->error);
        }
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
    // >>>>>>>
}

// RUBAH STATUS KEMBALI KE PROSES

function backProses($order)
{
    global $datetime;
    global $conn;
    $id = $order['no_spk'];

    $data = data("SELECT * FROM data WHERE no_spk = '$id' ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $data = $data[0];
    $prev_log = json_decode($data['log'], true);
    $status = strtoupper($data['status']);
    
    $log = array();
    $log['date'] = $datetime;
    $log['status'] = $data['status'];
    $log['action'] = 'move';
    $log['detail'] = [];
    $log['user'] = $_SESSION['kode'];

    array_push($log['detail'], "Perpindahan status dari $status kembali ke => PROSES");

    array_push($prev_log, $log);
    $log = json_encode($prev_log, JSON_PRETTY_PRINT);
    $log = mysqli_real_escape_string($conn, $log);

    $query = "UPDATE data SET 
                    log = '$log',
                    status = 'proses'
                WHERE no_spk = '$id' ";
    mysqli_query($conn, $query);
    $result = mysqli_error($conn);


    if (mysqli_affected_rows($conn) > 0) {
        $notif = data("SELECT * FROM notif_msg WHERE no_spk = '$id' ");
        if (!empty($notif)) {
            $query = "DELETE FROM notif_msg WHERE no_spk = '$id' ";
        }
        mysqli_query($conn, $query);
        return 'ok';
    } else {
        return $result;
    }
}

// FUNGSI DELETE DATA

function delete($order)
{
    $id = $order['no_spk'];
    global $conn;
    $query = "DELETE FROM data WHERE no_spk = '$id' ";
    mysqli_query($conn, $query);
    $result = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        $notif = data("SELECT * FROM notif_msg WHERE no_spk = '$id' ");
        if (!empty($notif)) {
            $query = "DELETE FROM notif_msg WHERE no_spk = '$id' ";
        }
        mysqli_query($conn, $query);
        return 'ok';
    } else {
        return $result;
    }
}


// FUNGSI SERVICE CENTER.......>>>

// input service center
function inputServiceCenter($order)
{
    global $conn;
    global $datetime;
    if (empty($order['date'])) {
        $date = $datetime;
    } else {
        $date = date('Y-m-d H:i:s', strtotime($order['date']));
    }

    if (empty($order['kode'])) {
        $str = "ABCDEFGHIJKLMNOPRSTUVWXYZ1234567890";
        $kode_sc = substr(str_shuffle($str), 0, 6);
    } else {
        $kode_sc = $order['kode'];
    }

    $nama = htmlspecialchars($order['nama']);
    $up_to = htmlspecialchars($order['up_to']);
    $no_tlp = htmlentities($order['no_tlp'], ENT_QUOTES, 'UTF-8');
    $alamat = htmlentities($order['alamat'], ENT_QUOTES, 'UTF-8');
    $unit = htmlspecialchars($order['unit']);
    $legal_name = htmlspecialchars($order['legal_name']);
    $rek_number = htmlentities($order['rek_number'], ENT_QUOTES, 'UTF-8');
    $note = htmlentities($order['note'], ENT_QUOTES, 'UTF-8');

    $query = "INSERT INTO service_center (date,kode,nama,up_to,no_tlp,alamat,unit,legal_name,rek_number,note)
                    VALUES 
                    ('$date',
                    '$kode_sc', 
                    '$nama',
                    '$up_to',
                    '$no_tlp',
                    '$alamat',
                    '$unit',
                    '$legal_name',
                    '$rek_number',
                    '$note')";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        return $result;
    }
}

// edit service center
function editServiceCenter($order)
{
    global $conn;
    $id = $order['kode'];
    $data = data("SELECT * FROM service_center WHERE kode = '$id' ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $data = $data[0];

    $nama = htmlspecialchars($order['nama']);
    $up_to = htmlspecialchars($order['up_to']);
    $no_tlp = htmlentities($order['no_tlp'], ENT_QUOTES, 'UTF-8');
    $alamat = htmlentities($order['alamat'], ENT_QUOTES, 'UTF-8');
    $unit = htmlspecialchars($order['unit']);
    $legal_name = htmlspecialchars($order['legal_name']);
    $rek_number = htmlentities($order['rek_number'], ENT_QUOTES, 'UTF-8');
    $note = htmlentities($order['note'], ENT_QUOTES, 'UTF-8');


    $query = "UPDATE service_center SET 
                    nama = '$nama',
                    up_to = '$up_to',
                    no_tlp = '$no_tlp',
                    alamat = '$alamat',
                    unit = '$unit',
                    legal_name = '$legal_name',
                    rek_number = '$rek_number',
                    note = '$note'
                WHERE kode = '$id' ";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        if (empty($result)) {
            return 'Anda Tidak Melakukan Perubahan !';
        }
    }
    return $result;
}
;

//DELETE SERVICE CENTER
function deleteServiceCenter($order)
{
    global $conn;
    $kode = $order['kode'];
    $data = data("SELECT * FROM service_center WHERE kode = '$kode'");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }

    $query = "DELETE FROM service_center WHERE kode = '$kode' ";
    mysqli_query($conn, $query);
    $result = mysqli_error($conn);
    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        return $result;
    }
}


// FUNGSI USER.......>>>

// input User
function inputNewUser($order)
{
    global $conn;
    global $datetime;
    $code = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890%&*?!@";
    $token = substr(str_shuffle($code), 0, 40);

    if (empty($order['kode'])) {
        die('kolom KODE USER tidak boleh kosong !');
    }
    if (empty($order['akses'])) {
        die('kolom AKSES Belum Dipilih !');
    }
    if (empty($order['username'])) {
        die('kolom USERNAME tidak boleh kosong !');
    }
    if (empty($order['counter'])) {
        die('kolom COUNTER tidak boleh kosong !');
    }

    $kode = removeSpecialChar($order['kode']);
    $akses = htmlspecialchars($order['akses']);
    $counter = htmlspecialchars($order['counter']);
    $role = htmlspecialchars($order['role']);
    $username = htmlspecialchars($order['username']);
    $pwd = '0000';
    $password = password_hash($pwd, PASSWORD_DEFAULT);

    $query = "INSERT INTO logininfo (username,password,akses,counter,token,role,nama,kodeuser,date_status,status)
                    VALUES 
                    ('$username',
                    '$password', 
                    '$akses',
                    '$counter',
                    '$token',
                    '$role',
                    '$username',
                    '$kode',
                    '$datetime',
                    'offline')";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        return $result;
    }
}

//DELETE User
function deleteUser($order)
{
    global $conn;
    $kode = $order['kode'];
    $data = data("SELECT * FROM logininfo WHERE kodeuser = '$kode'");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }

    $query = "DELETE FROM logininfo WHERE kodeuser = '$kode' ";
    mysqli_query($conn, $query);
    $result = mysqli_error($conn);
    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        return $result;
    }
}

//RESET password User
function resetUserPwd($order)
{
    global $conn;
    $kode = $order['kode'];
    $data = data("SELECT * FROM logininfo WHERE kodeuser = '$kode'");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }
    $code = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890%&*?!@";
    $token = substr(str_shuffle($code), 0, 40);
    $password = password_hash('0000', PASSWORD_DEFAULT);

    $query = "UPDATE logininfo SET 
        token = '$token',
        password = '$password'
    WHERE kodeuser = '$kode' ";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);
    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        return $result;
    }
}

// edit user
function editUser($order)
{
    global $conn;

    $id = $order['id'];
    $kode = $order['kode'];
    $data = data("SELECT * FROM logininfo WHERE id = $id ");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }

    if (empty($order['kode'])) {
        die('kolom KODE USER tidak boleh kosong !');
    }
    if (empty($order['akses'])) {
        die('kolom AKSES Belum Dipilih !');
    }
    if (empty($order['username'])) {
        die('kolom USERNAME tidak boleh kosong !');
    }
    if (empty($order['counter'])) {
        die('kolom COUNTER tidak boleh kosong !');
    }

    $kode = removeSpecialChar($order['kode']);
    $akses = htmlspecialchars($order['akses']);
    $counter = htmlspecialchars($order['counter']);
    $role = htmlspecialchars($order['role']);
    $username = htmlspecialchars($order['username']);


    $query = "UPDATE logininfo SET 
                    kodeuser = '$kode',
                    akses = '$akses',
                    counter = '$counter',
                    role = '$role',
                    username = '$username'
                WHERE id = $id ";

    mysqli_query($conn, $query);
    $result = mysqli_error($conn);

    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        if (empty($result)) {
            return 'Anda Tidak Melakukan Perubahan !';
        }
    }
    return $result;
}
;


//FUNGSI INVOICE
//input nota
function inputNota($order)
{
    global $conn;
    global $datetime;
    if (empty($order['date'])) {
        $date = $datetime;
    } else {
        $date = date('Y-m-d H:i', strtotime($order['date']));
    }

    $str = "ABCDEFGHJKLMNPRSTUVWXYZ";
    $no_spk = date('Ymd', strtotime($datetime)) . substr(str_shuffle($str), 0, 3);

    // $link = $order['link'];
    $qts = $order['qts'];
    $admin = $_SESSION['nama'];
    $kode_inv = $order['kode'];
    $desc = $order['desc'];
    $buy = $order['buy'];
    $margin = $order['margin'];
    $sell = $order['sell'];
    $profit = $order['profit'];
    $subtotal = $order['subtotal'];
    $dpp = $order['dpp'];
    $ppn = $order['ppn'];
    $deposit = $order['deposit'];
    $total = $order['total'];
    $note = htmlentities($order['note'], ENT_QUOTES, 'UTF-8');
    $saveas = htmlspecialchars($order['saveas']);


    $json_desc = mysqli_real_escape_string($conn, $desc);
    $json_kode = mysqli_real_escape_string($conn, $kode_inv);

    $query = "INSERT INTO invoice (date,kode,admin,qts,kode_part,deskripsi,buy,margin,sell,profit,subtotal,dpp,ppn,deposit,total,save_as,status,note)
                    VALUES 
                    ('$date',
                    '$no_spk',
                    '$admin',
                    '$qts',
                    '$json_kode',
                    '$json_desc',
                    '$buy',
                    '$margin',
                    '$sell',
                    '$profit',
                    '$subtotal',
                    '$dpp',
                    '$ppn',
                    '$deposit',
                    '$total',
                    '$saveas',
                    'pending',
                    '$note')";

    $conn->query($query);
    if ($conn->affected_rows > 0) {
        echo 'ok';
    } else {
        echo $conn->error;
    }
    // >>>>>>>
}

//input nota FOR
function inputNotaFor($order)
{
    global $conn;
    global $datetime;
    if (empty($order['date'])) {
        $date = $datetime;
    } else {
        $date = date('Y-m-d H:i', strtotime($order['date']));
    }

    $str = "ABCDEFGHJKLMNPRSTUVWXYZ";
    $no_spk = date('Ymd', strtotime($datetime)) . substr(str_shuffle($str), 0, 3);


    $link = $order['link'];
    $admin = $_SESSION['nama'];
    $qts = $order['qts'];
    $kode_inv = $order['kode'];
    $desc = $order['desc'];
    $buy = $order['buy'];
    $margin = $order['margin'];
    $sell = $order['sell'];
    $profit = $order['profit'];
    $subtotal = $order['subtotal'];
    $dpp = $order['dpp'];
    $ppn = $order['ppn'];
    $deposit = $order['deposit'];
    $total = $order['total'];
    $note = htmlentities($order['note'], ENT_QUOTES, 'UTF-8');
    $saveas = htmlspecialchars($order['saveas']);

    if (empty($link)) {
        die('Invoice tidak memiliki relasi terhadap NO SPK dari data yang sudah ada !');
    }
    $data = "SELECT * FROM data WHERE no_spk = '$link'";
    if (empty($data)) {
        die('Invoice tidak dapat dibuat tanpa relasi dari NO SPK yang terdaftar !');
    }

    $json_desc = mysqli_real_escape_string($conn, $desc);
    $json_kode = mysqli_real_escape_string($conn, $kode_inv);

    $sql_nota = "INSERT INTO invoice (date,kode,admin,link,qts,kode_part,deskripsi,buy,margin,sell,profit,subtotal,dpp,ppn,deposit,total,save_as,status,note)
                    VALUES 
                    ('$date',
                    '$no_spk',
                    '$admin',
                    '$link', 
                    '$qts',
                    '$json_kode',
                    '$json_desc',
                    '$buy',
                    '$margin',
                    '$sell',
                    '$profit',
                    '$subtotal',
                    '$dpp',
                    '$ppn',
                    '$deposit',
                    '$total',
                    '$saveas',
                    'pending',
                    '$note')";

    $sql_data = "UPDATE data SET 
        invoice = '$no_spk' 
        WHERE no_spk = '$link'";

    // Memulai transaksi
    $conn->begin_transaction();


    try {
        // Melakukan query INSERT
        if ($conn->query($sql_nota) === TRUE) {
            // Melakukan query DELETE
            if ($conn->query($sql_data) === TRUE) {
                // Commit transaksi jika keduanya berhasil
                $conn->commit();
                echo 'ok';
            } else {
                throw new Exception("Error in DELETE query: " . $conn->error);
            }
        } else {
            throw new Exception("Error in INSERT query: " . $conn->error);
        }
    } catch (Exception $e) {
        // Rollback transaksi jika terjadi kesalahan
        $conn->rollback();
        echo "Error: " . $e->getMessage();
    }
    // >>>>>>>
}

//edit nota
function editNota($order)
{
    global $conn;
    global $datetime;
    $id = $order['id'];

    if (empty($order['date'])) {
        $date = $datetime;
    } else {
        $date = date('Y-m-d H:i', strtotime($order['date']));
    }

    $data = data("SELECT * FROM invoice WHERE kode = '$id'");
    if (empty($data)) {
        die('Invoice mungkin telah terhapus !');
    }

    $data = $data[0];
    $qts = $order['qts'];
    $kode_part = $order['kode'];
    $desc = $order['desc'];
    $buy = $order['buy'];
    $margin = $order['margin'];
    $sell = $order['sell'];
    $profit = $order['profit'];
    $subtotal = $order['subtotal'];
    $dpp = $order['dpp'];
    $ppn = $order['ppn'];
    $deposit = $order['deposit'];
    $total = $order['total'];
    $note = $order['note'];
    $rekening = htmlspecialchars($order['rekening']);

    $change = 0;

    if (
        $qts != $data['qts'] ||
        $kode_part != $data['kode_part'] ||
        $desc != $data['deskripsi'] ||
        $buy != $data['buy'] ||
        $margin != $data['margin'] ||
        $sell != $data['sell'] ||
        $profit != $data['profit'] ||
        $subtotal != $data['subtotal'] ||
        $dpp != $data['dpp'] ||
        $ppn != $data['ppn'] ||
        $deposit != $data['deposit'] ||
        $total != $data['total'] ||
        $note != $data['note'] ||
        $rekening != $data['rek'] ||
        ($date . ':00' != $data['date'])
    ) {
        $change++;
    }
    if ($change == 0) {
        return 'Tidak ada perubahan !';
    }

    $note = htmlentities($order['note'], ENT_QUOTES, 'UTF-8');
    $json_desc = mysqli_real_escape_string($conn, $desc);
    $json_kode = mysqli_real_escape_string($conn, $kode_part);


    $query = "UPDATE invoice SET 
    date = '$date',
    qts = '$qts', 
    kode_part = '$json_kode',
    deskripsi = '$json_desc',
    buy = '$buy',
    margin = '$margin',
    sell = '$sell',
    profit = '$profit',
    subtotal = '$subtotal',
    dpp = '$dpp',
    ppn = '$ppn',
    deposit = '$deposit',
    total = '$total',
    note = '$note',
    rek = '$rekening'
    WHERE kode = '$id'";

    $conn->query($query);
    if ($conn->affected_rows > 0) {
        return 'ok';
    } else {
        return $conn->error;
    }

}

//set invoice
function setInvoice($order)
{
    global $conn;
    global $datetime;
    $id = $order['id'];

    $data = data("SELECT * FROM invoice WHERE kode = '$id'");
    if (empty($data)) {
        die('Invoice mungkin telah terhapus !');
    }

    $data = $data[0];

    $quo = [];

    $quo_detail = [];

    $quo_detail['date'] = $data['date'];
    $quo_detail['qts'] = json_decode($data['qts'], true);
    $quo_detail['dekripsi'] = json_decode($data['deskripsi'], true);
    $quo_detail['kode_part'] = json_decode($data['kode_part'], true);
    $quo_detail['buy'] = json_decode($data['buy'], true);
    $quo_detail['margin'] = json_decode($data['margin'], true);
    $quo_detail['sell'] = json_decode($data['sell'], true);
    $quo_detail['profit'] = $data['profit'];
    $quo_detail['subtotal'] = $data['subtotal'];
    $quo_detail['dpp'] = $data['dpp'];
    $quo_detail['ppn'] = $data['ppn'];
    $quo_detail['deposit'] = $data['deposit'];
    $quo_detail['total'] = $data['total'];
    $quo_detail['save_as'] = 'quotation';
    $quo_detail['input'] = $_SESSION['kode'];
    array_push($quo, $quo_detail);
    $quo = json_encode($quo, JSON_PRETTY_PRINT);

    $json_quo = mysqli_real_escape_string($conn, $quo);

    $query = "UPDATE invoice SET 
        date = '$datetime',
        save_as = 'invoice',
        quotation = '$json_quo'
        WHERE kode = '$id'";

    $conn->query($query);
    if ($conn->affected_rows > 0) {
        return 'ok';
    } else {
        return $conn->error;
    }

}

//set paid
function setPaid($order)
{
    global $conn;
    global $datetime;
    $user = $_SESSION['kode'];

    $id = $order['id'];
    if (empty($order['date'])) {
        $date = $datetime;
    } else {
        $date = date('Y-m-d H:i', strtotime($order['date']));
    }

    $data = data("SELECT * FROM invoice WHERE kode = '$id'");
    if (empty($data)) {
        die('Invoice mungkin telah terhapus !');
    }
    $data = $data[0];
    if ($data['save_as'] != 'invoice') {
        return 'Tidak bisa melakukan proses ini jika status masih dalam quotation !';
    }


    $query = "UPDATE invoice SET 
        date_paid = '$date',
        status = 'paid',
        paid_input = '$user'
        WHERE kode = '$id'";

    $conn->query($query);
    if ($conn->affected_rows > 0) {
        return 'ok';
    } else {
        return $conn->error;
    }

}

//delete invoice
function deleteINV($order)
{
    global $conn;
    $kode = $order['kode'];
    $data = data("SELECT * FROM invoice WHERE kode = '$kode'");
    if (empty($data)) {
        return 'Tidak Ada data, mungkin telah terhapus !';
    }

    $query = "DELETE FROM invoice WHERE kode = '$kode' ";
    mysqli_query($conn, $query);
    $result = mysqli_error($conn);
    if (mysqli_affected_rows($conn) > 0) {
        return 'ok';
    } else {
        return $result;
    }
}


//signature
function signature($order)
{
    global $conn;
    $id = decrypt($order['no_spk']);
    $sign = $order['signature'];
    $data = data("SELECT * FROM data WHERE no_spk = '$id'");
    if (empty($data)) {
        die('Receipt mungkin telah terhapus !');
    }


    $query = "UPDATE data SET 
    signature = '$sign'
    WHERE no_spk = '$id'";

    $conn->query($query);
    if ($conn->affected_rows > 0) {
        return 'ok';
    } else {
        return $conn->error;
    }

}


//update version
function update_version($versi){
    global $conn;
    
    $query = "UPDATE version SET 
    versi = '$versi' ";

    $conn->query($query);
    if ($conn->affected_rows > 0) {
        return 'ok';
    } else {
        return $conn->error;
    }

}