<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css">
  <link rel="stylesheet" href="../../assets/vendor/boxicons/css/boxicons.min.css">
  <link rel="stylesheet" href="../../assets/vendor/quill/quill.snow.css">
  <link rel="stylesheet" href="../../assets/vendor/quill/quill.bubble.css">
  <link rel="stylesheet" href="../../assets/vendor/remixicon/remixicon.css">
  <link rel="stylesheet" href="../../assets/vendor/simple-datatables/style.css">
  <link rel="stylesheet" href="../../assets/vendor/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/tabs_admin.css">
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
      <ul id="nav-tabs">
        <li><a href="#">Data Buku</a>
            <section style="max-height: 500px; overflow-y: auto;">
              <div class="card mb-4">
                <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                  <h4 class="m-0 font-weight-bold text-primary">Data Buku</h4>
                  <!-- Button to Open the Modal -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#bookModal">
                        Tambah Buku
                  </button>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover1">
                    <thead class="bg-primary text-white">
                      <tr>
                        <th>No</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
                        <th>Tahun Terbit</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>Sang Pemimpi</td>
                        <td>Andrea Hirata</td>
                        <td>Bentang Pustaka</td>
                        <td>2006</td>
                        <td>Novel, Fiksi</td>
                        <td>
                          <a onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="delete_books.php?=<?= $data[''] ?>" class="btn btn-outline-danger d-flex justify-content-center">
                            <i class="bi bi-trash"></i>
                          </a>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Kiat Menulis Karya Ilmiah</td>
                        <td>Diah Erna Triningsih</td>
                        <td>PT Intan Pariwara</td>
                        <td>2008</td>
                        <td>Pendidikan</td>
                        <td>
                        <a onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="delete_books.php?kode_barang=<?= $data['kode_barang'] ?>" class="btn btn-outline-danger d-flex justify-content-center">
                            <i class="bi bi-trash"></i>
                          </a>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['kode_barang']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>Negeri di Ujung Tanduk</td>
                        <td>Tere Liye</td>
                        <td>Gramedia Pustaka Utama</td>
                        <td>2013</td>
                        <td>Novel, Fiksi</td>
                        <td>
                        <a onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="delete_books.php?kode_barang=<?= $data['kode_barang'] ?>" class="btn btn-outline-danger d-flex justify-content-center">
                            <i class="bi bi-trash"></i>
                          </a>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['kode_barang']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Sejarah Diplomasi Indonesia</td>
                        <td>Irawan</td>
                        <td>Gramedia Pustaka Utama</td>
                        <td>2013</td>
                        <td>Pendidikan, Sejarah</td>
                        <td>
                        <a onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="delete_books.php?kode_barang=<?= $data['kode_barang'] ?>" class="btn btn-outline-danger d-flex justify-content-center">
                            <i class="bi bi-trash"></i>
                          </a>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['kode_barang']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Pulang</td>
                        <td>Tere Liye</td>
                        <td>Republika Penerbit</td>
                        <td>2015</td>
                        <td>Novel, Fiksi</td>
                        <td>
                        <a onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="delete_books.php?kode_barang=<?= $data['kode_barang'] ?>" class="btn btn-outline-danger d-flex justify-content-center">
                            <i class="bi bi-trash"></i>
                          </a>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['kode_barang']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>Negeri Para Bedebah</td>
                        <td>Tere Liye</td>
                        <td>Gramedia Pustaka Utama</td>
                        <td>2012</td>
                        <td>Novel, Fiksi</td>
                        <td>
                        <a onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="delete_books.php?kode_barang=<?= $data[''] ?>" class="btn btn-outline-danger d-flex justify-content-center">
                            <i class="bi bi-trash"></i>
                          </a>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
        </section>
    </li>

  <li><a href="#">Data Review</a>
  <section style="max-height: 500px; overflow-y: auto;">
  <div class="card mb-4">
                <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                  <h4 class="m-0 font-weight-bold text-primary">Data Review</h4>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover2">
                    <thead class="bg-primary text-white">
                      <tr>
                        <th>No</th>
                        <th>ID Peminjaman</th>
                        <th>ID Buku</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Waktu Ulasan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>1209192</td>
                        <td>P001</td>
                        <td>5</td>
                        <td>Y</td>
                        <td>-</td>
                        <td>
                          <a onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="delete_books.php?=<?= $data[''] ?>" class="btn btn-outline-danger d-flex justify-content-center">
                            <i class="bi bi-trash"></i>
                          </a>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>19218032</td>
                        <td>P002</td>
                        <td>3</td>
                        <td>G</td>
                        <td>-</td>
                        <td>
                        <a onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="delete_books.php?kode_barang=<?= $data['kode_barang'] ?>" class="btn btn-outline-danger d-flex justify-content-center">
                            <i class="bi bi-trash"></i>
                          </a>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['kode_barang']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>23902903</td>
                        <td>P003</td>
                        <td>4</td>
                        <td>ok</td>
                        <td>-</td>
                        <td>
                        <a onclick="return confirm('Apakah Anda yakin ingin menghapus data?')" href="delete_books.php?kode_barang=<?= $data['kode_barang'] ?>" class="btn btn-outline-danger d-flex justify-content-center">
                            <i class="bi bi-trash"></i>
                          </a>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit<?php echo $data['kode_barang']; ?>">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </section>
  </li>
  </ul>

        <!-- include/footer.php -->
        <?php
        include "../../include/footer.php";
        ?>
    </div>
  </div>

  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>
  <script src="../../assets/js/off-canvas.js"></script>
  <script src="../../assets/js/hoverable-collapse.js"></script>
  <script src="../../assets/js/template.js"></script>
  <script src="../../assets/js/settings.js"></script>
  <script src="../../assets/js/todolist.js"></script>
  <script src="../../assets/js/file-upload.js"></script>
  <script src="../../assets/js/typeahead.js"></script>
  <script src="../../assets/js/select2.js"></script>
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>
  <script src="../../assets/js/main.js"></script>
  <script src="../../assets/js/tabs_admin.js"></script>
  <script src="../../assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover1').DataTable(); // ID From dataTable with Hover
      $('#dataTableHover2').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>
</html>