<?php

require_once '../koneksi.php';

if (!$connFirst) {
    die('Not Connected to server/user and password false');
}


// master info
$username = 'sangut';
$password = 'kmzwa8awaa';
$password = password_hash($password, PASSWORD_DEFAULT);
$password2 = password_hash('master', PASSWORD_DEFAULT);
$akses = 'master';
$role = 'teknisi';
$counter = 'pusat';
$nama = 'putu ardi';
$kodeuser = 'mtr001';
$token = '';
$status = '';

//version info;
$input_version = '3.1.40';
$maintenance = '';
$version_kode = 'service';

// default service center
$sc_date = '2023-11-17 10:41:00';
$sc_kode = 'SNR';
$sc_nama = 'Digital Repair';
$sc_upto = 'Wayan';
$sc_notlp = '08980000703';
$sc_alamat = 'jl. Tukad pancoran 4 blok A4 no. 12B\r\nDenpasar - Bali';
$sc_unit = '';
$sc_legalname = 'Digitalisasi.net';
$sc_reknumber = '';
$sc_note = '';

function success($no, $info)
{
    $msg = <<<msg
    $no. <span class="color-green">✔✔✔</span> Table <span class="color-orange">"$info"</span> created Success ! 
    <br>
    msg;

    return $msg;
}

function input($no, $info)
{
    $msg = <<<msg
    $no. <span class="color-green">✔✔✔</span> Success to insert data to => <span class="color-orange">"$info"</span>
    <br>
    msg;

    return $msg;
}

function fail($no, $table, $error)
{
    $msg = <<<msg
    $no. <span class="color-red">ERROR</span> : Creating Table <span class="color-orange">"$table"</span>
    <br>
    ...↳ <span class='color-red italic'>$error</span>
    <br>
    msg;

    return $msg;
}

function exist($no, $table)
{
    $msg = <<<msg
    $no. <span class="color-red">✘✘✘</span> Tabel <span class="color-orange">"$table"</span> allready exists
    <br>
    msg;

    return $msg;

}


if ($connFirst) {
    $query = "CREATE DATABASE IF NOT EXISTS $database";
    $result = $connFirst->query($query);

    if (!$result) {
        die($connFirst->error);
    }
    echo "1. <span class='color-green'>✔✔✔</span> Database <span class='color-orange'>$database</span> created Success !";
    echo '<br>';
}

// membuat koneksi ke database
$conn = new mysqli($server, $userServer, $serverPwd, $database);

// cek table version
$query = "SHOW TABLES LIKE 'version' ";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo exist(2, 'VERSION');
} else {
    $createTable = "CREATE TABLE `version` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `versi` varchar(20) DEFAULT NULL,
            `maintenance` varchar(10) NULL,
            `kode` varchar(10) NOT NULL UNIQUE
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $result = $conn->query($createTable);

    if ($result === true) {
        echo success(2, 'VERSION');

        // INPUT VERSION
        $query = "INSERT INTO version (versi,maintenance,kode)
            VALUES 
            ('$input_version',
            '$maintenance',
            '$version_kode')";

        $result = $conn->query($query);

        if ($result === true) {
            echo input(3, 'VERSION');
        } else {
            echo fail(3, 'VERSION', $conn->error);
        }

    } else {
        echo fail(2, 'VERSION', $conn->error);
    }
}




// cek table logininfo
$query = "SHOW TABLES LIKE 'logininfo' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo exist(4, 'LOGININFO');
} else {
    $createTable = "CREATE TABLE `logininfo` (
            `id` INT AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(20) NOT NULL UNIQUE,
            `password` varchar(255) NOT NULL,
            `akses` varchar(20) NOT NULL,
            `role` varchar(20) DEFAULT NULL,
            `counter` varchar(20) DEFAULT NULL,
            `nama` varchar(50) NOT NULL,
            `kodeuser` varchar(50) NOT NULL UNIQUE,
            `token` varchar(50) DEFAULT NULL UNIQUE,
            `date_status` datetime DEFAULT NULL,
            `status` varchar(20) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
          ";
    $result = $conn->query($createTable);
    if ($result === true) {
        echo success(4, 'LOGININFO');

        // INPUT default master
        $query = "INSERT INTO `logininfo` (`username`, `password`, `akses`, `role`, `counter`, `nama`, `kodeuser`, `token`, `date_status`, `status`) VALUES
            ('$username', '$password', '$akses', '$role','$counter', '$nama', '$kodeuser', '$token', '$datetime', '$status')";

        $query2 = "INSERT INTO `logininfo` (`username`, `password`, `akses`, `role`, `counter`, `nama`, `kodeuser`, `token`, `date_status`, `status`) VALUES
            ('master', '$password2', 'master', '$role','$counter', 'master', 'mtr002', 'c9p5au8naa', '$datetime', '$status')";

        $result = $conn->query($query);
        $result = $conn->query($query2);

        if ($result === true) {
            echo input(5, 'LOGININFO');
        } else {
            echo fail(5, 'LOGININFO', $conn->error);
        }
    } else {
        echo fail(4, 'LOGININFO', $conn->error);
    }
}




