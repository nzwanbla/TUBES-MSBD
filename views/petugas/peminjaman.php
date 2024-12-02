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
                  <h4 class="m-0 font-weight-bold text-primary">Data Peminjaman Buku</h4>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                        Tambah Peminjaman
                    </button>
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
                        <th>Tanggal Pengembalian</th>
                        <th>Denda</th>
                        <th>Status</th>
                        <th>Petugas</th>
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
                        <td>-<td>
                        <td>Dipinjam</td>
                        <td>-</td>
                        <td>
                          <a href="" class="badge badge-danger">Hapus</a>
                          <a href="" class="badge badge-success">Edit</a>
                          <a href="" class="badge badge-warning">Perpanjang</a>
                          <a href="" class="badge badge-info">Kembalikan</a>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>P002</td>
                        <td>Laila</td>
                        <td>Sejarah Diplomasi Indonesia</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>08-11-2024</td>
                        <td>Rp. 0</td>
                        <td>Dikembalikan</td>
                        <td>-</td>
                        <td>
                          <a href="" class="badge badge-danger">Hapus</a>
                          <a href="" class="badge badge-success">Edit</a>
                          <a href="" class="badge badge-warning">Perpanjang</a>
                          <a href="" class="badge badge-info">Kembalikan</a>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>P003</td>
                        <td>Putra</td>
                        <td>Negeri Para Bedebah</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>-</td>
                        <td>Rp. 10.000</td>
                        <td>Terlambat</td>
                        <td>-</td>
                        <td>
                          <a href="" class="badge badge-danger">Hapus</a>
                          <a href="" class="badge badge-success">Edit</a>
                          <a href="" class="badge badge-warning">Perpanjang</a>
                          <a href="" class="badge badge-info">Kembalikan</a>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>P004</td>
                        <td>Mahen</td>
                        <td>Kiat Menulis Karya Ilmiah</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>-</td>
                        <td>-</td>
                        <td>Dipinjam</td>
                        <td>-</td>
                        <td>
                          <a href="" class="badge badge-danger">Hapus</a>
                          <a href="" class="badge badge-success">Edit</a>
                          <a href="" class="badge badge-warning">Perpanjang</a>
                          <a href="" class="badge badge-info">Kembalikan</a>
                        </td>
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>P005</td>
                        <td>Citra</td>
                        <td>Sang Pemimpi</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>-</td>
                        <td>Rp. 10.000</td>
                        <td>Terlambat</td>
                        <td>-</td>
                        <td>
                          <a href="" class="badge badge-danger">Hapus</a>
                          <a href="" class="badge badge-success">Edit</a>
                          <a href="" class="badge badge-warning">Perpanjang</a>
                          <a href="" class="badge badge-info">Kembalikan</a>
                        </td>
                      </tr>
                      <tr>
                        <td>6</td>
                        <td>P006</td>
                        <td>Budi</td>
                        <td>Pulang</td>
                        <td>01-11-2024</td>
                        <td>08-11-2024</td>
                        <td>07-11-2024</td>
                        <td>Rp. 0</td>
                        <td>Dikembalikan</td>
                        <td>-</td>
                        <td>
                          <a href="" class="badge badge-danger">Hapus</a>
                          <a href="" class="badge badge-success">Edit</a>
                          <a href="" class="badge badge-warning">Perpanjang</a>
                          <a href="" class="badge badge-info">Kembalikan</a>
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

<?php
    $tujuhHariMendatang = strtotime("+7 days");
    $jatuhTempo = date("Y-m-d", $tujuhHariMendatang);
?>
<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Data Peminjaman</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">
        <label>ID Peminjaman <small class="text-danger">*</small></label>
          <input type="text" name="id_peminjaman" placeholder="ID Peminjaman" class="form-control" required>
          <br>
          <label>Nama Peminjam <small class="text-danger">*</small></label>
          <input type="text" name="nama_peminjam" placeholder="Nama Peminjam" class="form-control" required>
          <br>
          <label>Pilih Buku <small class="text-danger">*</small></label>
          <select name="id_buku" class="form-control form-control-sm" required>
            <option value=""> - Id Buku / Judul Buku - </option>
            <?php
              foreach ($buku as $row) {?>
                <option value="<?= $row->id_buku;?>"> <?= $row->id_buku;?> / <?= $row->judul?></option>
              <?php }
            ?>
          </select>
          <br>
          <label>Tanggal Peminjaman <small class="text-danger">*</small></label>
          <input type="text" name="waktu_peminjaman" value="<?=date('Y-m-d');?>" placeholder="Tanggal Peminjaman" class="form-control" readonly>
          <br>
          <label>Jatuh Tempo <small class="text-danger">*</small></label>
          <input type="text" name="waktu_pengembalian" value="<?= $jatuhTempo;?>" placeholder="Jatuh Tempo" class="form-control" readonly>
          <br>
          <label>Tanggal Pengembalian <small class="text-danger">*</small></label>
          <input type="text" name="tanggal_pengembalian" placeholder="Tanggal Pengembalian" class="form-control" required>
          <br>
          <label>Denda <small class="text-danger">*</small></label>
          <input type="text" name="denda" placeholder="Denda" class="form-control" required>
          <br>
          <label>Status <small class="text-danger">*</small></label>
          <input type="text" name="status" placeholder="Status" class="form-control" required>
          <br>
          <label>Petugas <small class="text-danger">*</small></label>
          <input type="text" name="petugas" placeholder="Petugas" class="form-control" required>
          <br>
          <button type="submit" class="btn btn-primary" name="addnewguru">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
</html>