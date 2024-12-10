<?php

require './include/Pengunjung_function.php';

if (empty($_SESSION['username']) or $_SESSION['status'] != 'Pengunjung') {
    header("Location: ./error-403.php");
}

$res = getDataBooksLim(6);
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
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                                id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">
                                                <i class="mdi mdi-calendar"></i> Today (5 Nov 2024)
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuDate2">
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
                                    <img src="../../assets/images/dashboard/people2.jpeg" alt="people">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 grid-margin transparent">
                            <div class="row">
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-tale">
                                        <div class="card-body">
                                            <p class="mb-4">Riwayat Peminjaman</p>
                                            <p class="fs-30 mb-2">1</p>
                                            <p>10.00% (30 days)</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Ulasan Buku Hari ini</p>
                                            <p class="fs-30 mb-2">2</p>
                                            <p>22.00% (30 days)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                                    <div class="card card-light-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Notifikasi Pengingat</p>
                                            <p class="fs-30 mb-2">4</p>
                                            <p>2.00% (30 days)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title mb-2 text-center">Review Buku</p>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-borderless">
                                            <thead>
                                                </tbody>
                                        </table>

                                        <div class="container1">
                                            <!--kartu buku pertama-->
                                            <div class="card">
                                                <img src="https://via.placeholder.com/100x150"
                                                    alt="Cover buku Chances Are">
                                                <div class="card-details">
                                                    <div class="card-title">Chances Are</div>
                                                    <div class="card-author">oleh Richard Russo</div>
                                                    <div class="card-rating">
                                                        <span class="stars">★★★★★</span>
                                                        <span class="votes">1,237 ulasan</span>
                                                    </div>
                                                    <div class="card-description">
                                                        Bestseller sepanjang masa dengan cerita yang penuh keindahan dan
                                                        mendalam.
                                                    </div>
                                                    <div class="profile-likes">
                                                        <img src="images/faces/face1.jpg" class="profile-pic"
                                                            alt="Profil 1">
                                                        <img src="images/faces/face2.jpg" class="profile-pic"
                                                            alt="Profil 2">
                                                        <img src="images/faces/face3.jpg" class="profile-pic"
                                                            alt="Profil 3">
                                                        <span class="like-text">Dina dan 2 lainnya menyukai ini</span>
                                                    </div>
                                                </div>
                                                <div class="menu" onclick="toggleMenu()">⋮</div>
                                                <div class="menu-options" id="menu-options">
                                                    <div onclick="openPopup()">Ulasan</div>
                                                    <div onclick="goToDetail()">Detail</div>
                                                </div>
                                            </div>

                                            <div class="container1">
                                                <!--kartu buku kedua-->
                                                <div class="card">
                                                    <img src="https://via.placeholder.com/100x150"
                                                        alt="Cover buku Chances Are">
                                                    <div class="card-details">
                                                        <div class="card-title">Chances Are</div>
                                                        <div class="card-author">oleh Richard Russo</div>
                                                        <div class="card-rating">
                                                            <span class="stars">★★★★★</span>
                                                            <span class="votes">1,237 ulasan</span>
                                                        </div>
                                                        <div class="card-description">
                                                            Bestseller sepanjang masa dengan cerita yang penuh keindahan
                                                            dan mendalam.
                                                        </div>
                                                        <div class="profile-likes">
                                                            <img src="images/faces/face4.jpg" class="profile-pic"
                                                                alt="Profil 1">
                                                            <img src="images/faces/face2.jpg" class="profile-pic"
                                                                alt="Profil 2">
                                                            <img src="images/faces/face3.jpg" class="profile-pic"
                                                                alt="Profil 3">
                                                            <span class="like-text">Dina dan 2 lainnya menyukai
                                                                ini</span>
                                                        </div>
                                                    </div>
                                                    <div class="menu" onclick="toggleMenu()">⋮</div>
                                                    <div class="menu-options" id="menu-options">
                                                        <div onclick="openPopup()">Ulasan</div>
                                                        <div onclick="goToDetail()">Detail</div>
                                                    </div>
                                                </div>


                                                <!-- Overlay dan Popup untuk Ulasan -->
                                                <div class="overlay" onclick="closePopup()"></div>
                                                <div class="popup" id="popup">
                                                    <p>Bagikan ulasan Anda tentang buku ini. Apa yang Anda suka atau
                                                        tidak suka?</p>
                                                    <button onclick="closePopup()">Tutup</button>
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
                                                    <img src="<?= $book['foto_buku'] ?>" alt="<?= $book['judul'] ?>"
                                                        class="book-photo">
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