<?php

require './include/Pengunjung_Function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Pengunjung') {
	header("Location: ./error-403.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Perpustakaan SMAN 2 Binjai</title>
  
  <?php include "./include/css.php"; ?>

</head>

<body>
  <div class="container-scroller">
    <!-- include:navbar.php -->
    <?php
    include "./include/navbar.php";
    ?>

    <div class="container-fluid page-body-wrapper">
      <!-- include -->
      <!-- sidebar_settings.php -->
      <?php
      include "../../include/sidebar_setting.php";
      ?>



      <!-- sidebar.php -->
      <?php
      include "./include/sidebar.php";
      ?>

      <!-- Tampilan main yang diubah tiap file -->
      
        <!-- include/footer.php -->
        <?php
        include "../../include/footer.php";
        ?>
    </div>
  </div>

  <?php include "./include/js.php"; ?>
</html>