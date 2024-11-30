<?php

require './include/Petugas_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Petugas') {
    header("Location: ../login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku</title>
    <?php include "./include/css.php"; ?>


    <style>
        .star-rating {
            font-size: 1.5rem;
            /* Ukuran bintang */
            color: #ffcc00;
            /* Warna bintang terisi (kuning) */
        }

        .star {
            font-size: 1.5rem;
            /* Ukuran setiap bintang */
        }

        .star-rating .star:last-child {
            color: #d3d3d3;
            /* Warna bintang kosong (abu-abu) */
        }

        /* Styling untuk layout umum */
        .container-scroller {
            background-color: #f4f6f9;
        }

        .catalog-card {
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #fff;
        }

        /* Styling untuk baris buku dan ulasan */
        .book-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        /* Styling untuk kolom gambar */
        .col-md-4 {
            flex: 0 0 30%;
            max-width: 30%;
            padding-right: 20px;
        }

        /* Styling untuk kolom informasi buku */
        .col-md-8 {
            flex: 0 0 65%;
            max-width: 65%;
        }

        .catalog-card-img-container {
            text-align: center;
            margin-bottom: 15px;
        }

        .catalog-card-img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        /* Styling untuk detail buku */
        .catalog-card-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .catalog-card-author {
            font-size: 1.2rem;
            color: #555;
        }

        .catalog-card-text {
            font-size: 1rem;
            margin-top: 20px;
            color: #333;
            line-height: 1.5;
        }

        .catalog-card-info p {
            font-size: 1.1rem;
            color: #555;
        }

        /* Styling untuk bagian ulasan */
        .reviews-section {
            margin-top: 30px;
        }

        .review-container {
            max-height: 200px;
            overflow-y: auto;
            margin-bottom: 10px;
        }

        .review {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 0.9rem;
            color: #333;
        }

        .review-header {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .review-avatar {
            margin-right: 10px;
        }

        .review-avatar img.avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .review-info {
            display: flex;
            flex-direction: column;
        }

        .review-info strong {
            font-size: 1rem;
            color: #333;
        }

        .review-date {
            font-size: 0.9rem;
            color: #aaa;
        }

        .review-body {
            font-size: 1rem;
            color: #333;
            line-height: 1.5;
        }

        /* Styling untuk tombol lihat ulasan lainnya */
        #toggleReviewsBtn {
            display: block;
            margin: 0 auto;
            padding: 5px 15px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            border: none;
            text-align: center;
        }

        #toggleReviewsBtn:hover {
            background-color: #0056b3;
            cursor: pointer;
        }

        /* Responsif untuk ukuran layar kecil */
        @media (max-width: 768px) {
            .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
                padding-right: 0;
            }

            .col-md-8 {
                flex: 0 0 100%;
                max-width: 100%;
            }

            .review-avatar img.avatar {
                width: 40px;
                height: 40px;
            }

            .review-body {
                font-size: 1rem;
            }
        }
    </style>






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
                                    <div class="col-md-3">
                                        <div class="catalog-card-img-container">
                                            <img src="../../assets/images/perpus.png" alt="Book Image"
                                                class="catalog-card-img">
                                        </div>
                                    </div>

                                    <!-- Kolom Informasi Utama Buku (Tengah) -->
                                    <div class="col-md-5">
                                        <h2 class="catalog-card-title">Nama Buku</h2>
                                        <p class="catalog-card-author"><strong>Penulis:</strong> John Doe</p>
                                        <p><strong>No ISBN:</strong> 978-3-16-148410-0</p>
                                        <p><strong>Genre:</strong> Biologi, Sains</p>
                                        <p><strong>Tahun Terbit:</strong> 2022</p>
                                        <p><strong>Penerbit:</strong> Penerbit ABC</p>
                                        <p><strong>Ketersediaan:</strong> Tersedia (10 Buku)</p>
                                        <!-- Informasi Ketersediaan -->
                                    </div>

                                    <!-- Kolom Informasi Tambahan (Kanan) -->
                                    <div class="col-md-4">
                                        <!-- Menambahkan jarak kosong di atas -->
                                        <div class="mb-4"></div>

                                        <!-- Rating dengan model bintang -->
                                        <div class="catalog-card-rating">
                                            <strong>Rating:</strong>
                                            <!-- Menampilkan bintang berdasarkan rating -->
                                            <span class="star-rating">
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9733;</span>
                                                <span class="star">&#9734;</span> <!-- Bintang kosong -->
                                            </span>
                                            <span> 4.5/5</span>
                                        </div>

                                        <!-- Jumlah dipinjam dan ulasan -->
                                        <div class="catalog-card-voter">
                                            <strong>Jumlah Dipinjam:</strong> 120 kali
                                            <br>
                                            <strong>Jumlah Ulasan:</strong> 120 orang
                                        </div>
                                    </div>

                                </div>


                                <p class="catalog-card-text mt-3">
                                    Sinopsis: Buku ini menjelaskan tentang konsep-konsep dasar dalam biologi dan
                                    kehidupan makhluk hidup, dengan pembahasan mendalam mengenai sel, ekosistem, dan
                                    organisme.
                                </p>

                                <!-- Ulasan Buku -->
                                <div class="reviews-section mt-4">
                                    <h5><strong>Ulasan Buku</strong></h5>

                                    <!-- Ulasan Buku -->
                                    <div class="review-container">
    <div class="review">
        <div class="review-header">
            <div class="review-avatar">
                <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="avatar">
            </div>
            <div class="review-info">
                <strong>Jane Smith</strong>
                <p class="review-date">10 Januari 2023</p>
            </div>
        </div>
        <div class="review-body">
            <p>Buku ini sangat informatif dan mudah dipahami. Saya sangat merekomendasikan untuk pemula yang tertarik mempelajari biologi.</p>
        </div>
        <!-- Rating Bintang -->
        <div class="review-rating">
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9734;</span> <!-- Bintang kosong -->
            <span> 4/5</span>
        </div>
    </div>

    <div class="review">
        <div class="review-header">
            <div class="review-avatar">
                <img src="https://www.w3schools.com/w3images/avatar2.png" alt="Avatar" class="avatar">
            </div>
            <div class="review-info">
                <strong>Albert Einstein</strong>
                <p class="review-date">15 Januari 2023</p>
            </div>
        </div>
        <div class="review-body">
            <p>Menurut saya, buku ini memiliki penjelasan yang mendalam, tetapi cukup mudah dimengerti oleh pembaca.</p>
        </div>
        <!-- Rating Bintang -->
        <div class="review-rating">
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9733;</span>
            <span class="star">&#9734;</span>
            <span class="star">&#9734;</span> <!-- Bintang kosong -->
            <span> 3/5</span>
        </div>
    </div>
</div>


                                    <!-- Tombol untuk melihat lebih banyak ulasan -->
                                    <button class="btn btn-outline-primary mt-2" id="toggleReviewsBtn">Lihat Ulasan
                                        Lainnya</button>
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