// cek table data
$query = "SHOW TABLES LIKE 'data' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo exist(6, 'DATA');
} else {
    $createTable = "CREATE TABLE `data` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `no_spk` varchar(50) NOT NULL UNIQUE,
        `date` datetime NOT NULL,
        `date_proses` datetime DEFAULT NULL,
        `date_update` datetime DEFAULT NULL,
        `date_finish` datetime DEFAULT NULL,
        `date_pickup` datetime DEFAULT NULL,
        `counter` varchar(20) NOT NULL,
        `service_at` varchar(50) DEFAULT NULL,
        `location` varchar(50) DEFAULT NULL,
        `nama` varchar(100) NOT NULL,
        `alamat` text NOT NULL,
        `wa` varchar(20) NOT NULL,
        `no_tlp` varchar(20) DEFAULT NULL,
        `tipe` varchar(20) NOT NULL,
        `unit` varchar(100) NOT NULL,
        `sn` varchar(100) NOT NULL,
        `error` text NOT NULL,
        `result` text DEFAULT NULL,
        `cost` text DEFAULT NULL,
        `acc` varchar(10) DEFAULT NULL,
        `note` text DEFAULT NULL,
        `pin` varchar(10) NOT NULL,
        `status` varchar(20) NOT NULL,
        `penerima` varchar(20) NOT NULL,
        `kelengkapan` longtext DEFAULT NULL,
        `signature` text DEFAULT NULL,
        `invoice` varchar(50) DEFAULT NULL,
        `surat_jalan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`surat_jalan`)),
        `time_line` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`time_line`)),
        `log` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`log`))
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $result = $conn->query($createTable);
    if ($result === true) {
        echo success(6, 'DATA');
    } else {
        echo fail(6, 'DATA', $conn->error);
    }
}

// cek table pickup
$query = "SHOW TABLES LIKE 'pickup' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo exist(7, 'PICKUP');
} else {
    $createTable = "CREATE TABLE `pickup` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `no_spk` varchar(50) NOT NULL UNIQUE,
        `date` datetime NOT NULL,
        `date_proses` datetime DEFAULT NULL,
        `date_update` datetime DEFAULT NULL,
        `date_finish` datetime DEFAULT NULL,
        `date_pickup` datetime DEFAULT NULL,
        `counter` varchar(20) NOT NULL,
        `service_at` varchar(50) DEFAULT NULL,
        `location` varchar(50) DEFAULT NULL,
        `nama` varchar(100) NOT NULL,
        `alamat` text NOT NULL,
        `wa` varchar(20) NOT NULL,
        `no_tlp` varchar(20) DEFAULT NULL,
        `tipe` varchar(20) NOT NULL,
        `unit` varchar(100) NOT NULL,
        `sn` varchar(100) NOT NULL,
        `error` text NOT NULL,
        `result` text DEFAULT NULL,
        `cost` text DEFAULT NULL,
        `acc` varchar(10) DEFAULT NULL,
        `note` text DEFAULT NULL,
        `pin` varchar(10) NOT NULL,
        `status` varchar(20) NOT NULL,
        `penerima` varchar(20) NOT NULL,
        `kelengkapan` longtext DEFAULT NULL,
        `signature` text DEFAULT NULL,
        `invoice` varchar(50) DEFAULT NULL,
        `surat_jalan` text DEFAULT NULL,
        `time_line` longtext DEFAULT NULL,
        `log` longtext DEFAULT NULL,
        INDEX idx_date (date),
        INDEX idx_nama (nama),
        INDEX idx_no_w (wa)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $result = $conn->query($createTable);

    if ($result === true) {
        echo success(7, 'PICKUP');
    } else {
        echo fail(7, 'PICKUP', $conn->error);
    }
}

// cek table notif_msg
$query = "SHOW TABLES LIKE 'notif_msg' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo exist(8, 'NOTIF_MSG');
} else {
    $createTable = "CREATE TABLE `notif_msg` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `no_spk` varchar(50) NOT NULL UNIQUE,
        `date` datetime DEFAULT NULL,
        `date_wa` datetime DEFAULT NULL,
        `date_info` datetime DEFAULT NULL,
        `nama` varchar(100) DEFAULT NULL,
        `status` varchar(20) DEFAULT NULL,
        `klik` varchar(5) DEFAULT NULL,
        `wa` varchar(5) DEFAULT NULL,
        FOREIGN KEY (no_spk) REFERENCES data(no_spk) ON DELETE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";

    $result = $conn->query($createTable);
    if ($result === true) {
        echo success(8, 'NOTIF_MSG');
    } else {
        echo fail(8, 'NOTIF_MSG', $conn->error);
    }
}

// cek table invoice
$query = "SHOW TABLES LIKE 'invoice' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo exist(9, 'INVOICE');
} else {
    $createTable = "CREATE TABLE `invoice` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `admin` varchar(50) NOT NULL,
        `date` datetime NOT NULL,
        `date_paid` datetime DEFAULT NULL,
        `paid_input` varchar(50) DEFAULT NULL,
        `kode` varchar(50) NOT NULL UNIQUE,
        `link` varchar(50) DEFAULT NULL,
        `qts` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`qts`)),
        `kode_part` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
        `deskripsi` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
        `buy` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`buy`)),
        `margin` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`margin`)),
        `sell` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`sell`)),
        `profit` varchar(100) NOT NULL,
        `subtotal` varchar(100) NOT NULL,
        `dpp` varchar(100) NOT NULL,
        `ppn` varchar(100) NOT NULL,
        `deposit` varchar(100) NOT NULL,
        `discount` varchar(100) DEFAULT NULL,
        `total` varchar(100) NOT NULL,
        `cancel` varchar(100) DEFAULT NULL,
        `spend` varchar(100) DEFAULT NULL,
        `save_as` varchar(20) NOT NULL,
        `status` varchar(20) DEFAULT NULL,
        `rek` varchar(20) DEFAULT NULL,
        `note` text DEFAULT NULL,
        INDEX idx_date (date),
        `quotation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $result = $conn->query($createTable);
    if ($result === true) {
        echo success(9, 'INVOICE');
    } else {
        echo fail(9, 'INVOICE', $conn->error);
    }
}

