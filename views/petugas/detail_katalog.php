<?php

require './include/Petugas_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Petugas') {
    header("Location: ../login.php");
}

if (isset($_GET['id'])) {
    $id_buku = $_GET['id'];
}

$detailBuku = getDetailBook($id_buku);
$genreBuku = getGenreBook($id_buku);
$ulasanBuku = getReviewBook($id_buku);
$countUlasan = getCountReview($id_buku);
$countPeminjaman = getCountPeminjaman($id_buku);

$rating = $detailBuku['rating']; // Contoh: 4.6



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan SMAN 2 Binjai</title>
    <?php include "./include/css.php"; ?>
    <link rel="stylesheet" href="../../assets/css/detail_katalog.css">

</head>

<body>

    <div class="container-scroller">
        <?php include "./include/navbar.php"; ?>
        <div class="container-fluid page-body-wrapper">
            <?php include "../../include/sidebar_setting.php"; ?>
            <?php include "./include/sidebar.php"; ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <!-- Detail Buku -->
                    <div class="col-md-10">
                        <div class="card catalog-card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Kolom Gambar (Kiri) -->
                                    <div class="col-md-2">
                                        <div class="catalog-card-img-container">
                                            <img src="<?= $detailBuku['foto_buku'] ?>" alt="<?= $detailBuku['judul'] ?>"
                                                class="catalog-card-img">
                                        </div>
                                    </div>

                                    <!-- Kolom Informasi Utama Buku (Tengah) -->
                                    <div class="col-md-4">
                                        <h2 class="catalog-card-title"><?= $detailBuku['judul'] ?></h2>
                                        <strong>Penulis:</strong> <?= $detailBuku['penulis'] ?>
                                        <br><strong>No ISBN:</strong> <?= $detailBuku['ISBN'] ?>
                                        <br><strong>Genre:</strong> <?php foreach ($genreBuku as $genre) { ?>
                                            <?= $genre['nama_genre'] ?>
                                        <?php } ?>
                                        <br><strong>Tahun Terbit:</strong> <?= $detailBuku['tahun_terbit'] ?>
                                        <br><strong>Penerbit:</strong> <?= $detailBuku['penerbit'] ?>
                                        <br><strong>Lokasi Rak:</strong> <?= $detailBuku['lokasi_rak'] ?>

                                        <!-- Informasi Ketersediaan -->
                                    </div>

                                    <!-- Kolom Informasi Tambahan (Kanan) -->
                                    <div class="col-md-5">
                                        <!-- Menambahkan jarak kosong di atas -->
                                        <div class="mb-5"></div>

                                        <!-- Rating dengan model bintang -->
                                        <div class="catalog-card-rating">
                                            <strong>Rating:</strong>
                                            <!-- Menampilkan rating atau 'Not Rated' jika tidak ada rating -->
                                            <?php if ($rating == 'Not Rated') { ?>
                                                <span>Not Rated</span>
                                                <!-- Jika rating "Not Rated", tampilkan teks tanpa bintang -->
                                            <?php } else { ?>
                                                <!-- Menampilkan bintang berdasarkan rating -->
                                                <span class="star-rating2">
                                                    <?php
                                                    // Menghitung jumlah bintang penuh dan bintang kosong
                                                    $fullStars = floor($rating); // Bintang penuh sesuai dengan angka bulat dari rating
                                                    $emptyStars = 5 - $fullStars; // Menghitung sisa bintang kosong untuk mencapai 5
                                                
                                                    // Tampilkan bintang penuh
                                                    for ($i = 0; $i < $fullStars; $i++) {
                                                        echo '<span style="color: #ffcc00; font-size: 1.5rem;">&#9733;</span>'; // Bintang penuh
                                                    }

                                                    // Tampilkan bintang kosong jika ada
                                                    for ($i = 0; $i < $emptyStars; $i++) {
                                                        echo '<span style="color: #d3d3d3; font-size: 1.5rem;">&#9734;</span>'; // Bintang kosong
                                                    }
                                                    ?>
                                                </span>
                                                <span> <?= $rating ?></span> <!-- Menampilkan nilai rating -->
                                            <?php } ?>
                                        </div>
                                        <!-- Jumlah dipinjam dan ulasan -->
                                        <div class="catalog-card-voter">
                                            <strong>Jumlah Dipinjam:</strong>
                                            <?= $countPeminjaman['jumlah_peminjaman'] ?> kali
                                            <br><strong>Jumlah Ulasan:</strong> <?= $countUlasan['jumlah_ulasan'] ?>
                                            orang
                                            <br><strong>Ketersediaan:</strong> <?php
                                            if ($detailBuku['jumlah_buku_tersedia'] == 0) {
                                                echo "Tidak Tersedia";
                                            } else {
                                                echo "Tersedia (" . $detailBuku['jumlah_buku_tersedia'] . " Buku)";
                                            }
                                            ?>
                                        </div>
                                    </div>

                                </div>

                                <strong>SINOPSIS</strong>
                                <p class="catalog-card-text mt-1">
                                    <?= $detailBuku['sinopsis'] ?>
                                </p>

                                <!-- Ulasan Buku -->
                                <div class="reviews-section mt-4">
                                    <h5><strong>Ulasan Buku</strong></h5>

                                    <!-- Cek apakah ada ulasan -->
                                    <?php if($countUlasan['jumlah_ulasan'] > 0) { ?>
                                        <!-- Ulasan Buku -->
                                        <div class="review-container">
                                            <?php
                                            foreach ($ulasanBuku as $ulasan) {
                                                ?>
                                                <div class="review">
                                                    <div class="review-header">
                                                        <div class="review-avatar">
                                                            <img src="<?= $ulasan['foto_profil'] ?>" alt="Avatar"
                                                                class="avatar">
                                                        </div>
                                                        <div class="review-info">
                                                            <strong><?= $ulasan['nama_user'] ?></strong>
                                                            <p class="review-date">
                                                                <?= date('Y-m-d', strtotime($ulasan['waktu_ulasan'])); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="review-body">
                                                        <p><?= $ulasan['komentar'] ?></p>
                                                    </div>
                                                    <!-- Rating Bintang -->
                                                    <span class="star-rating2">
                                                        <?php
                                                        $rating = $ulasan['rating']; // Nilai rating (1-5)
                                                
                                                        for ($i = 1; $i <= 5; $i++) {
                                                            if ($i <= $rating) {
                                                                // Bintang penuh jika i <= rating
                                                                echo '<span style="color: #ffcc00; font-size: 1.5rem;">&#9733;</span>'; // Bintang penuh (kuning)
                                                            } else {
                                                                // Bintang kosong jika i > rating
                                                                echo '<span style="color: #d3d3d3; font-size: 1.5rem;">&#9734;</span>'; // Bintang kosong (abu-abu)
                                                            }
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                            <?php } ?>
                                        </div>

                                        <!-- Tombol untuk melihat lebih banyak ulasan -->
                                        <button class="btn btn-outline-primary mt-2" id="toggleReviewsBtn">Lihat Ulasan
                                            Lainnya</button>
                                    <?php } else { ?>
                                        <!-- Tampilkan pesan jika tidak ada ulasan -->
                                        <div class="alert alert-info mt-2 text-center" role="alert">
                                            Tidak ada ulasan untuk buku ini.
                                        </div>
                                    <?php } ?>
                                </div>


                            </div>
                        </div>
                    </div>

                </div>
                <?php include "../../include/footer.php"; ?>
            </div>
        </div>
    </div>





    <script>
        // Menangani aksi untuk menampilkan lebih banyak ulasan
        const toggleReviewsBtn = document.getElementById("toggleReviewsBtn");
        let isReviewsExpanded = false;

        toggleReviewsBtn.addEventListener("click", function () {
            const reviewContainer = document.querySelector(".review-container");

            if (isReviewsExpanded) {
                reviewContainer.style.maxHeight = "200px";  // Menyembunyikan ulasan tambahan
                toggleReviewsBtn.textContent = "Lihat Ulasan Lainnya";
            } else {
                reviewContainer.style.maxHeight = "none";  // Menampilkan semua ulasan
                toggleReviewsBtn.textContent = "Sembunyikan Ulasan";
            }

            isReviewsExpanded = !isReviewsExpanded;
        });
    </script>


    <?php include "./include/js.php"; ?>
</body>

</html>