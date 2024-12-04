<?php

    require './include/Petugas_Function.php';

    if (empty($_SESSION['username']) or $_SESSION['status'] != 'Petugas')
    {
        header("Location: ../login.php");
    }

    $res = getDataBooks(6);

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

      <!-- to do list.php -->
      <?php
      include "../../include/to_do_list.php";
      ?>

      <!-- sidebar.php -->
      <?php
      include "./include/sidebar.php";
      ?>

      <!-- tampilan main yang diubah tiap file -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Selamat Datang, <?=$_SESSION['nama']?> !</h3>
                  <h6 class="font-weight-normal mb-0">Perpustakaan SMA Negeri 2 Binjai<span class="text-primary"></span>
                  </h6>
                </div>
                <div class="col-12 col-xl-4">
                  <div class="justify-content-end d-flex">
                    <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                      <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="mdi mdi-calendar"></i> Today (5 Nov 2024)
                      </button>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                        <a class="dropdown-item" href="#">January - March</a>
                        <a class="dropdown-item" href="#">March - June</a>
                        <a class="dropdown-item" href="#">June - August</a>
                        <a class="dropdown-item" href="#">August - November</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="../../assets/images/dashboard/people.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Medan</h4>
                        <h6 class="font-weight-normal">Indonesia</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Buku</p>
                      <p class="fs-30 mb-2">4006</p>
                      <p>10.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Peminjaman Keseluruhan</p>
                      <p class="fs-30 mb-2">61344</p>
                      <p>22.00% (30 days)</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Laporan Denda</p>
                      <p class="fs-30 mb-2">34040</p>
                      <p>2.00% (30 days)</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Anggota Aktif</p>
                      <p class="fs-30 mb-2">47033</p>
                      <p>0.22% (30 days)</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Detail Peminjaman Buku</p>
                  <p class="font-weight-500">Laporan Detail Peminjaman Buku dari Anggota Perpustakaan</p>
                  <div class="d-flex flex-wrap mb-5">
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Total Buku</p>
                      <h3 class="text-primary fs-30 font-weight-medium">12.3k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Buku yang Sedang Dipinjam</p>
                      <h3 class="text-primary fs-30 font-weight-medium">14k</h3>
                    </div>
                    <div class="mr-5 mt-3">
                      <p class="text-muted">Persentase Buku Terpinjam</p>
                      <h3 class="text-primary fs-30 font-weight-medium">71.56%</h3>
                    </div>
                    <div class="mt-3">
                      <p class="text-muted">Total Anggota Terdaftar</p>
                      <h3 class="text-primary fs-30 font-weight-medium">34040</h3>
                    </div>
                  </div>
                  <canvas id="order-chart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <p class="card-title">Laporan Aktivitas Peminjaman</p>
                    <a href="#" class="text-info">View all</a>
                  </div>
                  <p class="font-weight-500">Laporan Aktivitas Peminjaman dari Anggota Perpustakaan</p>
                  <div id="sales-legend" class="chartjs-legend mt-4 mb-2"></div>
                  <canvas id="sales-chart"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- katalog buku -->
    <div class="container">
    <div class="catalog" id="catalog">
        <h2>Katalog Buku</h2>
    </div>
    <div class="explore" id="explore">
        <a href="./katalog.php">Lihat Lainnya</a>
    </div>
</div>
<div class="book-slide">
    <div class="book js-flickity" data-flickity-options='{ "wrapAround": true }'>
        <?php foreach ($res as $book): ?>
            <div class="book-cell">
                <div class="book-img">
                    <img src="<?= $book['foto_buku'] ?>" alt="Book Image" class="book-photo">
                </div>
                <div class="book-content">
                    <div class="book-title"><?= $book['judul'] ?></div>
                    <div class="book-author">by <?= $book['penulis'] ?></div>
                    <div class="rate">
                    <?php
                    $rating = $book['rating'];
                    if ($rating == 'Not Rated')
                    {
                      echo '<span class="not-rated">Not Rated</span>';
                    }
                    else {
                      for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $rating) {
                          echo '<span class="star filled">&#9733;</span>'; // Bintang terisi
                         } else {
                          echo '<span class="star">&#9734;</span>'; // Bintang kosong
                        }
                    }
                  }
                    ?>
                        <span class="book-voters"><?= $book['jumlah_pemberi_rating'] ?> voters</span>
                    </div>
                    <div class="book-sum"><?= substr($book['sinopsis'], 0, 100) ?>...</div>
                    <div class="book-see book-blue">
                        <a href="./detail_katalog.php?id=<?= $book['id_buku'] ?>">Lihat Detail</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php

$books = [];
// Menggunakan foreach untuk memproses data dan memasukkannya ke dalam $res
foreach ($res as $data) {
    // Mengisi array $books dengan data yang sudah diproses (menggunakan htmlspecialchars untuk keamanan)
    $books[] = [
        'id_buku' => $data['id_buku'],
        'judul' => htmlspecialchars($data['judul'], ENT_QUOTES, 'UTF-8'),
        'penulis' => htmlspecialchars($data['penulis'], ENT_QUOTES, 'UTF-8'),
        'foto_buku' => htmlspecialchars($data['foto_buku'], ENT_QUOTES, 'UTF-8'),
        'rating' => $data['rating'],
        'jumlah_pemberi_rating' => $data['jumlah_pemberi_rating'],
        'sinopsis' => htmlspecialchars($data['sinopsis'], ENT_QUOTES, 'UTF-8')
    ];
}

?>
        <!-- include:footer.php -->
        <?php
        include "../../include/footer.php";
        ?>

      </div>

    </div>

  </div>

  <?php include "./include/js.php"; ?>
  
</body>

</html>