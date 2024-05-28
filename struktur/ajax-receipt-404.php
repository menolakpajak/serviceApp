<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include_once '../struktur/favicon.php'; ?>
    <title>Receipt Not Found</title>

    <link href="../alert/sweetalert2.css" rel="stylesheet">
</head>

<body>

</body>
<script src="../alert/sweetalert2.all.js?versi=<?= $version; ?>"></script>
<script>
    Swal.fire({
        title: "<strong>ERROR</strong>",
        icon: "error",
        html: `
  <h4 style="text-align:center;color:#f70000e0;font-weight:400;">⚠️ DATA details not found, RECEIPT will be deleted automatically if you have PICKED UP your UNIT!</h4>
  <h4 style="text-align:center;color:#f70000e0;font-weight:400;">⚠️ Detail DATA tidak ditemukan, RECEIPT Akan terhapus otomatis jika anda telah MENGAMBIL UNIT anda!</h4>
  `,
        showCloseButton: false,
        showConfirmButton: false,
        showCancelButton: false,
        focusConfirm: false
    });
</script>

</html>

<?php exit; ?>