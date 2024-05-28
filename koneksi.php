<?php
// error_reporting(0);


date_default_timezone_set("Asia/Hong_Kong");
$datetime = date('Y-m-d H:i');

$server = 'localhost';
$userServer = 'digp8161_service';
$serverPwd = 'Kmzwa8aw@@';
$database = 'digp8161_service';

// $server = 'localhost';
// $userServer = 'root';
// $serverPwd = '';
// $database = 'service';


$connFirst = new mysqli($server, $userServer, $serverPwd);
if ($connFirst->connect_error) {
    die("Koneksi gagal: " . $connFirst->connect_error);
    $connFirst->close();
}

function format_date($date, $format)
{
    $date = date_create($date);
    return date_format($date, $format);
}

// >>>>>>>>>>>>> cek ada atau tidak database  <<<<<<<<<<<<<<<<
$sistem = "SELECT COUNT(*) AS `exists` FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMATA.SCHEMA_NAME='$database'";
$dbExists = $connFirst->query($sistem);

$row = $dbExists->fetch_assoc();
// Mengambil nilai 'exists' dari hasil query
$dbExistsCount = $row['exists'];


if ($dbExistsCount > 0) {

    $conn = new mysqli($server, $userServer, $serverPwd, $database);
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }
    //ambil data di database
    function data($info)
    {
        global $conn;

        $result = $conn->query($info);
        $rows = [];
        if ($result->num_rows > 0) {
            // Menampilkan data hasil
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
        }
        return $rows;
    }

    //remove specialchar function
    function removeSpecialChar($input)
    {
        $specialChars = array(
            '!',
            '"',
            '#',
            '$',
            '%',
            '&',
            "'",
            '(',
            ')',
            '*',
            '+',
            ',',
            '-',
            '.',
            '/',
            ':',
            ';',
            '<',
            '=',
            '>',
            '?',
            '@',
            '[',
            '\\',
            ']',
            '^',
            '_',
            '`',
            '{',
            '|',
            '}',
            '~',
            ',',
            "'",
            '"',
            "\\",
            '/'
        );
        $replacement = '';
        $output = str_replace($specialChars, $replacement, $input);
        return $output;
    }

    //remove input function
    function removeInputChar($input)
    {
        $specialChars = array(
            '"',
            '#',
            '$',
            '%',
            '&',
            "'",
            '(',
            ')',
            '*',
            '+',
            '-',
            '/',
            ':',
            ';',
            '<',
            '=',
            '>',
            '?',
            '@',
            '[',
            '\\',
            ']',
            '^',
            '_',
            '`',
            '{',
            '|',
            '}',
            '~',
            ',',
            "'",
            '"',
            "\\",
            '/'
        );
        $replacement = '';
        $output = str_replace($specialChars, $replacement, $input);
        return $output;
    }

    // fungsi enkripsi url
    function encrypt($data)
    {
        $key = 'kmzwa8awaa';
        $result = '';
        $dataLength = strlen($data);
        $keyLength = strlen($key);

        for ($i = 0; $i < $dataLength; $i++) {
            $result .= $data[$i] ^ $key[$i % $keyLength];
        }

        return base64_encode($result);
    }
    // fungsi dekripsi url
    function decrypt($data)
    {
        $key = 'kmzwa8awaa';
        $data = base64_decode($data);
        $result = '';
        $dataLength = strlen($data);
        $keyLength = strlen($key);

        for ($i = 0; $i < $dataLength; $i++) {
            $result .= $data[$i] ^ $key[$i % $keyLength];
        }

        return $result;
    }

    // funsi user login
    function login($kode, $token, $akses)
    {
        $login = data("SELECT * FROM logininfo WHERE kodeuser = '$kode' ")[0];
        if ($token != $login['token']) {
            header('Location: ../logout.php');
            die;
        }
        if (!in_array($_SESSION['akses'], $akses)) {
            header('Location: ../logout.php');
            die;
        }
    }

    $query = "SHOW TABLES LIKE 'version' ";
    $result = $conn->query($query);
    // var_dump($result);
    if ($result) {
        $version = data("SELECT * FROM version WHERE id = 1")[0]['versi'];
    } else {
        $version = '0.0.0.0';
    }

}
