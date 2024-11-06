<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="../../admin.php"><img src="../../images/Logo-SMAN2.svg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="../../admin.php"><img src="../../images/Logo-SMAN2.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../../images/admin.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="../../images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../admin.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Tambah Buku</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="../../pages/books/add_books.php">Add Books</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Tambah User</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../pages/tables/basic-table.html">Basic table</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Riwayat</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../pages/icons/mdi.html">Mdi icons</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../pages/documentation/documentation.html">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
        <partial:../../partials/_footer.html>
        
        <section class="section">
          <div class="row">
              <div>
                  <div class="card">
                      <div class="card-body">
                          <!-- Button trigger modal -->
                          <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                              <i class="bi bi-plus-circle"> Add Products</i>
                          </button>

                          <!-- Modal -->
                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalLabel"> Add Products</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <form class="row" action="this_add_books.php" method="POST" enctype="multipart/form-data" id="forma">
                                              <div class="col-12">
                                                  <label for="kodebrg" class="form-label">Kode barang</label>
                                                  <input type="text" class="form-control" id="kodebrg" name="kode_barang" required>
                                              </div>
                                              <div class="col-12">
                                                  <label for="nama_barang" class="form-label">Nama Barang</label>
                                                  <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
                                              </div>
                                              <div class="col-12">
                                                  <label for="gbr" class="form-label">Gambar Barang</label>
                                                  <input type="file" class="form-control" id="gbr" name="gambar" required>
                                              </div>
                                              <div class="col-12">
                                                  <label for="hargasli" class="form-label">Harga Asli</label>
                                                  <input type="number" class="form-control" id="hargasli" name="harga_asli" required>
                                              </div>
                                              <div class="col-12">
                                                  <label for="hargajual" class="form-label">Harga Jual</label>
                                                  <input type="number" class="form-control" id="hargajual" name="harga_jual" required>
                                              </div>
                                              <div class="col-12">
                                                  <label for="kategori" class="form-label">Kategori</label>
                                                  <select name="kategori" id="kategori" class="form-control" required>
                                                      <option value="#">--Pilih kategori barang--</option>
                                                      <option value="facialWash">Facial Wash</option>
                                                      <option value="moisturizer">Moisturizer</option>
                                                      <option value="toner">Toner</option>
                                                      <option value="bodyWash">Body Wash</option>
                                                      <option value="bodyLotion">Body Lotion</option>
                                                      <option value="Others">Others</option>
                                                  </select>
                                              </div>
                                              <div class="col-12">
                                                  <label for="skicarega" class="form-label">Skincare / Nonskincare</label>
                                                  <select name="skincareorno" id="skicarega" form="forma" class="form-control" required>
                                                      <option value="#">--Skincare atau Nonskincare--</option>
                                                      <option value="Skincare">Skincare</option>
                                                      <option value="Nonskincare">Nonskincare</option>
                                                  </select>
                                              </div>
                                              <div class="text-center">
                                                  <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                              </div>
                                          </form><!-- Vertical Form -->
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- Bordered Table -->
                          <div class="table-responsive">
                              <table class="table table-bordered mt-3">
                                  <thead>
                                      <tr style="text-align:center">
                                          <th scope="col">No</th>
                                          <th scope="col">Kode Barang</th>
                                          <th scope="col">Nama Barang</th>
                                          <th scope="col">Harga Asli</th>
                                          <th scope="col">Harga Jual</th>
                                          <th scope="col">Gambar</th>
                                          <th scope="col">Kategori</th>
                                          <th scope="col">Skincare / Nonskincare</th>
                                          <th scope="col">Aksi</th>

                                      </tr>
                                  </thead>
                                  <tbody>
                                      <?php
                                      $host = 'localhost';
                                      $user = 'root';
                                      $pass = '';
                                      $database = 'becare';

                                      $conn = mysqli_connect($host, $user, $pass, $database);
                                      // $query = "SELECT * FROM barang";
                                      // $sql =mysqli_query($conn,$query);

                                      $limit = 5;
                                      $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                      $halaman_awal = ($halaman > 1) ? ($halaman * $limit) - $limit : 0;

                                      $sebelumnya = $halaman - 1;
                                      $selanjutnya = $halaman + 1;
                                      // menghitung jumlah data keseluruhan

                                      $query = mysqli_query($conn, "SELECT * FROM barang");
                                      $jlh_data = mysqli_num_rows($query);

                                      // menghitung jumlah halaman

                                      $jlh_halaman = ceil($jlh_data / $limit);
                                      $hal_akhir = $jlh_halaman;
                                      $query2 = "SELECT * FROM barang LIMIT $halaman_awal, $limit";
                                      $hasil2 = mysqli_query($conn, $query2);

                                      $no = $halaman_awal + 1;
                                      while ($data = mysqli_fetch_array($hasil2)) {
                                      ?>


                                          <tr>
                                              <th scope="row"><?= $no++ ?></th>
                                              <td><?= $data['kode_barang'] ?></td>
                                              <td><?= $data['nama_barang'] ?></td>
                                              <td><?= $data['harga_asli'] ?></td>
                                              <td><?= $data['harga_jual'] ?></td>
                                              <td><img src="uploads/<?php echo $data['gambar']; ?>" width=40></td>
                                              <td><?= $data['kategori'] ?></td>
                                              <td><?= $data['skincareorno'] ?></td>
                                              <td>
                                                  <a onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="deleteproducts.php?kode_barang=<?= $data['kode_barang'] ?>" class="btn btn-outline-danger d-flex justify-content-center">
                                                      <i class="bi bi-trash"></i>
                                                  </a>
                                                  <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['kode_barang']; ?>">
                                                      <i class="bi bi-pencil"></i>
                                                  </button>
                                              </td>
                                          </tr>
                                  </tbody>
                                  <!-- Modal -->
                                  <div class="modal fade" id="tomboledit<?php echo $data['kode_barang']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <h1 class="modal-title fs-5" id="exampleModalLabel"> Edit Products</h1>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body">

                                                  <form class="row" action="editproducts.php" method="POST" enctype="multipart/form-data">

                                                      <div class="col-12">
                                                          <label for="kodebrg" class="form-label">Kode barang</label>
                                                          <input type="text" class="form-control" id="kodebrg" name="kode_barang" required value="<?= $data['kode_barang'] ?>" readonly>
                                                      </div>
                                                      <div class="col-12">
                                                          <label for="nama_barang" class="form-label">Nama Barang</label>
                                                          <input type="text" class="form-control" id="nama_barang" name="nama_barang" required value="<?= $data['nama_barang'] ?>">
                                                      </div>
                                                      <div class="col-12">
                                                          <label for="gbr" class="form-label">Gambar Barang</label>
                                                          <input type="file" class="form-control" id="gbr" name="gambar">
                                                      </div>
                                                      <div class="col-12">
                                                          <label for="hargasli" class="form-label">Harga Asli</label>
                                                          <input type="number" class="form-control" id="hargasli" name="harga_asli" required value="<?= $data['harga_asli'] ?>">
                                                      </div>
                                                      <div class="col-12">
                                                          <label for="hargajual" class="form-label">Harga Jual</label>
                                                          <input type="number" class="form-control" id="hargajual" name="harga_jual" required value="<?= $data['harga_jual'] ?>">
                                                      </div>
                                                      <div class="col-12">
                                                          <label for="kategori" class="form-label">Kategori</label>
                                                          <select name="kategori" id="kategori" class="form-control" required>
                                                              <option value="#">--Pilih kategori barang--</option>
                                                              <option value="facialWash" <?php echo ($data['kategori'] == "facialWash") ? 'selected' : ''; ?>>Facial Wash</option>
                                                              <option value="moisturizer" <?php echo ($data['kategori'] == "moisturizer") ? 'selected' : ''; ?>>Moisturizer</option>
                                                              <option value="toner" <?php echo ($data['kategori'] == "toner") ? 'selected' : ''; ?>>Toner</option>
                                                              <option value="bodyWash" <?php echo ($data['kategori'] == "bodyWash") ? 'selected' : ''; ?>>Body Wash</option>
                                                              <option value="bodyLotion" <?php echo ($data['kategori'] == "bodyLotion") ? 'selected' : ''; ?>>Body Lotion</option>
                                                              <option value="Others" <?php echo ($data['kategori'] == "Others") ? 'selected' : ''; ?>>Others</option>
                                                          </select>
                                                      </div>

                                                      <div class="col-12">
                                                          <label for="skicarega" class="form-label">Skincare / Nonskincare</label>
                                                          <select name="skincareorno" id="skicarega" class="form-control" required>
                                                              <?php
                                                              foreach ($skincareorno as $fon) {
                                                                  echo "<option value = '$fon'";
                                                                  echo $data['skincareorno'] == $fon ? 'selected="selected"' : '';
                                                                  echo ">$fon</option>";
                                                              }
                                                              ?>
                                                              <option value="#">--Skincare atau Nonskincare--</option>
                                                              <option <?php if ($data['skincareorno'] == "Skincare") {
                                                                          echo "selected";
                                                                      } ?>>Skincare</option>
                                                              <option <?php if ($data['skincareorno'] == "Nonskincare") {
                                                                          echo "selected";
                                                                      } ?>>Nonskincare</option>
                                                          </select>
                                                      </div>
                                                      <div class="text-center">
                                                          <button type="submit" class="btn btn-primary mt-3" name="submit">Submit</button>
                                                      </div>

                                                  </form><!-- Vertical Form -->
                                              </div>
                                          </div>

                                      </div>
                                  </div>
                              <?php } ?>
                              </tbody>
                              </table>
                          </div>
                          <!-- End Bordered Table -->
                          <nav aria-label="...">
                              <ul class="pagination justify-content-center">
                                  <li class="page-item">
                                      <a class="page-link" href="?halaman=<?php echo $sebelumnya; ?>" tabindex="-1" tabindex="-1">Previous</a>
                                  </li>

                                  <?php
                                  for ($i = 1; $i <= $jlh_halaman; $i++) {
                                      echo "<li class='page-item'><a class='page-link' href='?halaman=$i'>$i</a></li>";
                                  }
                                  ?>

                                  <a class="page-link" href="?halaman=<?php echo $selanjutnya; ?>">Next</a>
                                  </li>
                                  <li class="page-item">
                                      <a class="page-link" href="?halaman=<?php echo $jlh_halaman; ?>">Last Page</a>
                                  </li>
                              </ul>
                          </nav>
                      </div>
                  </div>
              </div>
          </div>


      </section>

      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  
  <!-- End custom js for this page-->
</body>

</html>
