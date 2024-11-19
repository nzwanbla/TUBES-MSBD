<?php

    require './include/Admin_function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Admin')
    {
        header("Location: ../login.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Admin</title>

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

      <!-- to do list.php -->
      <?php
      include "../../include/to_do_list.php";
      ?>

      <!-- sidebar.php -->
      <?php
      include "./include/sidebar.php";
      ?>

      <!-- Tampilan main yang diubah tiap file -->
      <div class=" container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="main-panel w-100  documentation">
            <div class="content-wrapper">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12 pt-5">
                    <a class="btn btn-primary" href="../login.php"><i class="ti-home mr-2"></i>Back to home</a>
                  </div>
                </div>
                <div class="row pt-5 mt-5">
                  <div class="col-12 pt-5 text-center">
                    <i class="text-primary mdi mdi-file-document-box-multiple-outline display-1"></i>
                    <h3 class="text-primary font-weight-light mt-5">
                      The detailed documentation of Skydash Admin Template is provided at 
                      <a href="http://bootstrapdash.com/demo/skydash/docs/documentation.html" target="_blank" class="text-danger d-block text-truncate">
                        http://bootstrapdash.com/demo/skydash/docs/documentation.html
                      </a>
                    </h3>
                    <h4 class="mt-4 font-weight-light text-primary">
                      In case you want to refer the documentation file, it is available at 
                      <span class="text-danger">/docs/documentation.html</span> 
                      in the downloaded folder
                    </h4>
                  </div>
                </div>
              </div>
            </div>
      
        <!-- include/footer.php -->
        <?php
        include "../../include/footer.php";
        ?>

      </div>

    </div>

  </div>

  <?php include "./include/js.php"; ?>

</body>

</html>
