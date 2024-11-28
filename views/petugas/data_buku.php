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
                        <td>Kiat Menulis Karya Ilmiah</td>
                        <td>Diah Erna Triningsih</td>
                        <td>PT Intan Pariwara</td>
                        <td>2008</td>
                        <td>Pendidikan</td>
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
                        <td>Negeri di Ujung Tanduk</td>
                        <td>Tere Liye</td>
                        <td>Gramedia Pustaka Utama</td>
                        <td>2013</td>
                        <td>Novel, Fiksi</td>
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
                        <td>Sejarah Diplomasi Indonesia</td>
                        <td>Irawan</td>
                        <td>Gramedia Pustaka Utama</td>
                        <td>2013</td>
                        <td>Pendidikan, Sejarah</td>
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
                        <td>Pulang</td>
                        <td>Tere Liye</td>
                        <td>Republika Penerbit</td>
                        <td>2015</td>
                        <td>Novel, Fiksi</td>
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
                        <td>Negeri Para Bedebah</td>
                        <td>Tere Liye</td>
                        <td>Gramedia Pustaka Utama</td>
                        <td>2012</td>
                        <td>Novel, Fiksi</td>
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
                        <td>19218032</td>
                        <td>P002</td>
                        <td>3</td>
                        <td>G</td>
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
                        <td>3</td>
                        <td>23902903</td>
                        <td>P003</td>
                        <td>4</td>
                        <td>ok</td>
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

  <?php include "./include/js.php"; ?>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover1').DataTable(); // ID From dataTable with Hover
      $('#dataTableHover2').DataTable(); // ID From dataTable with Hover
    });
  </script>
</body>
<!-- The Modal -->
<div class="modal fade" id="bookModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Buku</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">
        <label>Judul Buku <small class="text-danger">*</small></label>
          <input type="text" name="judul" placeholder="Judul Buku" class="form-control" required>
          <br>
          <label>Penulis <small class="text-danger">*</small></label>
          <input type="text" name="penulis" placeholder="Penulis" class="form-control" required>
          <br>
          <label>Penerbit <small class="text-danger">*</small></label>
          <input type="text" name="penerbit" placeholder="Penerbit" class="form-control" required>
          <br>
          <label>Tahun Terbit <small class="text-danger">*</small></label>
          <input type="text" name="tahun_terbit" placeholder="Tahun Terbit" class="form-control" required>
          <br>
          <label>Kategori <small class="text-danger">*</small></label>
          <input type="text" name="kategori" placeholder="Kategori" class="form-control" required>
          <br>
          <button type="submit" class="btn btn-primary" name="addnewguru">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</html>