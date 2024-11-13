<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard User</title>
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../../assets/js/select.dataTables.min.css" type="text/css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="../../assets/css/font-awesome.css">
    <link rel="stylesheet" href="../../assets/css/card.css">
    <link rel="stylesheet" href="../../assets/css/flickity.css">
    <link rel="stylesheet" href="../../assets/css/flickity.min.css">

    <!-- partial:partials/_navbar.html
     <link rel="stylesheet" href="../assets/css/style_user.css">
    -->

    <link rel="shortcut icon" href="../../assets/images/favicon.png" />

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
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Selamat Datang, Safna</h3>
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
                                    <img src="../../assets/images/dashboard/people2.png" alt="people">
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

                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="card-title mb-2 text-center">Katalog Buku</p>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-borderless">
                                                        <thead>
                                                            <tr>
                                                                <th>Buku</th>
                                                                <th>Penulis</th>
                                                                <th>Tahun Terbit</th>
                                                                <th>ISBN</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Search Engine Marketing</td>
                                                                <td class="font-weight-bold">zzz</td>
                                                                <td>21 Sep 2018</td>
                                                                <td>913808392</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Search Engine Optimization</td>
                                                                <td class="font-weight-bold">aaa</td>
                                                                <td>13 Jun 2018</td>
                                                                <td>913808392</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Display Advertising</td>
                                                                <td class="font-weight-bold">bbb</td>
                                                                <td>28 Sep 2018</td>
                                                                <td>913808392</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Pay Per Click Advertising</td>
                                                                <td class="font-weight-bold">ccc</td>
                                                                <td>30 Jun 2018</td>
                                                                <td>913808392</td>
                                                            </tr>
                                                            <tr>
                                                                <td>E-Mail Marketing</td>
                                                                <td class="font-weight-bold">ddd</td>
                                                                <td>01 Nov 2018</td>
                                                                <td>913808392</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Referral Marketing</td>
                                                                <td class="font-weight-bold">eee</td>
                                                                <td>20 Mar 2018</td>
                                                                <td>913808392</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Social media marketing</td>
                                                                <td class="font-weight-bold">fff</td>
                                                                <td>26 Oct 2018</td>
                                                                <td>913808392</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- include footer -->
                <?php
                include "./include/footer.php";
                ?>
            </div>

        </div>

    </div>



    <script src="../../vendors/js/vendor.bundle.base.js"></script>
    <script src="../../vendors/chart.js/Chart.min.js"></script>
    <script src="../../vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="../../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="../../assets/js/dataTables.select.min.js"></script>
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/template.js"></script>
    <script src="../../assets/js/settings.js"></script>
    <script src="../../assets/js/todolist.js"></script>
    <script src="../../assets/js/dashboard.js"></script>
    <script src="../../assets/js/Chart.roundedBarCharts.js"></script>
    <script src="../../assets/js/flickity.pkgd.min.js"></script>
    <script src="../../assets/js/flickity.pkgd.js"></script>
    <script src="../../assets/js/review_book.js"></script>

</body>

</html>