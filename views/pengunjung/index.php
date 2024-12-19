<?php

require './include/Pengunjung_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Pengunjung') {
    header("Location: ./error-403.php");
}

$id_u = $_SESSION['id_user'];

$res = getDataBooksLim(6);

$query_buku = query("SELECT COUNT(*) AS total_buku FROM eksemplar_buku WHERE status NOT IN ('Hilang', 'Rusak')");
$total_buku = $query_buku->fetch_assoc()['total_buku'];

// 2. Total Peminjaman
$query_peminjaman = query("SELECT COUNT(*) AS total_peminjaman FROM peminjaman_buku WHERE YEAR(waktu_peminjaman) = YEAR(current_date) AND MONTH(waktu_peminjaman) = MONTH(current_date) AND id_user = $id_u ");
$total_peminjaman = $query_peminjaman->fetch_assoc()['total_peminjaman'];


// 4. Anggota Aktif
$query_review = query("SELECT COUNT(*) AS total_review FROM view_ulasan_buku WHERE id_user = $id_u ");
$total_review = $query_review->fetch_assoc()['total_review'];

?>

<!DOCTYPE html>
<html lang="en">


<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Perpustakaan SMAN 2 Binjai</title>

<?php include "./include/css.php"; ?>


<!-- <link rel="stylesheet" href="../../assets/css/style_user.css"> -->





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
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Selamat Datang, <?= $_SESSION['nama'] ?> !</h3>
                                    <h6 class="font-weight-normal mb-0">Perpustakaan SMA Negeri 2 Binjai<span
                                            class="text-primary"></span>
                                    </h6>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="d-flex flex-md-grow-1 flex-xl-grow-0 align-items-center">
                                            <span class="h4 text-dark">
                                                <i class="mdi mdi-calendar"></i>
                                                Today (<?php echo date('j M Y'); ?>)
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-md-6 grid-margin stretch-card">
                            <div class="card tale-bg">
                                <div class="card-people mt-auto">
                                    <img src="../../assets/images/dashboard/people2.jpeg" alt="people"
                                        style="width: 100%; height: auto; object-fit: cover;">
                                </div>
                            </div>
                        </div> -->

                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card tale-bg">
                                <div class="card-people mt-auto">
                                    <img src="../../assets/images/dashboard/people.svg" alt="people">
                                    <div class="weather-info">
                                        <div class="d-flex">

                                            <div class="ml-2">
                                                <h4 class="location font-weight-normal">Binjai</h4>
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
                                        <a href="katalog.php" class="text-white text-decoration-none">
                                            <div class="card-body">
                                                <p class="mb-4">Total Buku</p>
                                                <p class="fs-30 mb-2"><?= $total_buku ?></p>
                                                <p>Jumlah Koleksi Buku</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <a href="data_peminjaman.php" class="text-white text-decoration-none">
                                            <div class="card-body">
                                                <p class="mb-4">Riwayat Peminjaman</p>
                                                <p class="fs-30 mb-2"><?= $total_peminjaman ?></p>
                                                <p>Peminjaman Bulan Ini</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <a href="data_review.php" class="text-white text-decoration-none">
                                            <div class="card-body">
                                                <p class="mb-4">Riwayat Review</p>
                                                <p class="fs-30 mb-2"><?= $total_review ?></p>
                                                <p>Ulasan Buku</p>
                                            </div>
                                        </a>
                                    </div>
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
                                        <img src="<?= $book['foto_buku'] ?>" alt="<?= $book['judul'] ?>" class="book-photo">
                                    </div>
                                    <div class="book-content">
                                        <div class="book-title"><?= $book['judul'] ?></div>
                                        <div class="book-author">by <?= $book['penulis'] ?></div>
                                        <div class="rate">
                                            <?php
                                            $rating = $book['rating'];
                                            if ($rating == 'Not Rated') {
                                                echo '<span class="not-rated">Not Rated</span>';
                                            } else {
                                                for ($i = 1; $i <= 5; $i++) {
                                                    if ($i <= $rating) {
                                                        echo '<span class="star filled">&#9733;</span>'; // Bintang terisi
                                                    } else {
                                                        echo '<span class="star">&#9734;</span>'; // Bintang kosong
                                                    }
                                                }
                                            }
                                            ?>
                                            <span class="book-voters"><?= $book['jumlah_pemberi_rating'] ?>
                                                voters</span>
                                        </div>
                                        <div class="book-sum"><?= substr($book['sinopsis'], 0, 100) ?>...</div>
                                        <div class="book-see book-blue">
                                            <a class="text-light"
                                                href="./detail_katalog.php?id=<?= $book['id_buku'] ?>">Lihat
                                                Detail</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <section id="testimonials">
                        <h4 class="sec-head">Kutipan Motivasi</h4>
                        <div class="cust-quotes">
                            <blockquote data-timeout="5000">
                                <p>Membaca adalah jendela dunia.</p>
                                <cite>Soetomo</cite>
                            </blockquote>
                            <blockquote data-timeout="5000">
                                <p>Buku adalah sumber pengetahuan yang tak ternilai.</p>
                                <cite>Abdurrahman Wahid</cite>
                            </blockquote>
                            <blockquote data-timeout="5000">
                                <p>Kunci kesuksesan adalah fokus pada tujuan, bukan hambatan.</p>
                                <cite>Albert Schweitzer</cite>
                            </blockquote>
                            <blockquote data-timeout="5000">
                                <p>Sebuah ruangan tanpa buku bagaikan tubuh tanpa jiwa.</p>
                                <cite>Marcus Tullius Cicero</cite>
                            </blockquote>
                        </div>
                    </section>

                    <!-- include footer -->
                    <?php
                    include "../../include/footer.php";
                    ?>
                </div>

            </div>

        </div>

        <?php include "./include/js.php"; ?>

</body>

</html>