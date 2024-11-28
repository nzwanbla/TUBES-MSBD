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

      <!-- Tampilan main yang diubah tiap file -->
      <div class="col-lg-10">
              <div class="card mb-4">
                <div class="card-header py-4 d-flex flex-row align-items-center justify-content-between">
                  <h4 class="m-0 font-weight-bold text-primary">Laporan Data Peminjaman</h4>
                  <!-- <a href="" class="btn btn-primary">Ekspor ke Excel</a> -->
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="bg-primary text-white">
                      <tr>
                        <th>No</th>
                        <th>ID Peminjaman</th>
                        <th>Nama Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Jatuh Tempo</th>
                        <th>Status</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Denda</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>P001</td>
                        <td>Aldi</td>
                        <td>Sang Pemimpi</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>Dipinjam</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>P002</td>
                        <td>Laila</td>
                        <td>Sejarah Diplomasi Indonesia</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>Dikembalikan</td>
                        <td>08-11-2024</td>
                        <td>Rp. 0</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>P003</td>
                        <td>Putra</td>
                        <td>Negeri Para Bedebah</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>Terlambat</td>
                        <td>-</td>
                        <td>Rp. 10.000</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>P004</td>
                        <td>Mahen</td>
                        <td>Kiat Menulis Karya Ilmiah</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>Dipinjam</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>P005</td>
                        <td>Citra</td>
                        <td>Sang Pemimpi</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>Terlambat</td>
                        <td>-</td>
                        <td>Rp. 10.000</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit">
                              <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>P006</td>
                        <td>Budi</td>
                        <td>Pulang</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>Dikembalikan</td>
                        <td>07-11-2024</td>
                        <td>Rp. 0</td>
                        <td>
                        <button type="button" class="btn btn-outline-danger mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tombolhapus">
                             <i class="bi bi-trash"></i>
                           </button>
                            <button type="button" class="btn btn-outline-primary mt-2 d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#tomboledit">
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
        <!-- include/footer.php -->
        <?php
        include "../../include/footer.php";
        ?>
    </div>
  </div>

  <?php include "./include/js.php"; ?>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>

</html>