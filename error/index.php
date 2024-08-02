<?php


?>

<!DOCTYPE html>

<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Error - 404 | Pages Not Found</title>

  <meta name="description" content="" />

  <!-- favicon -->
  <?php include_once '../struktur/favicon.php' ?>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- CSS -->
  <link rel="stylesheet" href="<?= $page[1]; ?>/error/error.css" />
</head>

<body>
  <!-- Content -->

  <!-- Error -->
  <div class="container-xxl container-p-y">
    <div class="misc-wrapper">
      <h2 class="mb-2 mx-2">Page Not Found :(</h2>
      <p class="mb-4 mx-2">Oops! 😖 The requested URL was not found on this server.</p>
      <!-- <a href="../" style="color:white; background-color:#696cff; border-radius:20px; padding: 8px;">Back to home</a> -->
      <div class="mt-3">
        <img src="<?= $page[1]; ?>/error/error.png" alt="page-misc-error-light" width="500" class="img-fluid" data-app-dark-img="error.image" data-app-light-img="error-image" />
      </div>
    </div>
  </div>
  <!-- /Error -->

  <!-- / Content -->

</body>

</html>