// cek table service center
$query = "SHOW TABLES LIKE 'service_center' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo exist(10, 'SERVICE_CENTER');
} else {
    $createTable = "CREATE TABLE `service_center` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `date` datetime NOT NULL,
        `kode` varchar(10) NOT NULL UNIQUE,
        `nama` varchar(100) NOT NULL,
        `up_to` varchar(100) DEFAULT NULL,
        `no_tlp` text NOT NULL,
        `alamat` text NOT NULL,
        `unit` varchar(200) DEFAULT NULL,
        `legal_name` varchar(100) DEFAULT NULL,
        `rek_number` text DEFAULT NULL,
        `note` text DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $result = $conn->query($createTable);
    if ($result === true) {
        echo success(10, 'SERVICE_CENTER');
        // INPUT service center
        $query = "INSERT INTO `service_center` (`date`, `kode`, `nama`, `up_to`, `no_tlp`, `alamat`, `unit`, `legal_name`, `rek_number`, `note`) VALUES
            ('$sc_date', '$sc_kode', '$sc_nama', '$sc_upto', '$sc_notlp', '$sc_alamat', '$sc_unit', '$sc_legalname', '$sc_reknumber', '$sc_note')";


        $result = $conn->query($query);

        if ($result === true) {
            echo input(11, 'SERVICE_CENTER');
        } else {
            echo fail(11, 'SERVICE_CENTER', $conn->error);
        }
    } else {
        echo fail(10, 'SERVICE_CENTER', $conn->error);
    }
}



// cek table surat jalan
$query = "SHOW TABLES LIKE 'surat_jalan' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo exist(12, 'SURAT JALAN');
} else {
    $createTable = "CREATE TABLE `surat_jalan` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `admin` varchar(50) NOT NULL,
        `date` datetime NOT NULL,
        `no_spk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
        `sn` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
        `unit` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
        `kelengkapan` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
        `error` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
        `tujuan` varchar(50) NOT NULL,
        `resi` varchar(100) DEFAULT NULL,
        `note` text DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $result = $conn->query($createTable);
    if ($result === true) {
        echo success(12, 'SURAT JALAN');
    } else {
        echo fail(12, 'SURAT JALAN', $conn->error);
    }
}


// cek table EARNINGS
$query = "SHOW TABLES LIKE 'earnings' ";
$result = $conn->query($query);
if ($result->num_rows > 0) {
    echo exist(13, 'EARNINGS');
} else {
    $createTable = "CREATE TABLE `earnings` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `date` datetime NOT NULL,
        `penerima` varchar(100) NOT NULL,
        `no_spk` varchar(50) NOT NULL UNIQUE,
        `invoice` varchar(50) DEFAULT NULL,
        `profit` varchar(100) DEFAULT NULL,
        `status` varchar(50) DEFAULT NULL,
        INDEX idx_date (date),
        INDEX idx_penerima (penerima),
        INDEX idx_status (status)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci";
    $result = $conn->query($createTable);
    if ($result === true) {
        echo success(13, 'EARNINGS');
    } else {
        echo fail(13, 'EARNINGS', $conn->error);
    }
}